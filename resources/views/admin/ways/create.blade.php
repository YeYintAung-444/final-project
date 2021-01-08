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
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4>Way Register Form</h4>
            <form method="post" action="{{route('ways.store')}}" enctype="multipart/form-data" class="mt-3">
              @csrf
              <div class="form-group">
                <label for="townshipInput">Township:</label>
                <input type="text" name="township" class="form-control @error('township') is-invalid @enderror" id="townshipInput" value="{{old('township')}}">
                @error('township')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="roadInput">Road:</label>
                <input type="text" name="road" class="form-control @error('road') is-invalid @enderror" id="roadInput" value="{{old('road')}}">
                @error('road')
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
