$(document).ready(function () {
    let nameError = true;
    $("#name").keyup(function () {
        validateUsername();
    });

    function validateUsername() {
        let usernameValue = $("#name").val();
        if (usernameValue.length == "") {
            $("#nameError").html("**Please enter your name.");
            $("#nameError").css("color", "red");
            $("#name").focus();
            nameError = false;
            return false;
        } else if (usernameValue.length < 3) {
            $("#nameError").html(
                "**Length of name must be atleast 3 character."
            );
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
    $("#email").keyup(function () {
        validateEmail();
    });

    function validateEmail() {
        const email = document.getElementById("email");
        let regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
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

    $("#phone").on("input", function () {
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
    $("#password").keyup(function () {
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
    $("#cPassword").keyup(function () {
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
    $("#signupbtn").click(function () {
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
