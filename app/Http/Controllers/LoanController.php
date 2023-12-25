<?php

namespace App\Http\Controllers;

use App\Mail\LoanApproval;
use App\Models\Loan;
use App\Models\LoanGuarantor;
use App\Models\Tenure;
use App\Models\User;
use App\Services\RepaymentScheduleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LoanController extends Controller
{
    /**
     * @var RepaymentScheduleService
     */
    private $repaymentScheduleService;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->user()->can('viewAny', Loan::class)){
            $loans = Loan::all();
        }else{
            $loans = Loan::where('user_id', auth()->user()->mainone_id)->get();
        }

        $activeLoan = Loan::where([
            'user_id' => $request->user()->mainone_id,
        ])->whereIn('status', [Loan::ACTIVE, Loan::PENDING])->count();

        return view('pages.loans.index', [
            'loans' => $loans,
            'hasActive' => $activeLoan > 0 // A user should not be able to request a new loan if there's an active or pending loan request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $users = User::with('wallet')
        ->where('mainone_id', '!=', $user->mainone_id)
        ->where('status', User::ACTIVE)
        ->orderBy('firstname', 'asc')
        ->orderBy('lastname', 'asc')
        ->get();
        $tenures = Tenure::all();
        return view('pages.loans.loan-new', [
            'users' => $users,
            'tenures' => $tenures
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            /**
             * @todo Validate request
             */
            $guarantors = $request->post('guarantors');
            $loan = $request->post('loan');
            $removeGuarantors = $request->post('remove');
            $deductFromMonthly = $request->post('deduct_monthly', true);

            DB::beginTransaction();
            $loanData = [
                'user_id' => auth()->user()->mainone_id,
                'loan_amount' => $loan['loan_amount'],
                'tenure' => $loan['tenure'],
                'interest' => 10,
                'monthly_deduction' => 12000,
                'deduct_from_monthly_contribution' => $deductFromMonthly
            ];

            //Insert or update Loan data
            if($loan['id']){
                Loan::where('id', $loan['id'])->update($loanData);
                $loan = Loan::where('id', $loan['id'])->first();
            }else{
                $loan = Loan::create($loanData);
            }

            /**
             * @todo Notify Guarantors
             */
            foreach($guarantors as $guarantor){
                //Insert or update LoanGuarantors
                if($guarantor['id']){
                    LoanGuarantor::where('id', $guarantor['id'])->update([
                        'guarantor_id' => $guarantor['guarantor_id'],
                        'amount' => $guarantor['amount']
                    ]);
                }else{
                    LoanGuarantor::create([
                        'loan_id' => $loan->id,
                        'user_id' => auth()->user()->mainone_id,
                        'guarantor_id' => $guarantor['guarantor_id'],
                        'amount' => $guarantor['amount'],
                    ]);
                }
            }

            if(!empty($removeGuarantors)){
                //delete LoanGuarantors
                LoanGuarantor::whereIn('id', $removeGuarantors)->delete();
            }

            DB::commit();
            $loanGuarantors = LoanGuarantor::where('loan_id', $loan->id)->get();
            /**
             * @todo Notify guarantors
             */
            return response()->json(['status' => 'success', 'loan' => $loan, 'loan_guarantors' => $loanGuarantors]);
        }catch(Exception $exception){
            DB::rollBack();
            report($exception);
            return response()->json(['status' => 'failure', 'msg' => $exception->getMessage()], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Loan $loan)
    {
        if($request->user()->cannot('view', $loan)){
            abort(403);
        }
        $loan = Loan::where('id', $loan->id)->first();
        $guarantors = LoanGuarantor::where('loan_id', $loan->id)->get();
        $user = auth()->user();
        $users = User::with('wallet')
        ->where('mainone_id', '!=', $user->mainone_id)
        ->where('status', User::ACTIVE)
        ->orderBy('firstname', 'asc')
        ->orderBy('lastname', 'asc')
        ->get();
        $tenures = Tenure::all();

        return view('pages.loans.loan-show', [
            'users' => $users,
            'loan' => $loan,
            'guarantors' => $guarantors,
            'tenures' => $tenures
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Loan $loan)
    {
        if($request->user()->cannot('update', $loan)){
            abort(403);
        }
        $loan = Loan::where('id', $loan->id)->first();
        $guarantors = LoanGuarantor::where('loan_id', $loan->id)->get();
        $user = auth()->user();
        $users = User::with('wallet')
        ->where('mainone_id', '!=', $user->mainone_id)
        ->where('status', User::ACTIVE)
        ->orderBy('firstname', 'asc')
        ->orderBy('lastname', 'asc')
        ->get();
        $tenures = Tenure::all();

        return view('pages.loans.loan-edit', [
            'users' => $users,
            'loan' => $loan,
            'guarantors' => $guarantors,
            'tenures' => $tenures
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteGuarantor($id){
        $status = LoanGuarantor::where('id', $id)->delete();
        return response()->json(['status' => $status]);
    }

    public function generatePaymentSchedule(Request $request, Loan $loan = null){
        $request->validate([
            'principal' => 'required|numeric',
            'interest' => 'required|numeric',
            'tenure' => 'required|numeric',
            'start_date' => 'nullable|date'
        ]);

        $principal = $request->post('principal');
        $interest = $request->post('interest');
        $tenure = $request->post('tenure');
        $startDate = $request->post('start_date');

        if($loan && $loan->approval_status == Loan::APPROVED){ // Loan has been approved. Get the repayment schedule already created
            $repaymentSchedules = $loan->repaymentSchedules;
            $monthlyPayment = $loan->monthly_deduction;
            $totalInterest = 0;
            foreach($repaymentSchedules as $schedule){
                $totalInterest += $schedule->interest;
            }
            $schedule = [
                'schedule' => $repaymentSchedules->toArray(),
                'total_interest' => round($totalInterest, 2),
                'monthly_payment' => $monthlyPayment
            ];

        }else{ // this is a preview. Generate a repayment schedule
            $repaymentScheduleService = $this->getRepaymentScheduleService();
            $schedule = $repaymentScheduleService->generateRepaymentSchedule($principal, $interest, $tenure, $startDate);
        }
        return response()->json(['status' => 'success', 'schedule' => $schedule]);
    }

    public function approveLoan(Request $request, Loan $loan){
        $request->validate([
            'effective_date' => 'nullable|date'
        ]);
        $effectiveDate = $request->post('effective_date', now()->toDateString());
        $loan->approval_status = Loan::APPROVED;
        $loan->effective_date = $effectiveDate;
        $loan->date_approved = now();
        $loan->status = Loan::ACTIVE;
        $loan->save();

        $repaymentScheduleService = $this->getRepaymentScheduleService();
        $schedule = $repaymentScheduleService->createRepaymentSchedule($loan);

        //notify user on approval
        Mail::to($loan->user->email)->send(new LoanApproval($loan));
        return response()->json(['status' => 'success', 'schedule' => $schedule, 'loan' => $loan]);
    }

    public function rejectLoan(Loan $loan){
        $loan->approval_status = Loan::REJECTED;
        $loan->status = Loan::INACTIVE;
        $loan->save();

        //notify user on approval
        Mail::to($loan->user->email)->send(new LoanApproval($loan));
        return response()->json(['status' => 'success', 'loan' => $loan]);
    }

    private function getRepaymentScheduleService(): RepaymentScheduleService{
        if($this->repaymentScheduleService){
            return $this->repaymentScheduleService;
        }
        $this->repaymentScheduleService = app()->make(RepaymentScheduleService::class);
        return $this->repaymentScheduleService;
    }
}
