@extends('delivery.master')
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
$confirmStatus = "Confirm";
$deliveryStatus = "Delivery";

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
  
    $confirm_orders=Order::where('status','=',$confirmStatus)
                          ->whereBetween('order_date', [$startDate, $endDate])
                          ->get();

    $delivery_orders=Order::where('status','=',$deliveryStatus)
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
    $confirm_orders=Order::where('status','=',$confirmStatus)->get();
    $delivery_orders=Order::where('status','=',$deliveryStatus)->get();
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
    
    $confirm_orders=Order::where('status','=',$confirmStatus)
                          ->where('order_date',$todayDate)
                          ->get();
    $delivery_orders=Order::where('status','=',$deliveryStatus)
                          ->where('order_date',$todayDate)
                          ->get();
    }


// if (isset($_SESSION['nav'])) {
//     if ($_SESSION['nav']=='confirm') {
//         $confirm=' active';
//         $delivery='';
//         $confirm_tab=' show active';
//         $delivery_tab='';
//     }
    
    
// } else {
//     $confirm='';
//     $delivery='active';
//     $confirm_tab='';
//     $delivery_tab=' show active';
// }

    if (isset($_SESSION['nav'])) {
        if ($_SESSION['nav']=='confirm') {
            $confirm=' active';
            $delivery='';
            $confirm_tab=' show active';
            $delivery_tab='';
        }
        else{
            $confirm='';
            $delivery=' active';
            $confirm_tab=' ';
            $delivery_tab='show active';
        }

    }
    else {
            $confirm=' active';
            $delivery='';
            $confirm_tab=' show active';
            $delivery_tab='';
        }
   
 
@endphp


<main class="app-content">

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"> Search Delivery History </h3>
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
                            <a class="nav-link {{$confirm}} " id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">  Order - Confirm </a> 
                            <a class="nav-link {{$delivery}} " id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">  Order - Delivery </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{$confirm_tab}}" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Address</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            <th class="align-middle text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($confirm_orders as $data)

                                        @php
                                        $cid=$data->customer_id;
                                        $customer = Customer::where('id',$cid)->first();
                                        @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$customer->address}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>

                                                 
                                                <td class="align-middle text-center">
                                                    {{-- <form id="info{{$data->id}}" action="{{route('orderinfo')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                      </form>
                                                    <button class="btn btn-outline-info" onclick="document.getElementById('info{{$data->id}}').submit();">
                                                        <i class="fas fa-info"></i>
                                                    </button> --}}

                                                    <form id="delivery{{$data->id}}" action="{{route('delistatus')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                        <input type="text" name="status" value="Delivery">                                                
                                                    </form>
                                                    <a href="{{route('delistatus')}}" class="btn btn-outline-success" onclick="event.preventDefault();document.getElementById('delivery{{$data->id}}').submit();">
                                                        <i class="fas fa-truck"></i>
                                                    </a>

                                                    
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
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Address</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            {{-- <th class="align-middle text-center">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($delivery_orders as $data)

                                        @php
                                        $cid=$data->customer_id;
                                        $customer = Customer::where('id',$cid)->first();
                                        @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$customer->address}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                 
                                               {{--  <td class="align-middle text-center">
                                                    <form id="info{{$data->id}}" action="{{route('orderinfo')}}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" name="id" value="{{$data->id}}">
                                                      </form>
                                                    <button class="btn btn-outline-info" onclick="document.getElementById('info{{$data->id}}').submit();">
                                                        <i class="fas fa-info"></i>
                                                    </button>

                                                    
                                                </td> --}}
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
    
    $("#nav-confirm-tab").click(function(){
        setSession('nav','confirm','{{route('nav')}}');
    })
    $("#nav-delivery-tab").click(function(){
        setSession('nav','delivery','{{route('nav')}}');
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

        // alert("OK");
        $.ajax({
            url:url,
            method:"GET",
            data:{start:start,end:end},
            success:function(data){
                // alert("Success");
                if (data){
                    if (data=='today') {
                        location.href= '{{route('confirmpage')}}';
                    }else if (data=='all') {
                        location.href= '{{route('confirmpage')}}';
                    }else{
                        location.href= '{{route('confirmpage')}}';
                    }
                }
            }
        });
    }
})
</script>
@endsection

