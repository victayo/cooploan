<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepaymentSchedule extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const PAID = 'paid';
    const RESCHEDULED = 'rescheduled';

    protected $guarded = [];
}
