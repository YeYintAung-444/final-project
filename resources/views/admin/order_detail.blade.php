@extends('admin.master')
@php
use App\Order;
use App\User;
use App\Customer;
use App\Product;
use App\Price_stock;
use App\Product_order;

@endphp
@section('content')

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  {{-- <h2 class="page-header"><i class="fa fa-globe"></i> <?= $customer['shop_name'] ?></h2> --}}
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{$order->order_date}}</h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>Sonic Wholesale Supplier</strong>{{-- <br>user address<br>Email: {{$user->email}} --}}</address>
                </div>
                <div class="col-4">To
                  <address><strong>{{ $customer->shop_name }}</strong><br>Phone: {{ $customer->phone }}<br>Address: {{ $customer->address }}</address>
                </div>
                <div class="col-4"><b>Invoice #{{$order->voucher_no}}</b><br><br><b>Order ID:</b> {{$order->id}}<br><b>Account ID:</b> {{$customer->id}}</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Code</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@php
                    		$product_orders=Product_order::where('order_id','=',$order->id)->get();
                    	@endphp
                    	@foreach ($product_orders as $product_order)
                    		@php 
                    			$product=Product::find($product_order->product_id);
                    			if ($product_order->units_of_measure=='pc') {
                    				$price=$product->price_stock->pc_price;
                    			}else if ($product_order->units_of_measure=='dozen'){
								            $price=$product->price_stock->dozen_price;
                    			}
                          else{
                            $price=$product->price_stock->set_price;
                          }
                    		@endphp
                          
	                    <tr>
	                   
                        <td>{{$product->name}}</td> 
                        <td>{{$product->code_no}}</td>
                        <td> {{$price}}</td>
                        <td>{{$product_order->quantity}}</td>
                        <td>{{$product_order->units_of_measure}}</td>
                        <td class="text-right">{{number_format(($product_order->quantity)*$price,2)}}</td>
	                    </tr>
                      	@endforeach
                      	<tr>
                      		<td colspan="5" class="text-right font-weight-bold">Total</td>
                      		<td class="text-right font-weight-bold">{{number_format($order->total,2)}}</td>
                      	</tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="{{route('orderlistpage')}}"><i class="fa fa-print"></i> Back</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>

@endsection