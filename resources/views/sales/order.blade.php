@extends('sales.master')

@section('content')

   @php
      use App\Customer;
      use App\Way;
      session_start();
      
      if (isset($_SESSION['way'])) {
          $wayid=$_SESSION['way'];
          $customers=Customer::where('way_id','=', $wayid)->get();
          $way=Way::find($wayid);

      }

    @endphp

  <main class="app-content">

    @if (isset($_SESSION['way'])) 

    <div class="app-title">
      <div>
        <h4></i>Current Way</h4>
        <h5>{{ $way->township }}, {{ $way->road }}</h5>
      </div>

      <div>
        {{-- <a class="btn btn-success btn-md changeWay">Change Way</a> --}}
        <button type="button" class="btn btn-outline-light btn-lg changeWay" style="color: #009688">Change Way</button>
      </div>
      
    </div>

     <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Customers List</h4>
            

            <div class="table-responsive mt-3">
              <table class="table table-striped sampleTable">
               <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Shop Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 @php
                 $j=0;
                 @endphp

                 @foreach($customers as $customer)
                 <tr class="table-info">
                  <td> {{ ++$j}}</td>
                  <td> {{ $customer->shop_name }} </td>
                  <td>{{ $customer->phone }}</td>
                  <td>{{ $customer->address }}</td>   
                  <td>
                    <button class="btn btn-light btn-sm chooseCustomer" style="color: #009688" data-wid="{{$way->id}}" data-cid="{{ $customer->id}}">Choose</button>

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


  @else

    {{-- <div class="app-title" id="way">
      <div>
        <h1><i class="fa fa-dashboard"></i>Way List</h1>    
      </div>
    </div> --}}

     <div class="row" id="way">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Ways List</h4>
            

            <div class="table-responsive mt-3">
              <table class="table table-striped sampleTable">
               <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Township</th>
                  <th>Road</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($ways as $way)
                <tr>
                  <td>{{$i++  }}</td>
                  <td>{{ $way->township }}</td>
                  <td>{{ $way->road }}</td>
                  <td>
                    <a class="btn btn-light btn-sm chooseWay" style="color: #009688" data-id="{{$way->id}}">Choose</a>
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


    <div class="row" id="customer"  style="display: none;">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Customers List</h4>
            

            <div class="table-responsive mt-3">
              <table class="table table-striped sampleTable">
               <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Shop Name</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="appendcustomer">
                <tr></tr>

              </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>   
    </div>  

    @endif 
 </main> 

@endsection

@section('script')

<script type="text/javascript">


  $(document).ready(function(){

   // $('#customer').hide();

   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  
    $(document).on('click','.chooseWay',function(){
      var id=$(this).data('id');
      setSession('way',id,'{{route('session')}}');


    $.ajax({
                url:'{{route('getCustomerpage')}}',
                method:"GET",
                data:{id:id},
                success:function(data){
                  // console.log(data);
                  var html='';
                  if(data){
                    var array=JSON.parse(data);
                    var no=1;
                    array.forEach(function(v,i){

                    html+=`<tr>
                         <td>${no++}</td>
                         <td>${v.shop_name}</td>
                         <td>${v.phone}</td>
                         <td>${v.address}</td>
                         <td><button class="btn btn-light btn-sm chooseCustomer" style="color: #009688" data-wid="{{$way->id}}" data-cid="${v.id}">Choose</button></td>
                       </tr>`
                    });

                    $('#appendcustomer').append(html);
                    $('#customer').show(500);
                    $('#way').hide(500);
                  }

                  }
            });

    });

    $(document).on('click','.changeWay',function(){
    
      // alert('OK');
      endSession('way','','{{route('session')}}');

});

    $(document).on('click','.chooseCustomer',function(){
    
      var id=$(this).data('cid');

      productSession('customer',id,'{{route('session')}}');

});

  function setSession(key,value,url){
        $.ajax({
            url:url,
            method:"GET",
            data:{key:key,value:value},
            success:function(data){
            }
        });
    }

    function endSession(key,value,url){
        $.ajax({
            url:url,
            method:"GET",
            data:{key:key,value:value},
            success:function(data){
              if(data){
                location.href='{{route('salespage')}}';

              }
            }
        });
    }


    function productSession(key,value,url){
        $.ajax({
            url:url,
            method:"GET",
            data:{key:key,value:value},
            success:function(data){
              if(data){
                location.href='{{route('productpage')}}';

              }
            }
        });
    }

});

</script>

@endsection

@section('tablescript')
  {{-- Datatable --}}
    <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('.sampleTable').DataTable();</script>

@endsection