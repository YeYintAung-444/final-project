@extends('sales.master')

@section('content')
  <main class="app-content">


    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h4 class="d-inline-block">Customers List</h4>
            <a  href="{{route('customers.create')}}" class="btn btn-light float-right" style="color: #009688">Add New</a>
            

            <div class="table-responsive mt-3">
              <table class="table sampleTable">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>Shop Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($customers as $customer)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$customer->shop_name}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->address}}</td>
                    <td class="align-middle text-center">
                      <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-light btn-sm" style="color: #009688">Edit</a>

                      <form method="post" action="{{route('customers.destroy',$customer->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="btnsubmit" class="btn btn-light btn-sm" value="Delete" style="color: #009688">
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

@section('tablescript')
  {{-- Datatable --}}
    <script type="text/javascript" src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('.sampleTable').DataTable();</script>

@endsection