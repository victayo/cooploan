<?php

namespace App\Services;

use App\Mail\GuarantorRequest;
use Illuminate\Support\Facades\Mail;

class LoanService extends Service{

    public function notifyGuarantors($loanGuarantors){
        foreach($loanGuarantors as $loanGuarantor){
            $email = $loanGuarantor->guarantor->email;
            $user = $loanGuarantor->user;
            $guarantor = $loanGuarantor->guarantor;
            $loan = $loanGuarantor->loan;
            $url = route('guarantor.show', ['id' => $loanGuarantor->id]);
            Mail::to($email)->send(new GuarantorRequest($user, $guarantor, $loan, $url));
        }
    }
}
