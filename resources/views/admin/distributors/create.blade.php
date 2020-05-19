@extends('admin.app')
@section('title') Add New Distributor @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Distributor</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Add new Distributor</h3>
                <form action="{{ route('admin.distributors.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('company_name') is-invalid @enderror" type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"/>
                            <span class="text-danger">@error('company_name') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="phone">Phone <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ old('phone') }}"/>
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="company_name" value="{{ old('email') }}"/>
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="address"> Address <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="5"></textarea>
                            <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                        </div>
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Distributor</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.distributors.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')

@endpush
