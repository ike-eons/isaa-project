@extends('admin.app')
@section('title') Invoice @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-line-chart"></i>&nbsp;Invoice</h1>
            <p>Create Invoice</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <invoice-form></invoice-form>
        </div>
    </div>

@endsection
@push('scripts')
    {{-- <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script> --}}
@endpush
