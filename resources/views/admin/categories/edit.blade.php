@extends('admin.app')
@section('title') Eco | Category @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Category</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Add Category</h3>
                <form action="{{ route('admin.categories.update',$targetCategory->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Category Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name',$targetCategory->name) }}"/>
                            <input type="hidden" name="id" value="{{ $targetCategory->id }}">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="description">Category Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                type="text" 
                                name="description" 
                                id="description"
                                rows="3">
                                {{ old('description',$targetCategory->description) }}
                            </textarea>
                            </div>
                            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                        </div>
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')

@endpush
