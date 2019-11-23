@extends('site.app')
@section('content')

<style>
    @-webkit-keyframes blinker {
        from {opacity: 1.0;}
        to {opacity: 0.3;}
    }
    .blink{
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.6s;
        -webkit-animation-iteration-count:infinite;
        -webkit-animation-timing-function:ease-in-out;
        -webkit-animation-direction: alternate;
    }
    
</style>

    <section class="container">
        <!-- CLEARANCE VALIDATION SECTION  -->
            <div  class="clearance pt-5">
            <div class="container">
                <div class="row">
                <div class="offset-2 col-8">
                    
                    {{-- Fee Requirements --}}

                    <div  @if($student->fee->payment == 0 ) 
                            class=" py-4 mb-3 bg-success"
                          @else
                            class=" py-4 mb-3 bg-danger"  
                          @endif
                        >
                        <div class="row">
                            <div class="col-md-9 ">
                                <h4 class=" text-white text-center">
                                    <i class="app-menu__icon fa fa-money" aria-hidden="true"></i>
                                     MINIMUM FEE REQUIREMENTS : {{--{{$student->libraryclearance->clearance}} --}}
                                </h4>
                            </div>
                            <div class="col-md-2 offset-md-1 text-white">
                                @if($student->fee->payment == 0) 
                                    <span style="font-size:30px;"><i class="fa fa-check"></i></span>
                                @else
                                    <span style="font-size:30px;"><i class="fa fa-close"></i></span> 
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    {{-- Library Clearance  --}}

                    <div  @if($student->libraryclearance->clearance == 'CLEARED') 
                            class=" py-4 mb-3 bg-success"
                          @else
                            class=" py-4 mb-3 bg-danger"  
                          @endif
                        >
                        <div class="row">
                            <div class="col-md-8 ">
                                <h4 class=" text-white text-center">
                                    <i class="app-menu__icon fa fa-institution" aria-hidden="true"></i>
                                     LIBRARY CLEARANCE :
                                </h4>
                            </div>
                            <div class="col-md-2 offset-md-2 text-white">
                                @if($student->libraryclearance->clearance == 'CLEARED') 
                                    <span style="font-size:30px;"><i class="fa fa-check"></i></span>
                                @else
                                    <span style="font-size:30px;"><i class="fa fa-close"></i></span> 
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- attendance --}}
                        <div  @if($student->qualityassurance->attendance == 0) 
                            class=" py-4 mb-3 bg-success"
                          @else
                            class=" py-4 mb-3 bg-danger"  
                          @endif
                        >
                        <div class="row">
                            <div class="col-md-8 ">
                                <h4 class=" text-white text-center">
                                    <i class="app-menu__icon fa fa-book" aria-hidden="true"></i>
                                     SUBJECTS ATTENDANCE ( ELIGIBILITY ) : {{--{{$student->libraryclearance->clearance}} --}}
                                </h4>
                            </div>
                            <div class="col-md-2 offset-md-2 text-white">
                                @if($student->qualityassurance->attendance == 0) 
                                    <span style="font-size:30px;"><i class="fa fa-check"></i></span>
                                @else
                                    <span style="font-size:30px;"><i class="fa fa-close"></i></span> 
                                @endif
                            </div>
                        </div>
                    </div>
                   
                  </div>  
                  {{-- end of column --}}
                </div>
                 {{-- end of row clearance --}}

                <div class="row mt-5 pb-5">
                <div class="offset-3 col-6">
                    @if ( $student->fee->payment == 0 &&
                          $student->libraryclearance->clearance == 'CLEARED' &&
                          $student->qualityassurance->attendance == 0
                        )
                        
                        <a class="btn btn-block btn-lg text-white btn-primary py-3" 
                            href="{{route('auth.hallticket',['id' =>auth()->id(),'student' => $student])}}" class="nav-link text-white">
                            <i class="fa fa-angle-double-right"></i>
                            Proceed To Print Hall-Ticket
                        </a>
                
                    @else
                        <h2 class="text-center text-warning blink pb-5">Make Sure All Requirement Are Met !!!</h2>
                    @endif
                    
                </div>
                </div>
            </div>
            </div>
    </section>
@endsection