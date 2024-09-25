"use strict";

document.addEventListener("DOMContentLoaded", function () {
    // body
    const body = document.body;
    // for upcoming tournaments tab on the home page
    const checkTournamentBtnElm = document.querySelectorAll(".check-tournament-btn");
    // for top ranking player tab on the home page
    const topRankingBtnContainer = document.querySelector(
        ".top-ranking-btn-container"
    );
    // for top ranking girl junior player
    const topRankingBtnJuniorGirlContainer = document.querySelector(
        ".top-ranking-btn-container-junior-girl"
    );
    const topRankingJuniorGirlPlayerBtn = document.querySelectorAll(
        ".top-ranking-junior-girl-player-btn"
    );
    // for top ranking boys junior player
    const topRankingBtnJuniorContainer = document.querySelector(
        ".top-ranking-btn-container-junior"
    );
    const topRanking = document.querySelectorAll(".top-ranking");
    const topRankingPlayerBtn = document.querySelectorAll(
        ".top-ranking-player-btn"
    );
    const topRankingJPlayerBtn = document.querySelectorAll(
        ".top-ranking-junior-player-btn"
    );
    // for top ranking player tab on the home page
    const recentResultBtnContainer = document.querySelector(
        ".recent-result-btn-container"
    );
    const recentResultBtnJuniorContainer = document.querySelector(
        ".recent-result-btn-container-junior"
    );
    const recentResult = document.querySelectorAll(".recent-result");
    const recentResultPlayerBtn =
        document.querySelectorAll(".recent-result-btn");
    const recentResultJPlayerBtn = document.querySelectorAll(
        ".recent-result-junior-player-btn"
    );

    // tournaments.blade.php
    // ***************************
    const tournamentSearchFormElm=document.tournamentSearchForm;
    const currentPastUpcomingTabsElm = document.getElementById(
        "current-past-upcoming-tabs"
    );
    const tournamentFilterCityFormElm = document.querySelector(
        ".tournament-filter-city-form"
    );
    const tournamentFilterCityInputElm = document.getElementById(
        "tournamentFilterCityInput"
    );
    const tournamentFilterCityArrowUpDownElm = document.getElementById(
        "tournamentFilterCityArrowUpDown"
    );
    const tournamentFilterItemCityListElm = document.querySelectorAll(
        ".tournament-filter-item-city-list"
    );
    const tournamentFilterCategoryFormElm = document.querySelector(
        ".tournament-filter-category-form"
    );
    const tournamentFilterCategoryInputElm = document.getElementById(
        "tournamentFilterCategoryInput"
    );
    const tournamentFilterCategoryArrowUpDownElm = document.getElementById(
        "tournamentFilterCategoryArrowUpDown"
    );
    const tournamentFilterItemCategoryListElm = document.querySelectorAll(
        ".tournament-filter-item-category-list"
    );
    // for category - subCategory
    const upcomingTournamentPlayerSubCategoryElm = document.getElementById(
        "upcomingTournamentPlayerSubCategory"
    );
    // ***************************
    const tournamentFilterYearFormElm = document.querySelector(
        ".tournament-filter-year-form"
    );
    const tournamentFilterYearInputElm = document.getElementById(
        "tournamentFilterYearInput"
    );
    const tournamentFilterYearArrowUpDownElm = document.getElementById(
        "tournamentFilterYearArrowUpDown"
    );
    const tournamentFilterItemYearListElm = document.querySelectorAll(
        ".tournament-filter-item-year-list"
    );
    const tournamentsFilterMonthFormElm = document.querySelector(
        ".tournament-filter-month-form"
    );
    const tournamentsFilterMonthInputElm = document.getElementById(
        "tournamentFilterMonthInput"
    );
    const tournamentFilterMonthArrowUpDownElm = document.getElementById(
        "tournamentFilterMonthArrowUpDown"
    );
    const tournamentFilterItemMonthListElm = document.querySelectorAll(
        ".tournament-filter-item-month-list"
    );
    const tournamentsFilterTourFormElm = document.querySelector(
        ".tournament-filter-tour-form"
    );
    const tournamentFilterTourInputElm = document.getElementById(
        "tournamentFilterTourInput"
    );
    const tournamentFilterTourArrowUpDownElm = document.getElementById(
        "tournamentFilterTourArrowUpDown"
    );
    const tournamentsFilterItemTourListElm = document.querySelectorAll(
        ".tournament-filter-item-tour-list"
    );
    // past tournament filter variable
    const pastTournamentSearchFormElm=document.pastTournamentSearchForm;
    const pastTournamentFilterYearFormElm=document.querySelector(".past-tournament-filter-year-form")
    const pastTournamentFilterYearInputElm=document.getElementById("pastTournamentFilterYearInput")
    const pastTournamentFilterYearArrowUpDownElm=document.getElementById("pastTournamentFilterYearArrowUpDown")
    const pastTournamentFilterItemYearListElm=document.querySelectorAll(".past-tournament-filter-item-year-list")
    const pastTournamentFilterMonthFormElm=document.querySelector(".past-tournament-filter-month-form")
    const pastTournamentFilterMonthInputElm=document.getElementById("pastTournamentFilterMonthInput")
    const pastTournamentFilterMonthArrowUpDownElm=document.getElementById("pastTournamentFilterMonthArrowUpDown")
    const pastTournamentFilterItemMonthListElm=document.querySelectorAll(".past-tournament-filter-item-month-list")
    const pastTournamentFilterCityFormElm=document.querySelector(".past-tournament-filter-city-form")
    const pastTournamentFilterCityInputElm=document.getElementById("pastTournamentFilterCityInput")
    const pastTournamentFilterCityArrowUpDownElm=document.getElementById("pastTournamentFilterCityArrowUpDown")
    const pastTournamentFilterItemCityListElm=document.querySelectorAll(".past-tournament-filter-item-city-list")
    const pastTournamentFilterCategoryFormElm=document.querySelector(".past-tournament-filter-category-form")
    const pastTournamentFilterCategoryInputElm=document.getElementById("pastTournamentFilterCategoryInput")
    const pastTournamentFilterCategoryArrowUpDownElm=document.getElementById("pastTournamentFilterCategoryArrowUpDown")
    const pastTournamentFilterItemCategoryListElm=document.querySelectorAll(".past-tournament-filter-item-category-list")
    const pastTournamentFilterTourFormElm=document.querySelector(".past-tournament-filter-tour-form")
    const pastTournamentFilterTourInputElm=document.getElementById("pastTournamentFilterTourInput")
    const pastTournamentFilterTourArrowUpDownElm=document.getElementById("pastTournamentFilterTourArrowUpDown")
    const pastTournamentFilterItemTourListElm=document.querySelectorAll(".past-tournament-filter-item-tour-list")
    const pastTournamentPlayerSubCategoryElm=document.getElementById("pastTournamentPlayerSubCategory")

    // current tournament filter variable
    const currentTournamentSearchFormElm=document.currentTournamentSearchForm;
    const currentTournamentFilterYearFormElm=document.querySelector(".current-tournament-filter-year-form")
    const currentTournamentFilterYearInputElm=document.getElementById("currentTournamentFilterYearInput")
    const currentTournamentFilterYearArrowUpDownElm=document.getElementById("currentTournamentFilterYearArrowUpDown")
    const currentTournamentFilterYearListElm=document.querySelectorAll(".current-tournament-filter-item-year-list")
    const currentTournamentFilterMonthFormElm=document.querySelector(".current-tournament-filter-month-form")
    const currentTournamentFilterMonthInputElm=document.getElementById("currentTournamentFilterMonthInput")
    const currentTournamentFilterMonthArrowUpDownElm=document.getElementById("currentTournamentFilterMonthArrowUpDown")
    const currentTournamentFilterItemMonthListElm=document.querySelectorAll(".current-tournament-filter-item-month-list")
    const currentTournamentFilterCityFormElm=document.querySelector(".current-tournament-filter-city-form")
    const currentTournamentFilterCityInputElm=document.getElementById("currentTournamentFilterCityInput")
    const currentTournamentFilterCityArrowUpDownElm=document.getElementById("currentTournamentFilterCityArrowUpDown")
    const currentTournamentFilterItemCityListElm=document.querySelectorAll(".current-tournament-filter-item-city-list")
    const currentTournamentFilterCategoryFormElm=document.querySelector(".current-tournament-filter-category-form")
    const currentTournamentFilterCategoryInputElm=document.getElementById("currentTournamentFilterCategoryInput")
    const currentTournamentFilterCategoryArrowUpDownElm=document.getElementById("currentTournamentFilterCategoryArrowUpDown")
    const currentTournamentFilterItemCategoryListElm=document.querySelectorAll(".current-tournament-filter-item-category-list")
    const currentTournamentFilterTourFormElm=document.querySelector(".current-tournament-filter-tour-form")
    const currentTournamentFilterTourInputElm=document.getElementById("currentTournamentFilterTourInput")
    const currentTournamentFilterTourArrowUpDownElm=document.getElementById("currentTournamentFilterTourArrowUpDown")
    const currentTournamentFilterItemTourListElm=document.querySelectorAll(".current-tournament-filter-item-tour-list")
    const currentTournamentPlayerSubCategoryElm=document.getElementById("currentTournamentPlayerSubCategory")

    // players.blade.php variable

    // recent tournament player img button variable
    const recent_tournament_result_photoElm = document.querySelectorAll(
        ".recent_tournament_result_photo"
    );
    // recent tournament popup variable
    const recentTournamentModelBackdropElm = document.querySelector(
        ".recentTournamentModelBackdrop"
    );
    const recentTournamentImageElm = document.querySelector(
        ".recentTournamentImage"
    );
    const recentTournamentClosePopUpElm = document.querySelector(
        ".recentTournamentClosePopUp"
    );
    const main_img_boxElm = document.querySelector(".main_img_box");
    const sub_img_boxElm = document.querySelectorAll(".sub-img-box");

    // functions start
    // showTournamentImgPopUpHandler
    const showTournamentImgPopUpHandler = function (backdrop, model, body) {
        backdrop.classList.add("active");
        model.classList.add("active");
        body.classList.add("hide");
    };
    const hideTournamentImgPopUpHandler = function (backdrop, model, body) {
        backdrop.classList.remove("active");
        model.classList.remove("active");
        body.classList.remove("hide");
    };
    const replaceImageHandler = function (event, main) {
        const img = main.querySelector("img");
        img.src = event.target.src;
    };
    // functions end

    // for upcoming tournaments tab functionality
    if (checkTournamentBtnElm){
        checkTournamentBtnElm.forEach(tab=>{
            tab.addEventListener("click", (event)=>{
                // console.log(event.target.getAttribute("data-activeTab"))
                checkTournamentBtnElm.forEach(activeTab=> activeTab.classList.remove("activeTabBtn"))
                if(event.target.getAttribute("data-activeTab")==="junior"){
                    event.target.parentElement.parentElement.classList.add("activeTabBtn")
                    event.target.classList.add("activeTabBtn")
                } else {
                    document.querySelectorAll(".tab-btn").forEach(active=>active.classList.remove("activeTabBtn"))
                    event.target.classList.add("activeTabBtn")
                }
            })
        })
    }

    // recent tournament player img button click function
    if (recent_tournament_result_photoElm) {
        recent_tournament_result_photoElm.forEach((button) => {
            button.addEventListener("click", (event) => {
                event.preventDefault();
                event.stopPropagation();
                showTournamentImgPopUpHandler(
                    recentTournamentModelBackdropElm,
                    recentTournamentImageElm,
                    body
                );
            });
        });
        recentTournamentClosePopUpElm.addEventListener("click", (event) => {
            event.stopPropagation();
            hideTournamentImgPopUpHandler(
                recentTournamentModelBackdropElm,
                recentTournamentImageElm,
                body
            );
        });
        recentTournamentModelBackdropElm.addEventListener("click", (event) => {
            event.stopPropagation();
            hideTournamentImgPopUpHandler(
                recentTournamentModelBackdropElm,
                recentTournamentImageElm,
                body
            );
        });
        if (recentTournamentModelBackdropElm && recentTournamentImageElm) {
            sub_img_boxElm.forEach((box) => {
                const img = box.querySelector("img");
                img.addEventListener("click", (event) => {
                    event.stopPropagation();
                    replaceImageHandler(event, main_img_boxElm);
                });
            });
        }
    }

    // for top ranking tab player functionality
    if (topRankingBtnContainer) {
        topRankingBtnContainer.addEventListener("click", (event) => {
           
            const clicked = event.target.closest(".top-ranking-player-btn");
           console.log('clicked',clicked)
            if (!clicked) {console.log('opoppop');};
            topRankingPlayerBtn.forEach((btn) =>
                btn.classList.remove("active")
            );
            clicked.classList.add("active");
            topRanking.forEach((btn) =>
                btn.classList.remove("top-ranking-player-active")
            );
            document.querySelector(`.top-ranking-player-${clicked.dataset.tab}`).classList.add("top-ranking-player-active");
        });
    }

    // for top ranking tab junior girl player functionality
    if (topRankingBtnJuniorGirlContainer) {
        topRankingBtnJuniorGirlContainer.addEventListener("click", (event) => {
            const clicked = event.target.closest(
                ".top-ranking-junior-girl-player-btn"
            );
            if (!clicked) return;
            topRankingJuniorGirlPlayerBtn.forEach((btn) => {
                btn.classList.remove("active");
            });
            clicked.classList.add("active");
            topRanking.forEach((btn) =>
                btn.classList.remove("top-ranking-player-active")
            );
            document
                .querySelector(`.top-ranking-player-${clicked.dataset.tab}`)
                .classList.add("top-ranking-player-active");
        });
    }

    // for top ranking tab junior player functionality
   
    if (topRankingBtnJuniorContainer) {
        topRankingBtnJuniorContainer.addEventListener("click", (event) => {
            const clicked = event.target.closest(
                ".top-ranking-junior-player-btn"
            );
            if (!clicked) return;
            topRankingJPlayerBtn.forEach((btn) =>
                btn.classList.remove("active")
            );
            clicked.classList.add("active");
            topRanking.forEach((btn) =>
                btn.classList.remove("top-ranking-player-active")
            );
            document
                .querySelector(`.top-ranking-player-${clicked.dataset.tab}`)
                .classList.add("top-ranking-player-active");
        });
    }

    // tournaments.blade.php
    // current/past/upcoming tournament filter
    if (currentPastUpcomingTabsElm) {
        currentPastUpcomingTabsElm.addEventListener("click", (event) => {
            const tabContainerBtnElm =
                event.target.closest(".tab-container-btn");
            if (!tabContainerBtnElm) return;
            document.querySelectorAll(".tab-container-btn").forEach((btn) => {
                btn.classList.remove("active");
            });
            tabContainerBtnElm.classList.add("active");
            const getDataFilter = tabContainerBtnElm.dataset.filter;
            document.querySelectorAll(".cart-section").forEach((section) => {
                section.classList.remove("active");
            });
            document
                .querySelector(`.cart-section-${getDataFilter}`)
                .classList.add("active");
        });
    }
    // tournaments filter by year
    if (tournamentFilterYearFormElm && tournamentFilterItemYearListElm) {
        tournamentFilterItemYearListElm.forEach((option) => {
            option.addEventListener("click", (event) => {
                event.stopPropagation();
                tournamentFilterItemYearListElm.forEach((selectedItem) => {
                    selectedItem.classList.remove("active");
                });
                option.classList.add("active");
                tournamentFilterYearFormElm.classList.remove("opened");
                tournamentFilterYearInputElm.value =
                    event.target.textContent.trim();
            });
        });
        tournamentFilterYearFormElm.addEventListener("click", (event) => {
            event.stopPropagation();
            const input = event.target.closest("input");
            if (!input) return;
            tournamentFilterYearFormElm.classList.toggle("opened");
            tournamentsFilterMonthFormElm.classList.remove("opened");
            tournamentFilterCityFormElm.classList.remove("opened");
            tournamentFilterCategoryFormElm.classList.remove("opened");
            tournamentsFilterTourFormElm.classList.remove("opened");
        });
        tournamentFilterYearArrowUpDownElm.addEventListener(
            "click",
            (event) => {
                event.stopPropagation();
                
                // const input = event.target.closest("input");
                // if (!input) return;
               //kajal add
                tournamentsFilterMonthFormElm.classList.remove("opened");
                tournamentFilterCityFormElm.classList.remove("opened");
                tournamentFilterCategoryFormElm.classList.remove("opened");
                tournamentsFilterTourFormElm.classList.remove("opened");
                //tillhere
                tournamentFilterYearFormElm.classList.toggle("opened");

            }
        );
        body.addEventListener("click", (event) => {
            event.stopPropagation();
            tournamentFilterYearFormElm.classList.remove("opened");
        });
    }
    // tournaments filter by month
    if (tournamentsFilterMonthFormElm && tournamentFilterItemMonthListElm) {
        tournamentFilterItemMonthListElm.forEach((option) => {
            option.addEventListener("click", (event) => {
                event.stopPropagation();
                tournamentFilterItemMonthListElm.forEach((selectedItem) => {
                    selectedItem.classList.remove("active");
                });
                // console.log(event.target.textContent)
                option.classList.add("active");
                tournamentsFilterMonthFormElm.classList.remove("opened");
                tournamentsFilterMonthInputElm.value =
                    event.target.textContent.trim();
            });
        });
        tournamentsFilterMonthFormElm.addEventListener("click", (event) => {
            event.stopPropagation();
            const input = event.target.closest("input");
            if (!input) return;
            tournamentFilterYearFormElm.classList.remove("opened");
            tournamentsFilterMonthFormElm.classList.toggle("opened");
            tournamentFilterCityFormElm.classList.remove("opened");
            tournamentFilterCategoryFormElm.classList.remove("opened");
            tournamentsFilterTourFormElm.classList.remove("opened");
        });
        tournamentFilterMonthArrowUpDownElm.addEventListener(
            "click",
            (event) => {
                event.stopPropagation();
               //kajal add
                tournamentFilterCityFormElm.classList.remove("opened");
                tournamentFilterCategoryFormElm.classList.remove("opened");
                tournamentsFilterTourFormElm.classList.remove("opened");
                tournamentFilterYearFormElm.classList.remove("opened");
                //tillhere
                tournamentsFilterMonthFormElm.classList.toggle("opened");
            }
        );
        body.addEventListener("click", (event) => {
            event.stopPropagation();
            tournamentsFilterMonthFormElm.classList.remove("opened");
        });
    }
    // tournaments filter by city
    if (tournamentFilterCityFormElm && tournamentFilterItemCityListElm) {
        tournamentFilterItemCityListElm.forEach((option) => {
            option.addEventListener("click", (event) => {
                event.stopPropagation();
                tournamentFilterItemCityListElm.forEach((selectedItem) => {
                    selectedItem.classList.remove("active");
                });
                // console.log(event.target.textContent)
                option.classList.add("active");
                tournamentFilterCityFormElm.classList.remove("opened");
                tournamentFilterCityInputElm.value =
                    event.target.textContent.trim();
            });
        });
        tournamentFilterCityFormElm.addEventListener("click", (event) => {
            event.stopPropagation();
            const input = event.target.closest("input");
            if (!input) return;
            tournamentFilterYearFormElm.classList.remove("opened");
            tournamentsFilterMonthFormElm.classList.remove("opened");
            tournamentFilterCityFormElm.classList.toggle("opened");
            tournamentFilterCategoryFormElm.classList.remove("opened");
            tournamentsFilterTourFormElm.classList.remove("opened");
        });
        tournamentFilterCityArrowUpDownElm.addEventListener(
            "click",
            (event) => {
                event.stopPropagation();
                //kajal add
                tournamentsFilterMonthFormElm.classList.remove("opened");
                tournamentFilterCategoryFormElm.classList.remove("opened");
                tournamentsFilterTourFormElm.classList.remove("opened");
                tournamentFilterYearFormElm.classList.remove("opened");
                //till here
                tournamentFilterCityFormElm.classList.toggle("opened");
                


            }
        );
        body.addEventListener("click", (event) => {
            event.stopPropagation();
            tournamentFilterCityFormElm.classList.remove("opened");
        });
    }
    // tournament select category fetch automatically sub category
    if (tournamentFilterCategoryFormElm) {
        const subCategoriesMap = {
            junior: ["Under 12", "Under 14", "Under 16", "Under 18"],
            senior: ["Men", "Women"],
        };

        tournamentFilterItemCategoryListElm.forEach((option) => {
            option.addEventListener("click", (event) => {
                event.stopPropagation();
                tournamentFilterItemCategoryListElm.forEach((item) =>
                    item.classList.remove("active")
                );
                option.classList.add("active");
                tournamentFilterCategoryFormElm.classList.remove("opened");
                tournamentFilterCategoryInputElm.value =
                    event.target.textContent.trim();

                const category = option.getAttribute("data-category");
                updateSubCategories(category);
            });
        });

        tournamentFilterCategoryFormElm.addEventListener("click", (event) => {
            event.stopPropagation();
            const input = event.target.closest("input");
            if (!input) return;
            // kajal add
            tournamentsFilterMonthFormElm.classList.remove("opened");
            tournamentFilterCityFormElm.classList.remove("opened");
            tournamentFilterYearFormElm.classList.remove("opened");
            //till here
            toggleForm(tournamentFilterCategoryFormElm);
        });

        tournamentFilterCategoryArrowUpDownElm.addEventListener(
            "click",
            (event) => {
                event.stopPropagation();
// kajal add
                tournamentsFilterMonthFormElm.classList.remove("opened");
                tournamentFilterCityFormElm.classList.remove("opened");
                tournamentFilterYearFormElm.classList.remove("opened");
//till here
                toggleForm(tournamentFilterCategoryFormElm);
            }
        );

        tournamentsFilterTourFormElm.addEventListener("click", (event) => {
            event.stopPropagation();
            const input = event.target.closest("input");
            if (!input) return;
            //kajal add
            tournamentsFilterMonthFormElm.classList.remove("opened");
            tournamentFilterCityFormElm.classList.remove("opened");
            tournamentFilterYearFormElm.classList.remove("opened");
            //tillhere
            toggleForm(tournamentsFilterTourFormElm);
        });

        tournamentFilterTourArrowUpDownElm.addEventListener(
            "click",
            (event) => {
                event.stopPropagation();
                //kajal add
            tournamentsFilterMonthFormElm.classList.remove("opened");
            tournamentFilterCityFormElm.classList.remove("opened");
            tournamentFilterYearFormElm.classList.remove("opened");
            //tillhere
                toggleForm(tournamentsFilterTourFormElm);
            }
        );

        body.addEventListener("click", () => {
            tournamentFilterCategoryFormElm.classList.remove("opened");
            tournamentsFilterTourFormElm.classList.remove("opened");
        });

        function toggleForm(formElm) {
            formElm.classList.toggle("opened");
            document
                .querySelectorAll(
                    ".tournament-filter-category-form, .tournament-filter-tour-form"
                )
                .forEach((elm) => {
                    if (elm !== formElm) elm.classList.remove("opened");
                });
        }

        function updateSubCategories(category) {
            upcomingTournamentPlayerSubCategoryElm.innerHTML =
                '<li class="filter-item tournament-filter-item-tour-list active">Sub Category</li>';
            if (subCategoriesMap[category]) {
                subCategoriesMap[category].forEach((subCategory) => {
                    const li = document.createElement("li");
                    li.className =
                        "filter-item tournament-filter-item-tour-list";
                    li.textContent = subCategory;
                    upcomingTournamentPlayerSubCategoryElm.appendChild(li);
                });
            }
            bindSubCategoryEvents();
        }

        function bindSubCategoryEvents() {
            const tournamentsFilterItemTourListElm = document.querySelectorAll(
                ".tournament-filter-item-tour-list"
            );
            tournamentsFilterItemTourListElm.forEach((option) => {
                option.addEventListener("click", (event) => {
                    event.stopPropagation();
                    tournamentsFilterItemTourListElm.forEach((item) =>
                        item.classList.remove("active")
                    );
                    option.classList.add("active");
                    tournamentsFilterTourFormElm.classList.remove("opened");
                    tournamentFilterTourInputElm.value =
                        event.target.textContent.trim();
                    // console.log(tournamentFilterTourInputElm.value);
                });
            });
        }

        // Initial binding for subcategories if they exist
        bindSubCategoryEvents();
    }
    // tournament search form
    if (tournamentSearchFormElm) {
        tournamentSearchFormElm.addEventListener("submit", event=>{
            event.preventDefault();
            const tournamentFilterYearInput=event.target.tournamentFilterYearInput.value;
            const tournamentFilterMonthInput=event.target.tournamentFilterMonthInput.value;
            const tournamentFilterCityInput=event.target.tournamentFilterCityInput.value;
            const tournamentFilterCategoryInput=event.target.tournamentFilterCategoryInput.value;
            const tournamentFilterTourInput=event.target.tournamentFilterTourInput.value;
            // console.log(tournamentFilterYearInput)
            if (tournamentFilterYearInput==="Year"&&tournamentFilterMonthInput==="Months"&&tournamentFilterCityInput==="City"&&tournamentFilterCategoryInput==="Player Category"&&tournamentFilterTourInput==="Sub Category"){
                alert("Please select one input!")
            }else {
                // event.target.submit();
            }
        })
    }

    // functions for category update
    const pastCurrentSubCategories={
        junior: ["Under 12", "Under 14", "Under 16", "Under 18"],
        senior: ["Men", "Women"],
    }

    const removeOpenedClassHandler=(formOne, formTwo, formThree, formFour, formFive)=>{
        formOne.classList.remove("opened")
        formTwo.classList.remove("opened")
        formThree.classList.remove("opened")
        formFour.classList.remove("opened")
        formFive.classList.remove("opened")
    }

    const bindCurrentPastSubCategories=(listItem, input, form)=>{
        listItem.forEach(option=>{
            option.addEventListener("click",event=>{
                event.stopPropagation()
                listItem.forEach(item=>item.classList.remove("active"))
                option.classList.add("active")
                form.classList.remove("opened")
                input.value=event.target.textContent.trim()
            })
        })
    }

    const updatePastCurrentSubCategory=(category, classes, ulId, input,form)=>{
        ulId.innerHTML= `<li class="filter-item ${classes} active">Sub Category</li>`;
        if (pastCurrentSubCategories[category]){
            pastCurrentSubCategories[category].forEach(subCategory=>{
                const li=document.createElement("li")
                li.className = `filter-item ${classes}`;
                li.textContent = subCategory;
                ulId.appendChild(li)
            })
        }
        const listItems=document.querySelectorAll(`.${classes}`)

        bindCurrentPastSubCategories(listItems, input,form)
    }

    const formOpenCloseHandler=(event, formOne, formTwo, formThree, formFour, main)=>{
        event.stopPropagation()
        const input = event.target.closest("input")
        // console.log(event.target)
        if (!input) return;
        main.classList.add("opened")
        formOne.classList.remove("opened")
        formTwo.classList.remove("opened")
        formThree.classList.remove("opened")
        formFour.classList.remove("opened")
    }

    const valueUpdateHandler =(event, items, input, form)=>{
        items.forEach(selectedItem=>selectedItem.classList.remove("active"))
        event.target.classList.add("active")
        input.value=event.target.textContent.trim();
        form.classList.remove("opened")
    }

    // past tournament form filter/ submit functionality
    if (pastTournamentSearchFormElm) {
        pastTournamentFilterItemCategoryListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation()
                pastTournamentFilterItemCategoryListElm.forEach(selectedItem=>selectedItem.classList.remove("active"))
                event.target.classList.add("active")
                removeOpenedClassHandler(pastTournamentFilterCategoryFormElm, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm, pastTournamentFilterTourFormElm)
                pastTournamentFilterCategoryInputElm.value=event.target.textContent.trim()
                const pastCategory=event.target.getAttribute("data-category")
                const classes="past-tournament-filter-item-tour-list";
                pastTournamentFilterTourInputElm.value=""
                updatePastCurrentSubCategory(pastCategory, classes,pastTournamentPlayerSubCategoryElm,pastTournamentFilterTourInputElm,pastTournamentFilterTourFormElm)
            })
        })
        pastTournamentFilterCategoryFormElm.addEventListener("click", function(event) {
            formOpenCloseHandler(event, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm,pastTournamentFilterTourFormElm,pastTournamentFilterCategoryFormElm)
        })
        pastTournamentFilterCategoryArrowUpDownElm.addEventListener("click", function(event) {
            formOpenCloseHandler(event, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm,pastTournamentFilterTourFormElm, pastTournamentFilterCategoryArrowUpDownElm)
        })
        pastTournamentFilterTourFormElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm,pastTournamentFilterCategoryFormElm, pastTournamentFilterTourFormElm)
        })
        pastTournamentFilterTourArrowUpDownElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm,pastTournamentFilterCategoryFormElm, pastTournamentFilterTourArrowUpDownElm)
        })
        body.addEventListener("click", event=>{
            event.stopPropagation()
           removeOpenedClassHandler(pastTournamentFilterCategoryFormElm, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm, pastTournamentFilterTourFormElm)
        })
        bindCurrentPastSubCategories(pastTournamentFilterItemTourListElm, pastTournamentFilterTourInputElm,pastTournamentFilterTourFormElm)

        pastTournamentFilterYearFormElm.addEventListener("click", function(event) {
            formOpenCloseHandler(event, pastTournamentFilterCategoryFormElm, pastTournamentFilterMonthFormElm, pastTournamentFilterCityFormElm,pastTournamentFilterTourFormElm, pastTournamentFilterYearFormElm)
        })
        pastTournamentFilterItemYearListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation();
                valueUpdateHandler(event, pastTournamentFilterItemYearListElm, pastTournamentFilterYearInputElm, pastTournamentFilterYearFormElm)
            })
        })
        pastTournamentFilterYearArrowUpDownElm.addEventListener("click", ()=> {
            pastTournamentFilterYearFormElm.classList.toggle("opened")
        })

        pastTournamentFilterMonthFormElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, pastTournamentFilterCategoryFormElm, pastTournamentFilterYearFormElm, pastTournamentFilterCityFormElm,pastTournamentFilterTourFormElm, pastTournamentFilterMonthFormElm)
        })
        pastTournamentFilterItemMonthListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation();
                valueUpdateHandler(event, pastTournamentFilterItemMonthListElm, pastTournamentFilterMonthInputElm, pastTournamentFilterMonthFormElm)
            })
        })
        pastTournamentFilterMonthArrowUpDownElm.addEventListener("click", ()=> {
            pastTournamentFilterMonthFormElm.classList.toggle("opened")
        })

        pastTournamentFilterCityFormElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, pastTournamentFilterCategoryFormElm, pastTournamentFilterYearFormElm, pastTournamentFilterMonthFormElm,pastTournamentFilterTourFormElm, pastTournamentFilterCityFormElm)
        })
        pastTournamentFilterItemCityListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation();
                valueUpdateHandler(event, pastTournamentFilterItemCityListElm, pastTournamentFilterCityInputElm, pastTournamentFilterCityFormElm)
            })
        })
        pastTournamentFilterCityArrowUpDownElm.addEventListener("click", ()=> {
            pastTournamentFilterCityFormElm.classList.toggle("opened")
        })

        pastTournamentSearchFormElm.addEventListener("submit", event=>{
            event.preventDefault();
            const tournamentFilterYearInput=event.target.tournamentFilterYearInput.value;
            const tournamentFilterMonthInput=event.target.tournamentFilterMonthInput.value;
            const tournamentFilterCityInput=event.target.tournamentFilterCityInput.value;
            const tournamentFilterCategoryInput=event.target.tournamentFilterCategoryInput.value;
            const tournamentFilterTourInput=event.target.tournamentFilterTourInput.value;

            if (tournamentFilterYearInput==="Year"&&tournamentFilterMonthInput==="Months"&&tournamentFilterCityInput==="City"&&tournamentFilterCategoryInput==="Player Category"&&tournamentFilterTourInput==="Sub Category"){
                alert("Please select one input!")
            }else {
                event.preventDefault();
            }
        })
    }
    // current tournament filter/ submit form functionality
    if (currentTournamentSearchFormElm) {
        currentTournamentFilterItemCategoryListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation()
                currentTournamentFilterItemCategoryListElm.forEach(selectedItem=>selectedItem.classList.remove("active"))
                event.target.classList.add("active")
                removeOpenedClassHandler(currentTournamentFilterCategoryFormElm, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm, currentTournamentFilterTourFormElm)
                currentTournamentFilterCategoryInputElm.value=event.target.textContent.trim()
                const currentCategories=event.target.getAttribute("data-category")
                const classes="current-tournament-filter-item-tour-list";
                currentTournamentFilterTourInputElm.value=""
                updatePastCurrentSubCategory(currentCategories, classes,currentTournamentPlayerSubCategoryElm,currentTournamentFilterTourInputElm,currentTournamentFilterTourFormElm)
            })
        })
        currentTournamentFilterCategoryFormElm.addEventListener("click", function(event) {
            formOpenCloseHandler(event, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm,currentTournamentFilterTourFormElm,currentTournamentFilterCategoryFormElm)
        })
        currentTournamentFilterCategoryArrowUpDownElm.addEventListener("click", function(event) {
            formOpenCloseHandler(event, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm,currentTournamentFilterTourFormElm, currentTournamentFilterCategoryArrowUpDownElm)
        })
        currentTournamentFilterTourFormElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm,currentTournamentFilterCategoryFormElm, currentTournamentFilterTourFormElm)
        })
        currentTournamentFilterTourArrowUpDownElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm,currentTournamentFilterCategoryFormElm, currentTournamentFilterTourArrowUpDownElm)
        })
        body.addEventListener("click", event=>{
            event.stopPropagation()
           removeOpenedClassHandler(currentTournamentFilterCategoryFormElm, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm, currentTournamentFilterTourFormElm)
        })
        bindCurrentPastSubCategories(currentTournamentFilterItemTourListElm, currentTournamentFilterTourInputElm,currentTournamentFilterTourFormElm)
        currentTournamentFilterYearFormElm.addEventListener("click", function(event) {
            formOpenCloseHandler(event, currentTournamentFilterCategoryFormElm, currentTournamentFilterMonthFormElm, currentTournamentFilterCityFormElm,currentTournamentFilterTourInputElm, currentTournamentFilterYearFormElm)
        })
        currentTournamentFilterYearListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation();
                valueUpdateHandler(event, currentTournamentFilterYearListElm, currentTournamentFilterYearInputElm, currentTournamentFilterYearFormElm)
            })
        })
        currentTournamentFilterYearArrowUpDownElm.addEventListener("click", ()=> {
            currentTournamentFilterYearFormElm.classList.toggle("opened")
        })

        currentTournamentFilterMonthFormElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, currentTournamentFilterCategoryFormElm, currentTournamentFilterYearFormElm, currentTournamentFilterCityFormElm,currentTournamentFilterTourInputElm, currentTournamentFilterMonthFormElm)
        })
        currentTournamentFilterItemMonthListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation();
                valueUpdateHandler(event, currentTournamentFilterItemMonthListElm, currentTournamentFilterMonthInputElm, currentTournamentFilterMonthFormElm)
            })
        })
        currentTournamentFilterMonthArrowUpDownElm.addEventListener("click", ()=> {
            currentTournamentFilterMonthFormElm.classList.toggle("opened")
        })
        currentTournamentFilterCityFormElm.addEventListener("click", event=>{
            formOpenCloseHandler(event, currentTournamentFilterCategoryFormElm, currentTournamentFilterYearFormElm, currentTournamentFilterMonthFormElm,currentTournamentFilterTourInputElm, currentTournamentFilterCityFormElm)
        })
        currentTournamentFilterItemCityListElm.forEach(option=>{
            option.addEventListener("click", event=>{
                event.stopPropagation();
                valueUpdateHandler(event, currentTournamentFilterItemCityListElm, currentTournamentFilterCityInputElm, currentTournamentFilterCityFormElm)
            })
        })
        currentTournamentFilterCityArrowUpDownElm.addEventListener("click", ()=> {
            currentTournamentFilterCityFormElm.classList.toggle("opened")
        })

        currentTournamentSearchFormElm.addEventListener("submit", event=>{
            event.preventDefault();
            const tournamentFilterYearInput=event.target.tournamentFilterYearInput.value;
            const tournamentFilterMonthInput=event.target.tournamentFilterMonthInput.value;
            const tournamentFilterCityInput=event.target.tournamentFilterCityInput.value;
            const tournamentFilterCategoryInput=event.target.tournamentFilterCategoryInput.value;
            const tournamentFilterTourInput=event.target.tournamentFilterTourInput.value;

            if (tournamentFilterYearInput==="Year"&&tournamentFilterMonthInput==="Months"&&tournamentFilterCityInput==="City"&&tournamentFilterCategoryInput==="Player Category"&&tournamentFilterTourInput==="Sub Category"){
                alert("Please select one input!")
            }else {
                event.preventDefault();
            }
        })
    }
});


$(".set-bg").each(function () {
    var bg = $(this).data("setbg");
    $(this).css("background-image", "url(" + bg + ")");
});

$(document).ready(function () {
    $(".reg-btn").click(function () {
        // Get the target content ID from the data attribute
        var targetId = $(this).data("target");

        // Hide all content divs
        $(".content").removeClass("show-form");

        // Show the content div corresponding to the clicked menu link
        $("#" + targetId).addClass("show-form");
    });
});
