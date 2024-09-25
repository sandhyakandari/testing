import {
    itaNumberFunction,
    enterNameChangeHandler,
    enterMiddleNameFunctionHandler,
    enterNumberChangeHandler,
    enterEmailChangeHandler,
    selectItemChangeHandler,
    enterItemChangeHandler,
    checkboxChangeHandler,
    preventFormSubmitHandler,
} from "./functions.js";
("use strict");
document.addEventListener("DOMContentLoaded", () => {
    // player-complete-registration variable
    const playerCompleteRegisterElm = document.playerCompleteRegister;
    const ita_number_Elm = document.getElementById("ita_number");
    let itaNumberError = document.getElementById("itaNumberError");
    const firstNameElm = document.getElementById("firstName");
    let firstNameError = document.getElementById("firstNameError");
    const middleNameElm = document.getElementById("middleName");
    let middleNameError = document.getElementById("middleNameError");
    const lastName = document.getElementById("lastName");
    let lastNameError = document.getElementById("lastNameError");
    const guardianName = document.getElementById("guardianName");
    let guardianNameError = document.getElementById("guardianNameError");
    const dateValue = document.getElementById("dateValue");
    let dobError = document.getElementById("dobError");
    const mobileNumber = document.getElementById("mobileNumber");
    let mobileNumberError = document.getElementById("mobileNumberError");
    const email = document.getElementById("email");
    let emailError = document.getElementById("emailError");
    const addressLine1Elm = document.getElementById("addressLine1");
    let addressLineOneErrorElm = document.getElementById("addressLineOneError");
    const addressLine2Elm = document.getElementById("addressLine2");
    let addressLineTwoErrorElm = document.getElementById("addressLineTwoError");
    const district = document.getElementById("district");
    let districtError = document.getElementById("districtError");
    const playerPinElm=document.getElementById("playerPin")
    let playerPinErrorElm=document.getElementById("playerPinError")
    const state = document.getElementById("state");
    let stateError = document.getElementById("stateError");
    const country = document.getElementById("country");
    let countryError = document.getElementById("countryError");
    const photo = document.getElementById("photo");
    let photoError = document.getElementById("photoError");
    const hereBy = document.getElementById("hereBy");
    let hereByError = document.getElementById("hereByError");
    const playerAbideTermsConditionsElm=document.getElementById("abideTermsConditions")
    let playerAbideTermsConditionsErrorElm=document.getElementById("abideTermsConditionsError")
    const disputeShall = document.getElementById("disputeShall");
    let disputeShallError = document.getElementById("disputeShallError");

    // academy complete registration variable
    const academyCompleteRegister = document.academyCompleteRegister;
    const aita_numberElm = document.getElementById("aita_number");
    let aitaAcademyNumberErrorElm = document.getElementById(
        "aitaAcademyNumberError"
    );
    const academyNameElm = document.getElementById("academyName");
    let academyNameErrorElm = document.getElementById("academyNameError");
    const ownerManagerNameElm = document.getElementById("ownerManagerName");
    let ownerManagerNameErrorElm = document.getElementById(
        "ownerManagerNameError"
    );
    const academyMobileNumberElm = document.getElementById(
        "academyMobileNumber"
    );
    let academyMobileNumberErrorElm = document.getElementById(
        "academyMobileNumberError"
    );
    const academyEmailElm = document.getElementById("academyEmail");
    let academyEmailErrorElm = document.getElementById("academyEmailError");
    const numberOfCourtsElm = document.getElementById("numberOfCourts");
    let numberOfCourtsError = document.getElementById("numberOfCourtsError");
    const academyCityElm=document.getElementById("academyCity")
    let academyCityErrorElm=document.getElementById("academyCityError")
    const academyPinElm=document.getElementById("academyPin")
    let academyPinErrorElm=document.getElementById("academyPinError")
    const academyStateElm=document.getElementById("academyState")
    let academyStateErrorElm=document.getElementById("academyStateError")
    const academyPhotoElm = document.getElementById("academyPhoto");
    let academyPhotoErrorElm = document.getElementById("academyPhotoError");
    const academyHereByElm = document.getElementById("academyHereBy");
    let academyHereByErrorElm = document.getElementById("academyHereByError");
    const abideTermsConditionsElm=document.getElementById("abideTermsConditions")
    let abideTermsConditionsErrorElm=document.getElementById("abideTermsConditionsError")
    const academyDisputeShall = document.getElementById("academyDisputeShall");
    let academyDisputeShallErrorElm = document.getElementById(
        "academyDisputeShallError"
    );
    const countryCodeElm = document.getElementById("countryCode");
    const academyAddressElm=document.getElementById("academyAddress")
    let academyAddressErrorElm=document.getElementById("academyAddressError")

    // player-complete-registration functions
    if (playerCompleteRegisterElm) {
        // ita_number_Elm.addEventListener("keyup", function (event) {
        //     itaNumberFunction(
        //         event,
        //         itaNumberError,
        //         "Please enter AITA number!"
        //     );
        // });
        firstNameElm.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                firstNameError,
                "Please enter your first name!"
            );
        });
        middleNameElm.addEventListener(
            "keyup",
            enterMiddleNameFunctionHandler.bind(middleNameError)
        );
        lastName.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                lastNameError,
                "Please enter your last name!"
            );
        });
        guardianName.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                guardianNameError,
                "Please enter your guardian name!"
            );
        });
        dateValue.addEventListener("change", function (event) {
            enterItemChangeHandler(
                event,
                dobError,
                "Please select your date of birth!"
            );
        });
        mobileNumber.addEventListener("keyup", function (event) {
            enterNumberChangeHandler(
                event,
                mobileNumberError,
                "Please enter your mobile number!"
            );
        });
        email.addEventListener("keyup", function (event) {
            enterEmailChangeHandler(
                event,
                emailError,
                "Please enter your email!"
            );
        });
        addressLine1Elm.addEventListener("keyup", function (event) {
            itaNumberFunction(
                event,
                addressLineOneErrorElm,
                "Please enter your address!"
            );
        });
        addressLine2Elm.addEventListener("keyup", function (event) {
            itaNumberFunction(
                event,
                addressLineTwoErrorElm,
                "Please enter your address!"
            );
        });
        district.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                districtError,
                "Please enter your district name!"
            );
        });
        playerPinElm.addEventListener("keyup", event=>{
            enterNumberChangeHandler(event, playerPinErrorElm, "Please enter your pin code!")
        })
        state.addEventListener("change", function (event) {
            enterItemChangeHandler(
                event,
                stateError,
                "Please enter your state name!"
            );
        });
        country.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                countryError,
                "Please enter your country name!"
            );
        });
        photo.addEventListener("change", function (event) {
            selectItemChangeHandler(
                event,
                photoError,
                "Please select profile picture!"
            );
        });
        hereBy.addEventListener("change", function (event) {
            checkboxChangeHandler(event, hereByError);
        });
        playerAbideTermsConditionsElm.addEventListener("change", event=>{
            checkboxChangeHandler(event, playerAbideTermsConditionsErrorElm);
        })
        disputeShall.addEventListener("change", function (event) {
            checkboxChangeHandler(event, disputeShallError);
        });
        // form submit
        playerCompleteRegisterElm.addEventListener("submit", function (event) {
            event.preventDefault()
            const ita_number_value = this.ita_number.value;
            const firstNameValue = this.firstName.value;
            const middleNameValue = this.middleName.value;
            const lastNameValue = this.lastName.value;
            const guardianNameValue = this.guardianName.value;
            const dobValue = this.dob.value;
            const phoneValue = this.phone.value;
            const emailValue = this.email.value;
            const address_line_1 = this.address_line_1.value;
            const address_line_2 = this.address_line_2.value;
            const districtValue = this.district.value;
            const pinValue = this.pin.value;
            const stateValue = this.state.value;
            const countryValue = this.country.value;
            const photoValue = this.photo.value;
            const hereByValue = this.hereBy;
            const abideTermsConditionsValue=this.abideTermsConditions;
            const disputeShallValue = this.disputeShall;

            if (firstNameValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    firstNameError,
                    "Please enter your first name!",
                    firstNameElm
                );
                return false;
            } else if (firstNameError.textContent) {
                preventFormSubmitHandler(
                    event,
                    firstNameError,
                    "Please enter your valid name!",
                    firstNameElm
                );
                return false;
            } else if (middleNameError.textContent) {
                preventFormSubmitHandler(
                    event,
                    middleNameError,
                    "Please enter your valid middle name!",
                    middleNameElm
                );
                return false;
            } else if (lastNameValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    lastNameError,
                    "Please enter your last name!",
                    lastName
                );
                return false;
            } else if (lastNameError.textContent) {
                preventFormSubmitHandler(
                    event,
                    lastNameError,
                    "Please enter valid last name!",
                    lastName
                );
                return false;
            } else if (guardianNameValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    guardianNameError,
                    "Please enter your guardian name!",
                    guardianName
                );
                return false;
            } else if (guardianNameError.textContent) {
                preventFormSubmitHandler(
                    event,
                    guardianNameError,
                    "Please enter valid guardian name!",
                    guardianName
                );
                return false;
            } else if (dobValue === "") {
                preventFormSubmitHandler(
                    event,
                    dobError,
                    "Please select your date of birth!",
                    dateValue
                );
                return false;
            } else if (dobError.textContent) {
                preventFormSubmitHandler(
                    event,
                    dobError,
                    "Please enter select your valid date of birth!",
                    dateValue
                );
                return false;
            } else if (phoneValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    mobileNumberError,
                    "Please enter your mobile number!",
                    mobileNumber
                );
                return false;
            } else if (mobileNumberError.textContent) {
                preventFormSubmitHandler(
                    event,
                    mobileNumberError,
                    "Please enter your valid mobile number!",
                    mobileNumber
                );
                return false;
            } else if (emailValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    emailError,
                    "Please enter your email!",
                    email
                );
                return false;
            } else if (emailError.textContent) {
                preventFormSubmitHandler(
                    event,
                    emailError,
                    "Please enter your valid email!",
                    email
                );
                return false;
            } else if (photoValue.length === 0) {
                preventFormSubmitHandler(
                    event,
                    photoError,
                    "Please select your profile picture!",
                    photo
                );
                return false;
            } else if (photoError.textContent) {
                preventFormSubmitHandler(
                    event,
                    photoError,
                    "Please select your valid profile picture!",
                    photo
                );
                return false;
            } else if (address_line_1.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    addressLineOneErrorElm,
                    "Please enter your address!",
                    addressLine1Elm
                );
                return false;
            } else if (addressLineOneErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    addressLineOneErrorElm,
                    "Please enter your address!",
                    addressLine1Elm
                );
                return false;
            } else if (address_line_2.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    addressLineTwoErrorElm,
                    "Please enter your address!",
                    addressLine2Elm
                );
                return false;
            } else if (addressLineTwoErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    addressLineTwoErrorElm,
                    "Please enter your address!",
                    addressLine2Elm
                );
                return false;
            } else if (districtValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    districtError,
                    "Please enter your district name!",
                    district
                );
                return false;
            } else if (districtError.textContent) {
                preventFormSubmitHandler(
                    event,
                    districtError,
                    "Please enter your valid district name!",
                    district
                );
                return false;
            } else if (pinValue.trim().length===0) {
                preventFormSubmitHandler(
                    event,
                    playerPinErrorElm,
                    "Please enter your pin code!",
                    playerPinElm
                );
                return false;
            } else if (playerPinErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    playerPinErrorElm,
                    "Please enter your pin code!",
                    playerPinElm
                );
                return false;
            } else if (pinValue.trim().length!==6) {
                preventFormSubmitHandler(
                    event,
                    playerPinErrorElm,
                    "Pin code should be 6 digits!",
                    playerPinElm
                );
                return false;
            } else if (stateValue.trim() === "") {
                preventFormSubmitHandler(
                    event,
                    stateError,
                    "Please enter your state name!",
                    state
                );
                return false;
            } else if (stateError.textContent) {
                preventFormSubmitHandler(
                    event,
                    stateError,
                    "Please enter your valid state name!",
                    state
                );
                return false;
            } else if (countryValue.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    countryError,
                    "Please enter your country name!",
                    country
                );
                return false;
            } else if (!hereByValue.checked) {
                preventFormSubmitHandler(
                    event,
                    hereByError,
                    "Please accept the agreement to proceed!",
                    hereBy
                );
                return false;
            } else if (hereByError.textContent) {
                preventFormSubmitHandler(
                    event,
                    hereByError,
                    "Please accept the agreement to proceed!",
                    hereBy
                );
                return false;
            } else if (!abideTermsConditionsValue.checked) {
                preventFormSubmitHandler(
                    event,
                    playerAbideTermsConditionsErrorElm,
                    "Please accept the agreement to proceed!",
                    playerAbideTermsConditionsElm
                );
                return false;
            } else if (playerAbideTermsConditionsErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    playerAbideTermsConditionsErrorElm,
                    "Please accept the agreement to proceed!",
                    playerAbideTermsConditionsElm
                );
                return false;
            } else if (!disputeShallValue.checked) {
                preventFormSubmitHandler(
                    event,
                    disputeShallError,
                    "Please accept the agreement to proceed!",
                    disputeShall
                );
                return false;
            } else if (disputeShallError.textContent) {
                preventFormSubmitHandler(
                    event,
                    disputeShallError,
                    "Please accept the agreement to proceed!",
                    disputeShall
                );
                return false;
            } else {
                event.target.submit();
                return;
            }
        });
    }

    // academy-complete-registration function
    if (academyCompleteRegister) {
        // let iti = window.intlTelInput(academyMobileNumberElm, {
        //     initialCountry: "in", // initial country is India
        //     separateDialCode: false,
        //     nationalMode: false,
        //     preferredCountries: ["in"],
        //     showSelectedDialCode: true,
        //     utilsScript:
        //         "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        // });
        // // Update hidden countryCode input on change
        // function updateCountryCode() {
        //     var countryCode = iti.getSelectedCountryData().dialCode;
        //     countryCodeElm.value = countryCode;
        //     // console.log(countryCodeElm.value);
        // }

        // // Call updateCountryCode initially
        // updateCountryCode();

        // // Add event listener for country change
        // iti.promise.then(function () {
        //     academyMobileNumberElm.addEventListener(
        //         "countrychange",
        //         updateCountryCode
        //     );
        // });
        academyNameElm.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                academyNameErrorElm,
                "Please enter your academy name!"
            );
        });
        ownerManagerNameElm.addEventListener("keyup", function (event) {
            enterNameChangeHandler(
                event,
                ownerManagerNameErrorElm,
                "Please enter academy owner/ manager name!"
            );
        });
        academyMobileNumberElm.addEventListener("keyup", function (event) {
            enterNumberChangeHandler(
                event,
                academyMobileNumberErrorElm,
                "Please enter academy phone number!"
            );
        });
        academyEmailElm.addEventListener("keyup", function (event) {
            enterEmailChangeHandler(
                event,
                academyEmailErrorElm,
                "Please enter academy email!"
            );
        });
        numberOfCourtsElm.addEventListener("change", function (event) {
            enterItemChangeHandler(
                event,
                numberOfCourtsError,
                "Please select number of courts!"
            );
        });
        academyAddressElm.addEventListener("keyup",event=>{
            itaNumberFunction(
                event,
                academyAddressErrorElm,
                "Please enter address!"
            );
        })
        academyCityElm.addEventListener("keyup", event=>{
            itaNumberFunction(
                event,
                academyCityErrorElm,
                "Please enter academy city!"
            );
        })
        academyPinElm.addEventListener("keyup", event=>{
            enterNumberChangeHandler(event, academyPinErrorElm, "Please enter academy pin code!")
        })
        academyStateElm.addEventListener("change", event=>{
            enterItemChangeHandler(event, academyStateErrorElm, "Please select academy state!")
        })
        academyHereByElm.addEventListener("change", function (event) {
            checkboxChangeHandler(event, academyHereByErrorElm);
        });
        abideTermsConditionsElm.addEventListener("change", event=>{
            checkboxChangeHandler(event, abideTermsConditionsErrorElm)
        })
        academyDisputeShall.addEventListener("change", function (event) {
            checkboxChangeHandler(event, academyDisputeShallErrorElm);
        });

        academyCompleteRegister.addEventListener("submit", (event) => {
            event.preventDefault()
            const academyName = event.target.academyName.value;
            const ownerManagerName = event.target.ownerManagerName.value;
            const phone = event.target.phone.value;
            const email = event.target.email.value;
            const courtsCount = event.target.courtsCount.value;
            const address=event.target.address.value;
            const city = event.target.city.value;
            const pin = event.target.pin.value;
            const state = event.target.state.value;
            const photo = event.target.photo.value;
            const hereBy = event.target.hereBy;
            const abideTermsConditions = event.target.abideTermsConditions;
            const disputeShall = event.target.disputeShall;

            if (academyName.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    academyNameErrorElm,
                    "Please enter academy name!",
                    academyNameElm
                );
                return false;
            } else if (academyNameErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyNameErrorElm,
                    "Please enter academy valid name!",
                    academyNameElm
                );
                return false;
            } else if (ownerManagerName.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    ownerManagerNameErrorElm,
                    "Please enter academy owner/ manager name!",
                    ownerManagerNameElm
                );
                return false;
            } else if (ownerManagerNameErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    ownerManagerNameErrorElm,
                    "Please enter academy owner/ manager valid name!",
                    ownerManagerNameElm
                );
                return false;
            } else if (phone.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    academyMobileNumberErrorElm,
                    "Please enter academy phone number!",
                    academyMobileNumberElm
                );
                return false;
            } else if (academyMobileNumberErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyMobileNumberErrorElm,
                    "Please enter academy valid phone number!",
                    academyMobileNumberElm
                );
                return false;
            } else if (email.trim().length === 0) {
                preventFormSubmitHandler(
                    event,
                    academyEmailErrorElm,
                    "Please enter academy email!",
                    academyEmailElm
                );
                return false;
            } else if (academyEmailErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyEmailErrorElm,
                    "Please enter academy valid email!",
                    academyEmailElm
                );
                return false;
            } else if (courtsCount === "") {
                preventFormSubmitHandler(
                    event,
                    numberOfCourtsError,
                    "Please select number of courts!",
                    numberOfCourtsElm
                );
                return false;
            } else if (numberOfCourtsError.textContent) {
                preventFormSubmitHandler(
                    event,
                    numberOfCourtsError,
                    "Please select number of courts!",
                    numberOfCourtsElm
                );
                return false;
            } else if (address.trim().length===0) {
                preventFormSubmitHandler(
                    event,
                    academyAddressErrorElm,
                    "Please enter academy city name!",
                    academyAddressElm
                );
                return false;
            } else if (academyAddressErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyAddressErrorElm,
                    "Please enter academy city name!",
                    academyAddressElm
                );
                return false;
            } else if (city.trim().length===0) {
                preventFormSubmitHandler(
                    event,
                    academyCityErrorElm,
                    "Please enter academy city name!",
                    academyCityElm
                );
                return false;
            } else if (academyCityErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyCityErrorElm,
                    "Please enter academy city name!",
                    academyCityElm
                );
                return false;
            } else if (pin.trim().length===0){
                preventFormSubmitHandler(
                    event,
                    academyPinErrorElm,
                    "Please enter pin code!",
                    academyCityElm
                );
                return false;
            } else if (pin.trim().length!==6){
                preventFormSubmitHandler(
                    event,
                    academyPinErrorElm,
                    "Please enter six digits pin code!",
                    academyCityElm
                );
                return false;
            } else if (academyPinErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyPinErrorElm,
                    "Please enter pin code!",
                    academyCityElm
                );
                return false;
            } else if (state==="") {
                preventFormSubmitHandler(
                    event,
                    academyStateErrorElm,
                    "Please enter academy state!",
                    academyStateElm
                );
                return false;
            } else if (academyStateErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyStateErrorElm,
                    "Please enter academy state!",
                    academyStateElm
                );
                return false;
            }  else if (!hereBy.checked) {
                preventFormSubmitHandler(
                    event,
                    academyHereByErrorElm,
                    "Please accept the agreement to proceed!",
                    academyHereByElm
                );
                return false;
            } else if (academyHereByErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyHereByErrorElm,
                    "Please accept the agreement to proceed!",
                    academyHereByElm
                );
                return false;
            } else if (!abideTermsConditions.checked) {
                preventFormSubmitHandler(
                    event,
                    abideTermsConditionsErrorElm,
                    "Please accept the agreement to proceed!",
                    abideTermsConditionsElm
                );
            } else if (abideTermsConditionsErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    abideTermsConditionsErrorElm,
                    "Please accept the agreement to proceed!",
                    abideTermsConditionsElm
                );
            } else if (!disputeShall.checked) {
                preventFormSubmitHandler(
                    event,
                    academyDisputeShallErrorElm,
                    "Please accept the agreement to proceed!",
                    academyDisputeShall
                );
                return false;
            } else if (academyDisputeShallErrorElm.textContent) {
                preventFormSubmitHandler(
                    event,
                    academyDisputeShallErrorElm,
                    "Please accept the agreement to proceed!",
                    academyDisputeShall
                );
                return false;
            } else {
                event.target.submit()
            }
        });
    }
});
