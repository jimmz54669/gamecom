<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
     /* The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
     'prodname', 'prodcode', 'qty', 'price', 'amount', 'orderid', 'userid',
    ];

}
