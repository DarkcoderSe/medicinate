<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>
            @yield('title')Online Donation Unused Medicines for NGOs
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('admin/assets/libs/owl.carousel/assets/owl.carousel.min.css')}}">

        <link rel="stylesheet" href="{{asset('admin/assets/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        @stack('styles')

        <style>
            .nav-sticky .os {
                color: #000 !important;
            }

            .sticky {
                color: aliceblue;
            }
        </style>
        @yield('styles')
    </head>

    <body data-spy="scroll" data-target="#topnav-menu" data-offset="60">

        <nav class="navbar navbar-expand-lg navigation fixed-top sticky">
            <div class="container">
                <a class="navbar-logo" href="{{ URL::to('/') }}">
                    <img src="{{URL::to('admin/assets/logo.png')}}" alt="" height="65" class="logo logo-dark">
                    <img src="{{URL::to('admin/assets/logo.png')}}" alt="" height="65" class="logo logo-light">
                </a>

                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav ml-auto" id="topnav-menu" >
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ URL::to('/') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('donation') }}">Donate Medicines</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('donation/history') }}">My Donations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('feedback') }}">Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('ngo') }}">NGOs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/#faqs') }}">FAQs</a>
                        </li>

                    </ul>

                    @guest
                    <div class="ml-lg-2">
                        <a href="{{ URL::to('login') }}" class="btn btn-outline-success w-xs">Login</a>
                    </div>
                    <div class="ml-lg-2">
                        <a href="{{ URL::to('register') }}" class="btn btn-link text-light os w-xs">Register</a>
                    </div>
                    @else
                    <div class="ml-lg-2 mr-2">
                        <a href="javascript:void(0);" class="text-light os w-xs">{{ auth()->user()->name ?? '' }}</a>

                    </div>
                    <div class="ml-lg-2">
                        <a href="javascript:void(0);" class="btn btn-danger text-light w-xs" onclick='document.getElementById("logout-form").submit();'>Logout</a>
                        <form id='logout-form' action="{{route('logout')}}" method='POST'>
                            @csrf
                        </form>

                    </div>
                    @endguest
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- Footer start -->
        <footer class="landing-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <img src="assets/images/logo-light.png" alt="" height="20">
                        </div>

                        <p class="mb-2">2020 © Online Unused Medicine Donation for NGOs</p>
                    </div>

                </div>
            </div>
            <!-- end container -->
        </footer>
        <!-- Footer end -->

        <!-- JAVASCRIPT -->
        <script src="{{URL::to('admin/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{URL::to('admin/assets/libs/jquery.easing/jquery.easing.min.js')}}"></script>

        <!-- Plugins js-->
        <script src="{{URL::to('admin/assets/libs/jquery-countdown/jquery.countdown.min.js')}}"></script>

        <!-- owl.carousel js -->
        <script src="{{URL::to('admin/assets/libs/owl.carousel/owl.carousel.min.js')}}"></script>

        <!-- ICO landing init -->
        <script src="{{URL::to('admin/assets/js/pages/ico-landing.init.js')}}"></script>

        <script src="{{URL::to('admin/assets/js/app.js')}}"></script>

        <script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

        @stack('script')
        {!! Toastr::message() !!}

        @yield('scripts')

    </body>
</html>
