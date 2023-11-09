<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    const ACTIVE = 'active';
    const PENDING = 'pending';
    const COMPLETED = 'completed';

    protected $guarded = [];

    public function guarantors(){
        return $this->hasMany(LoanGuarantor::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'mainone_id');
    }
}
