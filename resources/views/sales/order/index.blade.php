@extends('sales.master')
@section('content')
@php
use App\Order;
use App\Customer;
use App\User;
use App\Product;

$label_S_date='';
$label_e_date='';
$all='';
$orderStatus = "Order";
$confirmStatus = "Confirm";
$uid=Auth::user()->id;

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
                          // ->whereBetween('order_date', [$startDate, $endDate])
                          ->where('user_id','=',$uid)
                          ->get();


    $confirm_orders=Order::where('status','=',$confirmStatus)
                          // ->whereBetween('order_date', [$startDate, $endDate])
                          ->where('user_id','=',$uid)
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
    $pending_orders=Order::where('status','=',$orderStatus)
                            ->where('user_id','=',$uid)
                            ->get();
    $confirm_orders=Order::where('status','=',$confirmStatus)
                            ->where('user_id','=',$uid)
                            ->get();
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

    $pending_orders=Order::select('*')
                    ->where([
                    ['status','=',$orderStatus],
                    ['user_id','=',$uid]
                    ])
                    ->get();
                         
   
    // dd($pending_orders);
    $confirm_orders=Order::where('status','=',$confirmStatus)
                          // ->where('order_date',$todayDate)
                          ->where('user_id','=',$uid)
                          ->get();
    // dd($confirm_orders);

    }
if (isset($_SESSION['nav'])) {
    if ($_SESSION['nav']=='pending') {
        $pending=' active';
        $confirm='';
        $pending_tab=' show active';
        $confirm_tab='';
    }
    if ($_SESSION['nav']=='confirm') {
        $pending='';
        $confirm=' active';
        $pending_tab='';
        $confirm_tab=' show active';
    }
   
} else {
    $pending=' active';
    $confirm='';
    $pending_tab=' show active';
    $confirm_tab='';
}
@endphp

<main class="app-content">

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Order History </h3>
               {{--  <div class="tile-body">
                    
                </div> --}}
            </div>

            <div class="tile">
                <div class="tile-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link {{$pending}} " id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true"> Order - Pending </a>
                            <a class="nav-link {{$confirm}} " id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">  Order - Confirm </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{$pending_tab}}" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle text-center">Order Date</th>
                                            <th class="align-middle text-center">Sales Staff</th>
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Address</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            <th class="align-middle text-center">Total</th>
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
                                                <td class="align-middle text-center">{{$data->order_date}}</td>
                                                <td class="align-middle text-center">{{$user->name}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$customer->address}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                 <td class="align-middle text-center">{{number_format($data->total)}}  Ks</td>
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
                                            <th class="align-middle text-center">Order Date</th>
                                            <th class="align-middle text-center">Sales Staff</th>
                                            <th class="align-middle text-center">Shop Name</th>
                                            <th class="align-middle text-center">Address</th>
                                            <th class="align-middle text-center">Voucher No</th>
                                            <th class="align-middle text-center">Total</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($confirm_orders as $data)
                                            <tr>
                                                <td class="align-middle text-center">{{$i++}}</td>
                                                <td class="align-middle text-center">{{$data->order_date}}</td>

                                                <td class="align-middle text-center">{{$user->name}}</td>
                                                <td class="align-middle text-center">{{$customer->shop_name}}</td>
                                                <td class="align-middle text-center">{{$customer->address}}</td>
                                                <td class="align-middle text-center">{{$data->voucher_no}}</td>
                                                 <td class="align-middle text-center">{{number_format($data->total)}} Ks</td>
                                              
                                                   
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

