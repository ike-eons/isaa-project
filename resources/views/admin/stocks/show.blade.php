@extends('admin.app')
@section('title') Stocks @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text-o"></i>&nbsp;Stocks</h1>
            <p>Printable Stock Invoice</p>
        </div>
    <a href="{{ route('admin.stocks.create') }}" class="btn btn-primary pull-right">Edit Stock</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="tile">
                        <div class="tile-body">
                            From:
                            <div class="row">
                                <div class="col-md-7">
                                
                                <h4>{{$stock->distributor->company_name}}</h4>
                                <p><i class="fa fa-address-card">&nbsp;</i>{{$stock->distributor->address}} <br>
                                <i class="fa fa-phone text-primary" aria-hidden="true">&nbsp; </i> {{$stock->distributor->phone}} <br>
                                <i class="fa fa-envelope-square">&nbsp;</i>{{$stock->distributor->email}}</p>
                                </div>
                                <div class="col-md-5">
                                    <h5>Distro No# {{ $stock->reference }} </h5>
                                    <p class="text-bold">Stock No: {{$stock->number}}</p>
                                    <p class="text-bold">Date: {{$stock->date}}</p>
                                </div>
                            </div>
                            {{-- table --}}
                            <div class="row">
                                <div class="col-12 table-responsive">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Product Discription</th>
                                        <th>Price(per Carton)</th>
                                        <th>Qty(in Carton)</th>
                                        <th>Subtotal</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      
                                        @foreach ($stock->stock_items as $item)
                                        <tr>
                                            <td>{{ $item->product->description }}</td>
                                            <td> GH¢&nbsp;{{ number_format($item->product->stock_price) }}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td> GH¢&nbsp;{{ number_format($item->product->stock_price * $item->quantity) }}</td>
                                        </tr>
                                        @endforeach
                                      
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col-md-4 offset-md-8 text-center">
                                        <h5 style="border: 1px #e5e5e5 solid; padding:5px 0px">Total: GH¢&nbsp; {{number_format($stock->total)}}</h5>
                                </div>
                              </div>
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
