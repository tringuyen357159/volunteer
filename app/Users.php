<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'photo',
        'email',
        'email_verified_at',
        'password',
    ];
    public $timestamps = true;

    public function volunteer()
    {
        return $this->hasOne(\App\Volunteer::class);
    }
    public function eventVolunteer()
    {
        return $this->hasMany(\App\event_volunteer::class, 'user_id');
    }


}
