@extends('admin.master')

@section('content')
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Ways</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('ways.index') }}">Ways</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4>Way Edit Form</h4>
            <form method="post" action="{{route('ways.update',$way->id)}}" enctype="multipart/form-data" class="mt-3">
              @csrf
              @method('PUT')
              
              <div class="form-group">
                <label for="township">Township:</label>
                <input type="text" name="township" class="form-control @error('township') is-invalid @enderror" id="township" value="{{$way->township}}">
                @error('township')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="road">Street:</label>
                <input type="text" name="road" class="form-control @error('road') is-invalid @enderror" id="road" value="{{$way->road}}">
                @error('road')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-group">
                <input type="submit" name="btn-submit" value="Update" class="btn btn-light" style="color: #009688">
              </div>
            </form>
          </div>
        </div>
      </div>   
    </div>    
  </main>
@endsection

@section('script')
  
@endsection