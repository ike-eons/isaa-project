@extends('admin.app')
@section('title') Invoices @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-line-chart"></i>&nbsp;Invoices</h1>
            <p>List of All Invoices</p>
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
                                        <th> Date </th>
                                        <th> Due Date </th>
                                        <th> Invoice No </th>
                                        <th> Customer </th>
                                        <th> Total Amount </th>
                                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->due_date }}</td>
                                        <td><a href="{{route('admin.invoices.show',$invoice->id)}}">{{ $invoice->number }}</a></td>
                                        <td>{{ $invoice->customer->getTextAttribute() }}</td>
                                        <td>GH¢&nbsp;{{ number_format($invoice->total,2) }}</td>
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
