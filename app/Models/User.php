<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const PENDING = 'pending';
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const APPROVED = 'approved';
    const DECLINED = 'declined';

    protected $primaryKey = 'mainone_id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mainone_id',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'dob',
        'password',
        'address',
        'city',
        'state',
        'country',
        'gender',
        'approval_status',
        'status',
        'save_amount',
        'phone',
        'membership_fee',
        'date_approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getFullNameAttribute(){
        if($this->attributes['middlename']){
            return $this->attributes['firstname'] . " ". $this->attributes['middlename'] . " ".$this->attributes['lastname'];
        }
        return $this->attributes['firstname'] . " ".$this->attributes['lastname'];
    }

    public function wallet(){
        return $this->hasOne(Wallet::class, 'user_id', 'mainone_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    public function hasRole($role): bool {
        return $this->roles->contains('name', $role);
    }

    public function isAdmin(){
        return $this->hasRole(Role::ADMIN);
    }
}
