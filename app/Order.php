<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    /* The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'userid', 'ordersubtotal', 'ordertotal', 'orderdiscount', 'shippingfee', 'ordertype', 'ordertotalqty', 'orderstatus', 'orderaddress'
    ];

}
