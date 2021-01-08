@extends('admin.master')

@section('content')
@php
  use App\Price_stock;
  use App\Customer;
@endphp

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Products</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Proucts</a></li>
    </ul>
  </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Products List</h4>
            <a  href="{{route('products.create')}}" class="btn btn-light float-right" style="color: #009688">Add New</a>     

             <div class="table-responsive mt-3">
              <table class="table table-bordered" id="sampleTable">
                <thead class="thead-light">
                  <tr>
                    <th class="align-middle text-center" rowspan="2" width="7%">No</th>
                    <th class="align-middle text-center" rowspan="2" width="13%">Code</th>
                    <th class="align-middle text-center" rowspan="2" width="20%">Name</th>
                    <th class="align-middle text-center" colspan="3" width="20%">Price</th>
                    <th class="align-middle text-center" colspan="3" width="20%">Stock</th>
                    <th class="align-middle text-center" rowspan="2" width="20%">Action</th>
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
                  @php $i=1; @endphp
                  @foreach($products as $product)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$product->code_no}}</td>
                    <td>{{$product->name}}</td>
                    @php
                    $pid=$product->id;
                    $pricestock = Price_stock::where('product_id',$pid)->first();
                    @endphp

                    <td>{{$pricestock->pc_price}}</td>
                    <td>{{$pricestock->dozen_price}}</td>
                    <td>{{$pricestock->set_price}}</td>
                    <td>{{$pricestock->pcs_count}}</td>
                    <td>{{$pricestock->dozens_count}}</td>
                    <td>{{$pricestock->sets_count}}</td>
                    
                    <td  class="align-middle text-center">
                      <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-light btn-sm" style="color: #009688">Edit</a>
                      <form id="plus{{$product->id}}" action="{{route('stockadd')}}" method="POST" class="d-none">
                        @csrf
                        @method('GET')
                        <input type="" name="id" value="{{ $product->id }}">
                        <input type="" name="state" value="idcarried">
                      </form>
                      <a href="" class="btn btn-light btn-sm" style="color: #009688"
                      onclick="event.preventDefault();document.getElementById('plus{{$product->id}}').submit();">Add</a>

                      <form method="post" action="{{route('products.destroy',$product->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="btnsubmit" class="btn btn-light btn-sm" style="color: #009688" value="Delete">
                      </form>
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
  <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/plugins/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection