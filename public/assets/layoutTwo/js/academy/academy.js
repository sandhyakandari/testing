import {
  enterEmailChangeHandler,
  enterItemChangeHandler,
  enterNameChangeHandler,
  enterNumberChangeHandler,
  itaNumberFunction,
  preventFormSubmitHandler,
  selectItemChangeHandler,
} from "../../../js/logged-user/functions.js";

document.addEventListener("DOMContentLoaded", (event) => {
  // body
  const body = document.body;

  // academy/academySidebar.blade.php
  const profileImageFormElm = document.profileImageForm;
  const profileImageElm = document.getElementById("profileImage");
  const profileImgChangeBtnElm = document.getElementById("profileImgChangeBtn");

  // academy/uploadImages.blade.php
  const uploadImagesElm = document.uploadImages;
  const imageElm = document.getElementById("image");
  const imageErrorElm = document.getElementById("imageError");

  // academy/myProfile.blade.php
  const academyEditProfileBtnElm = document.getElementById(
    "academyEditProfileBtn"
  );
  const academyCancelEditProfileBtnElm = document.getElementById(
    "academyCancelEditProfileBtn"
  );
  const academyProfileFormElm = document.academyProfileForm;
  const academyNameElm = document.getElementById("academyName");
  let academyNameErrorElm = document.getElementById("academyNameError");
  const owner_nameElm = document.getElementById("owner_name");
  let owner_nameErrorElm = document.getElementById("owner_nameError");
  const academyEmailElm = document.getElementById("academyEmail");
  let academyEmailErrorElm = document.getElementById("academyEmailError");
  const academyCountryCodeElm = document.getElementById("academyCountryCode");
  const academyPhoneElm = document.getElementById("academyPhone");
  let academyPhoneErrorElm = document.getElementById("academyPhoneError");
  const no_of_courtsElm = document.getElementById("numberOfCourts");
  let no_of_courtsErrorElm = document.getElementById("no_of_courtsError");
  const hardElm = document.getElementById("hard");
  let hardErrorElm = document.getElementById("hardError");
  const clayElm = document.getElementById("clay");
  let clayErrorElm = document.getElementById("clayError");
  const grassElm = document.getElementById("grass");
  let grassErrorElm = document.getElementById("grassError");
  const academyAddressElm = document.getElementById("academyAddress");
  let academyAddressErrorElm = document.getElementById("academyAddressError");
  const academyCityElm = document.getElementById("academyCity");
  let academyCityErrorElm = document.getElementById("academyCityError");
  const academyPinElm = document.getElementById("academyPin");
  let academyPinErrorElm = document.getElementById("academyPinError");
  const academyStateElm = document.getElementById("academyState");
  let academyStateErrorElm = document.getElementById("academyStateError");
  const stay_yesElm = document.getElementById("stay_yes");
  const stay_noElm = document.getElementById("stay_no");
  const academyWebElm = document.getElementById("academyWeb");
  let academyWebErrorElm = document.getElementById("academyWebError");
  const academyGeoLocationElm = document.getElementById("academyGeoLocation");
  let academyGeoLocationErrorElm = document.getElementById(
    "academyGeoLocationError"
  );
  const academy_aitaElm = document.getElementById("academy_aita");
  let academy_aitaErrorElm = document.getElementById("academy_aitaError");
  const have_not_academy_aitaElm = document.getElementById(
    "have_not_academy_aita"
  );
  const academyEditProfileSubmitBtnElm = document.getElementById(
    "academyEditProfileSubmitBtn"
  );
  const aboutAcademyElm = document.getElementById("aboutAcademy");
  const aboutDescriptionElm = document.getElementById("aboutDescription");

  // academy/createTournament.blade.php
  const createTournamentFormElm = document.createTournamentForm;
  const tournamentCategoryElm = document.getElementById("tournamentCategory");
  let tournamentCategoryErrorElm = document.getElementById(
    "tournamentCategoryError"
  );
  const tournamentNameElm = document.getElementById("tournamentName");
  let tournamentNameErrorElm = document.getElementById("tournamentNameError");
  const tournamentAcademyNameElm = document.getElementById(
    "tournamentAcademyName"
  );
  let tournamentAcademyNameErrorElm = document.getElementById(
    "tournamentAcademyNameError"
  );
  const tournamentPlayerCategoryElm = document.getElementById(
    "tournamentPlayerCategory"
  );
  let tournamentPlayerCategoryErrorElm = document.getElementById(
    "tournamentPlayerCategoryError"
  );
  const tournamentSubCategoryElm = document.getElementById(
    "tournamentSubCategory"
  );
  let tournamentSubCategoryErrorElm = document.getElementById(
    "tournamentSubCategoryError"
  );
  const tournamentSurfaceElm = document.getElementById("tournamentSurface");
  let tournamentSurfaceErrorElm = document.getElementById(
    "tournamentSurfaceError"
  );
  const tournamentCityElm = document.getElementById("tournamentCity");
  let tournamentCityErrorElm = document.getElementById("tournamentCityError");
  const tournamentDateElm = document.getElementById("tournamentDate");
  let tournamentDateErrorElm = document.getElementById("tournamentDateError");
  // const tournamentLastDateElm = document.getElementById("tournamentLastDate");
  // let tournamentLastDateErrorElm = document.getElementById(
  //     "tournamentLastDateError"
  // );
  // const tournamentPriceElm = document.getElementById("tournamentPrice");
  // let tournamentPriceErrorElm = document.getElementById(
  //     "tournamentPriceError"
  // );
  // const aboutTournamentElm = document.getElementById("aboutTournament");
  // let aboutTournamentErrorElm = document.getElementById(
  //     "aboutTournamentError"
  // );
  const selectedSubCategoryItemUlElm = document.getElementById(
    "selectedSubCategoryItemUl"
  );
  const selectBtn = document.querySelector(".select-btn");
  const btnText = document.querySelector(".btn-text");
  const tournamentSubCategoryNameElm = document.querySelector(
    "#tournamentSubCategory[name = 'subCategory[]']"
  );

  // update email
  const updateEmailFormElm = document.updateEmailForm;
  const currentEmailElm = document.getElementById("currentEmail");
  let currentEmailErrorElm = document.getElementById("currentEmailError");
  const newEmailElm = document.getElementById("newEmail");
  let newEmailErrorElm = document.getElementById("newEmailError");
  const briefConditionElm = document.getElementById("briefCondition");
  let briefConditionErrorElm = document.getElementById("briefConditionError");

  // update aita number
  const updateAITAFormElm = document.updateAITAForm;
  const currentAitaElm = document.getElementById("currentAita");
  let currentAitaErrorElm = document.getElementById("currentAitaError");
  const newAitaElm = document.getElementById("newAita");
  let newAitaErrorElm = document.getElementById("newAitaError");
  const aitaConditionElm = document.getElementById("aitaCondition");
  let aitaConditionErrorElm = document.getElementById("aitaConditionError");

  // player manual registration by the academy
  const manualEntryFormElm = document.manualEntryForm;
  const manualEnterNameElm = document.getElementById("manualEnterName");
  let manualEnterNameErrorElm = document.getElementById("manualEnterNameError");
  const manualSubCategoryele = document.querySelectorAll('.checkbox-juniors');
  const manualSubCategoryErrorElm = document.getElementById(
    "manualSubCategoryErrorElm"
  );
  const manualEnterDobElm = document.getElementById("manualEnterDob");
  let manualEnterDobErrorElm = document.getElementById("manualEnterDobError");
  const manual_enter_stateElm=document.getElementById("manual_enter_state")
  let manual_enter_stateErrorElm=document.getElementById("manual_enter_stateError")
  const manual_enter_aita_numberElm = document.getElementById(
    "manual_enter_aita_number"
  );
  let manual_enter_aita_numberErrorElm = document.getElementById(
    "manual_enter_aita_numberError"
  );

  // edit tournament form
  const editTournamentFormElm = document.editTournamentForm;

  // academySidebar.blade.php
  const academySidebarLeftPanelElm = document.getElementById(
    "academySidebarLeftPanel"
  );
  const tournamentListAnchorElm = document.querySelector("#tournamentList > a");
  const tournamentListDivElm = document.querySelector("#tournamentList > div");
  const tournamentDropdownElm = document.getElementById("tournament-dropdown");

  if (uploadImagesElm) {
    imageElm.addEventListener("change", (event) => {
      selectItemChangeHandler(event, imageErrorElm, "Please select image!");
    });

    uploadImagesElm.addEventListener("submit", (event) => {
      event.preventDefault();
      // Get the array of selected images
      const images = event.target.image.files;

      // Validate the number of images
      if (images.length === 0) {
        const errorMessage = "Please select at least one image.";
        preventFormSubmitHandler(event, imageErrorElm, errorMessage, imageElm);
      } else {
        event.target.submit();
      }
    });
  }

  if (
    academyEditProfileBtnElm &&
    academyCancelEditProfileBtnElm &&
    academyProfileFormElm
  ) {
    academyEditProfileBtnElm.addEventListener("click", (event) => {
      event.preventDefault();
      event.target.setAttribute("disabled", "true");
      academyNameElm.removeAttribute("readonly");
      owner_nameElm.removeAttribute("readonly");
      academyPhoneElm.removeAttribute("readonly");
      no_of_courtsElm.removeAttribute("disabled");
      hardElm.removeAttribute("disabled");
      clayElm.removeAttribute("disabled");
      grassElm.removeAttribute("disabled");
      academyAddressElm.removeAttribute("readonly");
      academyCityElm.removeAttribute("readonly");
      academyPinElm.removeAttribute("readonly");
      academyStateElm.removeAttribute("disabled");
      stay_yesElm.removeAttribute("disabled");
      stay_noElm.removeAttribute("disabled");
      academyWebElm.removeAttribute("readonly");
      academyGeoLocationElm.removeAttribute("readonly");
      have_not_academy_aitaElm &&
        have_not_academy_aitaElm.removeAttribute("readonly");
      aboutAcademyElm.removeAttribute("readonly");
      aboutDescriptionElm.removeAttribute("readonly");
      academyCancelEditProfileBtnElm.removeAttribute("disabled");
      academyEditProfileSubmitBtnElm.removeAttribute("disabled");
    });
    academyCancelEditProfileBtnElm.addEventListener("click", (event) => {
      event.preventDefault();
      event.target.setAttribute("disabled", "true");
      academyNameElm.setAttribute("readonly", "true");
      owner_nameElm.setAttribute("readonly", "true");
      academyPhoneElm.setAttribute("readonly", "true");
      no_of_courtsElm.setAttribute("disabled", "true");
      hardElm.setAttribute("disabled", "true");
      clayElm.setAttribute("disabled", "true");
      grassElm.setAttribute("disabled", "true");
      academyAddressElm.setAttribute("readonly", "true");
      academyCityElm.setAttribute("readonly", "true");
      academyPinElm.setAttribute("readonly", "true");
      academyStateElm.setAttribute("disabled", "true");
      stay_yesElm.setAttribute("disabled", "true");
      stay_noElm.setAttribute("disabled", "true");
      academyWebElm.setAttribute("readonly", "true");
      academyGeoLocationElm.setAttribute("readonly", "true");
      have_not_academy_aitaElm &&
        have_not_academy_aitaElm.setAttribute("readonly", "true");
      aboutAcademyElm.setAttribute("readonly", "true");
      aboutDescriptionElm.setAttribute("readonly", "true");
      academyEditProfileBtnElm.removeAttribute("disabled");
      academyEditProfileSubmitBtnElm.setAttribute("disabled", "true");
    });
    academyNameElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        academyNameErrorElm,
        "Please enter your academy name!"
      );
    });
    owner_nameElm.addEventListener("keyup", (event) => {
      enterNameChangeHandler(
        event,
        owner_nameErrorElm,
        "Please enter academy owner name!"
      );
    });
    academyPhoneElm.addEventListener("keyup", (event) => {
      enterNumberChangeHandler(
        event,
        academyPhoneErrorElm,
        "Please enter academy phone number!"
      );
    });
    no_of_courtsElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        no_of_courtsErrorElm,
        "Please select number of courts!"
      );
    });
    academyAddressElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        academyAddressErrorElm,
        "Please enter academy address!"
      );
    });
    academyCityElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        academyCityErrorElm,
        "Please enter academy city!"
      );
    });
    academyPinElm.addEventListener("keyup", (event) => {
      enterNumberChangeHandler(
        event,
        academyPinErrorElm,
        "Please enter academy pin code!"
      );
    });
    academyStateElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        academyStateErrorElm,
        "Please enter academy state!"
      );
    });
    academyProfileFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const name = event.target.name.value;
      const owner_name = event.target.owner_name.value;
      const email = event.target.email.value;
      const phone = event.target.phone.value;
      const no_of_courts = event.target.no_of_courts.value;
      const address = event.target.address.value;
      const city = event.target.city.value;
      const pin = event.target.pin.value;
      const state = event.target.state.value;

      if (name.trim().length === 0) {
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
          "Please enter academy name!",
          academyNameElm
        );
        return false;
      } else if (owner_name.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          owner_nameErrorElm,
          "Please enter owner name!",
          owner_nameElm
        );
        return false;
      } else if (owner_nameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          owner_nameErrorElm,
          "Please enter owner name!",
          owner_nameElm
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
          "Please enter academy email!",
          academyEmailElm
        );
        return false;
      } else if (phone.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          academyPhoneErrorElm,
          "Please enter academy phone number!",
          academyPhoneElm
        );
        return false;
      } else if (academyPhoneErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          academyPhoneErrorElm,
          "Please enter academy phone number!",
          academyPhoneElm
        );
        return false;
      } else if (no_of_courts === "") {
        preventFormSubmitHandler(
          event,
          no_of_courtsErrorElm,
          "Please select no of courts!",
          no_of_courtsElm
        );
        return false;
      } else if (no_of_courtsErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          no_of_courtsErrorElm,
          "Please select no of courts!",
          no_of_courtsElm
        );
        return false;
      } else if (address.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          academyAddressErrorElm,
          "Please enter academy city!",
          academyAddressElm
        );
        return false;
      } else if (academy_aitaErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          academyAddressErrorElm,
          "Please enter academy city!",
          academyAddressElm
        );
        return false;
      } else if (city.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          academyCityErrorElm,
          "Please enter academy city!",
          academyCityElm
        );
        return false;
      } else if (academyCityErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          academyCityErrorElm,
          "Please enter academy city!",
          academyCityElm
        );
        return false;
      } else if (pin.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          academyPinErrorElm,
          "Please enter academy pin code!",
          academyPinElm
        );
        return false;
      } else if (academyPinErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          academyPinErrorElm,
          "Please enter academy pin code!",
          academyPinElm
        );
        return false;
      } else if (pin.trim().length !== 6) {
        preventFormSubmitHandler(
          event,
          academyPinErrorElm,
          "Pin code should be 6 digits!",
          academyPinElm
        );
        return false;
      } else if (state.trim() === "") {
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
      } else {
        event.target.submit();
      }
    });
  }

  if (profileImageFormElm) {
    profileImageElm.addEventListener("change", (event) => {
      if (event.target.files.length > 0) {
        profileImgChangeBtnElm.classList.add("active");
      } else {
        profileImgChangeBtnElm.classList.remove("active");
      }
    });

    profileImgChangeBtnElm.addEventListener("click", (event) => {
      event.preventDefault();
      const profileImage = profileImageFormElm.profileImage.files;
      if (profileImage.length !== 0) {
        profileImageFormElm.submit();
      }
    });
  }

  // create tournament functionality
  if (createTournamentFormElm) {
    const categoryData = [
      {
        categoryName: "Juniors",
        subCategoryName: ["Under 12", "Under 14", "Under 16", "Under 18"],
      },
      {
        categoryName: "Seniors",
        subCategoryName: ["Men", "Women"],
      },
    ];

    const tournamentSubCategoryValueElm = [];
    categoryData.forEach((item) => {
      const option = document.createElement("option");
      option.text = item.categoryName;
      option.value = item.categoryName;
      tournamentPlayerCategoryElm.add(option);
    });

    tournamentPlayerCategoryElm.addEventListener("change", (event) => {
      tournamentSubCategoryNameElm.value = [];
      selectedSubCategoryItemUlElm.innerHTML = "";
      btnText.innerText = "Sub Category";
      tournamentSubCategoryValueElm.length = 0;

      const selectedCategory = event.target.value;
      const selectedData = categoryData.find(
        (item) => item.categoryName === selectedCategory
      );
      if (selectedData) {
        selectedData.subCategoryName.forEach((subCategory) => {
          const listItem = `
                        <li class="selected-item-list">
                            <span class="checkbox">
                                <i class="fa fa-check check-icon"></i>
                            </span>
                            <span class="item-text">${subCategory}</span>
                        </li>
                    `;
          selectedSubCategoryItemUlElm.innerHTML += listItem;

          const items = document.querySelectorAll(".selected-item-list");
          items.forEach((item) => {
            item.addEventListener("click", function () {
              addItemSelectHandler(item);
            });
          });
        });
      }
    });

    tournamentPlayerCategoryElm.value = "";
    tournamentPlayerCategoryElm.dispatchEvent(new Event("change"));

    selectBtn.addEventListener("click", (event) => {
      event.stopPropagation();
      selectBtn.classList.toggle("open");
    });

    // body.addEventListener("click", () => {
    //     selectBtn.classList.remove("open");
    // });

    function addItemSelectHandler(item) {
      item.classList.toggle("checked");

      let checked = document.querySelectorAll(".checked");
      const itemTextElm = item.querySelector(".item-text");

      let tournamentSubCategoryValueIndexElm = "";
      if (checked && checked.length > 0 && item.classList.contains("checked")) {
        btnText.innerText = `${checked.length} Selected`;
        tournamentSubCategoryValueElm.push(itemTextElm.innerText);
        tournamentSubCategoryErrorElm.textContent = "";
      } else if (
        checked &&
        checked.length > 0 &&
        !item.classList.contains("checked")
      ) {
        btnText.innerText = `${checked.length} Selected`;
        tournamentSubCategoryValueIndexElm =
          tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
        tournamentSubCategoryValueElm.splice(
          tournamentSubCategoryValueIndexElm,
          1
        );
        tournamentSubCategoryErrorElm.textContent = "";
      } else {
        tournamentSubCategoryValueIndexElm =
          tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
        tournamentSubCategoryValueElm.splice(
          tournamentSubCategoryValueIndexElm,
          1
        );
        tournamentSubCategoryErrorElm.textContent =
          "Please select sub category!";
        btnText.innerText = "Sub Category";
      }
      tournamentSubCategoryNameElm.value =
        tournamentSubCategoryValueElm.join(", ");
      // console.log(tournamentSubCategoryNameElm.value);
    }

    // ******************
    tournamentCategoryElm.addEventListener("change", (event) => {
      if (event.target.value !== "") {
        tournamentNameElm.value = event.target.value;
      }
      enterItemChangeHandler(
        event,
        tournamentCategoryErrorElm,
        "Please select tournament category!"
      );
    });
    tournamentNameElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        tournamentNameErrorElm,
        "Please enter tournament name!"
      );
    });
    tournamentAcademyNameElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        tournamentAcademyNameErrorElm,
        "Please enter your academy name!"
      );
    });
    tournamentPlayerCategoryElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentPlayerCategoryErrorElm,
        "Please select category!"
      );
    });
    tournamentSubCategoryElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentSubCategoryErrorElm,
        "Please select sub category!"
      );
    });
    tournamentSurfaceElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentSurfaceErrorElm,
        "Please select surface!"
      );
    });
    tournamentCityElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        tournamentCityErrorElm,
        "Please enter tournament city!"
      );
    });
    tournamentDateElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentDateErrorElm,
        "Please select tournament date!"
      );
    });
    // tournamentLastDateElm.addEventListener("change", (event) => {
    //     enterItemChangeHandler(
    //         event,
    //         tournamentLastDateErrorElm,
    //         "Please select tournament apply last date!"
    //     );
    // });
    // tournamentPriceElm.addEventListener("keyup", (event) => {
    //     enterNumberChangeHandler(
    //         event,
    //         tournamentPriceErrorElm,
    //         "Please enter tournament price!"
    //     );
    // });
    // aboutTournamentElm.addEventListener("keyup", (event) => {
    //     itaNumberFunction(
    //         event,
    //         aboutTournamentErrorElm,
    //         "Please enter about the tournament!"
    //     );
    // });
    createTournamentFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const tournamentCategory = event.target.tournamentCategory.value;
      const tournamentName = event.target.tournamentName.value;
      const academyName = event.target.academyName.value;
      const category = event.target.category.value;
      const subCategory = tournamentSubCategoryValueElm.join(", ");
      const surface = event.target.surface.value;
      const city = event.target.city.value;
      const date = event.target.date.value;
      const lastDate = event.target.lastDate.value;
      const price = event.target.price.value;
      // const aboutTournament = event.target.aboutTournament.value;

      if (tournamentCategory === "") {
        preventFormSubmitHandler(
          event,
          tournamentCategoryErrorElm,
          "Please select tournament category!",
          tournamentCategoryElm
        );
        return false;
      } else if (tournamentCategoryErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentCategoryErrorElm,
          "Please select tournament category!",
          tournamentCategoryElm
        );
        return false;
      } else if (tournamentName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          tournamentNameErrorElm,
          "Please enter tournament name!",
          tournamentName
        );
        return false;
      } else if (tournamentNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentNameErrorElm,
          "Please enter tournament name!",
          tournamentName
        );
        return false;
      } else if (academyName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          tournamentAcademyNameErrorElm,
          "Please enter academy name!",
          tournamentAcademyNameElm
        );
        return false;
      } else if (tournamentAcademyNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentAcademyNameErrorElm,
          "Please enter academy name!",
          tournamentAcademyNameElm
        );
        return false;
      } else if (category === "") {
        preventFormSubmitHandler(
          event,
          tournamentPlayerCategoryErrorElm,
          "Please select category!",
          tournamentPlayerCategoryElm
        );
        return false;
      } else if (tournamentPlayerCategoryErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentPlayerCategoryErrorElm,
          "Please select category!",
          tournamentPlayerCategoryElm
        );
        return false;
      } else if (subCategory === "") {
        preventFormSubmitHandler(
          event,
          tournamentSubCategoryErrorElm,
          "Please select sub category!",
          tournamentSubCategoryElm
        );
      } else if (tournamentSubCategoryErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentSubCategoryErrorElm,
          "Please select sub category!",
          tournamentSubCategoryElm
        );
      } else if (tournamentSurfaceErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentSubCategoryErrorElm,
          "Please select sub category!",
          tournamentSubCategoryElm
        );
      } else if (surface === "") {
        preventFormSubmitHandler(
          event,
          tournamentSurfaceErrorElm,
          "Please select surface!",
          tournamentSurfaceElm
        );
        return false;
      } else if (tournamentSurfaceErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentSurfaceErrorElm,
          "Please select surface!",
          tournamentSurfaceElm
        );
        return false;
      } else if (city.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          tournamentCityErrorElm,
          "Please enter city name!",
          tournamentCityElm
        );
        return false;
      } else if (tournamentCityErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentCityErrorElm,
          "Please enter city name!",
          tournamentCityElm
        );
        return false;
      } else if (date === "") {
        preventFormSubmitHandler(
          event,
          tournamentDateErrorElm,
          "Please select tournament date!",
          tournamentDateElm
        );
        return false;
      } else if (tournamentDateErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentDateErrorElm,
          "Please select tournament date!",
          tournamentDateElm
        );
        return false;
      }
      // else if (lastDate === "") {
      //     preventFormSubmitHandler(
      //         event,
      //         tournamentLastDateErrorElm,
      //         "Please select tournament last date!",
      //         tournamentLastDateElm
      //     );
      //     return false;
      // } else if (tournamentLastDateErrorElm.textContent) {
      //     preventFormSubmitHandler(
      //         event,
      //         tournamentLastDateErrorElm,
      //         "Please select tournament last date!",
      //         tournamentLastDateElm
      //     );
      //     return false;
      // }
      // else if (price.trim().length === 0) {
      //     preventFormSubmitHandler(
      //         event,
      //         tournamentPriceErrorElm,
      //         "Please enter price value!",
      //         tournamentPriceElm
      //     );
      //     return false;
      // } else if (tournamentPriceErrorElm.textContent) {
      //     preventFormSubmitHandler(
      //         event,
      //         tournamentPriceErrorElm,
      //         "Please enter price value!",
      //         tournamentPriceElm
      //     );
      //     return false;
      // }
      // else if (aboutTournament.trim().length === 0) {
      //     preventFormSubmitHandler(
      //         event,
      //         aboutTournamentErrorElm,
      //         "Please enter about the tournament!",
      //         aboutTournamentElm
      //     );
      //     return false;
      // } else if (aboutTournamentErrorElm.textContent) {
      //     preventFormSubmitHandler(
      //         event,
      //         aboutTournamentErrorElm,
      //         "Please enter about the tournament!",
      //         aboutTournamentElm
      //     );
      //     return false;
      // }
      else {
        event.target.submit();
      }
    });
  }

  // update email functionality
  if (updateEmailFormElm) {
    currentEmailElm.addEventListener("keyup", (event) => {
      enterEmailChangeHandler(
        event,
        currentEmailErrorElm,
        "Please enter your current email address!"
      );
    });
    newEmailElm.addEventListener("keyup", (event) => {
      enterEmailChangeHandler(
        event,
        newEmailErrorElm,
        "Please enter your new email address!"
      );
    });
    briefConditionElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        briefConditionErrorElm,
        "Please enter your note!"
      );
    });
    updateEmailFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const currentEmail = event.target.currentEmail.value;
      const newEmail = event.target.newEmail.value;
      const message = event.target.message.value;

      if (currentEmail.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          currentEmailErrorElm,
          "Please enter your current email address!",
          currentEmailElm
        );
        return false;
      } else if (currentEmailErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          currentEmailErrorElm,
          "Please enter your current email address!",
          currentEmailElm
        );
        return false;
      } else if (newEmail.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          newEmailErrorElm,
          "Please enter your new email address!",
          newEmailElm
        );
        return false;
      } else if (newEmailErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          newEmailErrorElm,
          "Please enter your new email address!",
          newEmailElm
        );
        return false;
      } else if (message.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          briefConditionErrorElm,
          "Please enter your note!",
          briefConditionElm
        );
        return false;
      } else if (briefConditionErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          briefConditionErrorElm,
          "Please enter your note!",
          briefConditionElm
        );
        return false;
      } else {
        event.target.submit();
      }
    });
  }

  // update aita number functionality
  if (updateAITAFormElm) {
    currentAitaElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        currentAitaErrorElm,
        "Please enter your current aita number!"
      );
    });
    newAitaElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        newAitaErrorElm,
        "Please enter your new aita number!"
      );
    });
    aitaConditionElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        aitaConditionErrorElm,
        "Please enter your note!"
      );
    });
    updateAITAFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const currentAita = event.target.currentAita.value;
      const newAita = event.target.newAita.value;
      const message = event.target.message.value;

      if (currentAita.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          currentAitaErrorElm,
          "Please enter your current aita number!",
          currentAitaElm
        );
        return false;
      } else if (currentAitaErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          currentAitaErrorElm,
          "Please enter your current aita number!",
          currentAitaElm
        );
        return false;
      } else if (newAita.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          newAitaErrorElm,
          "Please enter your new aita number!",
          newAitaElm
        );
        return false;
      } else if (newAitaErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          newAitaErrorElm,
          "Please enter your new aita number!",
          newAitaElm
        );
        return false;
      } else if (message.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          aitaConditionErrorElm,
          "Please enter your note!",
          aitaConditionElm
        );
        return false;
      } else if (aitaConditionErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          aitaConditionErrorElm,
          "please enter your note!",
          aitaConditionElm
        );
        return false;
      } else {
        event.target.submit();
      }
    });
  }

  // player manual register by the academy
  if (manualEntryFormElm) {
    let junior_error=false;
    // console.log(manual_registered_ju_subCategories, manual_registered_se_subCategories)
    manualEnterNameElm.addEventListener("keyup", (event) => {
      enterNameChangeHandler(
        event,
        manualEnterNameErrorElm,
        "Please enter player name!"
      );
    });
    manualSubCategoryele.forEach(elm=>{
        elm.addEventListener("change", (event) => {
            if (event.target.checked) {
            //   console.log("Item is checked")
              junior_error=true;
              manualSubCategoryErrorElm.textContent = "";
            }

        })
    });
    manualEnterDobElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        manualEnterDobErrorElm,
        "Please select player date of birth!"
      );
    });
    manual_enter_stateElm.addEventListener("change", function (event) {
        enterItemChangeHandler(
            event,
            manual_enter_stateErrorElm,
            "Please select your state!"
          );
    })
    manualEntryFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const name = event.target.name.value;
      const dob = event.target.dob.value;
      const selectedCheckboxes = document.querySelectorAll(
        'input[name="subCategories[]"]:checked'
      );
      const state=event.target.state.value;

      if (name.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          manualEnterNameErrorElm,
          "Please enter player name!",
          manualEnterNameElm
        );
        return false;
      } else if (selectedCheckboxes?.length == 0) {
          event.preventDefault(),
          manualSubCategoryErrorElm.textContent="Please select at least one subcategory";
          return false;
      } else if (manualEnterNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          manualEnterNameErrorElm,
          "Please enter player name!",
          manualEnterNameElm
        );
        return false;
      } else if (dob == "") {
        preventFormSubmitHandler(
          event,
          manualEnterDobErrorElm,
          "Please select player date of birth!",
          manualEnterDobElm
        );
        return false;
      } else if (manualEnterDobErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          manualEnterDobErrorElm,
          "Please select player date of birth!",
          manualEnterDobElm
        );
        return false;
      } else if (state==="") {
        preventFormSubmitHandler(
            event,
            manual_enter_stateErrorElm,
            "Please select your state!",
            manual_enter_stateElm
          );
          return false;
      } else if (manual_enter_stateErrorElm.textContent) {
        preventFormSubmitHandler(
            event,
            manual_enter_stateErrorElm,
            "Please select your state!",
            manual_enter_stateElm
          );
          return false;
      } else {
        event.target.submit();
      }
    });
  }

  // edit tournament form functionality
  if (editTournamentFormElm) {
    // ******************
    const categoryData = [
      {
        categoryName: "Juniors",
        subCategoryName: ["Under 12", "Under 14", "Under 16", "Under 18"],
      },
      {
        categoryName: "Seniors",
        subCategoryName: ["Men", "Women"],
      },
    ];

    const tournamentSubCategoryValueElm =
      tournamentSubCategoryIdValue.split(", ");

    tournamentSubCategoryValueElm.forEach((select_sub_category) => {
      btnText.innerText = tournamentSubCategoryValueElm.length;

      const selectListItem = `
                <li class="selected-item-list ${
                  select_sub_category ? "checked" : null
                }">
                    <span class="checkbox">
                        <i class="fa fa-check check-icon"></i>
                    </span>
                    <span class="item-text">${select_sub_category}</span>
                </li>
            `;
      selectedSubCategoryItemUlElm.innerHTML += selectListItem;
      tournamentSubCategoryNameElm.value =
        tournamentSubCategoryValueElm.join(", ");
      // console.log(tournamentSubCategoryNameElm.value)
    });
    // debugger;

    categoryData.forEach((item) => {
      const option = document.createElement("option");
      option.text = item.categoryName;
      option.value = item.categoryName;
      tournamentPlayerCategoryElm.add(option);
    });
    tournamentPlayerCategoryElm.addEventListener("change", (event) => {
      tournamentSubCategoryNameElm.value = [];
      selectedSubCategoryItemUlElm.innerHTML = "";
      btnText.innerText = "Sub Category";
      tournamentSubCategoryValueElm.length = 0;

      const selectedCategory = event.target.value;
      const selectedData = categoryData.find(
        (item) => item.categoryName === selectedCategory
      );
      if (selectedData) {
        selectedData.subCategoryName.forEach((subCategory) => {
          const listItem = `
                        <li class="selected-item-list">
                            <span class="checkbox">
                                <i class="fa fa-check check-icon"></i>
                            </span>
                            <span class="item-text">${subCategory}</span>
                        </li>
                    `;
          selectedSubCategoryItemUlElm.innerHTML += listItem;

          const items = document.querySelectorAll(".selected-item-list");
          items.forEach((item) => {
            item.addEventListener("click", function () {
              addItemSelectHandler(item);
            });
          });
        });
      }
    });

    tournamentPlayerCategoryElm.value = tournamentPlayerCategoryIdValue;
    // console.log(tournamentSubCategoryIdValue.split(', '))
    // tournamentPlayerCategoryElm.dispatchEvent(new Event("change"));

    selectBtn.addEventListener("click", (event) => {
      event.stopPropagation();
      selectBtn.classList.toggle("open");
    });

    // body.addEventListener("click", () => {
    //     selectBtn.classList.remove("open");
    // });

    function addItemSelectHandler(item) {
      item.classList.toggle("checked");

      let checked = document.querySelectorAll(".checked");
      const itemTextElm = item.querySelector(".item-text");

      let tournamentSubCategoryValueIndexElm = "";
      if (checked && checked.length > 0 && item.classList.contains("checked")) {
        btnText.innerText = `${checked.length} Selected`;
        tournamentSubCategoryValueElm.push(itemTextElm.innerText);
        tournamentSubCategoryErrorElm.textContent = "";
      } else if (
        checked &&
        checked.length > 0 &&
        !item.classList.contains("checked")
      ) {
        btnText.innerText = `${checked.length} Selected`;
        tournamentSubCategoryValueIndexElm =
          tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
        tournamentSubCategoryValueElm.splice(
          tournamentSubCategoryValueIndexElm,
          1
        );
        tournamentSubCategoryErrorElm.textContent = "";
      } else {
        tournamentSubCategoryValueIndexElm =
          tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
        tournamentSubCategoryValueElm.splice(
          tournamentSubCategoryValueIndexElm,
          1
        );
        tournamentSubCategoryErrorElm.textContent =
          "Please select sub category!";
        btnText.innerText = "Sub Category";
      }
      tournamentSubCategoryNameElm.value =
        tournamentSubCategoryValueElm.join(", ");
      // console.log(tournamentSubCategoryNameElm.value);
    }
    // ******************
    tournamentCategoryElm.addEventListener("change", (event) => {
      if (event.target.value !== "") {
        tournamentNameElm.value = event.target.value;
      }
      enterItemChangeHandler(
        event,
        tournamentCategoryErrorElm,
        "Please select tournament category!"
      );
    });
    tournamentNameElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        tournamentNameErrorElm,
        "Please enter tournament name!"
      );
    });
    tournamentAcademyNameElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        tournamentAcademyNameErrorElm,
        "Please enter your academy name!"
      );
    });
    tournamentPlayerCategoryElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentPlayerCategoryErrorElm,
        "Please select category!"
      );
    });
    tournamentSubCategoryElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentSubCategoryErrorElm,
        "Please select sub category!"
      );
    });
    tournamentSurfaceElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentSurfaceErrorElm,
        "Please select surface!"
      );
    });
    tournamentCityElm.addEventListener("keyup", (event) => {
      itaNumberFunction(
        event,
        tournamentCityErrorElm,
        "Please enter tournament city!"
      );
    });
    tournamentDateElm.addEventListener("change", (event) => {
      enterItemChangeHandler(
        event,
        tournamentDateErrorElm,
        "Please select tournament date!"
      );
    });
    editTournamentFormElm.addEventListener("submit", (event) => {
      event.preventDefault();
      const tournamentCategory = event.target.tournamentCategory.value;
      const tournamentName = event.target.tournamentName.value;
      const academyName = event.target.academyName.value;
      const category = event.target.category.value;
      const subCategory = tournamentSubCategoryValueElm.join(", ");
      const surface = event.target.surface.value;
      const city = event.target.city.value;
      const date = event.target.date.value;
      const lastDate = event.target.lastDate.value;
      const price = event.target.price.value;

      if (tournamentCategory === "") {
        preventFormSubmitHandler(
          event,
          tournamentCategoryErrorElm,
          "Please select tournament category!",
          tournamentCategoryElm
        );
        return false;
      } else if (tournamentCategoryErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentCategoryErrorElm,
          "Please select tournament category!",
          tournamentCategoryElm
        );
        return false;
      } else if (tournamentName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          tournamentNameErrorElm,
          "Please enter tournament name!",
          tournamentName
        );
        return false;
      } else if (tournamentNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentNameErrorElm,
          "Please enter tournament name!",
          tournamentName
        );
        return false;
      } else if (academyName.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          tournamentAcademyNameErrorElm,
          "Please enter academy name!",
          tournamentAcademyNameElm
        );
        return false;
      } else if (tournamentAcademyNameErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentAcademyNameErrorElm,
          "Please enter academy name!",
          tournamentAcademyNameElm
        );
        return false;
      } else if (category === "") {
        preventFormSubmitHandler(
          event,
          tournamentPlayerCategoryErrorElm,
          "Please select category!",
          tournamentPlayerCategoryElm
        );
        return false;
      } else if (tournamentPlayerCategoryErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentPlayerCategoryErrorElm,
          "Please select category!",
          tournamentPlayerCategoryElm
        );
        return false;
      } else if (subCategory === "") {
        preventFormSubmitHandler(
          event,
          tournamentSubCategoryErrorElm,
          "Please select sub category!",
          tournamentSubCategoryElm
        );
      } else if (tournamentSubCategoryErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentSubCategoryErrorElm,
          "Please select sub category!",
          tournamentSubCategoryElm
        );
      } else if (tournamentSurfaceErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentSubCategoryErrorElm,
          "Please select sub category!",
          tournamentSubCategoryElm
        );
      } else if (surface === "") {
        preventFormSubmitHandler(
          event,
          tournamentSurfaceErrorElm,
          "Please select surface!",
          tournamentSurfaceElm
        );
        return false;
      } else if (tournamentSurfaceErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentSurfaceErrorElm,
          "Please select surface!",
          tournamentSurfaceElm
        );
        return false;
      } else if (city.trim().length === 0) {
        preventFormSubmitHandler(
          event,
          tournamentCityErrorElm,
          "Please enter city name!",
          tournamentCityElm
        );
        return false;
      } else if (tournamentCityErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentCityErrorElm,
          "Please enter city name!",
          tournamentCityElm
        );
        return false;
      } else if (date === "") {
        preventFormSubmitHandler(
          event,
          tournamentDateErrorElm,
          "Please select tournament date!",
          tournamentDateElm
        );
        return false;
      } else if (tournamentDateErrorElm.textContent) {
        preventFormSubmitHandler(
          event,
          tournamentDateErrorElm,
          "Please select tournament date!",
          tournamentDateElm
        );
        return false;
      } else {
        event.target.submit();
      }
    });
  }

  // academySidebar.blade.php functionality
  if (academySidebarLeftPanelElm) {
    const showTournamentHandler = function () {
      tournamentDropdownElm.classList.toggle("active");
      if (tournamentDropdownElm.classList.contains("active")) {
        tournamentListDivElm.classList.add("active");
      } else {
        tournamentListDivElm.classList.remove("active");
      }
    };
    tournamentListAnchorElm.addEventListener("click", showTournamentHandler);
    tournamentListDivElm.addEventListener("click", showTournamentHandler);
  }
});
