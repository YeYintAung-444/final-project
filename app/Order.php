<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    Protected $fillable=[
    	'user_id','customer_id','order_date','voucher_no','total','status',
    ];


    public function products(){
    	return $this->belongsToMany('App\Product','product_orders')
    					->withPivot('quantity')
    					->withPivot('units_of_measure')
    					->withTimestamps();
    }

    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }

}
