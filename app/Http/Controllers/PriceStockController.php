<?php

namespace App\Http\Controllers;

use App\Price_stock;
use Illuminate\Http\Request;

class PriceStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $price_stocks=Price_stock::orderBy('id','desc')->get();
        return view('admin.price_stocks.index',compact('price_stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $price_stocks=Price_stock::all();
        return view('admin.price_stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // $request->validate([
       //      'shop_name' => 'required|min:5',
    
       //  ]);

        // store data
        $price_stock = new Price_stock;
        $price_stock->pc_price = $request->pcprice;
        $price_stock->dozen_price = $request->dozenprice;
        $price_stock->set_price = $request->setprice;
        $price_stock->pcs_count = $request->pccount;
        $price_stock->sets_count = $request->setcount;
        $price_stock->dozens_count = $request->dozencount;
        $price_stock->save();

        // redirect
        return redirect()->route('price_stocks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Price_stock  $price_stock
     * @return \Illuminate\Http\Response
     */
    public function show(Price_stock $price_stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Price_stock  $price_stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Price_stock $price_stock)
    {
         return view('admin.price_stocks.edit',compact('price_stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Price_stock  $price_stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price_stock $price_stock)
    {
        //  $request->validate([
        //     'name' => 'required|min:3',
        // ]);

        // upload
        

       $price_stock->pc_price = $request->pcprice;
        $price_stock->dozen_price = $request->dozenprice;
        $price_stock->set_price = $request->setprice;
        $price_stock->pcs_count = $request->pccount;
        $price_stock->sets_count = $request->setcount;
        $price_stock->dozens_count = $request->dozencount;
        $price_stock->save();

        // redirect
        return redirect()->route('price_stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Price_stock  $price_stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price_stock $price_stock)
    {
       $price_stock->delete();
        // redirect
        return redirect()->route('price_stocks.index');
    }
}
