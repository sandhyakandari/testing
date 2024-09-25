@extends('layout.layout')

@section('title')
Kheldhaara | Forget Password
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
                                <div class="title text-dark text-center">Forgot Password</div>
                                <div class="text-dark mb-3">Enter your email address and we will send you a link to reset your password. </div>
                                <form id="forgetPasswordForm" action="{{ route('password.email')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            {{-- <label class="text-dark">Email</label> --}}
                                            <input type="email" id="reset-email" name="email" placeholder="Enter Your Email">
                                            <p id="emailError" class="error emailError"></p>
                                            @error('email')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="link"><button type="submit" id="resetbtn" class="theme-btn ">Send Reset Password Link</button></div>
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
        
    // Validate Email
    let emailError = true;
    $("#reset-email").keyup(function () {
        validateEmail();
    });
    
    function validateEmail(){
        const email = document.getElementById("reset-email");
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

    // Submit button
    $("#resetbtn").click(function () {
        validateEmail();
        if (
            emailError == true 
        ) {
            return true;
        } else {
            return false;
        }
    });

});
</script>
@endsection