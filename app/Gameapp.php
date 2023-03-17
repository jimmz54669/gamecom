<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gameapp extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
        'gameappname', 'gameapplink', 'gamebehavior', 'gamepic',
   ];

}
