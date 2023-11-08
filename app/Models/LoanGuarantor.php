<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanGuarantor extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const APPROVE = 'approve';
    const REJECT = 'reject';

    protected $guarded = [];

    public function loan(){
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'mainone_id');
    }

    public function guarantor(){
        return $this->belongsTo(User::class, 'guarantor_id', 'mainone_id');
    }

}
