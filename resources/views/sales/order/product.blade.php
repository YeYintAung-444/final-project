@extends('sales.master')
@section('content')

@php
  use App\Way;
  use App\Customer;
  use App\Price_stock;

  session_start();

  if (isset($_SESSION['way'])) {

  $wayid=$_SESSION['way'];  
  $customerid=$_SESSION['customer'];
  $way=Way::find($wayid);
  $customer=Customer::find($customerid);
}
@endphp


<main class="app-content">

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Select Items to Order!</h4>
            <a  href="{{route('orderdetailspage')}}" class="btn btn-light float-right" style="color: #009688">Done</a>
            
             <div class="table-responsive mt-3">
              <table class="table table-bordered sampleTable" >
                <thead class="thead-light">
                  <tr>
                    <th class="align-middle text-center" rowspan="2">No</th>
                    <th class="align-middle text-center" rowspan="2">Name</th>
                    <th class="align-middle text-center" colspan="3">Price</th>
                    <th class="align-middle text-center" colspan="3">Stock</th>
                    <th class="align-middle text-center" rowspan="2">Qty</th>
                    <th class="align-middle text-center" rowspan="2">Action</th>
                  </tr>
                  <tr>
                    <th class="align-middle text-center">pc</th>
                    <th class="align-middle text-center">dozen</th>
                    <th class="align-middle text-center">set</th>
                    <th class="align-middle text-center">pc</th>
                    <th class="align-middle text-center">dozen</th>
                    <th class="align-middle text-center">set</th>
                  </tr>
              </thead>
              <tbody>
                @php
                  $j=0;
                @endphp
              @foreach($products as $product)
                  
                  {{-- <tr></tr>       --}}
              <tr>
                @php
                $j+=1;
                @endphp
                  <tr class="table-info">
                    <td> {{ $j }}</td>
                    <td>{{ $product->name }} </td>
                          
                    <td class="align-middle text-right"> 
                      <span class="unit" id="sp1{{ $product->id }}" 
                        data-id='{{ $product->id }}'
                        data-set='#un{{ $product->id }}'
                        data-unit='pc_price'
                        data-price='{{ $product->price_stock->pc_price }}'
                        style=""
                        data-active='0'
                      >
                        {{number_format( $product->price_stock->pc_price) }}
                      </span> 
                    </td>
                    <td class="align-middle text-right">
                      <span class="unit" id="sp2{{ $product->id }}" 
                        data-id='{{ $product->id }}'
                        data-set='#un{{ $product->id }}'
                        data-unit='dozen_price'
                        data-price='{{ $product->price_stock->dozen_price }}'
                        style=""
                        data-active='0'
                    >
                      {{number_format($product->price_stock->dozen_price) }}
                      </span>
                    </td>
                    <td class="align-middle text-right">
                    <span class="unit" id="sp3{{ $product->id }}" 
                      data-id='{{ $product->id }}'
                      data-set='#un{{ $product->id }}'
                      data-unit='set_price'
                      data-price='{{ $product->price_stock->set_price }} '
                      style=""
                      data-active='0'
                    >
                     {{ number_format($product->price_stock->set_price) }} 
                    </span>
                   </td>
                    <td  class="align-middle text-right">
                    <span id="pc{{ $product->id }}" >{{ $product->price_stock->pcs_count }}</span>  </td>
                    <td  class="align-middle text-right">
                    <span id="dc{{ $product->id }}"> {{ $product->price_stock->dozens_count }}</span> </td>
                    <td  class="align-middle text-right"> 
                     <span id="sc{{ $product->id }}"> {{ $product->price_stock->sets_count }}</span></td>
                    <td class="align-middle text-center">  
                      <input id="qty{{ $product->id }}" class="w-50 text-right" type="number" name="qty" value="0" min="0"                      
                       >
                      <input id="price{{ $product->id }}" class="w-50" type="hidden">
                      <input id="unit{{ $product->id }}" class="w-50" type="hidden">
                    </td>
                    <td class="align-middle text-center">    
                    {{-- <a href="#" class="btn btn-warning btn-sm">Details</a> --}}
                    <button id='bt{{ $product->id }}' class="btn btn-light btn-sm order" style="color: #009688"
                      @guest
                      data-user='none'
                      @else                      
                      data-user='{{Auth::user()->id}}'
                      @endguest
                      data-customer='{{$customerid}}'
                      data-id='{{ $product->id }}'
                      data-name='{{ $product->name }}'
                      data-price='#price{{ $product->id }}'
                      data-unit='#unit{{ $product->id }}'
                      data-qty='#qty{{ $product->id }}'
                    >Order</button>
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
  </main>






@endsection

@section('script')

<script type="text/javascript">
  
  $(document).ready(function(){

    if (localStorage.getItem("item")) {
    var string=localStorage.getItem("item");
    var myArray=JSON.parse(string);
    myArray.forEach(function(v,i){
    $('#qty'+v.id).val(v.qty);

      if (v.unit=='pc') {
      $('#sp1'+v.id).attr('style','text-shadow: 1px 1px red'); 
      $('#sp2'+v.id).attr('style',''); 
      $('#sp3'+v.id).attr('style','');
      $('#price'+v.id).val(v.price);
      $('#unit'+v.id).val('pc');

      $('#pc'+v.id).attr('style','text-shadow: 1px 1px red'); 
      $('#dc'+v.id).attr('style',''); 
      $('#sc'+v.id).attr('style',''); 
    }else if (v.unit=='dozen') {
      $('#sp2'+v.id).attr('style','text-shadow: 1px 1px red'); 
      $('#sp1'+v.id).attr('style',''); 
      $('#sp3'+v.id).attr('style','');
      $('#price'+v.id).val(v.price);
      $('#unit'+v.id).val('dozen');
      
      $('#pc'+v.id).attr('style',''); 
      $('#dc'+v.id).attr('style','text-shadow: 1px 1px red');
      $('#sc'+v.id).attr('style','');
    }else{
      $('#sp3'+v.id).attr('style','text-shadow: 1px 1px red');
      $('#sp2'+v.id).attr('style',''); 
      $('#sp1'+v.id).attr('style','');
      $('#price'+v.id).val(v.price);
      $('#unit'+v.id).val('set');

      $('#pc'+v.id).attr('style',''); 
      $('#dc'+v.id).attr('style',''); 
      $('#sc'+v.id).attr('style','text-shadow: 1px 1px red');
    }
  })
}
  $(document).on('click','.unit',function(){
    var id=$(this).data('id');
    var unit=$(this).data('unit');
    var price=$(this).data('price');

    if (unit=='pc_price') {
      $('#sp1'+id).attr('style','text-shadow: 1px 1px red'); 
      $('#sp2'+id).attr('style',''); 
      $('#sp3'+id).attr('style','');
      $('#price'+id).val(price);
      $('#unit'+id).val('pc');

    }else if (unit=='dozen_price') {
      $('#sp2'+id).attr('style','text-shadow: 1px 1px red'); 
      $('#sp1'+id).attr('style',''); 
      $('#sp3'+id).attr('style','');
      $('#price'+id).val(price);
      $('#unit'+id).val('dozen');
    }else{
      $('#sp3'+id).attr('style','text-shadow: 1px 1px red'); 
      $('#sp2'+id).attr('style',''); 
      $('#sp1'+id).attr('style','');
      $('#price'+id).val(price);
      $('#unit'+id).val('set');

    }
  });

  $(document).on('click','.order',function(){
    var customer=$(this).data('customer');
    // alert(customer);
    var user=$(this).data('user');
    var id=$(this).data('id');
    var name=$(this).data('name');
    var price_id=$(this).data('price');
    var price=$(price_id).val();
    var unit_id=$(this).data('unit');
    var unit=$(unit_id).val();
    var qty_id=$(this).data('qty');
    var qty=$(qty_id).val();

    if (unit) {
    var item={
        id:id,
        name:name,
        price:price,
        qty:qty,
        unit:unit,
        user:user,
        customer:customer,
      }
      var itemList=localStorage.getItem("item");
      var itemArray;
      var hit=false;
      var old_qty=0;
      if (itemList) {
        itemArray=JSON.parse(itemList);   
        itemArray.forEach(function(v,i){
          if (v.id==id) {
            // old_qty=v.qty;
            v.qty=parseInt(qty)+parseInt(v.qty);
            hit=true;
            // console.log('hit')
          }
        })
        if (hit) {

        }else{
        itemArray.push(item);
        }
      }else{
        itemArray=[]
        itemArray.push(item);
      }

      $.ajax({
        url:'{{ route('qty_reactive') }}',
        method:'GET',
        data:{id:id,qty:qty,oqty:old_qty,unit:unit},
        success:function(ans){
          var ans=JSON.parse(ans);
          console.log(ans.error);
          if (ans.error!='error') {   // modify
            if (unit=='pc') {
              $('#dc'+id).text(ans.doz);
              $('#sc'+id).text(ans.set);
              $('#pc'+id).text(ans.pcs);
              $('#pc'+id).attr('style','text-shadow: 1px 1px red'); 
              $('#dc'+id).attr('style','');
              $('#sc'+id).attr('style','');
            }else if(unit=='dozen'){
              $('#dc'+id).text(ans.doz);
              $('#sc'+id).text(ans.set);
              $('#pc'+id).text(ans.pcs);
              $('#pc'+id).attr('style','');
              $('#dc'+id).attr('style','text-shadow: 1px 1px red'); 
              $('#sc'+id).attr('style','');
            }else{
              $('#dc'+id).text(ans.doz);
              $('#sc'+id).text(ans.set);
              $('#pc'+id).text(ans.pcs);
              $('#pc'+id).attr('style','');
              $('#dc'+id).attr('style','');
              $('#sc'+id).attr('style','text-shadow: 1px 1px red'); 
            }                   // modify
              stringItem=JSON.stringify(itemArray);
              localStorage.setItem("item",stringItem);
          }else{
            alert('Sorry!!!Balance Not Enough.');
            $(qty_id).val(old_qty);
          }
        }
      })
      }else{  // else of if(unit)
        alert('Firstly, You Must Choose Price!');
      }


  });

});

</script>

@endsection


@section('tablescript')


 {{-- Datatable --}}
    <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('.sampleTable').DataTable();</script>

@endsection


