<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
    'prodname', 'prodcode', 'prodprice', 'qty', 'userid',
   ];
}
