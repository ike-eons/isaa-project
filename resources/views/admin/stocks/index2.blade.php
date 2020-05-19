@extends('admin.app')
@section('title') Stocks @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-line-chart"></i>&nbsp;Stocks</h1>
            <p>List of All Stocks</p>
        </div>
    <a href="{{ route('admin.stocks.create') }}" class="btn btn-primary pull-right">Add Stock</a>
    </div>
    @include('admin.partials.flash')
    <all-stocks></all-stocks>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
