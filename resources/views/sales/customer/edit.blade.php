@extends('sales.master')

@section('content')
  <main class="app-content">

     <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Customers</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4>Customer Edit Form</h4>
            <form method="post" action="{{route('customers.update',$customer->id)}}" enctype="multipart/form-data" class="mt-3">
              @csrf
              @method('PUT')
              
              <div class="form-group">
                <label for="shopnameInput">Shop Name:</label>
                <input type="text" name="shopname" class="form-control @error('shopname') is-invalid @enderror" id="shopnameInput" value="{{$customer->shop_name}}">
                @error('shopname')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="shopnameInput">Phone:</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneInput" value="{{$customer->phone}}">
                @error('shopname')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="shopnameInput">Address:</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="addressInput" value="{{$customer->address}}">
                @error('address')
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
