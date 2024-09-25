@extends('layout.layout')

@section('title')
    Kheldhaara | Login
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title centred"
        style="background-image:url({{ asset('assets/images/academies/login.jpg') }}); margin-top: -324px;">
        <div class="container-fluid container-lg">
        </div>
    </section>
    <!-- page-title end -->

    <!-- form-section -->
    <section class="form-section bg-light m-0 p-3">
        <div class="container-fluid container-lg">
            <div class="row bg-white">
                <div class="video-gallery "
                    style="background-image: url({{ asset('assets/images/academies/reg-log.png') }}); width:40%; margin:auto;">
                </div>
                <div class="form-content custom-content-form">
                    <div class="content-box">
                        <div class="title text-dark text-center">Sign In</div>
                        <div class="text"> </div>
                        <form id="loginForm" action="{{ route('login') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="text-dark">How would you like to login:</label>
                                    <ul class="chicklet-list clearfix" id="loginTab" role="tablist">
                                        <li>
                                            <input type="radio" class="btn-check" name="user-type" id="option1"
                                                value="Academy" autocomplete="off" checked>
                                            <label class="btn user-type-btn text-dark" for="option1">Academy</label>
                                        </li>
                                        <li>
                                            <input type="radio" class="btn-check" name="user-type" id="option2"
                                                value="Player" autocomplete="off" checked>
                                            <label class="btn user-type-btn text-dark" for="option2">Player</label>
                                        </li>
                                    </ul>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <label class="text-dark">Email</label> --}}
                                    <input type="email" id="login-email" name="email" placeholder="Your Email">
                                    <p id="emailError" class="error emailError"></p>
                                    @error('email')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <label class="text-dark">Password</label> --}}
                                    <input type="password" name="password" id="login-password" placeholder="Your Password">
                                    <p id="passwordError" class="error passwordError"></p>
                                    @error('password')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="link"><button type="submit" id="signipbtn"
                                            class="theme-btn ">Login</button></div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <span class="reg-note">Not Registered? <a href="{{ route('getRegister') }}">Click
                                            here</a> to get registered.</span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <span class="reg-note"><a href="{{ route('password.request') }}">Forgot Password?</a> to
                                        reset your password.</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- form-section -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Validate Email
            let emailError = true;
            $("#login-email").keyup(function() {
                validateEmail();
            });

            function validateEmail() {
                const email = document.getElementById("login-email");
                let regex =
                    /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                let s = email.value;
                if (regex.test(s)) {
                    $("#emailError").html("");
                    emailError = true;
                    return true;
                } else {
                    $("#emailError").html("**Please enter valid email.");
                    $("#emailError").css("color", "red");
                    $("#email").focus();
                    emailError = false;
                    return false;
                }
            }

            let passwordError = true;
            $("#login-password").keyup(function() {
                validatePassword();
            });

            function validatePassword() {
                let passwordValue = $("#login-password").val();
                if (passwordValue.length == "") {
                    $("#passwordError").html("**Please enter your Password.");
                    $("#passwordError").css("color", "red");
                    $("#password").focus();
                    passwordError = false;
                    return false;
                }
                if (passwordValue.length < 4) {
                    $("#passwordError").html("**Please enter atleast 4 character.");
                    $("#passwordError").css("color", "red");
                    $("#password").focus();
                    passwordError = false;
                    return false;
                } else {
                    $("#passwordError").html("");
                    passwordError = true;
                    return true;
                }
            }
            // Submit button
            $("#signipbtn").click(function() {
                validatePassword();
                validateEmail();
                if (
                    emailError == true &&
                    passwordError == true
                ) {
                    return true;
                } else {
                    return false;
                }
            });

        });
    </script>
@endsection
