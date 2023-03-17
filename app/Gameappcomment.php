<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gameappcomment extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'content', 'userid', 'gameappid',
    ];

}
