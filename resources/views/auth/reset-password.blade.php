<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.authentication')

@section('title', 'Reset Password')

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
                    </div>

                    <div class="text-left">
                        <strong class="text-danger">MUST READ: </strong>
                        <code class="text-muted mb-1">
                            <ul>
                                <li>Use at least 8 characters</li>
                                <li>Include a mix of uppercase and lowercase letters</li>
                                <li>Include numbers and special characters</li>
                                <li>Avoid using easily guessable information, such as your name or birthdate</li>
                            </ul>
                        </code>
                    </div>
                    

                    <form action="l#">
                        <div class="mb-2">
                            <label for="passwords" class="form-label">New Password</label>
                            <input class="form-control" type="password" id="passwords" required="" placeholder="Enter new password">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirmpassword" class="form-control" placeholder="Enter your password">
                                
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Reset Password </button>
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
