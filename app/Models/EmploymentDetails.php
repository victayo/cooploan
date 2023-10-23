<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'mainone_id';
    protected $keyType = 'string';
    protected $guarded = [];
}
