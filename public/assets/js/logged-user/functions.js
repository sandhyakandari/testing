// ita number function
export const itaNumberFunction = function (event, errorElm, errorMessage) {
    const numberValue = event.target.value;
    if (numberValue.trim().length === 0) {
        errorElm.textContent = errorMessage;
    } else {
        errorElm.textContent = "";
    }
};
// enter name function handler
export const enterNameChangeHandler = function (
    event,
    errorElement,
    errorMessage
) {
    const nameValue = event.target.value;
    const nameRegEx = /^[a-zA-Z\s]+$/;
    if (nameValue.trim().length === 0) {
        errorElement.textContent = errorMessage;
    } else if (!nameRegEx.test(nameValue)) {
        errorElement.textContent = "Please enter only letters!";
    } else {
        errorElement.textContent = "";
    }
};
// enter middle name function handler
export const enterMiddleNameFunctionHandler = function (event) {
    const nameValue = event.target.value;
    const nameRegEx = /^[a-zA-Z\s]*$/;
    if (!nameRegEx.test(nameValue)) {
        this.textContent = "Please enter only letters!";
    } else {
        this.textContent = "";
    }
};
// select date change handler
export const enterItemChangeHandler = function (event, errorElm, errorMessage) {
    const selectValue = event.target.value;
    if (selectValue === "") {
        errorElm.textContent = errorMessage;
    } else {
        errorElm.textContent = "";
    }
};
// enter number change handler function
export const enterNumberChangeHandler = function (event, errorElm, errorMessage) {
    const numberValue = event.target.value;
    const numberRegEx = /^[0-9]+$/;
    if (numberValue.trim().length === 0) {
        errorElm.textContent = errorMessage;
    } else if (!numberRegEx.test(numberValue)) {
        errorElm.textContent = "Please enter only number!";
    } else {
        errorElm.textContent = "";
    }
};
// enter email change handler function
export const enterEmailChangeHandler = function (event, errorElm, errorMessage) {
    const emailValue = event.target.value;
    const emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
    if (emailValue.trim().length === 0) {
        errorElm.textContent = errorMessage;
    } else if (!emailRegEx.test(emailValue)) {
        errorElm.textContent = "Please enter your valid email!";
    } else {
        errorElm.textContent = "";
    }
};
// select file change handler function
export const selectItemChangeHandler = function (event, errorElm, errorMessage) {
    const itemValue = event.target.files.length;
    if (itemValue === 0) {
        errorElm.textContent = errorMessage;
    } else {
        errorElm.textContent = "";
    }
};
// checkbox change handler
export const checkboxChangeHandler = function (event, error) {
    if (!event.target.checked) {
        error.textContent = "Please accept the agreement to proceed!";
    } else {
        error.textContent = "";
    }
};
// prevent form submit handler function
export const preventFormSubmitHandler =function(event, errorElm, errorMessage, input) {
    event.preventDefault();
    errorElm.textContent=errorMessage;
    input.focus();
}
// enter current password handler
export const enterCurrentPasswordHandler=function (event, errorElm, errorMessage) {
    const oldPasswordValue=event.target.value;
    if (oldPasswordValue.length < 4) {
        errorElm.textContent=errorMessage;
    }else {
        errorElm.textContent="";
    }
}
// enter confirm password handler
export const enterConfirmPasswordHandler=function(event, password, errorElm, errorMessage) {
    const passwordValue=event.target.value;
    if (passwordValue != password.value) {
        errorElm.textContent=errorMessage;
    } else {
        errorElm.textContent="";
    }
}