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
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4>Add Stock Form</h4>
            <form action="{{route('stockadd')}}" method="POST">
              @csrf
              @method('GET')
              <input type="hidden" name="state" value="dbset">
              <input type="hidden" name="id" value="{{($product->id)}}">
              <div class="form-group">
                <label for="codeInput">Code Number:</label>
                <input type="text" name="codeno" class="form-control @error('codeno') is-invalid @enderror" id="codeInput" value="{{($product->code_no)}}">
                @error('codeno')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>


              <div class="form-group">
                <label for="pc">Pc Count:</label>
                <input type="text" name="pc" class="form-control @error('pc') is-invalid @enderror" id="codeInput">
                @error('pc')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="dozen">Dozen Count</label>
                <input type="text" name="dozen" class="form-control @error('dozen') is-invalid @enderror" id="dozen">
                @error('dozen')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="set">Set Count</label>
                <input type="text" name="set" class="form-control @error('set') is-invalid @enderror" id="set">
                @error('set')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <input type="submit" name="btn-submit" value="Add" class="btn btn-light" style="color: #009688">
              </div>
            </form>
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