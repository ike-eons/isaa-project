@extends('admin.app')
@section('title') Eco | Product @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>Product</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Add Products</h3>
                <form action="{{ route('admin.products.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        
                        <div class="form-group">
                            <label class="control-label" for="name">Product Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="weight">Product Weight <span class="m-l-5 text-danger"> *( in grams (/g) )</span></label>
                            <input class="form-control @error('weight') is-invalid @enderror" type="number" name="weight" id="name" value="{{ old('weight') }}"/>
                            <span class="text-danger">@error('weight') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="carton_quantity">Carton's Quantity <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('carton_quantity') is-invalid @enderror" type="number" step=".01" name="carton_quantity" id="carton_quantity" value="{{ old('carton_quantity') }}"/>
                            <span class="text-danger">@error('carton_quantity') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="stock_price"> Stock Price <span class="m-l-5 text-danger"> *( price/carton )</span></label>
                            <input class="form-control @error('stock_price') is-invalid @enderror" type="number" step=".01" name="stock_price" id="stock_price" value="{{ old('stock_price') }}"/>
                            <span class="text-danger">@error('stock_price') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sales_price"> Sales Price <span class="m-l-5 text-danger"> *( price/carton )</span></label>
                            <input class="form-control @error('sales_price') is-invalid @enderror" 
                                type="number" step=".01" name="sales_price" 
                                id="sales_price" value="{{ old('sales_price') }}"
                            />
                            <span class="text-danger">@error('sales_price') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="brand">Product Brand <span class="m-l-5 text-danger"> *</span></label>
                           
                            <select class="form-control custom-select mt-15 @error('course_id') is-valid @enderror " name="brand_id" id="brand_id">
                                <option value="">Select a Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}  ">
                                                {{ $brand->name }}
                                        </option>
                                    @endforeach
                            </select>
                            <span class="text-danger">@error('brand_id') {{ $message }} @enderror</span>
                            
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="category">Product Category <span class="m-l-5 text-danger"> *</span></label>
                           
                            <select class="form-control custom-select mt-15 @error('course_id') is-valid @enderror " name="category_id" id="category_id">
                                <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}  ">
                                                {{ $category->name }}
                                        </option>
                                    @endforeach
                            </select>
                            <span class="text-danger">@error('category_id') {{ $message }} @enderror</span>
                            
                        </div>

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Product</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.products.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')

@endpush
