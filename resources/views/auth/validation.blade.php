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
    .clearance {
            font-size: 64px;
    }

</style>
    <section class="container">
        <!-- CLEARANCE VALIDATION SECTION  -->
            <div  class="clearance pt-5">
            <div class="container">
                <div class="row">
                <div class=" col-10">
                    <h1 class=" text-center text-danger blink clearance pt-5"> You have not Registered for the Semester !!!<h1>
                </div>
                
            </div>
            </div>
    </section>
@endsection