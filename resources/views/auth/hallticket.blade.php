@extends('site.app')
@section('content')
@section('name','Examination : Hall Ticket')
    <section class="container">
        
    {{-- student details --}}

        
            <div class="row invoice-info">
                <div class="col-9">
                  <table>
                    <tr>
                      <td class="text-right">Name <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $student->getName() }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Index No. <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $student->index_no }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Department <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $student->course->department->department_name }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Course <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $student->course->course_name }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Regular/Weekend <span class="pl-1">:</span></td>
                      <td class="pl-2 py-1"><strong>{{ $student->regular_or_weekend }}</strong></td>
                    </tr>
                    <tr>
                      <td class="text-right">Nationality <span class="pl-1">:</span></th>
                      <td class="pl-2 py-1"><strong>{{ $student->nationality }}</strong></td>
                    </tr>

                   
                   </table>
                </div>
                
                <div class="col-3">
                  <img src="{{ asset('storage/'.$student->image) }}" 
                  alt="Student Photo" class="d-block img-fluid max-width:50% height:auto" />
                
                </div>
            
              </div>
          

    {{-- end of student details --}}
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">THEORY SUBJECT</h4>
                    </div>
                    <table class="table table-striped">

                        <thead class="thead-light">
                            <tr>
                                <th>Course Code</th>
                                <th>Subject Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Invigilators Signature</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td scope="row">BUS433</td>
                                <td>ENGINEERING ECONOMICS</td>
                                <td>21/07/2018</td>
                                <td>1:00PM - 4:00PM</td>
                                <td> </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-5 signature">
            <div class="col-6 mt-5">
                <p class="pt-3 font-weight-bold">STUDENT'S SIGNATURE</p>
            </div>
            <div class="col-6 mt-5">
                <div class="row">

                <div class="offset-6 col-6">
                    <p class="pt-3 text-center font-weight-bold">STUDENT VERIFICATION</p>
                <img src="{{asset('images/students/qrcode.png')}}" width="250" alt="qr code">
                </div>
                </div>
            </div>
        </div>
    </section>

@endsection