<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_stock extends Model
{
     Protected $fillable=[
    	'pc_price','dozen_price','set_price','pcs_count','dozens_count','sets_count','product_id',
    ];

}
