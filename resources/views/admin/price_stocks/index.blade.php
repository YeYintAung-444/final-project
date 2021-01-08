@extends('admin.master')

@section('content')
  <main class="main-panel">

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Price and Stock List</h4>
           
            

            <div class="table-responsive mt-3">
              <table class="table table-bordered datatable">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Product ID</th>
                    <th>Pc_Price</th>
                    <th>Dozen_Price</th>
                    <th>Set_Price</th>
                    <th>Pcs_Count</th>
                    <th>Dozens_Count</th>
                    <th>Sets_Count</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($price_stocks as $price_stock)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$price_stock->id}}</td>
                    <td>{{$price_stock->pc_price}}</td>
                    <td>{{$price_stock->dozen_price}}</td>
                    <td>{{$price_stock->set_price}}</td>
                    <td>{{$price_stock->pcs_count}}</td>
                    <td>{{$price_stock->dozens_count}}</td>
                    <td>{{$price_stock->sets_count}}</td>
                    
                    <td>
                      <a href="{{route('price_stocks.edit',$price_stock->id)}}" class="btn btn-warning btn-sm">Edit</a>

                      <form method="post" action="{{route('price_stocks.destroy',$price_stock->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="btnsubmit" class="btn btn-danger btn-sm" value="Delete">
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

             <a  href="{{route('price_stocks.create')}}" class="btn btn-success float-right mt-5" style="color: #009688">Add New</a>
          </div>
        </div>
      </div>   
    </div>    
  </main>
@endsection

