<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />

        <title> @yield('title') </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />

        <!-- App favicon -->
        <link rel="icon" href="{{asset('assets/favicon.ico')}}" type="image/gif" sizes="16x16">
        <!-- Bootstrap Css -->
        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">


    </head>

    <body data-sidebar="dark">
        

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ URL::to('/admin/home') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{URL::to('/assets/chota-e.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{URL::to('/assets/logo.svg')}}" alt="" height="37">
                                </span>
                            </a>

                            <a href="{{ URL::to('/admin/home') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{URL::to('/assets/chota-e.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{URL::to('/assets/logo.svg')}}" alt="" height="39">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                    

                        @php 
                            $user = Auth::user();
                        @endphp 
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ $user->logo_url ?? URL::to('/admin/assets/images/users/avatar-6.jpg') }}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1">{{ $user->name ?? 'Administrator' }} </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                {{-- <a class="dropdown-item" href="{{ route('admin.profile') }} "><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" onclick='document.getElementById("logout-form").submit();'>
                                    <form id='logout-form' action="{{route('logout')}}" method='POST'>
                                        @csrf
                                    </form>
                                    Logout
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{ URL::to('/admin/home') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span>Dashboards</span>
                                </a>
                              
                            </li>

                            <li>
                                <a href="{{ URL::to('admin/category') }}" class="waves-effect">
                                    <i class="bx bx-layer"></i>
                                    <span>Categories</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ URL::to('admin/badge') }}" class="waves-effect">
                                    <i class="bx bx-badge"></i>
                                    <span>Badges</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ URL::to('admin/reported-issue') }}" class="waves-effect">
                                    <i class="bx bx-bug-alt"></i>
                                    <span>Reported Issue</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ URL::to('admin/contact') }}" class="waves-effect">
                                    <i class="bx bx-envelope"></i>
                                    <span>Contact Us </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ URL::to('admin/preference') }}" class="waves-effect">
                                    <i class="bx bx-wrench"></i>
                                    <span>Preferences</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-key"></i>
                                    <span>Access Control</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ URL::to('admin/role') }}">
                                            <span>Roles</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ URL::to('admin/permission') }}">
                                            <span>Permissions</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        @yield('content')
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © PrepareHow.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Developed by PWH-DCSE
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-right">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-5">
                        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ URL::to('admin/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        {{-- <script src="{{ URL::to('admin/assets/libs/bootstrap/js/bootstrap.min.js') }}"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{ URL::to('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ URL::to('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ URL::to('admin/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ URL::to('admin/assets/libs/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ URL::to('admin/assets/js/pages/form-editor.init.js') }}"></script>
        

        <!-- apexcharts -->
        {{-- <script src="{{ URL::to('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

        <!-- crypto dash init js -->
        {{-- <script src="{{ URL::to('admin/assets/js/pages/crypto-dashboard.init.js') }}"></script> --}}

        <script src="{{ URL::to('admin/assets/js/app.js') }}"></script>

        {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
        <script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        @stack('script')
        {!! Toastr::message() !!}


    </body>
</html>
