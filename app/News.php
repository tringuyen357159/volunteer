<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title', 'slug','poster','summary','content', 'photo','type','user_id'
    ];
}
