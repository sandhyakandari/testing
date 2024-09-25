@extends('layout.layout')

@section('title')
Kheldhaara | Reset Password
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title centred" style="background-image:url({{ asset('assets/images/academies/login.jpg') }}); margin-top: -324px;">
        <div class="container">
            {{-- <div class="content-box">
                <div class="title">Login</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home')}}">Home</a></li>
                    <li>Login</li>
                </ul>
            </div> --}}
        </div>
    </section>
    <!-- page-title end -->

        <!-- form-section -->
        <section class="form-section bg-light m-0 p-3">
            <div class="container-fluid clearfix">
                <div class="row bg-white">
                        <div class="video-gallery " style="background-image: url({{ asset('assets/images/forgot_password.png')}}); width:40%; margin:auto;">
                            
                        </div>
                        <div class="form-content custom-content-form m-5">
                            <div class="content-box">
                                <div class="title text-dark text-center">Reset Password</div>
                                <div class="text"> </div>
                                <form id="resetPasswordForm" action="{{ route('password.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            {{-- <label class="text-dark">Password</label> --}}
                                            <input type="password" id="new-password" name="password" placeholder="Enter New Password">
                                            <p id="passwordError" class="error passwordError"></p>
                                            @error('password')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            {{-- <label class="text-dark">Confirm Password</label> --}}
                                            <input type="password" name="cpassword" id="conPassword" placeholder="Confirm Your Password">
                                            <p id="conPasswordError" class="error cPasswordError"></p>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="link"><button type="submit" id="updatebtn" class="theme-btn ">Update Password</button></div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <span class="reg-note"><a href="{{ route('getLogin')}}">Return</a> to Login.</span>
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

$(document).ready(function () {
        
    // Validate Password
    let passwordError = true;
    $("#new-password").keyup(function () {
        validatePassword();
    });
    function validatePassword() {
        let passwordValue = $("#new-password").val();
        if (passwordValue.length == "") {
            $("#passwordError").html("**Please enter your new password.");
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

    // Validate Confirm Password
    let confirmRPasswordError = true;
    $("#conPassword").keyup(function () {
        validateRConfirmPassword();
    });
    function validateRConfirmPassword() {
        confirmRPasswordError = true;
        let confirmPasswordValue = $("#conPassword").val();
        let passwordValue = $("#new-password").val();
        if (passwordValue != confirmPasswordValue) {
            $("#conPasswordError").html("**Password didn't Match");
            $("#conPasswordError").css("color", "red");
            $("#conPassword").focus();
            confirmRPasswordError = false;
            return false;
        } else {
            $("#conPasswordError").html("");
            confirmRPasswordError = true;
            return true;
        }
    }

    // Submit button
    $("#updatebtn").click(function () {
        validateRConfirmPassword();
        validatePassword();
        if (
            passwordError == true  && confirmRPasswordError == true
        ) {
            return true;
        } else {
            return false;
        }
    });

});
</script>
@endsection