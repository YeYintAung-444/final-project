@extends('admin.master')

@section('content')
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
            <h4>Product Create Form</h4>
            <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data" class="mt-3">
              @csrf

               <div class="form-group">
                <label for="codeInput">Code Number:</label>
                <input type="text" name="codeno" class="form-control @error('codeno') is-invalid @enderror" id="codeInput" value="{{old('codeno')}}">
                @error('codeno')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="nameInput">Name:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nameInput" value="{{old('name')}}">
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="fileInput">Photo:</label>
                <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror" id="fileInput">
                @error('photo')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

               <div class="form-group">
                <label for="descriptionInput">Description:</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="descriptioinInput" value="{{old('description')}}">
                @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="row">
              <div class="form-group col-6">
                <label for="fileInput">Brand:</label>
                <select class="form-control" name="brand">
                  @php 
                    use App\Brand;
                    $brands=Brand::All();
                  @endphp
                  @foreach($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                  @endforeach
                </select>
              </div>

                <div class="form-group col-6">
                <label for="fileInput">Subcategory:</label>
                <select class="form-control" name="subcategory">
                  @php 
                    use App\Subcategory;
                    $subcategories=Subcategory::All();
                  @endphp
                  @foreach($subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                  @endforeach
                </select>
              </div>
              </div>

                <div class="row">

                <div class="form-group col-4">
                <label for="pcprice">Pc Price:</label>
                <input type="text" name="pcprice" class="form-control @error('pcprice') is-invalid @enderror" id="pcprice" value="{{old('pcprice')}}">
                @error('pcprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-4">
                <label for="dozenprice">Dozen Price:</label>
                <input type="text" name="dozenprice" class="form-control @error('dozenprice') is-invalid @enderror" id="dozenprice" value="{{old('dozenprice')}}">
                @error('dozenprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
             
               <div class="form-group col-4">
                <label for="setprice">Set Price:</label>
                <input type="text" name="setprice" class="form-control @error('setprice') is-invalid @enderror" id="setprice" value="{{old('setprice')}}">
                @error('setprice')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

              <div class="row">
              <div class="form-group col-4">
                <label for="pccount">Pcs Count:</label>
                <input type="text" name="pccount" class="form-control @error('pccount') is-invalid @enderror" id="pccount" value="{{old('pccount')}}">
                @error('pccount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
          
              <div class="form-group col-4">
                <label for="dozencount">Dozens Count:</label>
                <input type="text" name="dozencount" class="form-control @error('dozencount') is-invalid @enderror" id="dozencount" value="{{old('dozencount')}}">
                @error('dozencount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group col-4">
                <label for="setcount">Sets Count:</label>
                <input type="text" name="setcount" class="form-control @error('setcount') is-invalid @enderror" id="setcount" value="{{old('setcount')}}">
                @error('setcount')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
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

@section('script')
  
@endsection