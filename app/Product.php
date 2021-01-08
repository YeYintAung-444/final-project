<?php

namespace App;
use App\Product;
use App\Price_stock;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    Protected $fillable=[
    	'code_no','name','photo','description','subcategory_id','brand_id',
    ];

    public function price_stock()
    {
        return $this->hasOne('App\Price_stock');
    }

    public function subcategory(){
    	return $this->belongsTo('App\Subcategory');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand');
    }

    public function orders(){
    	return $this->belongsToMany('App\Order','product_orders')
    					->withPivot('quantity')
    					->withPivot('units_of_measure')
    					->withTimestamps();
    }

}
