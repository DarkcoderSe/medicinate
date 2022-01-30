<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!-- App favicon -->
        <link rel="icon" href="{{asset('assets/favicon.ico')}}" type="image/gif" sizes="16x16">


        <!-- Bootstrap Css -->
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="home-btn d-none d-sm-block">
            <a href="{{ URL::to('/') }} " class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        <div class="account-pages my-5 pt-sm-5">
            @yield('content')
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{URL::to('admin/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{URL::to('admin/assets/libs/node-waves/waves.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{URL::to('admin/assets/js/app.js')}}"></script>
    </body>
</html>
