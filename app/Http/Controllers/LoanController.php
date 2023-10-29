<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanGuarantor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::where('user_id', auth()->user()->mainone_id)->get();
        return view('pages.loans.index', [
            'loans' => $loans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $users = User::where('mainone_id', '!=', $user->mainone_id)->get();
        return view('pages.loans.loan-new', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $guarantors = $request->post('guarantors');
            $loan = $request->post('loan');

            DB::beginTransaction();
            $loanData = [
                'user_id' => auth()->user()->mainone_id,
                'loan_amount' => $loan['loan_amount'],
                'tenure' => $loan['tenure'],
                'interest' => 10,
                'monthly_deduction' => 12000,
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
            DB::commit();
            $loanGuarantors = LoanGuarantor::where('loan_id', $loan->id)->get();
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $loan = Loan::where('id', $loan->id)->first();
        $guarantors = LoanGuarantor::where('loan_id', $loan->id)->get();
        $user = auth()->user();
        $users = User::where('mainone_id', '!=', $user->mainone_id)->get();

        return view('pages.loans.loan-edit', [
            'users' => $users,
            'loan' => $loan,
            'guarantors' => $guarantors
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
}
