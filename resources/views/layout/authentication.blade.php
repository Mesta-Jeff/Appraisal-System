<!DOCTYPE html>
<html lang="en" data-topbar-color="brand">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') - NES Appraisal System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured appraial system to build CRM, CMS, etc." name="description" />
        <meta content="Skai Mount" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('root/images/favicon.png') }}">

        <!-- Plugin CSS (jQuery Vector Map) -->
        <link href="{{ asset('root/mint/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

        <!-- App CSS (Bootstrap and Custom Styles) -->
        <link href="{{ asset('root/mint/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

        <!-- Icons CSS -->
        <link href="{{ asset('root/mint/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Theme Config JavaScript -->
        <script src="{{ asset('root/mint/assets/js/config.js') }}"></script>


    </head>

    <body class="loading">
        <div id="preloaders"><div id="statuses"><div class="spinners"></div></div></div>

        <div class="account-pages mt-5 mb-5">
            
            @yield('content')

        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            All Right Reserved.
            <script>document.write(new Date().getFullYear())</script> &copy; UEW NES. <small>Community-Edition</small>. Powered By <a href="#">Skai Mount</a> 
        </footer>

        <!-- Vendor js -->
        <script src="{{ asset('root/mint/assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('root/mint/assets/js/app.min.js') }}"></script>
        
    </body>
</html>