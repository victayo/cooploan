<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const MONTHLY_CONTRIBUTION = 'Monthly Contribution';
    const WALLET_FUNDING = 'Wallet Funding';
    const JOINING_FEE = 'Joining Fee';
    const LOAN_PROCESSING_FEE = 'Loan Processing Fee';
    const LOAN_PAYMENT = 'Loan Payment';
    const LOAN_DEBIT = 'Loan Debit';
    const GUARANTOR_DEBIT = 'Guarantor Debit';
    const GUARANTOR_CREDIT = 'Guanrantor Credit';
    const DIVIDEND = 'Dividend';

    protected $guarded = [];
}
