<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const STATUS_TRUE = 1;
    const STATUS_FALSE = 0;

    protected $table = 'event';

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'photo',
        'budget_estimates',
        'number_of_participants',
        'real_quantity',
        'start_day',
        'end_day',
        'type',
        'created_at',
        'updated_at',
        'user_id',
        'id',
        'status',
    ];
    public $timestamps = true;

    public function event_tool()
    {
        return $this->hasMany(\App\event_tool::class);
    }

    public function eventVolunteer()
    {
        return $this->hasMany(\App\event_volunteer::class, 'event_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
