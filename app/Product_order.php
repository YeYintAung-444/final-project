<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_order extends Model
{
   Protected $fillable=[
    	'quantity','units_of_measure','order_id','product_id',
    ];

}
