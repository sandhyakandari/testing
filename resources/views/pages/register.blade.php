@extends('layout.layout')

@section('title')
    Kheldhaara | Register
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
    <section class="form-section bg-light m-0 p-0">
        <div class="container-fluid container-lg">
            <div class="row bg-white">
                <div class="video-gallery "
                    style="background-image: url({{ asset('assets/images/academies/reg.jpg') }}); width:40%; margin:auto;">
                </div>
                <div class="form-content custom-content-form">
                    <div class="content-box">
                        <div class="title text-dark text-center">Sign Up</div>
                        <div class="text"> </div>
                        <form id="registrationForm" action="{{ route('register') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="text-dark mb-1">How would you like to register:</label>
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
                                    {{-- <label class="text-dark">Name</label> --}}
                                    <input type="text" id="name" class="name" name="name"
                                        placeholder="Your Name">
                                    <p id="nameError" class="error nameError"></p>
                                    @error('name')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <label class="text-dark">Email</label> --}}
                                    <input type="email" id="email" name="email" placeholder="Your Email">
                                    <p id="emailError" class="error emailError"></p>
                                    @error('email')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <label class="text-dark">Phone</label> --}}
                                    <input type="text" id="phone" name="phone" maxlength="10"
                                        placeholder="Your Phone">
                                    <p id="phoneError" class="error phoneError"></p>
                                    @error('phone')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <label class="text-dark">Password</label> --}}
                                    <input type="password" id="password" name="password" placeholder="Your Password">
                                    <p id="passwordError" class="error passwordError"></p>
                                    @error('password')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <label class="text-dark">Confirm Password</label> --}}
                                    <input type="password" name="cpassword" id="cpassword"
                                        placeholder="Confirm Your Password">
                                    <p id="cPasswordError" class="error cPasswordError"></p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="link"><button type="submit" class="theme-btn signupbtn">Register</button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <span class="reg-note">Already Registered? <a href="{{ route('getLogin') }}">Click
                                            here</a> to Login.</span>
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

            let nameError = true;
            $(".name").keyup(function() {
                validateUsername();
            });

            function validateUsername() {
                let usernameValue = $("#name").val();
                console.log(usernameValue);
                if (usernameValue.length == "") {
                    $("#nameError").html("**Please enter your name.")
                    $("#nameError").css("color", "red");
                    $("#name").focus();
                    nameError = false;
                    return false;
                } else if (usernameValue.length < 3) {
                    $("#nameError").html("**Length of name must be atleast 3 character.");
                    $("#nameError").css("color", "red");
                    $("#name").focus();
                    nameError = false;
                    return false;
                } else {
                    $("#nameError").html("");
                    nameError = true;
                }
            }

            // Validate Email
            let emailError = true;
            $("#email").keyup(function() {
                validateEmail();
            });

            function validateEmail() {
                const email = document.getElementById("email");
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

            // Validate Phone
            let phoneError = true;

            $("#phone").on("input", function() {
                validatePhone();
            });

            function validatePhone() {
                let phoneValue = $("#phone").val().trim();
                let digitsOnly = /^\d+$/; // Regular expression to match only digits

                if (phoneValue === "") {
                    $("#phoneError").html("**Please enter your phone number.");
                    $("#phoneError").css("color", "red");
                    $("#phone").focus();
                    phoneError = false;
                    return false;
                } else if (!digitsOnly.test(phoneValue)) {
                    $("#phoneError").html("**Please enter only numeric digits.");
                    $("#phoneError").css("color", "red");
                    $("#phone").focus();
                    phoneError = false;
                    return false;
                } else if (phoneValue.length !== 10) {
                    $("#phoneError").html("**Please enter a 10-digit phone number.");
                    $("#phoneError").css("color", "red");
                    $("#phone").focus();
                    phoneError = false;
                    return false;
                } else {
                    $("#phoneError").html("");
                    phoneError = true;
                }
            }

            // Validate Password
            let passwordError = true;
            $("#password").keyup(function() {
                validatePassword();
            });

            function validatePassword() {
                let passwordValue = $("#password").val();
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

            // Validate Confirm Password
            let confirmRPasswordError = true;
            $("#cPassword").keyup(function() {
                validateRConfirmPassword();
            });

            function validateRConfirmPassword() {
                confirmRPasswordError = true;
                let confirmPasswordValue = $("#cPassword").val();
                let passwordValue = $("#password").val();
                if (passwordValue != confirmPasswordValue) {
                    $("#cPasswordError").html("**Password didn't Match");
                    $("#cPasswordError").css("color", "red");
                    $("#cPassword").focus();
                    confirmRPasswordError = false;
                    return false;
                } else {
                    $("#cPasswordError").html("");
                    confirmRPasswordError = true;
                    return true;
                }
            }

            // Submit button
            $("#signupbtn").click(function() {
                validateRConfirmPassword();
                validatePassword();
                validatePhone();
                validateEmail();
                validateUsername();
                if (
                    nameError == true &&
                    phoneError == true &&
                    emailError == true &&
                    passwordError == true
                ) {
                    return true;
                } else {
                    return false;
                }
            });
        });

        $('#registrationForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('register') }}',
                data: formData,
                success: function(response) {
                    // Handle the server response
                    console.log(response.message);
                    alert('Success!', response.message, 'success');
                },
                error: function(error) {
                    // Handle errors
                    alert('Error submitting form');
                }
            });


        });
    </script>
@endsection
