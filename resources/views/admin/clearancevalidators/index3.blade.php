@extends('admin.app')
@section('title') Clearance Validator @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Clearance Validator </h1>
            <p>validation paramaters</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        
      
    </div>
   
    <example-component></example-component>
    
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
