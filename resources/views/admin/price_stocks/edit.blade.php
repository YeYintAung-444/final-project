@extends('admin.master')

@section('content')
  <main class="app-content">

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4>Price and Stock Edit Form</h4>
            <form method="post" action="{{route('price_stocks.update',$price_stock->id)}}" enctype="multipart/form-data" class="mt-3">
              @csrf
              @method('PUT')


              <div class="form-group">
                <label for="pid">Product ID:</label>
                <input type="text" name="pid" class="form-control @error('pid') is-invalid @enderror" id="pid" value="{{$price_stock->product_id}}">
                @error('pid')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="pcprice">Pc Price:</label>
                <input type="text" name="pcprice" class="form-control @error('pcprice') is-invalid @enderror" id="pcprice" value="{{$price_stock->pc_price}}">
                @error('pcprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
               <div class="form-group">
                <label for="dozenprice">Dozen Price:</label>
                <input type="text" name="dozenprice" class="form-control @error('dozenprice') is-invalid @enderror" id="dozenprice" value="{{$price_stock->dozen_price}}">
                @error('dozenprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
               <div class="form-group">
                <label for="setprice">Set Price:</label>
                <input type="text" name="setprice" class="form-control @error('setprice') is-invalid @enderror" id="setprice" value="{{$price_stock->set_price}}">
                @error('setprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
               <div class="form-group">
                <label for="pccount">Pc Count:</label>
                <input type="text" name="pccount" class="form-control @error('pccount') is-invalid @enderror" id="pccount" value="{{$price_stock->pcs_count}}">
                @error('pccount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
               <div class="form-group">
                <label for="dozencount">Dozen Count:</label>
                <input type="text" name="dozencount" class="form-control @error('dozencount') is-invalid @enderror" id="dozencount" value="{{$price_stock->dozens_count}}">
                @error('dozencount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="setcount">Set Count:</label>
                <input type="text" name="setcount" class="form-control @error('setcount') is-invalid @enderror" id="setcount" value="{{$price_stock->sets_count}}">
                @error('setcount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>




              
  
              <div class="form-group">
                <input type="submit" name="btn-submit" value="Update" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>   
    </div>    
  </main>
@endsection
