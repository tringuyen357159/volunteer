<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_spending extends Model
{
    protected $table = 'detail_spending';

    protected $fillable = [
        'event_id',
        'sponsor_id',
        'money',
        'created_at'
    ];
    public $timestamps = true;
    public function sponsors()
    {
        return $this->belongsTo(\App\Sponsor::class);
    }
    public function event()
    {
        return $this->belongsTo(\App\Event::class);
    }

}
