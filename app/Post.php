<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'sender_id',
        'reseiver_id',
        'realname',
        'filename',
        'ext',
        'size',
        'delivered',
    ];

}
