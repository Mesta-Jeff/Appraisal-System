<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-sidebar-user="true" data-topbar-color="brand">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title') - {{ env('APP_TITLE')}}, A product from SkaiMount</title>
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