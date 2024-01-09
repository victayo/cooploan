<?php

namespace App\Services;

use App\Mail\GuarantorRequest;
use App\Models\Loan;
use App\Models\User;
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

    public function hasActiveLoan(User $user): bool{
        $activeLoan = Loan::where([
            'user_id' => $user->mainone_id,
        ])->whereIn('status', [Loan::ACTIVE, Loan::PENDING])->count();

        return boolval($activeLoan);
    }
}
