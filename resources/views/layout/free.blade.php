<!DOCTYPE html>
<html lang="en" data-layout-mode="horizontal" data-topbar-color="brand">
    <head>

        <meta charset="utf-8" />
        <title>@yield('title') - NES Appraisal System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured appraial system to build CRM, CMS, etc." name="description" />
        <meta content="Skai Mount" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('root/images/favicon.png') }}">

        <link href="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App CSS (Bootstrap and Custom Styles) -->
        <link href="{{ asset('root/mint/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

        <!-- Icons CSS -->
        <link href="{{ asset('root/mint/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Theme Config JavaScript -->
        <script src="{{ asset('root/mint/assets/js/config.js') }}"></script>


    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <div id="preloaders"><div id="statuses"><div class="spinners"></div></div></div>

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
    
                    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <!-- Dark Logo -->
                        <a href="/" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('root/images/main-logo.png') }}" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('root/images/logo-text.png') }}" alt="" height="20">
                            </span>
                        </a>

                        <!-- Light Logo -->
                        <a href="/" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('root/images/main-logo.png') }}" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('root/images/logo-text.png') }}" alt="" height="30">
                            </span>
                        </a>

                    </div>

                    <ul class="list-unstyled topnav-menu mb-0" style="margin-right: 0px;">
                        <li class="d-flex justify-content-center">
                            <div class="waves-effect waves-light">
                                <h3 class="my-3 text-white">...</h3>
                            </div>
                        </li>
                    
                        {{-- <li class="dropdown d-none d-lg-inline-block">
                            <a  class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li> --}}
                    </ul>
                    
    
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Topbar End -->

            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        
                    </nav>
                </div> <!-- end container-fluid -->
            </div> <!-- end topnav-->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                   @yield('content')

                </div> 
                <!-- content -->

                <!-- Footer Start -->
                {{-- <hr> --}}
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                All Right Reserved.
                                <script>document.write(new Date().getFullYear())</script> &copy; UEW NES. <small>Community-Edition</small>. Powered By <a href="#">Skai Mount</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">Privacy Policies</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        

        <!-- Vendor js -->
        <script src="{{ asset('root/mint/assets/js/vendor.min.js') }}"></script>

        <script src="{{ asset('root/mint/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/js/pages/form-wizard.init.js') }}"></script>

        <script src="{{ asset('root/mint/assets/libs/select2/js/select2.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('root/mint/assets/js/app.min.js') }}"></script>
        
    </body>
</html>