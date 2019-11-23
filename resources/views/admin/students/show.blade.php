@extends('admin.app')
@section('title') student-details @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> STUDENT INFO </h1>
        </div>
      <a class="btn btn-primary" href="{{route('admin.students.edit',['id' => $targetStudent->id])}}">Edit Student Details</a>
    </div>
    @include('admin.partials.flash')

        <div class="row mb-5">
          <div class="col-md-2">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="modal">General</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.registrations.subjectregistration',['id'=>$targetStudent->id]) }}">Register Subjects</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.registrations.subjectregistration',['id'=>$targetStudent->id]) }}" data-toggle="modal" data-target="#addSubjectRegistrationModal"><i class="fa fa-plus"></i> Add Subjects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#FeeModal" data-target="#addFeeModal" data-toggle="modal">Fees</a></li>
                    <li class="nav-item"><a class="nav-link" href="#addttendanceModal" data-target="#addAttendanceModal" data-toggle="modal">Attendance</a></li>
                  </ul>
            </div>
          </div>

          <div class="col-md-10">

           <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">
              <i class="app-menu__icon fa fa-user-circle">
              </i>
              STUDENT DETAILS
            </h5>
          </div>
          <div class="card-body">
            <div class="row invoice-info">
                <div class="col-7">
                  <table>
                    <tr>
                      <td class="text-right">Name <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $targetStudent->getName() }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Index No. <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $targetStudent->index_no }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Department <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $targetStudent->course->department->department_name }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Course <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $targetStudent->course->course_name }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Regular/Weekend <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $targetStudent->regular_or_weekend }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Nationality <span class="pl-1">:</span></th>
                      <td class="pl-2 py-1"><strong>{{ $targetStudent->nationality }}</strong></td>
                    </tr>

                   
                   </table>
                </div>
                
                <div class="col-5">
                  <img src="{{ asset('storage/'.$targetStudent->image) }}" 
                  alt="Student Photo" class="d-block img-fluid max-width:50% height:auto" />
                
                </div>
            
              </div>
            </div>
          </div>
        </div>
      </div>
            
      <div>
          @foreach ($registrations as $registration)
              @if ($registration->student_id == $targetStudent->id )
                  
                  <student-page :studentid="{{$targetStudent->id}}" 
                  :registrationid="{{$registration->id}}"
                                >
                  </student-page>
              @endif
          @endforeach
      
      </div>

      {{--subject registration modal  --}}
            @include('admin/students/subjectsmodal')
      {{--end of subject registration modal  --}}

      {{-- Fees --}}

      <div class="card card-success card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">
              <span class="app-menu__icon">
                <ion-icon name="cash"></ion-icon>
              </span> FEE PAYMENT
            </h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-9 offset-md-3">
                <h5 class="pl-5">gh₵  {{$targetStudent->fee->payment}}</h5>
              </div>
            </div>
            <div class="row pt-2" style="border-top: 1px solid #f7f7f7">
              <div class="col-md-3 offset-md-9 " >
                <a href="#" class="btn btn-primary"><i class="app-menu__icon fa fa-edit"></i>Edit Fee</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Library --}}
      <div class="card card-danger card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">
              <i class="app-menu__icon fa fa-institution">
              </i>
              LIBRARY CLEARANCE
            </h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-9 offset-md-3">
                @if ($targetStudent->libraryclearance->clearance == 'CLEARED')
                  <h5 class="pl-5 text-success">{{$targetStudent->libraryclearance->clearance}}</h5>
                  
                  @else
                   <h5 class="pl-5 text-danger">{{$targetStudent->libraryclearance->clearance}}</h5>
                  @endif 
              
                
              </div>
            </div>
          </hr>
            <div class="row pt-2" style="border-top: 1px solid #f7f7f7">
              <div class="col-md-3 offset-md-9 " >
                <a href="#" class="btn btn-danger"><i class="app-menu__icon fa fa-edit"></i>Edit Clearance</a>
              </div>
            </div>
            </div>
          </div>
      

      {{-- QA --}}

      <div class="card card-warning card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">
              <i class="app-menu__icon fa fa-quora">
              </i>
              ATTENDANCE VALIDATION
            </h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-9 offset-md-3">
                <h5 class="pl-5">{{$targetStudent->qualityassurance->attendance}} %</h5>
              </div>
            </div>
          </hr>
            <div class="row pt-2" style="border-top: 1px solid #f7f7f7">
              <div class="col-md-3 offset-md-9 " >
                <a href="#" class="btn btn-warning"><i class="app-menu__icon fa fa-edit"></i>Edit Attendance</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>

      
       
        </div>
      </div>
      <div>
          
      </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
