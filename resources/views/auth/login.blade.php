<!-- resources/views/student/dashboard.blade.php -->

@extends('layout.authentication')

@section('title', 'Login')

@section('content')
    
<div class="container">
               
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-4" style="margin-top: 60px;">
            <div class="card" style="border-end-start-radius: 20px; border-start-end-radius: 20px; margin-bottom: -20px;">
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
                        <p class="text-muted mb-4 mt-3">Prioritize your security; keep your credentials private, safe, and secure. Others may attempt to impersonate you.</p>
                    </div>

                    <form id="my-form" action="post">
                        <div class="mb-2">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" placeholder="Enter your username">
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" placeholder="Enter your password">
                                
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="button" id="btn-login"> Continue Login </button>
                        </div>

                    </form>

                    <div class="text-center mt-2">
                        <p> <a href="{{ route('recover-password')}}" class="text-muted ms-1">Reset your password here</a></p>
                    </div>

                </div> <!-- end card-body -->
            </div>
            <!-- end card -->
            <p class="text-muted mt-4">
                If you suspect any unauthorized activity on your account, please report it immediately to our <a href="#"><strong>IT support team</strong></a>.
                 Your account security is our top priority.
            </p>
            
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>


<script>
    document.getElementById('btn-login').addEventListener('click', function() {
        window.location.href = "{{ route('student.dashboard') }}";
    });
</script>


@endsection
