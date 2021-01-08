<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Way;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::orderBy('id','desc')->get();
        return view('sales.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $ways=Way::all();
        return view('sales.customer.create',compact('ways'));
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
        $customer = new Customer;
        $customer->shop_name = $request->shopname;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->way_id = $request->way;
        $customer->save();

        // redirect
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
         $ways=Way::all();
         return view('sales.customer.edit',compact('customer'),compact('ways'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //  $request->validate([
        //     'name' => 'required|min:3',
        // ]);

        // upload
        

        $customer->shop_name = $request->shopname;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        // redirect
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
       $customer->delete();
        // redirect
        return redirect()->route('customers.index');
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function getCustomer(Request $request, Customer $customer)
    {
        // dd($request->id);
        // $customers=Customer::where('way_id','=',$request->id)->get();
        $customers=Customer::where('way_id','=', $request->id)->get();
        echo json_encode($customers);

    }
}
