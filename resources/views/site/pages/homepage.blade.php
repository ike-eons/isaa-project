@extends('site.app')

@section('content')
<style>
            html, body {
                
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
                color: black
            }
            
            .clearance {
                font-size: 64px;
            }
             @-webkit-keyframes blinker {
                from {opacity: 1.0;}
                to {opacity: 0.7;}
            }
            .blink{
                text-decoration: blink;
                -webkit-animation-name: blinker;
                -webkit-animation-duration: 0.6s;
                -webkit-animation-iteration-count:infinite;
                -webkit-animation-timing-function:ease-in-out;
                -webkit-animation-direction: alternate;
            }

                    .links > a {
                        color: #636b6f;
                        padding: 0 25px;
                        font-size: 13px;
                        font-weight: 600;
                        letter-spacing: .1rem;
                        text-decoration: none;
                        text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    <div class="container ">
        <div class="row">
            <div class="col-md-10 offset-md-1" style="margin-top: 50px">
                @if (Route::has('login'))
                    <div class="links py-5 ">
                        @auth
                            <h1><a class="nav-item pt-5 clearance blink" href="{{route('auth.clearance',auth()->id() )}}">CHECK CLEARANCE STATUS</a></h1>
                        @else
                            <h1><a class="nav-item pt-5 clearance blink" href="{{route('login')}}">CHECK CLEARANCE STATUS</a></h1> 
                        @endauth    
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection