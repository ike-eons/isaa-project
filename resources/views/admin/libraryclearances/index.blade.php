@extends('admin.app')
@section('title') Library clearance @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Library Clearance</h1>
            <p>clearnce status</p>
        </div>
       
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> INDEX NUMBER </th>
                                <th> NAME </th>
                                <th style="width:120px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> CLERANCE</i></th>>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($libraryclearances as $libraryclearance)
                                    <tr>
                                        <td><a href="#" >
                                            {{ $libraryclearance->student->index_no}}</a>
                                        </td>
                                        <td>{{ $libraryclearance->student->getName() }}</td>
                                         <td class="text-center"><span style="font-weight:bold">{{ $libraryclearance->clearance }}</span></td>
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
