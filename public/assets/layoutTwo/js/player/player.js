import {
  enterCurrentPasswordHandler,
  enterConfirmPasswordHandler,
  preventFormSubmitHandler,
  enterNameChangeHandler,
  enterMiddleNameFunctionHandler,
  enterNumberChangeHandler,
  enterItemChangeHandler,
  itaNumberFunction,
} from "../../../js/logged-user/functions.js";

document.addEventListener("DOMContentLoaded", () => {
  // body
  const body = document.body;

  // changePassword.blade.php
  const changePasswordForm = document.changePasswordForm;
  const currentPasswordElm = document.getElementById("currentPassword");
  const currentPasswordErrorElm = document.getElementById(
    "currentPasswordError"
  );
  const newPasswordElm = document.getElementById("newPassword");
  const newPasswordErrorElm = document.getElementById("newPasswordError");
  const confirmPasswordElm = document.getElementById("confirmPassword");
  const confirmPasswordErrorElm = document.getElementById(
    "confirmPasswordError"
  );
  // myProfile.blade.php
  const editProfileBtnElm = document.getElementById("editProfileBtn");
  const cancelEditProfileBtnElm = document.getElementById(
    "cancelEditProfileBtn"
  );
  const playerProfileFormElm = document.playerProfileForm;
  const userNameElm = document.getElementById("userName");
  const firstNameElm = document.getElementById("firstName");
  let firstNameErrorElm = document.getElementById("firstNameError");
  const middleNameElm = document.getElementById("middleName");
  let middleNameErrorElm = document.getElementById("middleNameError");
  const lastNameElm = document.getElementById("lastName");
  let lastNameErrorElm = document.getElementById("lastNameError");
  const guardianNameElm = document.getElementById("guardianName");
  let guardianNameErrorElm = document.getElementById("guardianNameError");
  const phoneElm = document.getElementById("phone");
  let phoneErrorElm = document.getElementById("phoneError");
  const dobElm = document.getElementById("dob");
  let dobErrorElm = document.getElementById("dobError");
  const address_1_elm = document.getElementById("address_1");
  let address_1_ErrorElm = document.getElementById("address_1_Error");
  const address_2_elm = document.getElementById("address_2");
  let address_2_ErrorElm = document.getElementById("address_2_Error");
  const districtElm = document.getElementById("district");
  let districtErrorElm = document.getElementById("districtError");
  const playerPinElm = document.getElementById("playerPin");
  let playerPinErrorElm = document.getElementById("playerPinError");
  const stateElm = document.getElementById("state");
  let stateErrorElm = document.getElementById("stateError");
  const haveNotAitaElm = document.getElementById("haveNotAita");
  let aitaErrorElm = document.getElementById("aitaError");
  const playerEditProfileBtn = document.getElementById("playerEditProfileBtn");
  const playerPersonalInfoElm = document.getElementById("playerPersonalInfo");
  const playerCareerInfoElm = document.getElementById("playerCareerInfo");

  // player dashboard
  const playerUpcomingTournamentFormElm = document.playerUpcomingTournamentForm;
  const upcomingTournamentCategoryElm = document.getElementById(
    "upcomingTournamentCategory"
  );
  const upcomingTournamentSubCategoryElm = document.getElementById(
    "upcomingTournamentSubCategory"
  );

  if (changePasswordForm) {
    currentPasswordElm.addEventListener("keyup", (event) => {
      enterCurrentPasswordHandler(
        event,
        currentPasswordErrorElm,
        "Please enter your old password!"
      );
    });
    newPasswordElm.addEventListener("keyup", (event) => {
      enterCurrentPasswordHandler(
        event,
        newPasswordErrorElm,
        "Please enter at least 4 character!"
      );
    });
    confirmPasswordElm.addEventListener("keyup", (event) => {
      enterConfirmPasswordHandler(
        event,
        newPasswordElm,
        confirmPasswordErrorElm,
        "Password and confirm password not matched!"
      );
    });
    changePasswordForm.addEventListener("submit", (event) => {
      const currentPassword = event.target.currentPassword.value;
      const newPassword = event.target.newPassword.value;
      const confirmPassword = event.target.confirmPassword.value;

      if (currentPassword.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          currentPasswordErrorElm,
          "Please enter your old password!",
          currentPasswordElm
        );
        return false;
      } else if (currentPasswordErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          currentPasswordErrorElm,
          "Please enter your old password!",
          currentPasswordElm
        );
        return false;
      } else if (newPassword.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          newPasswordErrorElm,
          "Please enter at least 4 character!",
          newPasswordElm
        );
        return false;
      } else if (newPasswordErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          newPasswordErrorElm,
          "Please enter at least 4 character!",
          newPasswordElm
        );
        return false;
      } else if (confirmPassword.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          confirmPasswordErrorElm,
          "Password and confirm password not matched!",
          confirmPasswordElm
        );
        return false;
      } else if (confirmPasswordErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          confirmPasswordErrorElm,
          "Password and confirm password not matched!",
          confirmPasswordElm
        );
        return false;
      } else {
        return true;
      }
    });
  }

  if (editProfileBtnElm && playerProfileFormElm && cancelEditProfileBtnElm) {
    editProfileBtnElm.addEventListener("click", (event) => {
      event.preventDefault();
      event.target.setAttribute("disabled", "true");
      firstNameElm.removeAttribute("readonly");
      middleNameElm.removeAttribute("readonly");
      lastNameElm.removeAttribute("readonly");
      guardianNameElm.removeAttribute("readonly");
      phoneElm.removeAttribute("readonly");
      dobElm.removeAttribute("readonly");
      address_1_elm.removeAttribute("readonly");
      address_2_elm.removeAttribute("readonly");
      districtElm.removeAttribute("readonly");
      playerPinElm.removeAttribute("readonly");
      haveNotAitaElm && haveNotAitaElm.removeAttribute("readonly");
      stateElm.removeAttribute("disabled");
      if(playerPersonalInfoElm)
      {playerPersonalInfoElm.removeAttribute("readonly");
      }
      if(playerCareerInfoElm)
      {
      playerCareerInfoElm.removeAttribute("readonly");
      }playerEditProfileBtn.removeAttribute("disabled");
      cancelEditProfileBtnElm.removeAttribute("disabled");
    });
    cancelEditProfileBtnElm.addEventListener("click", (event) => {
      event.preventDefault();
      event.target.setAttribute("disabled", "true");
      firstNameElm.setAttribute("readonly", "true");
      middleNameElm.setAttribute("readonly", "true");
      lastNameElm.setAttribute("readonly", "true");
      guardianNameElm.setAttribute("readonly", "true");
      phoneElm.setAttribute("readonly", "true");
      dobElm.setAttribute("readonly", "true");
      address_1_elm.setAttribute("readonly", "true");
      address_2_elm.setAttribute("readonly", "true");
      districtElm.setAttribute("readonly", "true");
      playerPinElm.setAttribute("readonly", "true");
      haveNotAitaElm && haveNotAitaElm.setAttribute("readonly", "true");
      stateElm.setAttribute("disabled", "true");
      if(playerPersonalInfoElm){
      playerPersonalInfoElm.setAttribute("readonly", "true");
      }
      if(playerCareerInfoElm)
      {
      playerCareerInfoElm.setAttribute("readonly", "true");
      }
      playerEditProfileBtn.setAttribute("disabled", "true");
      editProfileBtnElm.removeAttribute("disabled");
    });
    firstNameElm.addEventListener("keyup", (event) => {
      enterNameChangeHandler(
        event,
        firstNameErrorElm,
        "Please enter your first name!"
      );
    });
    middleNameElm.addEventListener(
      "keyup",
      enterMiddleNameFunctionHandler.bind(middleNameErrorElm)
    );
    lastNameElm.addEventListener("keyup", (event) => {
      enterNameChangeHandler(
        event,
        lastNameErrorElm,
        "Please enter your last name!"
      );
    });
    guardianNameElm.addEventListener("keyup", (event) => {
      enterNameChangeHandler(
        event,
        guardianNameErrorElm,
        "Please enter your guardian name!"
      );
    });
    phoneElm.addEventListener("keyup", (event) => {
      enterNumberChangeHandler(
        event,
        phoneErrorElm,
        "Please enter your phone number!"
      );
    });
    dobElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        dobErrorElm,
        "Please select your date of birth!"
      );
    });
    address_1_elm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        address_1_ErrorElm,
        "Please enter your address!"
      );
    });
    address_2_elm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        address_2_ErrorElm,
        "Please enter your address!"
      );
    });
    districtElm.addEventListener("keyup", (event) => {
      enterNameChangeHandler(
        event,
        districtErrorElm,
        "Please enter your district name!"
      );
    });
    playerPinElm.addEventListener("keyup", (event) => {
      enterNumberChangeHandler(
        event,
        playerPinErrorElm,
        "Please enter your pin code!"
      );
    });
    stateElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        stateErrorElm,
        "Please enter your state name!"
      );
    });
    playerProfileFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const firstName = event.target.firstName.value;
      const lastName = event.target.lastName.value;
      const guardianName = event.target.guardianName.value;
      const phone = event.target.phone.value;
      const dob = event.target.dob.value;
      const address_1 = event.target.address_1.value;
      const address_2 = event.target.address_2.value;
      const district = event.target.district.value;
      const pin = event.target.pin.value;
      const state = event.target.state.value;

      if (firstName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          firstNameErrorElm,
          "Please enter your first name!",
          firstNameElm
        );
        return false;
      } else if (firstNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          firstNameErrorElm,
          "Please enter your first name!",
          firstNameElm
        );
        return false;
      } else if (lastName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          lastNameErrorElm,
          "Please enter your last name!",
          lastNameElm
        );
        return false;
      } else if (lastNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          lastNameErrorElm,
          "Please enter your last name!",
          lastNameElm
        );
        return false;
      } else if (guardianName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          guardianNameErrorElm,
          "Please enter your guardian name!",
          guardianNameElm
        );
        return false;
      } else if (guardianNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          guardianNameErrorElm,
          "Please enter your guardian name!",
          guardianNameElm
        );
        return false;
      } else if (phone.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          phoneErrorElm,
          "Please enter your phone number!",
          phoneElm
        );
        return false;
      } else if (phoneErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          phoneErrorElm,
          "Please enter your phone number!",
          phoneElm
        );
        return false;
      } else if (dob === "") {
        preventFormSubmitHandler(
          event,
          dobErrorElm,
          "Please select your date of birth!",
          dobElm
        );
        return false;
      } else if (dobErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          dobErrorElm,
          "Please select your date of birth!",
          dobElm
        );
        return false;
      } else if (address_1.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          address_1_ErrorElm,
          "Please enter your address!",
          address_1_elm
        );
        return false;
      } else if (address_1_ErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          address_1_ErrorElm,
          "Please enter your address!",
          address_1_elm
        );
        return false;
      } else if (address_2.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          address_2_ErrorElm,
          "Please enter your address!",
          address_2_elm
        );
        return false;
      } else if (address_2_ErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          address_2_ErrorElm,
          "Please enter your address!",
          address_2_elm
        );
        return false;
      } else if (district.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          districtErrorElm,
          "Please enter your district name!",
          districtElm
        );
        return false;
      } else if (districtErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          districtErrorElm,
          "Please enter your district name!",
          districtElm
        );
        return false;
      } else if (pin.trim().length === 0) {
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
      } else if (pin.trim().length !== 6) {
        preventFormSubmitHandler(
          event,
          playerPinErrorElm,
          "Pin code should be 6 digits!",
          playerPinElm
        );
        return false;
      } else if (state.trim() === "") {
        preventFormSubmitHandler(
          event,
          stateErrorElm,
          "Please enter your state name!",
          stateElm
        );
        return false;
      } else if (stateErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          stateErrorElm,
          "Please enter your state name!",
          stateElm
        );
        return false;
      } else {
        event.target.submit();
        return true;
      }
    });
  }

  if (playerUpcomingTournamentFormElm) {
    const tournamentData = [
      {
        category: "Juniors",
        subCategory: ["Under 12", "Under 14", "Under 16", "Under 18"],
      },
      {
        category: "Seniors",
        subCategory: ["Men", "Women"],
      },
    ];

    tournamentData.forEach((item) => {
      const option = document.createElement("option");
      option.text = item.category;
      option.value = item.category;
      upcomingTournamentCategoryElm.add(option);
    });
    upcomingTournamentCategoryElm.addEventListener("change", (event) => {
      upcomingTournamentSubCategoryElm.innerHTML = "";
      const categoryValue = event.target.value;
      const checkData = tournamentData.find(
        (item) => item.category === categoryValue
      );
      if (checkData) {
        checkData.subCategory.forEach((item) => {
          const option = document.createElement("option");
          option.text = item;
          option.value = item;
          upcomingTournamentSubCategoryElm.add(option);
        });
      }
    });

    upcomingTournamentCategoryElm.value = "";
    upcomingTournamentCategoryElm.dispatchEvent(new Event("change"));
  }
});
