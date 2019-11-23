@extends('admin.app')
@section('title') Quality Assurance @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Quality Assurance</h1>
            <p>Student Class Attendance</p>
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
                                <th> Index Number </th>
                                <th> Name </th>
                                <th  class="text-center text-success">
                                    <i class="app-menu__icon fa fa-bolt "> </i>Attendance (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qualityassurances as $qualityassurance)
                                    <tr>
                                        <td><a href="#" >
                                            {{ $qualityassurance->student->index_no}}</a></td>
                                        <td>{{ $qualityassurance->student->getName() }}</td>
                                         <td>{{$qualityassurance->attendance }}%</td>
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
