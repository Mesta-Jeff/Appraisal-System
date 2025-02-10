@include('./includes/header')

<!-- Begin page -->
<div id="wrapper">


    @include('./includes/preloader')

    <!-- Topbar Start -->
    @include('./includes/topbar')
    <!-- Topbar End -->

    <!-- ========== Left Sidebar Start ========== -->
    @include('./includes/sidebar')
    <!-- Left Sidebar End -->

    <div class="content-page">
        <div class="content">

            @yield('content')

        </div>
        <!-- content -->

        <!-- Footer Start -->
        @include('./includes/footer')
        <!-- end Footer -->

    </div>

</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
@include('./includes/themes')
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('./includes/scripts-footer')
