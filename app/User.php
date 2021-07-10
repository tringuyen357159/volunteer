<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',  'photo',  'id', 'email_verified_at',
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
    public function volunteer()
    {
        return $this->hasOne(\App\Volunteer::class);
    }
    public function eventVolunteer()
    {
        return $this->hasMany(\App\event_volunteer::class, 'user_id');
    }

    public function employees()
    {
        return $this->hasOne(\App\Employee::class);
    }
    public function sponsors()
    {
        return $this->hasOne(\App\Sponsor::class);
    }
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class);
    }
    
}
