<?php

namespace App\Http\Controllers;

use App\Models\LoanGuarantor;
use Illuminate\Http\Request;

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
        $loanGuarantor->status = LoanGuarantor::APPROVE;
        $loanGuarantor->save();
    }

    public function reject($loanGuarantorId){
        $loanGuarantor = LoanGuarantor::where('id', $loanGuarantorId)->first();
        if(!$loanGuarantor){
            abort(404);
        }
        $loanGuarantor->status = LoanGuarantor::REJECT;
        $loanGuarantor->save();
    }
}
