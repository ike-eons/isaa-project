@extends('admin.app')
@section('title') customer-details @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> CUSTOMER DETAILS</a>
        </div>
    </div>
    @include('admin.partials.flash')

    <div class="row mb-5">
        <div class="col-md-2">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="modal">General</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Purchase History</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#addSubjectRegistrationModal"></i>Purchase Analysis</a></li>
            </ul>
        </div>
        </div>

        <div class="col-md-10">

            @include('admin.customers.customer_details')
        </div>
      </div>
      
      {{-- row --}}
      <div class="row">
        <!-- PURCHASE HISTORY -->
            @include('admin.customers.purchase_history')
      </div>  

      {{-- row --}}
      <div class="row">
        <!-- PURCHASE HISTORY -->
            @include('admin.customers.horizontal_chart')
      </div>  
      @foreach ($products as $product)
        @foreach ($target_products as $key=>$target_quantity)
            @if ($key == $product->id)
                <h3>{{$product->name }} => {{$target_quantity}}</h3>
            @endif
            
        @endforeach 
      @endforeach
      
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
