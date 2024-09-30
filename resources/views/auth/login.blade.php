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
                        <div id="myAlert" class="alert alert-danger mt-4" role="alert" style="display:none;">
                            <p id="my_para"></p>
                        </div>

                        <div class="mb-2">
                            <label for="emailaddress" class="form-label">Provide Username</label>
                            <input class="form-control" type="text" id="username">
                            <label id="nameError" style="display: none; color: red;">
                                Username should be accurate and it should exist</label>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Enter Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password-input"  class="form-control">  
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                            <label id="passError" style="display: none; color: red;">  Please enter a valid password to your account</label>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="auth-remember-check">
                                <label class="form-check-label" for="auth-remember-check">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="button" id="btnSubmit"> Continue Action </button>
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


<script src="{{ asset('root/mint/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('root/mint/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $(document).ready(function() {

        var rememberedUsername = localStorage.getItem('rememberedUsername');
        if (rememberedUsername !== null) {
            $('#username').val(rememberedUsername);
            $('#auth-remember-check').prop('checked', true);
        }

        $('#btnSubmit').click(function(e) {
            e.preventDefault();
            var buttonElement = $(this);

            var username = $('#username').val();
            var password = $('#password-input').val();

            var rememberMe = $('#auth-remember-check').prop('checked');
            if (rememberMe) {
                localStorage.setItem('rememberedUsername', username);
            } else {
                localStorage.removeItem('rememberedUsername');
            }

            if (username.length < 5) {
                $('#nameError').show();
            } else {
                $('#nameError').hide();
                $("#myAlert").hide();
            }
            if (password.length < 5) {
                $('#passError').show();
            } else {
                $('#passError').hide();
                $("#myAlert").hide();
                if (username.length >= 5 && password.length >= 5) {

                    // Send ajax request to the backend
                    buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Authenticating... ').attr("disabled", true);

                    $.ajax({
                        type: "POST",
                        url: '{{ route('signin') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            username: username,
                            password: password,
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = response.redirect;
                            } else {
                                buttonElement.prop('disabled', false).text('Confirm Action').css('cursor', 'pointer');
                                $("#my_para").html(response.message);
                                $("#myAlert").show();
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            let errorMessage;

                            // Check if the response contains the specific IP field error
                            try {
                                const response = JSON.parse(xhr.responseText);

                                // Check if the response contains the 'message' field
                                if (response.message) {
                                    // Check if 'message' is an object and contains the 'ip' field
                                    if (typeof response.message === 'object' && response.message.ip) {
                                        errorMessage = "Please check your internet connection and try again";
                                    } else {
                                        // Use the general message if available
                                        errorMessage = response.message;
                                    }
                                } else {
                                    errorMessage = "An unknown error occurred. Please try again also check your internet connection";
                                }
                            } catch (e) {
                                errorMessage = "An unknown error occurred. Please try again also check your internet connection";
                            }

                            $("#my_para").html(errorMessage);
                            $("#myAlert").show();
                            buttonElement.prop('disabled', false).text('Confirm Action').css('cursor', 'pointer');
                        }
                    });
                }
            }
        });

        $("#username").on("input", function() {
            if ($(this).val().length > 0) {
                $("#myAlert").hide();
                $('#nameError').hide();
            }
            else{
                $('#nameError').show();
            }
        });

        $("input[type='password']").on("input", function() {
            if ($(this).val().length > 0) {
                $('#passError').hide();
                $("#myAlert").hide();
            } else {
                $('#passError').show();
            }
        });


    });
    </script>


@endsection
