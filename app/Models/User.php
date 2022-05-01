<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
  

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
       {
           return $this->belongsToMany(Role::class);
       }

       /**
        * Assign the given role to the user.
        *
        * @param  string $role
        * @return mixed
        */
       public function assignRole($role)
       {
           return $this->roles()->save(
               Role::where('name', $role)->firstOrFail()
           );
       }

       /**
        * Determine if the user has the given role.
        *
        * @param  mixed $role
        * @return boolean
        */
       public function hasRole($role)
       {
           // check for string
           if (is_string($role)) {

               // boolean - role exists or not
               return $this->roles->contains('name', $role);
           }

           // determine whether role exists in within array of roles
           return !! $role->intersect($this->roles)->count();
       }

       /**
        * Determine if the user may perform the given permission.
        *
        * @param  Permission $permission
        * @return boolean
        */
       public function hasPermission(Permission $permission)
       {
           return $this->hasRole($permission->roles);
       }
}
