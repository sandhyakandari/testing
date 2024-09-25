"use strict";

document.addEventListener("DOMContentLoaded", function () {
  // on upcoming tournament page show player subcategory which sub category tournament register itself
  if (formTournamentClassElm) {
    formTournamentClassElm.forEach((elm) => {
      const categoryElmValue = elm.querySelector(".showCategoryClass")?.value;
      // console.log(categoryElmValue)
      const btnText = elm.querySelector(".btn-text");
      const selectBtn = elm.querySelector(".select-btn");

      if (selectBtn) {
        selectBtn.addEventListener("click", (event) => {
          event.stopPropagation();
          selectBtn.classList.toggle("open");
        });
      }

        const subCategoryClassElm = elm.querySelector(".showSubCategoryClass");
        // console.log("subCategoryClassElm value: ",subCategoryClassElm)
        const selectedTournamentItemElm = elm.querySelector(
          ".selectedTournamentItem"
        );

        const elmValue = subCategoryClassElm 
        ? subCategoryClassElm.getAttribute("data-show_subcategory") 
        : selectedTournamentItemElm.getAttribute("data-show_subcategory");
        // console.log(elmValue)

      const elmValueSplit = elmValue ? elmValue.split(",") : [];
      if (categoryElmValue === "Seniors") {
        elmValueSplit.forEach((data) => {
          const option = document.createElement("option");
          option.text = data;
          option.value = data;
          // console.log("Option created: ", option);
          if (subCategoryClassElm) {
            subCategoryClassElm.add(option);
          } else {
            console.error("subCategoryClassElm is null when trying to append option.");
          }
        });    
      } else {
        const tournamentSubCategoryNameElm = elm.querySelector(
          "#tournamentUpcomingSubCategory[name='showSubCategory[]']"
        );
        const tournamentSubCategoryErrorElm=elm.querySelector(".tournamentSubCategoryError")

        const tournamentSubCategoryValueElm = [];
        elmValueSplit.forEach((subCategory) => {
          const listItem = `
              <li class="selected-item-list">
                  <span class="checkbox">
                      <i class="fa fa-check check-icon"></i>
                  </span>
                  <span class="item-text">${subCategory}</span>
              </li>
          `;
          selectedTournamentItemElm.innerHTML += listItem;

          const items = selectedTournamentItemElm.querySelectorAll(
            ".selected-item-list"
          );
          items.forEach((item) => {
            item.addEventListener("click", function () {
              addItemSelectHandler(
                item,
                tournamentSubCategoryNameElm,
                btnText,
                tournamentSubCategoryValueElm,tournamentSubCategoryErrorElm
              );
            });
          });
        });
      }

      function addItemSelectHandler(
        item,
        tournamentSubCategoryNameElm,
        btnText,
        tournamentSubCategoryValueElm,tournamentSubCategoryErrorElm
      ) {
        item.classList.toggle("checked");
        let checked = selectedTournamentItemElm.querySelectorAll(".checked");
        const itemTextElm = item.querySelector(".item-text");

        let tournamentSubCategoryValueIndexElm = "";
        if (
          checked &&
          checked.length > 0 &&
          item.classList.contains("checked")
        ) {
          btnText.innerText = `${checked.length} Selected`;
          tournamentSubCategoryValueElm.push(itemTextElm.innerText);
          tournamentSubCategoryErrorElm.textContent="";
        } else if (
          checked &&
          checked.length > 0 &&
          !item.classList.contains("checked")
        ) {
          btnText.innerText = `${checked.length} Selected`;
          tournamentSubCategoryValueIndexElm =
            tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
            tournamentSubCategoryErrorElm.textContent="";
          tournamentSubCategoryValueElm.splice(
            tournamentSubCategoryValueIndexElm,
            1
          );
        } else {
          tournamentSubCategoryValueIndexElm =
            tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
          tournamentSubCategoryValueElm.splice(
            tournamentSubCategoryValueIndexElm,
            1
          );
          btnText.innerText = "Sub Category";
          tournamentSubCategoryErrorElm.textContent="Please select one sub category!"
        }
        if (tournamentSubCategoryNameElm) {
          tournamentSubCategoryNameElm.value =
            tournamentSubCategoryValueElm.join(",");
          // console.log(tournamentSubCategoryNameElm.value)
        } else {
          console.error(
            "Element for 'tournamentSubCategoryNameElm' not found."
          );
        }
      }
    });

    // when a player either apply or withdraw to a tournament then
    if (document.querySelectorAll(".tournament_apply_here")) {
      document.querySelectorAll(".tournament_apply_here").forEach((button) => {
        button.addEventListener("click", async (event) => {
          const row = event.target.closest("tr");
          const tournamentId = row.querySelector(
            '[name="tournament_id"]'
          ).value;
          const category = row.querySelector('[name="category"]').value;
          const subCategory = row.querySelector(
            '[name="showSubCategory[]"]'
          ).value;
          // console.log(subCategory.length)
          const tournamentSubCategoryErrorElm=row.querySelector(".tournamentSubCategoryError")
          if(subCategory.length===0){
            tournamentSubCategoryErrorElm.textContent="Please select one sub category!";
            return false;
          }

          let formData = new FormData();
          formData.append("tournament_id", tournamentId);
          formData.append("category", category);
          formData.append("subCategory", subCategory);

          try {
            let response = await fetch(playerRegisterTournamentRoute, {
              method: "POST",
              headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              body: formData,
            });
            if (!response.ok) {
              throw new Error("Response not okay: " + response.statusText);
            }
            let data = await response.json();
            window.location.reload()
            console.log(data);
          } catch (error) {
            // console.log(response)
            window.location.reload();
            console.error("Server error: ", error);
          }
        });
      });
    }
    if (document.querySelectorAll(".tournament_withdrawl")) {
      document.querySelectorAll(".tournament_withdrawl").forEach((button) => {
        button.addEventListener("click", async (event) => {
          const row = event.target.closest("tr");
          const tournamentId = row.querySelector(
            '[name="tournament_id"]'
          ).value;
          const category = row.querySelector('[name="category"]').value;
          const subCategory = row.querySelector(
            '[name="showSubCategory[]"]'
          ).value;
          // console.log(row, tournamentId, category)

          let formData = new FormData();
          formData.append("tournament_id", tournamentId);
          formData.append("category", category);
          formData.append("subCategory", subCategory);

          try {
            let response = await fetch(playerWithdrawTournamentRoute, {
              method: "POST",
              headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              body: formData,
            });

            if (!response.ok) {
              throw new Error("Response not okay: " + response.statusText);
            }
            let data = await response.json();
            window.location.reload();
            console.log(data);
          } catch (error) {
            console.error("Server error: ", error);
          }
        });
      });
    }
  }
});
