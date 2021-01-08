@extends('sales.master')

@section('content')
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Products</h1>
        <p>A free and open source Bootstrap 4 admin template</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Selected Product Lists</h4>
            <a class="btn btn-light float-right confirm" style="color: #009688">Confirm</a>
            

            <div class="table-responsive mt-3">
              <table class="table table-bordered sampleTable">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                 
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

   
    function showItem(){
      // alert("OK");
      itemList=localStorage.getItem("item");

      var nf = new Intl.NumberFormat();


      if(itemList){
        itemArray=JSON.parse(itemList);
        var html="";
        var number=0;
        var subtotal=0;
        var total=0;

        itemArray.forEach(function(v,i){
          number+=1;
          subtotal=parseInt(v.price*v.qty);
          numtotal=nf.format(subtotal); 
          price=nf.format(v.price)  
          
            html+=`<tr>
            <td>${number}</td>
            <td>${v.name}</td>
            <td><p> ${v.qty}</p></td>
            <td><p> ${v.unit}</p></td>
            <td><p> ${price} Ks</p></td>
            <td><p>${numtotal} Ks</p></td>
            </tr>`
            total+=subtotal;
       });
        
        total=nf.format(total);

        html+=`<tr>
        <td colspan="8">
        <h3 class="text-right">Total: ${total} Ks</h3>
        </td>
        </tr>`
        $('tbody').html(html);
        
       } 
      
}
       showItem();

       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


      $(document).on('click','.confirm',function(){

        // alert("Order Confirmed!");

        var item=localStorage.getItem('item');   
        var itemArray=JSON.parse(item);
        var total=itemArray.reduce((acc,row)=>acc+(row.price*row.qty),0);
        var customer=itemArray[0].customer;
        // alert(customer);

        // var id="check";
          $.post("{{route('orders.store')}}", { 
            item:item,
            total:total,
            customer:customer
             
        },function (response) {
         if(response=='Order Successful'){
           localStorage.clear();
           location.href = "{{ route('ordersuccesspage') }}";
           // alert(response);

         }


        });

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