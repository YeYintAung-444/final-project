@extends('admin.master')
@section('content')
@php
use App\Order;
use App\Customer;
use App\User;
use App\Product;

session_start();
$label_S_date='';
$label_e_date='';
$all='';
$orderStatus = "Order";
$confirmStatus = "Confirm";
$deliveryStatus = "Delivery";
$purchaseStatus = "Purchase";

    if (isset($_SESSION['startDate'])&&isset($_SESSION['endDate'])) {
    // for button active
    $search=' active';
    $alls=' ';
    $today=' ';
    $search_chk='checked';
    $alls_chk=' ';
    $today_chk=' ';
    // for button active
    // for label
    $label_S_date=$_SESSION['startDate'];
    $label_e_date=$_SESSION['endDate'];
    // for label
    $startDate=$_SESSION['startDate'];
    $endDate=$_SESSION['endDate'];
    $pending_orders=Order::where('status','=',$orderStatus)
                          ->whereBetween('order_date', [$startDate, $endDate])
                          ->get();
    $confirm_orders=Order::where('status','=',$confirmStatus)
                          ->whereBetween('order_date', [$startDate, $endDate])
                          ->get();
    $delivery_orders=Order::where('status','=',$deliveryStatus)
                          ->whereBetween('order_date', [$startDate, $endDate])
                          ->get();
    $purchase_orders=Order::where('status','=',$purchaseStatus)
                          ->whereBetween('order_date', [$startDate, $endDate])
                          ->get();
   
    }elseif(isset($_SESSION['all'])){
    // for button active
    $alls=' active';
    $search=' ';
    $today=' ';
    $search_chk='';
    $alls_chk='checked';
    $today_chk=' ';
    // for button active
    $all=$_SESSION['all'];
    $pending_orders=Order::where('status','=',$orderStatus)->get();
    $confirm_orders=Order::where('status','=',$confirmStatus)->get();
    $delivery_orders=Order::where('status','=',$deliveryStatus)->get();
    $purchase_orders=Order::where('status','=',$purchaseStatus)->get();
   
    }else{
    // for button active
    $today=' active';
    $alls=' ';
    $search=' ';
    $search_chk='';
    $alls_chk='';
    $today_chk='checked';
    // for button active
    date_default_timezone_set("Asia/Rangoon");
    
    $todayDate = date('Y-m-d',strtotime('today'));
    $pending_orders=Order::where('status','=',$orderStatus)
                          ->where('order_date',$todayDate)
                          ->get();
    $confirm_orders=Order::where('status','=',$confirmStatus)
                          ->where('order_date',$todayDate)
                          ->get();
    $delivery_orders=Order::where('status','=',$deliveryStatus)
                          ->where('order_date',$todayDate)
                          ->get();
    $purchase_orders=Order::where('status','=',$purchaseStatus)
                          ->where('order_date',$todayDate)
                          ->get();
    }
if (isset($_SESSION['nav'])) {
    if ($_SESSION['nav']=='pending') {
        $pending=' active';
        $confirm='';
        $delivery='';
        $purchase='';
       
        $pending_tab=' show active';
        $confirm_tab='';
        $delivery_tab='';
        $purchase_tab='';
        
    }
    if ($_SESSION['nav']=='confirm') {
        $pending='';
        $confirm=' active';
        $delivery='';
        $purchase='';
        
        $pending_tab='';
        $confirm_tab=' show active';
        $delivery_tab='';
        $purchase_tab='';
        
    }
    if ($_SESSION['nav']=='delivery') {
        $pending='';
        $confirm='';
        $delivery=' active';
        $purchase='';
        
        $pending_tab='';
        $confirm_tab='';
        $delivery_tab=' show active';
        $purchase_tab='';
        
    }

    if ($_SESSION['nav']=='purchase') {
        $pending='';
        $confirm='';
        $delivery='';
        $purchase='active';
        
        $pending_tab='';
        $confirm_tab='';
        $delivery_tab='';
        $purchase_tab='show active';
        
    }
    
} else {
    $pending=' active';
    $confirm='';
    $delivery='';
    $purchase='';
   
    $pending_tab=' show active';
    $confirm_tab='';
    $delivery_tab='';
    $purchase_tab='';
    
}
@endphp

<main class="app-content">

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"> Search Order History </h3>
                <div class="tile-body">
                    <form class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Start Date</label>
                            <input class="form-control" type="date" id="startDate">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">End Date</label>
                            <input class="form-control" type="date" id="endDate">
                        </div>
                        <div class="form-group col-md-4 align-self-end">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                              <label class="btn btn-primary searchBtn mr-5{{$search}}">  
                                <input type="radio" name="options" id="option1" autocomplete="off" {{$search_chk}}> Search
                              </label>
                              <label class="btn btn-primary allBtn mr-5{{$alls}}"> 
                                <input type="radio" name="options" id="option2" autocomplete="off" {{$alls_chk}}> All
                              </label>
                              <label class="btn btn-primary todayBtn mr-5{{$today}}">  
                                <input type="radio" name="options" id="option3" autocomplete="off" {{$today_chk}}> Today
                              </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tile">
                @if ($label_S_date!='')
                    <h3>Search From {{$label_S_date}} To {{$label_e_date}} </h3>
                @elseif($all!='')
                    <h3> All data </h3>
                @else
                    <h3> {{$todayDate}} </h3>
                @endif
                <div class="tile-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link {{$pending}} " id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true"> Order - Pending </a>
                            <a class="nav-link {{$confirm}} " id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">  Order - Confirm </a>
                            <a class="nav-link {{$delivery}} " id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">  Order - Delivery </a>
                            <a class="nav-link {{$purchase}} " id="nav-purchase-tab" data-toggle="tab" href="#nav-purchase" role="tab" aria-controls="nav-purchase" aria-selected="false">  Order - Purchase </a>
                            
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{$pending_tab}}" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Sales Staff</th>
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            <th class="align-middle text-center">Total</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($pending_orders as $data)

                                        @php
                                        $uid=$data->user_id;
                                        $user = User::where('id',$uid)->first();
                                        // var_dump($user).die();
                                        $cid=$data->customer_id;
                                        // var_dump($cid).die();

                                        $customer = Customer::where('id',$cid)->first();
                                        // var_dump($customer).die();
                                        @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$user->name}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                 <td class="align-middle text-center">{{$data->total}}</td>
                                                <td class="align-middle text-center">
                                                    <form id="info{{$data->id}}" action="{{route('orderinfo')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="cid" value="{{$data->customer_id}}">
                                                      </form>
                                                    <button class="btn btn-outline-info" onclick="document.getElementById('info{{$data->id}}').submit();">
                                                        <i class="fas fa-info"></i>
                                                    </button>

                                                    <form id="confirm{{$data->id}}" action="{{route('status')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="status" value="Confirm">                                                
                                                    </form>
                                                    <a href="{{route('status')}}" class="btn btn-outline-success" onclick="event.preventDefault();document.getElementById('confirm{{$data->id}}').submit();">
                                                        <i class="fas fa-check"></i>
                                                    </a>

                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$confirm_tab}}" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Sales Staff</th>
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            <th class="align-middle text-center">Total</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach ($confirm_orders as $data)
                                        @php
                                        $uid=$data->user_id;
                                        $user = User::where('id',$uid)->first();
                                        // var_dump($user).die();
                                        $cid=$data->customer_id;
                                        // var_dump($cid).die();

                                        $customer = Customer::where('id',$cid)->first();
                                        // var_dump($customer).die();
                                        @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$user->name}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                 <td class="align-middle text-center">{{$data->total}}</td>
                                                <td class="align-middle text-center">
                                                    <form id="info{{$data->id}}" action="{{route('orderinfo')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="cid" value="{{$data->customer_id}}">
                                                      </form>
                                                    <button class="btn btn-outline-info" onclick="document.getElementById('info{{$data->id}}').submit();">
                                                        <i class="fas fa-info"></i>
                                                    </button>

                                                  
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$delivery_tab}}" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Sales Staff</th>
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            <th class="align-middle text-center">Total</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @php
                                            $i=1;
                                        @endphp
                                        @foreach ($delivery_orders as $data)
                                        @php
                                        $uid=$data->user_id;
                                        $user = User::where('id',$uid)->first();
                                        // var_dump($user).die();
                                        $cid=$data->customer_id;
                                        // var_dump($cid).die();

                                        $customer = Customer::where('id',$cid)->first();
                                        // var_dump($customer).die();
                                        @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$user->name}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                 <td class="align-middle text-center">{{$data->total}}</td>
                                                <td class="align-middle text-center">

                                                    <form id="info{{$data->id}}" action="{{route('orderinfo')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="cid" value="{{$data->customer_id}}">
                                                      </form>
                                                    <button class="btn btn-outline-info" onclick="document.getElementById('info{{$data->id}}').submit();">
                                                        <i class="fas fa-info"></i>
                                                    </button>

                                                    <form id="purchase{{$data->id}}" action="{{route('status')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="status" value="Purchase">                                                
                                                    </form>
                                                    <a href="{{route('status')}}" class="btn btn-outline-danger" onclick="event.preventDefault();document.getElementById('purchase{{$data->id}}').submit();">
                                                        <i class="fas fa-comment-dollar"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$purchase_tab}}" id="nav-purchase" role="tabpanel" aria-labelledby="nav-purchase-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">Sr</th>
                                            <th class="align-middle text-center">Date</th>
                                            <th class="align-middle text-center">Voucherno</th>
                                            <th class="align-middle text-center">Total</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @php
                                            $i=1;
                                        @endphp
                                        @foreach ($purchase_orders as $data)
                                        @php
                                        $uid=$data->user_id;
                                        $user = User::where('id',$uid)->first();
                                        // var_dump($user).die();
                                        $cid=$data->customer_id;
                                        // var_dump($cid).die();

                                        $customer = Customer::where('id',$cid)->first();
                                        // var_dump($customer).die();
                                        @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$data->order_date}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                <td class="align-middle text-center">{{number_format($data->total)}}</td>
                                                <td class="align-middle text-center">
                                                    <form id="info{{$data->id}}" action="{{route('orderinfo')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="cid" value="{{$data->customer_id}}">
                                                        
                                                    </form>
                                                    <button class="btn btn-outline-info" onclick="document.getElementById('info{{$data->id}}').submit();">
                                                        <i class="fas fa-info"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')

<script type="text/javascript">
$(document).ready(function(){
    // for ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#nav-pending-tab").click(function(){
        setSession('nav','pending','{{route('nav')}}');
    })
    $("#nav-confirm-tab").click(function(){
        setSession('nav','confirm','{{route('nav')}}');
    })
    $("#nav-delivery-tab").click(function(){
        setSession('nav','delivery','{{route('nav')}}');
    })
     $("#nav-purchase-tab").click(function(){
        setSession('nav','purchase','{{route('nav')}}');
    })
   
    function setSession(key,value,url){
        $.ajax({
            url:url,
            method:"GET",
            data:{key:key,value:value},
            success:function(data){
            }
        });
    }
    $(".searchBtn").click(function(){
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        if (startDate&&endDate) {
            search(startDate,endDate,'{{route('search')}}')    
        }else{
            alert('empty search data');
            search(startDate,endDate,'{{route('search')}}')  
        }
    });
    $(".todayBtn").click(function(){
        var startDate = '';
        var endDate = '';
        search(startDate,endDate,'{{route('search')}}')
    });
    $(".allBtn").click(function(){
        var startDate = 'all';
        var endDate = 'all';
        search(startDate,endDate,'{{route('search')}}')
    });
    function search(start,end,url){
        $.ajax({
            url:url,
            method:"GET",
            data:{start:start,end:end},
            success:function(data){
                if (data){
                    if (data=='today') {
                        location.href= '{{route('orderlistpage')}}';
                    }else if (data=='all') {
                        location.href= '{{route('orderlistpage')}}';
                    }else{
                        location.href= '{{route('orderlistpage')}}';
                    }
                }
            }
        });
    }
})
</script>
@endsection

