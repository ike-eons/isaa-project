@extends('admin.app')
@section('title') Clearance Validator @endsection
<link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Clearance Validator </h1>
            <p>validation paramaters</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
           
           <div class="card card-danger card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">
              <span class="app-menu__icon">
                {{-- <ion-icon name="checkmark-circled"></ion-icon> --}}
              </span> SET CLEARANCE VALIDATION PARAMETERS
            </h5>
          </div>
          <div class="card-body">

              <div class="row">
                <div class="col-md-4">
                  <h5 class="pl-5">Minimum Fee Required</h5>
                </div>
                <div class="col-md-5">
                  <h5 class="pl-5 text-success">Gh₵  {{$clearancevalidator->fee}}</h5>
                </div>
                <div class="col-md-3 py-2" style="border-bottom: 1px solid #f7f7f7">
                  <a href="#" class="btn btn-primary"><i class="app-menu__icon fa fa-edit"></i>Edit Fee</a>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <h5 class="pl-5">Minimum Attendance Required</h5>
                </div>
                <div class="col-md-5">
                  <h5 class="pl-5 text-success">{{$clearancevalidator->attendance}} %</h5>
                </div>
                <div class="col-md-3 py-2" style="border-bottom: 1px solid #f7f7f7">
                  <a href="#" class="btn btn-primary"><i class="app-menu__icon fa fa-edit"></i>Edit Attendance</a>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <h5 class="pl-5">Library Clearance</h5>
                </div>
                <div class="col-md-5">
                  <h5 class="pl-5 text-success"> {{$clearancevalidator->library}}</h5>
                </div>
        
              </div>

            </div>
          </div> 

        </div>
    </div>
   
    <clearance-validator><clearance-validator>
    
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
