@extends('admin.master')

@section('content')
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Ways</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Ways</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Ways List</h4>
            <a  href="{{route('ways.create')}}" class="btn btn-light float-right" style="color: #009688">Add New</a>
            

            <div class="table-responsive mt-3">
              <table class="table table-bordered" id="sampleTable">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Township</th>
                    <th>Road</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @foreach($ways as $way)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$way->township}}</td>
                    <td>{{$way->road}}</td>
                    <td>
                      <a href="{{route('ways.edit',$way->id)}}" class="btn btn-warning btn-sm">Edit</a>

                      <form method="post" action="{{route('ways.destroy',$way->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
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