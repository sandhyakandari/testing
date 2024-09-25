document.addEventListener("DOMContentLoaded", function () {
  if (typeof fetchRegisteredPlayerRoute !== "undefined") {
    const createDropBoxElm = document.getElementById("create-draw-box");
    const createDrawTournamentNameElm = document.querySelector(
      ".createDrawTournamentName"
    );
    const createDrawSelectElm = document.getElementById("create-draw-select");
    const subCategoryElm = document.querySelectorAll(
      ".subCategory-tournament-draw"
    );
    const radioGroupElm = document.getElementById("radio-group");
    const fetchRegisteredPlayerElm = document.fetchRegisteredPlayer;
    const tournament_id_elm = fetchRegisteredPlayerElm.tournament_id;
    const playerRegisterDataElm = document.getElementById("playerRegisterData");
    const manulaRegisteredPlayerElm = document.getElementById(
      "manual-registered-player"
    );
    const createDrawForTournamentElm = document.createDrawForTournament;
    let drawTypeErrorElm = document.getElementById("drawTypeError");

    // change tournament radio group function handler
    const tournamentCategoryType = function (category, radioGroup,subCategory) {
      console.log(subCategory);
      

      if (category === "Seniors") {
        let dropdown=document.getElementById('gender_dropdown');
       
        dropdown.style.display='none';
        let html='';
        if(subCategory.includes('Men'))
        {   html+=`<div class="radio-group-senior">
          <input type="radio" name="sub-category" class="subCategory-tournament-draw" id="men" value="men">
          <label class="theme-btn-one" for="men">Men</label>
      </div>` }
         if(subCategory.includes('Women'))
        { html += `
        
          <div class="radio-group-senior">
              <input type="radio" name="sub-category" class="subCategory-tournament-draw" id="women" value="women">
              <label class="theme-btn-one" for="women">Women</label>
          </div>
        `; }
        radioGroup.innerHTML = html;
      } else if (category === "Juniors") {
        let dropdown=document.getElementById('gender_dropdown');
       
        dropdown.style.display='block';
         let html='';
        if(subCategory.includes('Under 12'))
        {html += ` <div class="radio-group-junior">
              <input type="radio" name="sub-category" class="subCategory-tournament-draw" id="under-12" value="under-12">
              <label class="theme-btn-one" for="under-12">Under 12</label>
          </div>`;
        }
           if(subCategory.includes('Under 14'))
            { 
              html+= `<div class="radio-group-junior">
                  <input type="radio" name="sub-category" class="subCategory-tournament-draw" id="under-14" value="under-14">
                  <label class="theme-btn-one" for="under-14">Under 14</label>
                </div>`;
          }
          if(subCategory.includes('Under 16'))
          {
             html+= `<div class="radio-group-junior">
                <input type="radio" name="sub-category" class="subCategory-tournament-draw" id="under-16" value="under-16">
                <label class="theme-btn-one" for="under-16">Under 16</label>
              </div>`;
          }
          if(subCategory.includes('Under 18'))
          { html+=`
          <div class="radio-group-junior">
              <input type="radio" name="sub-category" class="subCategory-tournament-draw" id="under-18" value="under-18">
              <label class="theme-btn-one" for="under-18">Under 18</label>
          </div>
        `;}
        radioGroup.innerHTML = html;
      } else {
        radioGroup.innerHTML = "";
      }
    };

    // radio button check handler
    const radioCheckedHandler = function (elm, error) {
      if (elm.checked) {
        // console.log(elm.checked);
        error.innerText = "";
      } else {
        error.innerText = "Please select type of draw!";
      }
    };
    // player gender select onchange handler
    const playerGenderSelectHandler = function (elm, error) {
      if (elm.value.trim() === "") {
        error.innerText = "Please select player gender type!";
      } else {
        error.innerText = "";
      }
    };

    // show pagination functionality
    const itemsPerPage = 50;
    let currentPage = 1;
    if (playerRegisterDataElm || manulaRegisteredPlayerElm) {
      const portalRegisteredPlayers = playerRegisterDataElm
        ? JSON.parse(
            playerRegisterDataElm.getAttribute("data-portalRegisteredPlayer")
          )
        : [];
      const manualRegisteredPlayers = manulaRegisteredPlayerElm
        ? JSON.parse(
            manulaRegisteredPlayerElm.getAttribute(
              "data-manualRegisteredPlayer"
            )
          )
        : [];

      const totalPlayers = [
        ...portalRegisteredPlayers,
        ...manualRegisteredPlayers,
      ];

      // Pagination logic
      function paginate(array, pageNumber, itemsPerPage) {
        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        return array.slice(startIndex, endIndex);
      }

      function renderPaginatedData(pageNumber) {
        const paginatedPlayers = paginate(
          totalPlayers,
          pageNumber,
          itemsPerPage
        );

        // Clear the existing data
        const playerDataContainer = document.querySelector(
          ".register-player-data"
        );
        playerDataContainer.innerHTML = `
          <ul class="player-data-heading">
            <li>S.No</li>
            <li>Name</li>
            <li>Rank</li>
            <li>Registration Number</li>
            <li>Gender</li>
            <li>Date Of Birth</li>
          </ul>
          `;

        // Add the paginated data
        paginatedPlayers.forEach((player, index) => {
          const playerIndex = (pageNumber - 1) * itemsPerPage + index + 1;
          playerDataContainer.innerHTML += `
            <ul class="player-data-items">
                <li>${playerIndex}</li>
                <li>
                    ${player.first_name || player.name} 
                    ${player.middle_name ? player.middle_name : ""}
                    ${player.last_name ? player.last_name : ""}
                </li>
                <li>${player.rank || ""}</li>
                <li>${player.ita_number || player.aita_number || ""}</li>
                <li>${player.gender}</li>
                <li>${new Date(player.dob)
                  .toLocaleDateString("en-GB", {
                    day: "2-digit",
                    month: "short",
                    year: "numeric",
                  })
                  .split("-")
                  .join("-")}</li>
            </ul>
          `;
        });

        renderPaginationControls();
      }

      // Function to render pagination controls
      function renderPaginationControls() {
        const totalPages = Math.ceil(totalPlayers.length / itemsPerPage);
        const paginationControlsContainer = document.createElement("div");
        paginationControlsContainer.classList.add("pagination-controls");

        if (totalPages <= 1) return; // If there's only one page, no need for pagination controls

        // Add "Prev" button
        const prevButton = document.createElement("button");
        prevButton.innerHTML = `<i class="fa fa-chevron-left"></i>`;
        prevButton.classList.add("pagination-button");
        if (currentPage === 1) {
          prevButton.disabled = true; // Disable "Prev" button on the first page
        }
        prevButton.addEventListener("click", () => {
          currentPage--;
          renderPaginatedData(currentPage);
        });
        paginationControlsContainer.appendChild(prevButton);

        // Add first page button
        const firstPageButton = createPageButton(1);
        paginationControlsContainer.appendChild(firstPageButton);

        if (currentPage > 3) {
          const dots = document.createElement("span");
          dots.innerText = "...";
          paginationControlsContainer.appendChild(dots);
        }

        // Add page buttons for current, previous, and next pages
        if (currentPage > 2) {
          const prevPageButton = createPageButton(currentPage - 1);
          paginationControlsContainer.appendChild(prevPageButton);
        }

        const currentPageButton = createPageButton(currentPage);
        paginationControlsContainer.appendChild(currentPageButton);

        if (currentPage < totalPages - 1) {
          const nextPageButton = createPageButton(currentPage + 1);
          paginationControlsContainer.appendChild(nextPageButton);
        }

        if (currentPage < totalPages - 2) {
          const dots = document.createElement("span");
          dots.innerText = "...";
          paginationControlsContainer.appendChild(dots);
        }

        // Add last page button
        const lastPageButton = createPageButton(totalPages);
        paginationControlsContainer.appendChild(lastPageButton);

        // Add "Next" button
        const nextButton = document.createElement("button");
        nextButton.innerHTML = `<i class="fa fa-chevron-right"></i>`;
        nextButton.classList.add("pagination-button");
        if (currentPage === totalPages) {
          nextButton.disabled = true; 
        }
        nextButton.addEventListener("click", () => {
          currentPage++;
          renderPaginatedData(currentPage);
        });
        paginationControlsContainer.appendChild(nextButton);

        const playerDataContainer = document.querySelector(
          ".register-player-data"
        );
        playerDataContainer.appendChild(paginationControlsContainer);
      }

      // Helper function to create page buttons
      function createPageButton(pageNumber) {
        const pageButton = document.createElement("button");
        pageButton.innerText = pageNumber;
        pageButton.classList.add("pagination-button");
        if (pageNumber === currentPage) {
          pageButton.classList.add("active");
        }
        pageButton.addEventListener("click", () => {
          currentPage = pageNumber;
          renderPaginatedData(currentPage);
        });
        return pageButton;
      }

      // Initial render
      renderPaginatedData(currentPage);
    }

    // showRegisteredPlayerData.blade.php page when dropdown has been changed
    tournament_id_elm.addEventListener("change", async function () {
      // console.log(tournament_id_elm.value)
      const tournament_id = tournament_id_elm.value;
      try {
        let formData = new FormData();
        formData.append("tournament_id", tournament_id);
        let response = await fetch(fetchRegisteredPlayerRoute, {
          method: "POST",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          body: formData,
        });

        // console.log(response)
        if (!response.ok) {
          throw new Error("Response not okay! ", response.statusText);
        }
        let data = await response.json();
        let itemsPerPage=50;
        let currentPage=1;
        const {
          portal_registered_players,
          manual_registered_player,
          tournaments,
        } = data;
        const totalRegisterPlayers=[...portal_registered_players, ...manual_registered_player]
         console.log(totalRegisterPlayers, tournaments);
        if (tournaments) {
          createDrawForTournamentElm.id.value = tournaments.tournament_id;
          createDrawTournamentNameElm.innerText = "";
          radioGroupElm.innerHTML = "";
          createDropBoxElm.classList.add("active");
          createDrawTournamentNameElm.innerText = tournaments.tournamentName;
          tournamentCategoryType(tournaments.category, radioGroupElm,tournaments.subCategory);
        } else {
          createDropBoxElm.classList.remove("active");
        }


        function paginate(array, pageNumber, itemsPerPage) {
          const startIndex = (pageNumber - 1) * itemsPerPage;
          const endIndex = startIndex + itemsPerPage;
          return array.slice(startIndex, endIndex);
        }
        // render pagination data
        function renderPaginatedData (pageNumber) {
          const paginatedPlayers = paginate(totalRegisterPlayers, pageNumber, itemsPerPage);

          // Clear the existing data
          const playerDataContainer = document.querySelector(
            ".register-player-data"
          );
          playerDataContainer.innerHTML = `
            <ul class="player-data-heading">
              <li>S.No</li>
              <li>Name</li>
              <li>Rank</li>
              <li>Registration Number</li>
              <li>Gender</li>
              <li>Date Of Birth</li>
            </ul>
          `;

          // Add the paginated data
          paginatedPlayers.forEach((player, index) => {
            const playerIndex = (pageNumber - 1) * itemsPerPage + index + 1;
            playerDataContainer.innerHTML += `
              <ul class="player-data-items">
                  <li>${playerIndex}</li>
                  <li>
                      ${player.first_name || player.name} 
                      ${player.middle_name ? player.middle_name : ""}
                      ${player.last_name ? player.last_name : ""}
                  </li>
                  <li>${player.rank || ""}</li>
                  <li>${player.ita_number || player.aita_number || ""}</li>
                  <li>${player.gender}</li>
                  <li>${new Date(player.dob)
                    .toLocaleDateString("en-GB", {
                      day: "2-digit",
                      month: "short",
                      year: "numeric",
                    })
                    .split("-")
                    .join("-")}</li>
              </ul>
            `;
          });
  
          renderPaginationControls();
        }

        // Function to render pagination controls
        function renderPaginationControls() {
          const totalPages = Math.ceil(totalRegisterPlayers.length / itemsPerPage);
          const paginationControlsContainer = document.createElement("div");
          paginationControlsContainer.classList.add("pagination-controls");
  
          if (totalPages <= 1) return; 
          // Add "Prev" button
          const prevButton = document.createElement("button");
          prevButton.innerHTML = `<i class="fa fa-chevron-left"></i>`;
          prevButton.classList.add("pagination-button");
          if (currentPage === 1) {
            prevButton.disabled = true; 
          }
          prevButton.addEventListener("click", () => {
            currentPage--;
            renderPaginatedData(currentPage);
          });
          paginationControlsContainer.appendChild(prevButton);
  
          // Add first page button
          const firstPageButton = createPageButton(1);
          paginationControlsContainer.appendChild(firstPageButton);
  
          if (currentPage > 3) {
            const dots = document.createElement("span");
            dots.innerText = "...";
            paginationControlsContainer.appendChild(dots);
          }
  
          // Add page buttons for current, previous, and next pages
          if (currentPage > 2) {
            const prevPageButton = createPageButton(currentPage - 1);
            paginationControlsContainer.appendChild(prevPageButton);
          }
  
          const currentPageButton = createPageButton(currentPage);
          paginationControlsContainer.appendChild(currentPageButton);
  
          if (currentPage < totalPages - 1) {
            const nextPageButton = createPageButton(currentPage + 1);
            paginationControlsContainer.appendChild(nextPageButton);
          }
  
          if (currentPage < totalPages - 2) {
            const dots = document.createElement("span");
            dots.innerText = "...";
            paginationControlsContainer.appendChild(dots);
          }
  
          // Add last page button
          const lastPageButton = createPageButton(totalPages);
          paginationControlsContainer.appendChild(lastPageButton);
  
          // Add "Next" button
          const nextButton = document.createElement("button");
          nextButton.innerHTML = `<i class="fa fa-chevron-right"></i>`;
          nextButton.classList.add("pagination-button");
          if (currentPage === totalPages) {
            nextButton.disabled = true; 
          }
          nextButton.addEventListener("click", () => {
            currentPage++;
            renderPaginatedData(currentPage);
          });
          paginationControlsContainer.appendChild(nextButton);
  
          const playerDataContainer = document.querySelector(
            ".register-player-data"
          );
          playerDataContainer.appendChild(paginationControlsContainer);
        }
  
        // Helper function to create page buttons
        function createPageButton(pageNumber) {
          const pageButton = document.createElement("button");
          pageButton.innerText = pageNumber;
          pageButton.classList.add("pagination-button");
          if (pageNumber === currentPage) {
            pageButton.classList.add("active");
          }
          pageButton.addEventListener("click", () => {
            currentPage = pageNumber;
            renderPaginatedData(currentPage);
          });
          return pageButton;
        }
  
        // Initial render
        renderPaginatedData(currentPage);

      } catch (error) {
        console.log("server error: ", error);
      }

      if (createDrawForTournamentElm) {
        // sub-category item change handler
        subCategoryElm.forEach((el) => {
          el.addEventListener("change", function () {
            radioCheckedHandler(el, drawTypeErrorElm);
          });
        });
        // player gender select handler
        createDrawSelectElm.addEventListener("change", function () {
          playerGenderSelectHandler(createDrawSelectElm, drawTypeErrorElm);
        });

        // draw prepare form submit handler
        createDrawForTournamentElm.addEventListener(
          "submit",
          async function (event) {
            event.preventDefault();
            const subCategoryCheckedElm = document.querySelectorAll(
              ".subCategory-tournament-draw"
            );
            const genderElm = this.gender.value;
           
            let isRadioChecked = false;
            subCategoryCheckedElm.forEach((elm) => {
              if (elm.checked) {
                isRadioChecked = true;
              }
            });
            const genderElement=this.gender.style.display;
            if(genderElement=='none'){
               console.log(genderElement);
            }
            if (genderElement!='none'  && (genderElm === "" || !isRadioChecked)) {
              if (genderElm === "") {
                drawTypeErrorElm.innerText = "Please select player type!";
              }
              if (!isRadioChecked) {
                drawTypeErrorElm.innerText =
                  "Please select a category of draw!";
              }
              return false;
            } else {
              drawTypeErrorElm.innerText = "";
              this.submit();
            }
          }
        );
      }
    });
  }
});
