<?php

namespace App\Http\Controllers;

use App\Way;
use Illuminate\Http\Request;

class WayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ways=Way::orderBy('id','desc')->get();
        return view('admin.ways.index',compact('ways'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ways=Way::all();
        return view('admin.ways.create');
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
        $way = new Way;
        $way->township = $request->township;
        $way->road = $request->road;
        $way->save();

        // redirect
        return redirect()->route('ways.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Way  $way
     * @return \Illuminate\Http\Response
     */
    public function show(Way $way)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Way  $way
     * @return \Illuminate\Http\Response
     */
    public function edit(Way $way)
    {
        
         return view('admin.ways.edit',compact('way'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Way  $way
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Way $way)
    {
        //  $request->validate([
        //     'name' => 'required|min:3',
        // ]);

        // upload
        

        $way->township = $request->township;
        $way->road = $request->road;
        $way->save();

        // redirect
        return redirect()->route('ways.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Way  $way
     * @return \Illuminate\Http\Response
     */
    public function destroy(Way $way)
    {
        $way->delete();
        // redirect
        return redirect()->route('ways.index');
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Way  $way
     * @return \Illuminate\Http\Response
     */
    public function session(Request $request, Way $way)
    {

        session_start();
        $key = $request->key;
        $value = $request->value;

        $_SESSION[$key]=$value;
        echo 'done';

    }

    
}
