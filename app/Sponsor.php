<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsors';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'amount_financed',
        'amount_spent',
        'method',
        'anonymous',
        'user_id'
    ];
    public $timestamps = true;

    // public function events()
    // {
    //     return $this->belongsToMany(\App\Event::class, \App\detail_spending::class);
    // }

    public function detailSpendings()
    {
        return $this->hasMany(\App\detail_spending::class);
    }

}
