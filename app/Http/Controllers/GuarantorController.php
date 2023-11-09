<?php

namespace App\Http\Controllers;

use App\Mail\GuarantorApproval;
use App\Models\LoanGuarantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GuarantorController extends Controller
{
    public function index(){
        $guarantees = LoanGuarantor::where('guarantor_id', auth()->user()->mainone_id)->with(['loan', 'user', 'guarantor'])->get();
        return view('pages.guarantors.index', [
            'guarantees' => $guarantees
        ]);
    }

    public function show($id){

    }

    public function approve($loanGuarantorId){
        $loanGuarantor = LoanGuarantor::where('id', $loanGuarantorId)->first();
        if(!$loanGuarantor){
            abort(404);
        }
        $loanGuarantor->status = LoanGuarantor::APPROVED;
        $loanGuarantor->save();

        // notify loan requester
        $user = $loanGuarantor->user;
        $url = route('loans.show', ['loan' => $loanGuarantor->loan->id]);
        Mail::to($user->email)->send(new GuarantorApproval($user, $loanGuarantor->loan, $url, LoanGuarantor::APPROVED));
        return response()->json(['status' => 'success']);
    }

    public function reject($loanGuarantorId){
        $loanGuarantor = LoanGuarantor::where('id', $loanGuarantorId)->first();
        if(!$loanGuarantor){
            abort(404);
        }
        $loanGuarantor->status = LoanGuarantor::REJECTED;
        $loanGuarantor->save();

        // notify loan requester
        $user = $loanGuarantor->user;
        $url = route('loans.show', ['loan' => $loanGuarantor->loan->id]);
        Mail::to($user->email)->send(new GuarantorApproval($user, $loanGuarantor->loan, $url, LoanGuarantor::REJECTED));
        return response()->json(['status' => 'success']);
    }
}
