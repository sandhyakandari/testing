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
          const isActiveTabPanelElm = document.querySelector(".isActiveTabPanel");
        
          const createP = document.createElement("p");
          createP.className = "showHowManyPlayerDraw";
          createP.textContent = `${show_draw[0].player_num} Draw`;
        
          const getPlayerNum = +show_draw[0].player_num.split(" ")[0];
          const totalRounds = calculateRounds(getPlayerNum);
        
          const underSubCategoryDrawBox = document.createElement("div");
          underSubCategoryDrawBox.className = "under-sub-category-draw-box";
        
          const playerDrawRoundElm = document.createElement("div");
          playerDrawRoundElm.className = "playerDrawRound";
        
          underSubCategoryDrawBox.appendChild(createP);
        
          let serial_nu_ul = document.createElement("ul");
          serial_nu_ul.className = `serial-num-ul`;
        
          for (let i = 1; i <= getPlayerNum; i++) {
            let serial_nu_ul_li = document.createElement("li");
            serial_nu_ul_li.innerText = i;
            serial_nu_ul.appendChild(serial_nu_ul_li);
          }
          playerDrawRoundElm.appendChild(serial_nu_ul);
        
          let registration_no_ul = document.createElement("ul");
          registration_no_ul.className = `reg-num-ul`;
        
          let rank_no_ul = document.createElement("ul");
          rank_no_ul.className = "rank-num-ul";
        
          let state_ul = document.createElement("ul");
          state_ul.className = "state-ul";
        
          let roundUl = document.createElement("ul");
          roundUl.className = `round round-1`;

          let ulArrayRoundOne=[];
          show_draw.forEach((data, index, array) => {
            const currentPlayerName = data.player_name;
            const nextPlayerName = array[index + 1] ? array[index + 1].player_name : "";
        
            let registration_no_ul_li = document.createElement("li");
            registration_no_ul_li.innerText = data.aita_number;
            registration_no_ul.appendChild(registration_no_ul_li);
        
            let rank_no_li = document.createElement("li");
            rank_no_li.innerText = data.rank;
            rank_no_ul.appendChild(rank_no_li);
        
            let state_li = document.createElement("li");
            state_li.innerText = data.state;
            state_ul.appendChild(state_li);
            
        
            // for (let i = 1; i <= totalRounds; i++) {
            if (data.roundOne==='yes'){
              let html = `
                <li class="spacer">&nbsp;</li>
                <li class="game game-top">${currentPlayerName}</li>
                <li class="game game-spacer">&nbsp;</li>
                <li class="game game-bottom">Bye</li>
                <li class="spacer">&nbsp;</li>
              `;
          
              ulArrayRoundOne.push(html)
            }
            // }
            
          });
        
          playerDrawRoundElm.appendChild(registration_no_ul);
          playerDrawRoundElm.appendChild(rank_no_ul);
          playerDrawRoundElm.appendChild(state_ul);

          // console.log(ulArrayRoundOne.join(" "))
          roundUl.innerHTML=ulArrayRoundOne.join(" ")
          playerDrawRoundElm.appendChild(roundUl);
          
          // Finally, append the entire structure to the parent element
          underSubCategoryDrawBox.appendChild(playerDrawRoundElm);
          isActiveTabPanelElm.appendChild(underSubCategoryDrawBox);
        }
        
      }

      // when clicked main or qualify draw button
      // async function handleShowDrawDesign(button) {
      //   const draw_id = button.getAttribute("data-draw-id");
      //   const gender = button.getAttribute("data-draw-gender");
      //   const subCategory = button.getAttribute("data-drow-sub-category");
      //   const draw_type = button.getAttribute("data-draw-type");
      //   const interim_draw_id = button.getAttribute("data-interim-draw-id");

      //   // console.log("draw id: ", draw_id, "gender:", gender, "subCategory: ", subCategory, "draw type:",
      //   //     draw_type);

      //   const draw_design_data = new FormData();
      //   draw_design_data.append("draw_id", draw_id);
      //   draw_design_data.append("gender", gender);
      //   draw_design_data.append("subCategory", subCategory);
      //   draw_design_data.append("draw_type", draw_type);
      //   draw_design_data.append("interim_draw_id", interim_draw_id);

      //   let response = await fetch(fetchDrawDataRoute, {
      //     method: "POST",
      //     headers: {
      //       "X-Requested-With": "XMLHttpRequest",
      //       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      //     },
      //     body: draw_design_data,
      //   });

      //   if (!response.ok) {
      //     throw new Error("Response not ok", response.statusText);
      //   }
      //   let data = await response.json();
      //   // console.log(data);
      //   const show_draw = data.show_draw;
      //   if (show_draw.length > 0) {
      //     console.log(show_draw)

      //     const isActiveTabPanelElm = document.querySelector(".isActiveTabPanel");

      //     const createP=document.createElement("p")
      //     createP.className="showHowManyPlayerDraw"
      //     createP.textContent = `${show_draw[0].player_num} Draw`;

      //     const getPlayerNum = +show_draw[0].player_num.split(" ")[0];
      //       // console.log(getPlayerNum)

      //     const totalRounds = calculateRounds(getPlayerNum);
      //       // console.log(totalRounds)

      //     const underSubCategoryDrawBox=document.createElement("div")
      //     underSubCategoryDrawBox.className="under-sub-category-draw-box"
      //     const playerDrawRoundElm = document.createElement("div")
      //     playerDrawRoundElm.className="playerDrawRound";


      //     for (let round = 1; round <= totalRounds; round++) {
      //       const roundUl = document.createElement("ul");
      //       roundUl.className = `round round-${round}`; 
        
      //       let roundData = "";
      //       if (round === 1) {
      //         roundData = show_draw
      //           .map((data, index, arr) => {
      //             if (index % 2 !== 0) return "";
        
      //             const currentPlayer = data;
      //             const nextPlayer = arr[index + 1] ? arr[index + 1] : null;
        
      //             let html = `
      //               <li class="spacer">&nbsp;</li>
      //               <li class="game game-top">${currentPlayer.player_name}</li>
      //               <li class="game game-spacer">&nbsp;</li>
      //               <li class="game game-bottom">${nextPlayer ? nextPlayer.player_name : "Bye"}</li>
      //               <li class="spacer">&nbsp;</li>
      //             `;
      //             return html;
      //           })
      //           .filter(Boolean)
      //           .join("");
      //       } else {
      //         roundData = `
      //           <li class="spacer">&nbsp;</li>
      //           <li class="game game-top">Winner of Round ${round - 1}</li>
      //           <li class="game game-spacer">&nbsp;</li>
      //           <li class="game game-bottom">Winner of Round ${round - 1}</li>
      //           <li class="spacer">&nbsp;</li>
      //         `;
      //       }
        
      //       roundUl.innerHTML = roundData;
      //       underSubCategoryDrawBox.appendChild(roundUl);
      //     }
        
      //     isActiveTabPanelElm.appendChild(underSubCategoryDrawBox);

      //   }
      // }
    }
  }
});
