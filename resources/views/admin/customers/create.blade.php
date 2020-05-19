@extends('admin.app')
@section('title') Eco | Customer @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>Customer</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Add Customers</h3>
                <form action="{{ route('admin.customers.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        
                        <div class="form-group">
                            <label class="control-label" for="firstname">First Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('firstname') is-invalid @enderror" type="text" name="firstname" id="firstname" value="{{ old('firstname') }}"/>
                            <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="lastname">Last Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" id="firstname" value="{{ old('lastname') }}"/>
                            <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="phone">Phone <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone') }}"/>
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="shop_name">Shop Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('shop_name') is-invalid @enderror" type="text" name="shop_name" id="shop_name" value="{{ old('shop_name') }}"/>
                            <span class="text-danger">@error('shop_name') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="shop_address">Shop Address <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control" name="shop_address" id="shop_address" cols="30" rows="5"></textarea>
                            <span class="text-danger">@error('shop_address') {{ $message }} @enderror</span>
                        </div>

                        

             
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Customer</button>
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
