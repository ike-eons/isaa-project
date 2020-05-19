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
                <h3 class="tile-title">Edit Products</h3>
                <form action="{{ route('admin.products.update',$targetProduct->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">

                        <div class="form-group">
                            <label class="control-label" for="name">Product Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" 
                                type="text" name="name" id="name" 
                                value="{{ old('name',$targetProduct->name) }}"
                            />
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="weight">Product Weight <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('weight') is-invalid @enderror" 
                                type="number" name="weight" id="name" 
                                value="{{ old('weight',$targetProduct->weight) }}"
                            />
                            <span class="text-danger">@error('weight') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="price">Product Price <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" 
                                type="number" name="price" id="name" 
                                value="{{ old('price',$targetProduct->price) }}"
                            />
                            <span class="text-danger">@error('price') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="brand">Product Brand <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('brand') is-invalid @enderror" 
                                type="text" name="brand" id="name" 
                                value="{{ old('brand',$targetProduct->brand_id) }}"
                            />
                            <span class="text-danger">@error('brand') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="category">Product Category <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category') is-invalid @enderror" 
                                type="text" name="category" id="category" 
                                value="{{ old('category',$targetProduct->category_id) }}"
                            />
                            <span class="text-danger">@error('category') {{ $message }} @enderror</span>
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
