<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tool_volunteer extends Model
{

    protected $table = 'tool_volunteer';

    protected $fillable = [
        'name_volunteer',
        'name_tool',
        'quanlity',
        'user_id',
        'tool_id',
        'event_id',
        'id'
    ];
    public $timestamps = true;

    public function tool()
    {
        return $this->belongsTo(\App\Tools::class);
    }

    // public function eventVolunteer()
    // {
    //     return $this->belongsTo(\App\event_volunteer::class);
    // }
}
