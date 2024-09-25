"use strict";
document.addEventListener("DOMContentLoaded", function () {
  const checkIsDrawCreatedElm = document.querySelector(".checkIsDrawCreated");
  const tournament_draw_category_box_elm = document.querySelector(
    ".tournament-draw-category-box"
  );

  if (
    typeof hasDrawRouteElm !== "undefined" ||
    typeof checkTypeOfDrawRoute !== "undefined" ||
    typeof fetchDrawDataRoute !== "undefined"
  ) {
    // empty all para elem
    // document.querySelectorAll(".showHowManyPlayerDraw").forEach(elm => {
    //     elm.textContent = "";
    // })
    // empty all para elem end

    if (checkIsDrawCreatedElm) {
      // click a draw button on the tab
      checkIsDrawCreatedElm.addEventListener("click", async function (event) {
        const data_tournament_id = this.getAttribute("data-tournament_id");
        const data_tournament_sub_category = this.getAttribute(
          "data-tournament_sub_category"
        );
        // console.log(data_tournament_id, data_tournament_sub_category)
        let formData = new FormData();
        formData.append("tournament_id", data_tournament_id);
        formData.append("subCategory", data_tournament_sub_category);

        let response = await fetch(hasDrawRouteElm, {
          method: "POST",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          body: formData,
        });

        if (!response.ok) {
          throw new Error("Response not ok", response.statusText);
        }
        let data = await response.json();
        // console.log(data);
        const sub_category_data = data.is_draw;
        if (sub_category_data.length > 0) {
          tournament_draw_category_box_elm.innerHTML = "";

          let navItemsHtml = "";
          let tabContentsHtml = "";

          const data_sub_category = sub_category_data.forEach((data, index) => {
            const data_category = [
              "Under 12",
              "Under 14",
              "Under 16",
              "Under 18",
            ];
            const genderInLoCase=data.gender.toLowerCase();
            const sub_cat_split=data.subCategory.split(' ').join('-')
            const draw_type_lowCase=data.draw_type.toLowerCase();
            // console.log(sub_cat_split)

            navItemsHtml += `<li class="nav-item checkQualifyOrMainDraw" role="presentation">
              <button class="nav-link" id="pills-${genderInLoCase}-${sub_cat_split}-tab" data-toggle="pill" data-target="#pills-${genderInLoCase}-${sub_cat_split}" type="button" role="tab" aria-controls="pills-${genderInLoCase}-${sub_cat_split}" aria-selected="true" data-draw-id="${data.draw_id}" data-interim-draw-id="${data.id}" data-subCategory="${data.subCategory}" data-draw-gender="${data.gender}" data-tournament-id="${data.tournament_id}">
                  ${data_category.includes(data.subCategory) ? data.subCategory + " " + data.gender : data.subCategory}
              </button>
            </li>`;

            tabContentsHtml += `<div class="tab-pane fade" id="pills-${genderInLoCase}-${sub_cat_split}" role="tabpanel" aria-labelledby="pills-${genderInLoCase}-${sub_cat_split}-tab">
            </div>`;
          });

          const finalHtml = `
              <ul class="nav nav-pills mb-3 show_sub_category_btn" id="pills-tab-0" role="tablist">
                  ${navItemsHtml}
              </ul>
              <div class="tab-content-0 draw_type_ul" id="pills-tabContent">
                  ${tabContentsHtml}
              </div>
          `;

          tournament_draw_category_box_elm.innerHTML = finalHtml;

          const buttons = tournament_draw_category_box_elm.querySelectorAll(
            ".checkQualifyOrMainDraw button"
          );
          buttons.forEach((button) => {
            button.addEventListener("click", function (event) {
              // console.log(event.target)
              const draw_id = event.target.getAttribute("data-draw-id");
              const interim_draw_id = event.target.getAttribute(
                "data-interim-draw-id"
              );
              const sub_category =
                event.target.getAttribute("data-subCategory");
              const gender = event.target.getAttribute("data-draw-gender");
              const tournament_id =
                event.target.getAttribute("data-tournament-id");
              handleQualifyOrMainDraw(
                interim_draw_id,
                draw_id,
                sub_category,
                gender,
                tournament_id
              );
            });
          });
        }
      });

      // when we clicked any category then check weather it is main draw or qualify draw
      const handleQualifyOrMainDraw = async function (
        interim_draw_id,
        draw_id,
        sub_category,
        gender,
        tournament_id
      ) {
        // console.log("sub category: ", sub_category, "draw id: ", draw_id,
        //     "Interime draw id: ", interim_draw_id, "gender is: ", gender, "tournament_id is: ",tournament_id);
        
        let draw_type_data = new FormData();
        draw_type_data.append("subCategory", sub_category);
        draw_type_data.append("draw_id", draw_id);
        draw_type_data.append("interim_draw_id", interim_draw_id);
        draw_type_data.append("gender", gender);
        draw_type_data.append("tournament_id", tournament_id);

        try {
          let response = await fetch(checkTypeOfDrawRoute, {
            method: "POST",
            headers: {
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            body: draw_type_data,
          });

          if (!response.ok) {
            throw new Error("Response not ok", response.statusText);
          }
          let data = await response.json();
          // console.log(data);
          const check_draw_type = data.check_draw_type;
          if (check_draw_type.length > 0) {
            let navItemsTypeDrawHtml="";
            let tabContentsTypeDrawHtml="";

            check_draw_type.forEach(data=>{
              const genderInLoCase=data.gender.toLowerCase();
              const sub_cat_split=data.subCategory.split(' ').join('-')
              const draw_type_lowCase=data.draw_type.toLowerCase();

              navItemsTypeDrawHtml += `<li class="nav-item showDrawDesign" role="presentation">
                <button class="nav-link" id="${genderInLoCase}-${sub_cat_split}-${draw_type_lowCase}-tab" data-toggle="tab" data-target="#${genderInLoCase}-${sub_cat_split}-${draw_type_lowCase}" type="button" role="tab" aria-controls="${genderInLoCase}-${sub_cat_split}-${draw_type_lowCase}" aria-selected="true" data-draw-id="${data.draw_id}" data-draw-gender="${data.gender}" data-draw-sub-category="${data.subCategory}" data-draw-type="${data.draw_type}" data-interim-draw-id="${data.id}">${data.draw_type}</button>
              </li>`;

              tabContentsTypeDrawHtml += `<div class="tab-pane fade isActiveTabPanel" id="${genderInLoCase}-${sub_cat_split}-${draw_type_lowCase}" role="tabpanel" aria-labelledby="${genderInLoCase}-${sub_cat_split}-${draw_type_lowCase}-tab"></div>`;
            })

            const finalHtmlDrawType = `
                <ul class="nav nav-pills mb-3" id="pills-tab-1" role="tablist">
                    ${navItemsTypeDrawHtml}
                </ul>
                <div class="tab-content-1" id="pills-tabContent-1">
                    ${tabContentsTypeDrawHtml}
                </div>
            `;

            const draw_type_ul_elm=document.querySelector(".draw_type_ul")
            draw_type_ul_elm.innerHTML = finalHtmlDrawType;
          }
        } catch (error) {
          console.log("server error: ", error);
        }
      };

      // checked clicked on right button or any other
      document.addEventListener("click", function (event) {
        if (event.target.matches(".showDrawDesign button")) {
          handleShowDrawDesign(event.target);
        }
      });

      // calculate a rounds
      function calculateRounds(numPlayers) {
        return Math.ceil(Math.log2(numPlayers));
      }

      // show draw 1st and another rounds
      const show_draw_data_handler=function(arr) {
        const arr_data=arr.map((data,index, array)=>{
          if (index % 2 !== 0) return "";
          const currentPlayerName = data.player_name;
          const nextPlayerName = array[index + 1] ? array[index + 1] : null;
      
          let html = `
            <li class="spacer">&nbsp;</li>
            <li class="game game-top">
              ${currentPlayerName}
            </li>
            <li class="game game-spacer">&nbsp;</li>
          `;
      
          if (nextPlayerName) {
            html += `
              <li class="game game-bottom">
                ${nextPlayerName.player_name}
              </li>
            `;
          } else {
            html += `
              <li class="game game-bottom">&nbsp;</li>
            `;
          }
      
          if (index >= array.length - 2) {
            html += `<li class="spacer">&nbsp;</li>`;
          }

         return html;
        })
        return arr_data;
      }

      // when clicked main or qualify draw button
      async function handleShowDrawDesign(button) {
        const draw_id = button.getAttribute("data-draw-id");
        const gender = button.getAttribute("data-draw-gender");
        const subCategory = button.getAttribute("data-drow-sub-category");
        const draw_type = button.getAttribute("data-draw-type");
        const interim_draw_id = button.getAttribute("data-interim-draw-id");

        // console.log("draw id: ", draw_id, "gender:", gender, "subCategory: ", subCategory, "draw type:",
        //     draw_type);

        const draw_design_data = new FormData();
        draw_design_data.append("draw_id", draw_id);
        draw_design_data.append("gender", gender);
        draw_design_data.append("subCategory", subCategory);
        draw_design_data.append("draw_type", draw_type);
        draw_design_data.append("interim_draw_id", interim_draw_id);

        let response = await fetch(fetchDrawDataRoute, {
          method: "POST",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          body: draw_design_data,
        });

        if (!response.ok) {
          throw new Error("Response not ok", response.statusText);
        }
        let data = await response.json();
        // console.log(data);
        const show_draw = data.show_draw;
        if (show_draw.length > 0) {
          // console.log(show_draw)

          const isActiveTabPanelElm = document.querySelector(".isActiveTabPanel");

          const createP=document.createElement("p")
          createP.className="showHowManyPlayerDraw"
          createP.textContent = `${show_draw[0].player_num} Draw`;

          const getPlayerNum = +show_draw[0].player_num.split(" ")[0];
            // console.log(getPlayerNum)

          const totalRounds = calculateRounds(getPlayerNum);
            // console.log(totalRounds)

          const underSubCategoryDrawBox=document.createElement("div")
          underSubCategoryDrawBox.className="under-sub-category-draw-box"
          const playerDrawRoundElm = document.createElement("div")
          playerDrawRoundElm.className="playerDrawRound";
          

          underSubCategoryDrawBox.appendChild(createP)

          const roundUl=document.createElement("ul")
          roundUl.className="round round-1";
          // console.log(roundUl)

          let show_draw_design_data = show_draw
            .map((data, index, arr) => {
              // console.log(arr)
              if (index % 2 !== 0) return "";
              const currentPlayerName = data.player_name;
              const nextPlayerName = arr[index + 1] ? arr[index + 1] : "";
      
              // if (!nextPlayerName) return "";
      
              let firstLi = "";
              if (index === 0 || data.bye === "yes") {
                firstLi = "spacer";
              }
              if (index !== 0 && data.bye !== "yes") {
                firstLi = "game game-spacer";
              }
              // if (index !== 0 && data.bye !== "yes" && nextPlayerName) {
              //     firstLi = "game game-spacer";
              // }
              if (
                index !== 0 &&
                data.bye !== "yes" &&
                nextPlayerName &&
                nextPlayerName.bye !== "yes"
              ) {
                firstLi = "spacer";
              }
      
              let currentPlayerClass = "";
              if (data.bye === "yes") {
                currentPlayerClass = "game gave_by winner game-top";
              }
              if (data.bye !== "yes") {
                currentPlayerClass = "game game-bottom";
              }
              if (data.bye !== "yes" && nextPlayerName) {
                currentPlayerClass = "game game-bottom";
              }
              if (
                data.bye !== "yes" &&
                nextPlayerName &&
                nextPlayerName.bye !== "yes"
              ) {
                currentPlayerClass = "game game-top";
              }
      
              let nextPlayerClassName = "game game game-bottom";
              if (data.bye === "yes") {
                nextPlayerClassName = "game game-top gave_by winner";
              } else if (
                data.bye === "yes" &&
                nextPlayerName.bye === "yes"
              ) {
                nextPlayerClassName = "game game-top gave_by winner";
              }
              if (data.bye === "yes" && nextPlayerName.bye !== "yes") {
                nextPlayerClassName = "game game-top";
              }
              if (data.bye !== "yes" && nextPlayerName.bye == "yes") {
                nextPlayerClassName = "game game-top gave_by winner";
              }
              if (nextPlayerName.bye === "yes") {
                nextPlayerClassName = "game game-top gave_by winner";
              }
      
              let spacerClass = "";
              if (data.bye === "yes") {
                spacerClass = "spacer";
              }
              if (data.bye !== "yes" && nextPlayerName.bye !== "yes") {
                spacerClass = "game game-spacer";
              }
              if (data.bye === "yes" && nextPlayerName.bye !== "yes") {
                spacerClass = "spacer";
              }
      
              let html=`
                <li class="${firstLi}">&nbsp;</li>
                <li class="${currentPlayerClass}">
                    ${currentPlayerName}
                </li>
                <li class="${spacerClass}">&nbsp;</li>
              `;

              if (nextPlayerName) {
                html += `
                  <li class="${nextPlayerClassName}">
                      ${nextPlayerName.player_name}
                  </li>
                `;
              } else {
                html = `
                    <li class="${spacerClass}">&nbsp;</li>
                `;
              }
      
              if (index >= arr.length - 2) {
                html += `<li class="spacer">&nbsp;</li>`;
              }
              return html;
            })
            .filter(Boolean);

          roundUl.innerHTML = show_draw_design_data.join("");
          playerDrawRoundElm.appendChild(roundUl);

          underSubCategoryDrawBox.appendChild(playerDrawRoundElm)

          let show_draw_round_two=show_draw && show_draw.filter(data=>data.roundTwo==='yes')
          const round_two_draw_player_num=getPlayerNum && getPlayerNum/2;
          // console.log(show_draw_round_two)
          if (round_two_draw_player_num===show_draw_round_two.length) {
            // console.log(show_draw_round_two)
            if (Math.sign(round_two_draw_player_num)<0) return;
            if (show_draw_round_two.length <= 4) return;

            let round_two_draw_design = show_draw_data_handler(show_draw_round_two);

            const roundTwoUl=document.createElement("ul")
            roundTwoUl.className="round round-2";

            roundTwoUl.innerHTML = round_two_draw_design.join("");
            playerDrawRoundElm.appendChild(roundTwoUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }

          const show_draw_round_three=show_draw_round_two.filter(data=>data.roundThree==='yes')
          const round_three_player_num=round_two_draw_player_num && round_two_draw_player_num/2;
          if (round_three_player_num===show_draw_round_three.length) {
            if (Math.sign(round_three_player_num)<0) return;
            if (show_draw_round_three.length <= 4) return;

            let round_three_draw_design = show_draw_data_handler(show_draw_round_three);

            const roundThreeUl=document.createElement("ul")
            roundThreeUl.className="round round-3";

            roundThreeUl.innerHTML = round_three_draw_design.join("");
            playerDrawRoundElm.appendChild(roundThreeUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }

          const show_draw_round_four=show_draw_round_three.filter(data=>data.roundFour==='yes')
          const round_four_player_num=round_three_player_num && round_three_player_num/2;
          if (round_four_player_num===show_draw_round_four.length) {
            if (Math.sign(round_four_player_num)<0) return;
            if (show_draw_round_four.length <= 4) return;

            let round_four_draw_design = show_draw_data_handler(show_draw_round_four);

            const roundFourUl=document.createElement("ul")
            roundFourUl.className="round round-4";

            roundFourUl.innerHTML = round_four_draw_design.join("");
            playerDrawRoundElm.appendChild(roundFourUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }

          const show_draw_round_five=show_draw_round_four.filter(data=>data.roundFive==='yes')
          const round_five_player_num=round_four_player_num && round_four_player_num/2;
          if (round_five_player_num===show_draw_round_five.length) {
            if (Math.sign(round_five_player_num)<0) return;
            if (show_draw_round_five.length <= 4) return;

            let round_five_draw_design = show_draw_data_handler(show_draw_round_five);

            const roundFiveUl=document.createElement("ul")
            roundFiveUl.className="round round-5";

            roundFiveUl.innerHTML = round_five_draw_design.join("");
            playerDrawRoundElm.appendChild(roundFiveUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }

          const show_draw_round_six=show_draw_round_four.filter(data=>data.roundSix==='yes')
          const round_six_player_num=round_five_player_num && round_five_player_num/2;
          if (round_six_player_num===show_draw_round_six.length) {
            if (Math.sign(round_six_player_num)<0) return;
            if (show_draw_round_six.length <= 4) return;

            let round_six_draw_design = show_draw_data_handler(show_draw_round_six);

            const roundSixUl=document.createElement("ul")
            roundSixUl.className="round round-6";

            roundSixUl.innerHTML = round_six_draw_design.join("");
            playerDrawRoundElm.appendChild(roundSixUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }

          const show_draw_round_semi_final=show_draw.filter(data=>data.semifinal==="yes")
          if (show_draw_round_semi_final.length===4) {
            let round_semi_final_draw_design = show_draw_data_handler(show_draw_round_semi_final);

            const roundSemiFinalUl=document.createElement("ul")
            roundSemiFinalUl.className="round round-semi-final";

            roundSemiFinalUl.innerHTML = round_semi_final_draw_design.join("");
            playerDrawRoundElm.appendChild(roundSemiFinalUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }

          const show_draw_round_final=show_draw.filter(data=>data.final==="yes")
          if (show_draw_round_final.length===2) {
            let round_final_draw_design = show_draw_data_handler(show_draw_round_final);

            const roundFinalUl=document.createElement("ul")
            roundFinalUl.className="round round-final";

            roundFinalUl.innerHTML = round_final_draw_design.join("");
            playerDrawRoundElm.appendChild(roundFinalUl);

            underSubCategoryDrawBox.appendChild(playerDrawRoundElm)
          }
            
          isActiveTabPanelElm.appendChild(underSubCategoryDrawBox)

        }
      }
    }
  }
});
