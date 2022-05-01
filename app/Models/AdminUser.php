<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Hash;

class AdminUser extends Authenticatable
{
    use Notifiable;


    protected $guard = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




       public function setPasswordAttribute($input)
       {
           if ($input) {
               $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
           }
}
       public function sendPasswordResetNotification($token)
       {
           $this->notify(new ResetPassword($token));
       }

       public function roles()
       {
           return $this->belongsToMany(Role::class);
       }

}
