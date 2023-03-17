<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'prodname', 'prodprice', 'prodimg', 'prodqty', 'prodcat', 'prodcode'
   ];
}
