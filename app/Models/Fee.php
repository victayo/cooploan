<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    const MEMBERSHIP_FEE = 'membership_fee';
    const LOAN_PROCESSING_FEE = 'loan_processing_fee';

    protected $guarded = [];
}
