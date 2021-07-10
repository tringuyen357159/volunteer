<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Users;

class event_volunteer extends Model
{
    protected $table = 'event_volunteer';

    protected $fillable = [
        'user_id','event_id','user_name','event_name',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(\App\Event::class);
    }

    public function toolVolunteer()
    {
        return $this->hasMany(\App\tool_volunteer::class,['event_id'], 'event_id');
    }//2 bawngr ni ddaau noi voi nha đc á
}
