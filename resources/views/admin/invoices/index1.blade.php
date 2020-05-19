@extends('admin.app')
@section('title') Invoices @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-line-chart"></i>&nbsp;Invoices</h1>
            <p>List of All Invoice Generated</p>
        </div>
    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary pull-right">Create Invoice</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th> Invoice No </th>
                                        <th> Customer  </th>
                                        <th> Amount </th>
                                        <th> Invoice Date </th>
                                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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
