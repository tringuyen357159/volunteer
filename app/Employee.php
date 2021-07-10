<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'phone', 'address','user_id','gender', 'birthday'
    ];
    public function user()
    {
        return $this->belongsTo(\App\Users::class,'user_id');
    }
}
