@extends('admin.master')

@section('content')
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Price and Stocks</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4>Product Details Form</h4>
            <form method="post" action="{{route('price_stocks.store')}}" enctype="multipart/form-data" class="mt-3">
              @csrf
              <div class="form-group">
                <label for="pid">Product ID:</label>
                <input type="text" name="pid" class="form-control @error('pid') is-invalid @enderror" id="pid" value="{{old('pid')}}">
                @error('pid')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="pcprice">Pc Price:</label>
                <input type="text" name="pcprice" class="form-control @error('pcprice') is-invalid @enderror" id="pcprice" value="{{old('pcprice')}}">
                @error('pcprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="dozenprice">Dozen Price:</label>
                <input type="text" name="dozenprice" class="form-control @error('dozenprice') is-invalid @enderror" id="dozenprice" value="{{old('dozenprice')}}">
                @error('dozenprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
               <div class="form-group">
                <label for="setprice">Set Price:</label>
                <input type="text" name="setprice" class="form-control @error('setprice') is-invalid @enderror" id="setprice" value="{{old('setprice')}}">
                @error('setprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="pccount">Pcs Count:</label>
                <input type="text" name="pccount" class="form-control @error('pccount') is-invalid @enderror" id="pccount" value="{{old('pccount')}}">
                @error('pccount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="dozencount">Dozens Count:</label>
                <input type="text" name="dozencount" class="form-control @error('dozencount') is-invalid @enderror" id="dozencount" value="{{old('dozencount')}}">
                @error('dozencount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="setcount">Sets Count:</label>
                <input type="text" name="setcount" class="form-control @error('setcount') is-invalid @enderror" id="setcount" value="{{old('setcount')}}">
                @error('setcount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>


              
              <div class="form-group">
                <input type="submit" name="btn-submit" value="Save" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>   
    </div>    
  </main>
@endsection
