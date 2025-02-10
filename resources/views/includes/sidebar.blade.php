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
            <img src="{{ asset('root/mint/assets/images/users/avatar-1.jpg') }}" alt="img" title="{{ session('name')}}"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="#" class="mt-4 mb-2 text-reset" data-bs-toggle="dropdown">{{ session('name' ?? '')}}</a>
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
                    <a href="{{ route('logout')}}" class="dropdown-item notify-item text-danger">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-reset" style="color: teal !important; font-weight: 900">{{ session('role') ?? ''}}</p>
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
                            <li id="view-faculties"><a href="{{ route('faculties')}}">Faculties</a></li>
                            <li id="view-departments"><a href="{{ route('departments')}}">Departments</a></li>
                            <li id="view-programme"><a href="{{ route('programmes')}}">Programme</a></li>
                            <li id="view-academic-year"><a href="{{ route('sessions')}}">Academic Year</a></li>
                            <li id="view-semester"><a href="{{ route('semester')}}">Semester</a></li>
                            <li id="view-courses"><a href="{{ route('courses')}}">Create Courses</a></li>
                            <li id="view-classes"><a href="{{ route('classes')}}">Level</a></li>
                            {{-- <li id="view-academic-year-semester"><a href="{{ route('session-semester')}}">Academic Semester</a></li> --}}
                            <li id="view-academic-year-semester-course"><a href="{{ route('session-course')}}">Mount Courses</a></li>                            
                            <li id="view-questions">
                                <a href="pages-starter.html#sidebarMultilevel2" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarMultilevel2">
                                    Manage Questions <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li><a href=" {{ route('question.section')}}">Sections</a></li>
                                        <li><a href="{{ route('questions')}}">Questions</a></li>
                                        <li><a href="{{ route('options')}}">Options</a></li>
                                        <li><a href="{{ route('question.option')}}">Questions & Options</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li id="Lecturer-courses"><a href="{{ route('lecturer.courses')}}">Assign Lecturer a Course</a></li>
                            <li id="system-dictionary"><a href="{{ route('system-dictionary')}}">System Configuration</a></li>
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

                {{-- <li class="menu-title mt-2">Custom</li>
                <li>
                    <a href="#sidebarExtendedui" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sidebarExtendedui">
                        <i class="ri-stack-line"></i>
                        <span class="badge bg-info float-end">Hot</span>
                        <span> Others</span>
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
                </li> --}}

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>