<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Volunteer extends Model
{
    protected $table = 'volunteers';
    protected $fillable = [
        'id',
        'gender	',
        'birthday',
        'phone',
        'address',
        'user_id',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(\App\Users::class,'user_id');
    }
}
