<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Way;
use App\Customer;
use App\Price_stock;
use App\User;


class MainController extends Controller
{
    public function admin($value='')
    {
    	return view('admin.admin');
    }

     public function sales($value='')     
    {
        $ways = Way::orderBy('id','desc')->get();
        return view('sales.order',compact('ways'));

    }

     public function confirmlist($value='')
    {
    	return view('delivery.confirmlist');
    }

    public function product($value='')
    {   
        $products = Product::orderBy('id','desc')->get();
        return view('sales.order.product',compact('products'));

    }

    public function orderdetails($value='')
    {   
        return view('sales.order.details');
    }

    public function ordersuccess($value='')
    {   
        return view('sales.order.ordersuccess');
    }

    public function orderlist($value='')
    {   
        return view('admin.orderlist');
    }

    public function userlist($value='')
    {   
        $users = User::orderBy('id','desc')->get();
        return view('admin.users',compact('users'));
    }

    public function documentation($value='')
    {   
        
        return view('documentation');
    }

}
