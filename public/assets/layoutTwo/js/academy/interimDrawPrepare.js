"use strict";
// academy/drawPrepare.blade.php
document.addEventListener("DOMContentLoaded", function () {
  const finalDrawPrepareFormElm = document.finalDrawPrepareForm;
  const drawTypeMainQualifyElm = document.querySelectorAll(
    ".draw-type-main-qualify"
  );
  const playerNumMainQualifyElm = document.querySelectorAll(
    ".playerNumMainQualify"
  );

  let drawTypeError = document.getElementById("drawTypeError");
  let numberOfPlayerErrorElm = document.getElementById("numberOfPlayerError");

  const isPlayerCheckboxElm=document.querySelectorAll(".isPlayerCheckbox")
  let isPlayerCheckboxErrorElm=document.getElementById("isPlayerCheckboxError")

  const checkallElm=document.getElementById("checkall")

  // draw radio button handler
  const radioButtonChangeHandler = function (error, errorMessage) {
    if (this.value) {
        // console.log(this)
      error.innerText = "";
    } else {
        // console.log(this)
      error.innerText = errorMessage;
    }
  };
//   checkbox validate handler
const checkboxChangeHandler = function(error, errorMessage, count, checkAll) {
  if (this.checked === false) {
      count--;
      if (checkAll.classList.contains("all-check-right")){
        checkAll.classList.replace("all-check-right","minus-checkbox")
        checkAll.checked=false;
      }
      // console.log("Unchecked, count:", count);
  } else {
      count++;
      // console.log("Checked, count:", count);
  }

  if (count === 0) {
      error.innerText = errorMessage;
  } else {
      error.innerText = "";
  }

  this.dataset.count = count;
}

  drawTypeMainQualifyElm.forEach((elm) => {
    elm.addEventListener("change", function () {
      radioButtonChangeHandler.call(
        this,
        drawTypeError,
        "Please select type of draw!"
      );
    });
  });
  playerNumMainQualifyElm.forEach((elm) => {
    elm.addEventListener("change", function () {
      radioButtonChangeHandler.call(
        this,
        numberOfPlayerErrorElm,
        "Please select draw number of players!"
      );
    });
  });
  isPlayerCheckboxElm.forEach(elm => {
    let count = 0;
    elm.addEventListener("change", function() {
        count = parseInt('0');

        checkboxChangeHandler.call(this, isPlayerCheckboxErrorElm, "No row selected!", count,checkallElm);

        isPlayerCheckboxElm.forEach(box => box.dataset.count = count);
    });
});
  // checkall checkbox click handler
  checkallElm.addEventListener("change", function(event) {
    if (event.target.classList.contains('not-checked')|| event.target.classList.contains("minus-checkbox")){
      event.target.classList.replace("not-checked","all-check-right")
      event.target.classList.replace("minus-checkbox","all-check-right")
      isPlayerCheckboxElm.forEach(elm=>{
          elm.checked=true;
      })
      isPlayerCheckboxErrorElm.textContent="";
    } else if (event.target.classList.contains("all-check-right")){
      event.target.classList.replace("all-check-right","minus-checkbox")
      isPlayerCheckboxElm.forEach(elm=>{
        elm.checked=false;
      })
    }
  })

  finalDrawPrepareFormElm.addEventListener("submit", function(event) {
    event.preventDefault();
    const drawType=this.drawType;
    const playerNum=this.playerNum;

    let drawTypeChecked=false;
    let playerNumChecked=false;
    let isPlayerCheckbox=false;

    drawTypeMainQualifyElm.forEach(elm=>{
        if (elm.checked) {
            drawTypeChecked = true;
        }
    })
    playerNumMainQualifyElm.forEach(elm=>{
        if(elm.checked) {
            playerNumChecked=true;
        }
    })
    isPlayerCheckboxElm.forEach(elm=>{
        if (elm.checked) {
            isPlayerCheckbox=true;
        }
    })

    if (!drawTypeChecked) {
        drawTypeError.textContent="Please select type of draw!";
    } else if (drawTypeError.textContent) {
        drawTypeError.textContent="Please select type of draw!";
    } else if (!playerNumChecked) {
        numberOfPlayerErrorElm.textContent="Please select draw number of players!";
    } else if (numberOfPlayerErrorElm.textContent) {
        numberOfPlayerErrorElm.textContent="Please select draw number of players!";
    } else if (!isPlayerCheckbox) {
        isPlayerCheckboxErrorElm.textContent="No row selected!";
    } else if (isPlayerCheckboxErrorElm.textContent) {
        isPlayerCheckboxErrorElm.textContent="No row selected!";
    } else {
        this.submit();
    }
  })
});
