<!DOCTYPE html>
<html lang="en" data-topbar-color="brand">
    <head>
        <meta charset="utf-8" />
        <title>Error 404 Found | Page not Found | - NES Appraisal System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('root/images/favicon.png') }}">

		<!-- App css -->
		<link href="{{ asset('root/mint/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('root/mint/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

		<!-- icons -->
		<link href="{{ asset('root/mint/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-6 col-xl-4 mb-0">
                            <div class="error-text-box">
                                <svg viewBox="0 0 600 200">
                                    <!-- Symbol-->
                                    <symbol id="s-text">
                                        <text text-anchor="middle" x="50%" y="50%" dy=".5em">error!</text>
                                    </symbol>
                                    <!-- Duplicate symbols-->
                                    <use class="text" xlink:href="#s-text"></use>
                                    <use class="text" xlink:href="#s-text"></use>
                                    <use class="text" xlink:href="#s-text"></use>
                                    <use class="text" xlink:href="#s-text"></use>
                                    <use class="text" xlink:href="#s-text"></use>
                                </svg>
                            </div>

                            <div class="text-center mb-3" style="margin-top: -1.5rem">
                                <a class="logo logo-light">
                                    <span class="logo-lg">
                                        <img src="{{ asset('root/images/logo-text-dark.png') }}" alt="" height="32">
                                    </span>
                                </a>
                            </div>

                            <div class="text-center pt-4">
                                <h3 class="mt-0 mb-2">Error Topic</h3>
                                <p class="mb-3" style="font-weight: bold">the content of the error here....</p>
                                <a href="#" class="btn btn-primary waves-effect waves-light">Back Home</a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    
                </div> <!-- container -->

            </div>

        </div>

    </body>
</html>