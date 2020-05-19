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
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th> Date </th>
                                        <th> Stock No </th>
                                        <th> Distributor </th>
                                        <th> Total Amount </th>
                                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->date }}</td>
                                    <td><a href="{{route('admin.stocks.show',$stock->id)}}" >{{ $stock->number }}</a></td>
                                        <td>{{ $stock->distributor->company_name }}</td>
                                        <td>GH¢&nbsp;{{ number_format($stock->total,2) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
