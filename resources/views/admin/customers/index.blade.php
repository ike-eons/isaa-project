@extends('admin.app')
@section('title') Customer @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>Customer</h1>
            <p>List of All Customers</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary pull-right">Add customer</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Phone </th>
                                <th> Shop Name </th>
                                <th> Shop Address </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td><a href="{{route('admin.customers.show',$customer->id)}}" >{{ $customer->firstname.' '.$customer->lastname }}</a></td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->shop_name }}</td>
                                        <td>{{ $customer->shop_address }}</td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.customers.edit',$customer->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.customers.delete',$customer->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                      
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
