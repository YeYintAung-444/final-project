<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    Protected $fillable=[
    	'shop_name','phone','address','way_id',
    ];

}
