@extends('admin.app')
@section('title') Product @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>Products</h1>
            <p>List of All products</p>
        </div>
    <a href="{{route('admin.products.create')}}" class="btn btn-primary pull-right">Add product</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                            
                                <th style="min-width:80px">Name</th>
                                <th>Description</span></th>
                                {{-- <th>Quantity <span class="text-danger">( /carton )</span></th> --}}
                                <th>Stock Price <span class="text-danger">( GH¢ )</span></th>
                                <th>Sales Price <span class="text-danger">( GH¢ )</span></th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th style="width:80px; min-width:60px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                    <tr>
                                        
                                        <td><a href="#" >{{ $product->name }}</a></td>
                                        {{-- <td>{{ $product->weight }} <span class="text-bold">g</span></td> --}}
                                        <td>{{ $product->getProductDescription() }}</td>
                                        <td class="text-success">GH¢&nbsp;{{number_format($product->stock_price,2)}}</td>
                                        <td class="text-info">GH¢&nbsp;{{number_format($product->sales_price,2)}}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
