@extends('admin.app')
@section('title') Inventory @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-line-chart"></i>&nbsp;Inventory</h1>
            <p>List of All Inventory Transactions</p>
        </div>
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
                                        <th> #ID </th>
                                        <th> Avaiable Quantity</th>
                                        <th> Total Amount </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->product->getProductDescription() }}</td>
                                        <td>{{ $inventory->available_quantity}}</td>
                                        <td>GH¢&nbsp;{{ $inventory->available_amount }}</td>
                                    </tr>
                            @endforeach
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
