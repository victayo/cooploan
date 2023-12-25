<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';

    protected $guarded = [];

    public function getDateApprovedAttribute(){
        if($this->attributes['date_approved']){
            return Carbon::parse($this->attributes['date_approved']);
        }
        return '';
    }

    public function guarantors(){
        return $this->hasMany(LoanGuarantor::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'mainone_id');
    }

    public function repaymentSchedules(){
        return $this->hasMany(RepaymentSchedule::class);
    }
}
