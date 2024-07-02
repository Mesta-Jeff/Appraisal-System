

<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-sidebar-user="true" data-topbar-color="brand">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title') - NES Appraisal System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured appraial system to build CRM, CMS, etc." name="description" />
        <meta content="Skai Mount" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('root/images/favicon.png') }}">

        <!-- Plugin CSS (jQuery Vector Map) -->
        <link href="{{ asset('root/mint/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

        {{-- SWEET ALERT --}}
        <link href="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('root/mint/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />


        <!-- App CSS (Bootstrap and Custom Styles) -->
        <link href="{{ asset('root/mint/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />


        <!-- DATATABLES -->
        <link href="{{ asset('root/mint/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />


        <!-- Icons CSS -->
        <link href="{{ asset('root/mint/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Theme Config JavaScript -->
        <script src="{{ asset('root/mint/assets/js/config.js') }}"></script>
        



    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <div id="preloaders"><div id="statuses"><div class="spinners"></div></div></div>
            {{-- <div id="preloader"><div id="status"><div class="spinner"></div></div></div> --}}

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
    
                    <ul class="list-unstyled topnav-menu float-end mb-0">

                        <li class="d-none d-lg-block">
                            <form class="app-search">
                                <div class="app-search-box dropdown">
                                    
                                </div>
                            </form>
                        </li>
    
                        <li class="dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="!#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Search">
                                </form>
                            </div>
                        </li>
    
                        <li class="d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light"  id="light-dark-mode" href="#">
                                <i class="fe-moon noti-icon"></i>
                            </a>
                        </li>


                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-navigation noti-icon"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge" style="display: none;">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
    
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-end">
                                            <a href="layouts-detached.html" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
    
                                <div class="noti-scroll" data-simplebar>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-soft-primary text-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Doug Dukes commented on Admin Dashboard
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Mario Drummond</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>
                                    
                                </div>
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>
    
                            </div>
                        </li>
    
            
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge" style="display: none;">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
    
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-end">
                                            <a href="layouts-detached.html" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
    
                                <div class="noti-scroll" data-simplebar>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Mario Drummond</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>

                                    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('root/mint/assets/images/users/avatar-1.jpg') }}" alt="img" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    Username here <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ri-account-circle-line"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ri-settings-3-line"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ri-wallet-line"></i>
                                    <span>My Wallet <span class="badge bg-success float-end">3</span> </span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="ri-lock-line"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item text-danger">
                                    <i class="ri-logout-box-line"></i>
                                    <span>Logout</span>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas" >
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul>

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
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>   
            
                        <li class="dropdown d-none d-xl-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                Create New
                                <i class="mdi mdi-chevron-down"></i> 
                            </a>
                            <div class="dropdown-menu">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-briefcase me-1"></i>
                                    <span>New Projects</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-user me-1"></i>
                                    <span>Create Users</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-bar-chart-line- me-1"></i>
                                    <span>Revenue Report</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a>
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-headphones me-1"></i>
                                    <span>Help & Support</span>
                                </a>
    
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Topbar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

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

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-boxs text-center">
                        <img src="{{ asset('root/mint/assets/images/users/avatar-1.jpg') }}" alt="img" title="Username Here"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-bs-toggle="dropdown">Username here <i class="mdi mdi-chevron-down"></i></a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock me-1"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item text-danger">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-reset">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <hr class="mx-3">
                        <ul id="side-menu">

                            <li class="menu-title">Home</li>
                            <li>
                                <a href="#">
                                    <i class="ri-dashboard-line"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class=" bx bx-git-compare "></i>
                                    <span> My Logs </span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Controls</li>

                            <li id="Settings-Control">
                                <a href="#sidebarEcommerce" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarEcommerce">
                                    <i class="bx bx-command "></i>
                                    <span class="badge bg-danger float-end">All</span>
                                    <span> System Settings </span>
                                </a>
                                <div class="collapse" id="sidebarEcommerce">
                                    <ul class="nav-second-level">
                                        <li id="view-roles"><a href="{{ route('roles')}}">Roles</a></li>
                                        <li id="view-permissions"><a href="{{ route('permissions')}}">Permissions</a></li>
                                        <li id="view-departments"><a href="{{ route('departments')}}">Departments</a></li>
                                        <li id="view-faculties"><a href="{{ route('faculties')}}">Faculties</a></li>
                                        <li id="view-courses"><a href="{{ route('courses')}}">Courses</a></li>
                                        <li id="view-classes"><a href="{{ route('classes')}}">Classes</a></li>
                                        <li id="view-questions"><a href="{{ route('questions')}}">Questions</a></li>
                                        <li id="system-config"><a href="{{ route('system-config')}}">System Config</a></li>
                                        <li id="system-dictionary"><a href="{{ route('system-dictionary')}}">System Dictionary</a></li>
                                        <li id="temp-appraisal"><a href="{{ route('appraisal-config')}}">Temp Appraisal</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li id="Appraisal-Control">
                                <a href="#sidebarEmail" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarEmail">
                                    <i class="fe-book-open"></i>
                                    <span> Appraisal </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmail">
                                    <ul class="nav-second-level">
                                        <li id="available-staff"><a href="{{ route('available-staff') }}">Available Staff</a></li>
                                        <li id="rejected-appraisal"><a href="{{ route('rejected-appraisal') }}">Rejected List</a></li>
                                        <li id="students-been-appraised"><a href="{{ route('students-been-appraised') }}">Students Been Appraised</a></li>
                                        <li id="staff-been-appraised"><a href="{{ route('staff-been-appraised') }}">Staff Been Appraised</a></li>
                                        <li id="appraisal-statistics"><a href="{{ route('appraisal-statistics') }}">General Statistics</a></li>
                                        <li id="lecturer-based-statistics"><a href="{{ route('lecturer-based-statistics') }}">Lecturer Based Statistics</a></li>
                                        <li id="department-based-statistics"><a href="{{ route('department-based-statistics') }}">Dept Based Statistics</a></li>
                                        <li id="faculty-based-statistics"><a href="{{ route('faculty-based-statistics') }}">Faculty Based Statistics</a></li>
                                        <li id="list-of-appraised-staff"><a href="{{ route('list-of-appraised-staff') }}">Appraised Staff</a></li>
                                        <li id="list-of-appraised-students"><a href="{{ route('list-of-appraised-students') }}">Appraised Students</a></li>
                                    </ul>
                                    
                                </div>
                            </li>

                            <li id="Users-Control">
                                <a href="#sidebarTasks" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarTasks">
                                    <i class="ri-team-line"></i>
                                    <span> User Management </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTasks">
                                    <ul class="nav-second-level">
                                        <li id="users-account"><a href="{{ route('users-account')}}">Users Account</a></li>
                                        <li id="view-students"><a href="{{ route('students')}}">Students List</a></li>
                                        <li id="view-staff"><a href="{{ route('staff')}}">Staff List</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="ri-price-tag-line"></i>
                                    <span> Tickets </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Custom</li>

                            <li>
                                <a href="#sidebarExtendedui" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarExtendedui">
                                    <i class="ri-stack-line"></i>
                                    <span class="badge bg-info float-end">Hot</span>
                                    <span> Other s</span>
                                </a>
                                <div class="collapse" id="sidebarExtendedui">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="#">Nestable List</a>
                                        </li>
                                        <li>
                                            <a href="#">Range Slider</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">

                   @yield('content')

                </div> 
                <!-- content -->

                <!-- Footer Start -->
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

        <!-- Right Sidebar -->
        <div class="offcanvas offcanvas-end right-bar" tabindex="-1" id="theme-settings-offcanvas" data-bs-scroll="true" data-bs-backdrop="true" >
            <div data-simplebar class="h-100">
    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    <div class="tab-pane" id="chat-tab" role="tabpanel">
                
                        <form class="search-bar p-3">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search here...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                     

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="fw-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                        <div class="px-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">App Development<span class="float-end">75%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                        </div>

                    </div>

                    <div class="tab-pane active" id="settings-tab" role="tabpanel">
                        <h6 class="fw-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">Theme Settings</span>
                        </h6>

                        <div class="p-3">
                            <div class="alert alert-warning" role="alert">
                                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                            </div>

                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-bs-theme" value="light" id="light-mode-check" checked>
                                <label class="form-check-label" for="light-mode-check">Light Mode</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-bs-theme" value="dark" id="dark-mode-check">
                                <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                            </div>

                            <!-- Width -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-layout-width" value="fluid" id="fluid-check" checked>
                                <label class="form-check-label" for="fluid-check">Fluid</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-layout-width" value="boxed" id="boxed-check">
                                <label class="form-check-label" for="boxed-check">Boxed</label>
                            </div>
                   

                            <!-- Topbar -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-topbar-color" value="light" id="lighttopbar-check">
                                <label class="form-check-label" for="lighttopbar-check">Light</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-topbar-color" value="dark" id="darktopbar-check" checked>
                                <label class="form-check-label" for="darktopbar-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-topbar-color" value="brand" id="brandtopbar-check">
                                <label class="form-check-label" for="brandtopbar-check">UEW</label>
                            </div>


                            <!-- Menu positions -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus Positon <small>(Leftsidebar and Topbar)</small></h6>
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-layout-position" value="fixed" id="fixed-check" checked>
                                <label class="form-check-label" for="fixed-check">Fixed</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-layout-position" value="scrollable" id="scrollable-check">
                                <label class="form-check-label" for="scrollable-check">Scrollable</label>
                            </div>


                            <!-- Menu Color-->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menu Color</h6>
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" value="light" id="light-check">
                                <label class="form-check-label" for="light-check">Light</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" value="dark" id="dark-check">
                                <label class="form-check-label" for="dark-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" value="brand" id="brand-check">
                                <label class="form-check-label" for="brand-check">UEW</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" value="gradient" id="gradient-check">
                                <label class="form-check-label" for="gradient-check">Gradient</label>
                            </div>
                                

                            <div class="d-grid mt-4">
                                <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        {{-- <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-account-group-outline"></i> &nbsp;Who is Here
        </a>
        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn1">
            <i class="mdi mdi-account-convert"></i> &nbsp;Quick View
        </a> --}}
        
        <!-- Vendor js -->
        <script src="{{ asset('root/mint/assets/js/vendor.min.js') }}"></script>

        <!-- KNOB JS -->
        <script src="{{ asset('root/mint/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

        <!-- Apex js -->
        <script src="{{ asset('root/mint/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Plugins js -->
        <script src="{{ asset('root/mint/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

        <!-- Datatables scripts -->
        <script src="{{ asset('root/mint/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>

        <script src="{{ asset('root/mint/assets/libs/select2/js/select2.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('root/mint/assets/js/app.min.js') }}"></script>



        <script>
            $(document).ready(function() {

                //INITIALIZING THE SELECT STYLE
                $('.select2').each(function() { 
                    $(this).select2({ 
                        dropdownParent: $(this).parent(),
                        width: '100%'
                    });
                    // $(this).val($(this).find('option:first').val()).trigger('change');
                });
            });
        </script>

    </body>
</html>
