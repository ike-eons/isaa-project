@extends('admin.app')
@section('title') Fees @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Student Fees</h1>
            <p>Fee Payment</p>
        </div>
       
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> Index Number </th>
                                <th> Name </th>
                                <th style="width:120px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> PAYMENT</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fees as $fee)
                                    <tr>
                                        <td><a href="#" >
                                            {{ $fee->student->index_no}}</a></td>
                                        <td>{{ $fee->student->getName() }}</td>
                                         <td>{{ $fee->payment }}</td>
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
