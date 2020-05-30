@extends('admin.app')
@section('title') Invoice @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text-o"></i>&nbsp;Invoice</h1>
            <p>Printable Invoice</p>
        </div>
    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary pull-right">Edit Invoice</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="tile">
                        <div class="tile-body">
                            
                            <div class="row">
                                <div class="col-md-5">
                                    <small>From:</small>
                                    <h4>Emmandget 19 Enterprise</h4>
                                    <p><i class="fa fa-phone-square"></i>&ensp;0244547665<br>
                                        <i class="fa fa-envelope-square"></i>&ensp;e.agyeidarko@gmail.com
                                    </p>
                                    

                                </div>
                                <div class="col-md-4">
                                    <small>To:</small>
                                    <h4>{{$invoice->customer->getTextAttribute()}}</h4>
                                    <p><i class="fa fa-address-card">&nbsp;</i>{{$invoice->customer->shop_name}} <br>
                                        &ensp;&emsp;{{$invoice->customer->shop_address}} <br>
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>&ensp; {{$invoice->customer->phone}}</p>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <p><span class="text-bold">&ensp;&ensp;&ensp;&ensp;Date</span> : {{$invoice->date}} <br>
                                       <span class="text-bold">Due Date </span> : {{$invoice->due_date}}</p>
                                    <p class="text-bold">Invoice No: {{$invoice->number}}</p>
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
                                      
                                        @foreach ($invoice->invoice_items as $item)
                                        <tr>
                                            <td>{{ $item->product->getTextAttribute() }}</td>
                                            <td> GH¢ {{ number_format($item->product->sales_price,2) }}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td> GH¢ {{ number_format($item->product->sales_price * $item->quantity,2) }}</td>
                                        </tr>
                                        @endforeach
                                      
                                    </tbody>
                                  </table>
                                </div>

                                <div class="col-md-4 offset-md-8 text-center">
                                    <h5 style="border: 1px #e5e5e5 solid; padding:5px 0px">Total: GH¢&nbsp; {{number_format($invoice->total,2)}}</h5>
                                </div>
                              </div>
                        </div>

                        {{-- print button --}}
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
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
