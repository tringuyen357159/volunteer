<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event_tool extends Model
{
    protected $table = 'event_tool';

    protected $fillable = [
        'name_event',
        'name_tool',
        'quanlity',
        'real_quanlity',
        'event_id',
        'tool_id',
        'id'
    ];
    public $timestamps = true;

    public function event()
    {
        return $this->belongsTo(\App\Event::class);
    }
}
