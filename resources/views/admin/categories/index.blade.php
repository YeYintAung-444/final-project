@extends('master')
@extends('admin.admin')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Catgories List</h1>  
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
            	
            	<a href="{{route('categories.create')}}" class="btn btn-success float-right mb-3">Add New</a>
              <div class="table-responsive">

              		<table class="table table-bordered" >
			     			<thead class="thead-dark">
			     			<tr>
			     				<th>#</th>
			     				<th>Name</th>
			     				<th>Photo</th>
                  				{{-- <th>Item Count</th> --}}
			     				<th>Action</th>
			     			</tr>
						    </thead>
			     			<tbody>
               				 @php $i=1; @endphp
			     			@foreach($categories as $category)
			     			<tr>
			     				<td>{{ $i++ }}</td>
			     				<td>{{ $category->name }}</td>
			     				<td><img src="{{asset($category->logo)  }}" width="100" ></td>
                  				{{-- <td>{{ count($category->items) }}</td> --}}
			     				<td>
			     					<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-warning">Edit</a>
				                    <form method="post" action="{{ route('categories.destroy',$category->id) }}" onsubmit="return confirm('Are you sure')" class="d-inline-block">
				                      @csrf
				                      @method('DELETE')
				                      <input type="submit" name="btnsubmit" class="btn btn-danger" value="Delete">
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
	<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection