<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    Protected $fillable=[
    	'name','logo',
    ];

     public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }
}
