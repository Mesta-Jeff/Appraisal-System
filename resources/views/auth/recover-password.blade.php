<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.authentication')

@section('title', 'Recover Password')

@section('content')
    
<div class="container">
               
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-4" style="margin-top: 60px;">
            <div class="card">
                <div class="card-body p-4">
                    
                    <div class="text-center w-95 m-auto">
                        <div class="auth-logo">
                            <a href="#" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('root/images/main-logo.png') }}" alt="" height="52">
                                </span>
                            </a>
        
                            <a href="#" class="logo logo-light text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('root/images/main-logo.png') }}" alt="" height="52">
                                </span>
                            </a>
                        </div>
                        <div class="alert alert-info mt-3 mb-4" role="alert">
                            Enter your email address, and we'll send you an email with instructions to reset your password.
                        </div>
                        
                    </div>

                    <form action="l#">
                        <div class="mb-4">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email address">
                        </div>

                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Recover Password </button>
                        </div>

                    </form>
                </div> 
            </div>
            <!-- end card -->

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">Back to <a href="{{ route('login')}}" class="text-primary fw-medium ms-1">Log in</a></p>
                </div> <!-- end col -->
            </div>

        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>

@endsection
