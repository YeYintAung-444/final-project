@extends('admin.master')

@section('content')

@php
  use App\Order;
  use App\Customer;
  use App\User;
  use App\Product;
@endphp

  <main class="app-content">
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i>Orders</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="category_new.php" class="btn btn-outline-primary">
                <i class="icofont-plus"></i>
            </a>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Search Order History</h3>
                <div class="tile-body">
                <form class="row">
                    <div class="form-group col-md-5">
                      <label class="control-label">Start Date</label>
                      <input class="form-control" type="date" id="startDate">
                    </div>
                    <div class="form-group col-md-5">
                      <label class="control-label">End Date</label>
                      <input class="form-control" type="date" id="endDate">
                    </div>
                    <div class="form-group col-md-2 align-self-end">
                      <button class="btn btn-primary searchBtn" type="button">Search</button>
                    </div>
                </form>
            </div>
    </div>


      <div class="tile" id="todayorderlistDiv">
        <div class="tile-body">
            <h3 class="tile-title">Today Order List</h3>

             <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true">Order-pending</a>
                    <a class="nav-link" id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">Order-Confirm</a>
                    <a class="nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Order-Delivered</a>
                    <a class="nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Order-Purchased</a>
                    <a class="nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Order-Cancel</a>
                </div>
            </nav>


            

            <div class="tab-content my-3" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">  
             <div class="table-responsive mt-3">
              <table class="table table-bordered" id="sampleTable">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Sales Staff</th>
                    <th>Shop Name</th>
                    <th>Voucher No</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 @php
                  $i=1; 
                  $orders = Order::where('status',1)->get();
                 @endphp
                 @foreach($orders as $order)

                  @php
                  $uid=$order->user_id;
                  $user = User::where('id',$uid)->first();
                  $cid=$order->customer_id;
                  $customer = Customer::where('id',$cid)->first();
                  @endphp
                 <tr>
                  <td>{{$i++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$customer->shop_name}}</td>
                  <td>{{$order->voucher_no}}</td>
                  <td>{{$order->total}}</td>
                  
                  <td>
                    <a href="{{route('changestatuspage',$order->id)}}" class="btn btn-outline-success">
                      Confirm</i>
                    </a> 
                    <a href="#>" class="btn btn-outline-success">
                      Cancel</i>
                    </a> 
                  </td>
                </tr>
                @endforeach

              </tbody>
              </table>
            </div>
          </div>


          <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
            <div class="table-responsive">
              <table class="table table-hover table-bordered display">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Voucherno</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                    $i=1; 
                    $orders = Order::where('status',2)->get();
                  @endphp
                 @foreach($orders as $order)

                  @php
                  $uid=$order->user_id;
                  $user = User::where('id',$uid)->first();
                  $cid=$order->customer_id;
                  $customer = Customer::where('id',$cid)->first();
                  @endphp
                 <tr>
                  <td>{{$i++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$customer->shop_name}}</td>
                  <td>{{$order->voucher_no}}</td>
                  <td>{{$order->total}}</td>
                </tr>
                @endforeach

                  </tbody>
                </table>
              </div>
            </div>


            <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
            <div class="table-responsive">
              <table class="table table-hover table-bordered display">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Voucherno</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                    $i=1; 
                    $orders = Order::where('status',3)->get();
                  @endphp
                 @foreach($orders as $order)

                  @php
                  $uid=$order->user_id;
                  $user = User::where('id',$uid)->first();
                  $cid=$order->customer_id;
                  $customer = Customer::where('id',$cid)->first();
                  @endphp
                 <tr>
                  <td>{{$i++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$customer->shop_name}}</td>
                  <td>{{$order->voucher_no}}</td>
                  <td>{{$order->total}}</td>
                  
                  <td>
                    <a href="#" class="btn btn-outline-success">
                      Purchase</i>
                    </a> 
                  </td>
                </tr>
                @endforeach

                  </tbody>
                </table>
              </div>
            </div>

            <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
            <div class="table-responsive">
              <table class="table table-hover table-bordered display">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Voucherno</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                    $i=1; 
                    $orders = Order::where('status',3)->get();
                  @endphp
                 @foreach($orders as $order)

                  @php
                  $uid=$order->user_id;
                  $user = User::where('id',$uid)->first();
                  $cid=$order->customer_id;
                  $customer = Customer::where('id',$cid)->first();
                  @endphp
                 <tr>
                  <td>{{$i++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$customer->shop_name}}</td>
                  <td>{{$order->voucher_no}}</td>
                  <td>{{$order->total}}</td>
                </tr>
                @endforeach

                  </tbody>
                </table>
              </div>
            </div>



        </div>
      </div>   
    </div>    
  </main>
@endsection

@section('script')
  <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection