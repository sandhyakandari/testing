@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Upcoming-Tournaments
@endsection

@section('content')
    <!--page-title-two-->
    <section class="page-title-two">
        <div class="title-box centred bg-color-2">
            <div class="pattern-layer">
                <div class="pattern-1"
                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-70.png') }});"></div>
                <div class="pattern-2"
                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-71.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="title">
                    <h1>Upcoming Tournaments</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Upcoming Tournaments</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- player-upcoming-tournaments-section-start -->
    <section class="patient-dashboard bg-color-3 player-dashboard-section player-upcoming-tournament-section">
        @include('layoutTwo.playerSidebar')
        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="doctors-appointment player-dashboard-tournament">
                        <div class="title-box">
                            <h3>Upcoming Tournaments</h3>
                            <p class="as-per-your-category">Kindly apply as per your category.</p>
                        </div>
                        <div class="doctors-list">
                            @if (count($tournaments) > 0)
                                <div class="tournament-filter mt-3">
                                    <form method="POST" class="filter-form" name="playerUpcomingTournamentForm"
                                        id="playerUpcomingTournamentForm">
                                        @csrf
                                        <div class="form-group">
                                            <select name="year" id="upcomingTournamentYears" class="category-select">
                                                <option value="">Year</option>
                                                @if (count($years) > 0)
                                                    @foreach ($years as $year)
                                                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="month" id="upcomingTournamentMonths" class="category-select">
                                                <option value="">Months</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="city" id="upcomingTournamentCity" class="category-select">
                                                <option value="">City</option>
                                                @if (count($cities) > 0)
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->city }}">{{ $city->city }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="category" id="upcomingTournamentCategory" class="category-select">
                                                <option value="">Player Category</option>
                                                {{-- <option value="Boy's">Boy's</option>
                                                <option value="Girl's">Girl's</option>
                                                <option value="Senior's">Senior's</option> --}}
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="subCategory" id="upcomingTournamentSubCategory"
                                                class="category-select">
                                                <option value="">Sub Category</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="facilities" id="upcomingTournamentStay" class="category-select">
                                                <option value="">Stay Facilities</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="theme-btn-one upcoming-tournament-filter-btn2 upcoming-tournament-filter-btn2-search">

                                                <i class="fas fa-search"></i>
                                            </button>
                                            <button type="reset"
                                                class="theme-btn-one upcoming-tournament-filter-btn2 upcoming-tournament-filter-btn2-reset">
                                                <!-- Reset -->
                                                <i class="fas fa-sync-alt"></i>

                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="{{ count($tournaments) == 1 ? 'p_one' : null }} {{ count($tournaments) == 2 ? 'p_two' : null }} {{ count($tournaments) == 3 ? 'p_three' : null }} {{ count($tournaments) == 4 ? 'p_four' : null }} {{ count($tournaments) == 5 ? 'p_five' : null }} {{ count($tournaments) == 6 ? 'p_six' : null }} {{ count($tournaments) == 7 ? 'p_seven' : null }} {{ count($tournaments) == 8 ? 'p_eight' : null }} {{ count($tournaments) == 9 ? 'p_nine' : null }}">
                                    <div class="table-outer">
                                        <table class="doctors-table player-tournament-table">
                                            <thead class="table-header">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Academy Name</th>
                                                    <th>City/ Town</th>
                                                    <th>Surface</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                @foreach ($tournaments as $tournament)
                                                    <tr id="form-{{ $tournament->tournament_id }}"
                                                        class="formTournamentClass">
                                                        <td>
                                                            <p>
                                                                <a
                                                                    href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                    {{ $tournament->tournamentName }}
                                                                </a>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ date('d-m-Y', strtotime($tournament->fromDate)) }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->academy_name }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->city }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->surface }}</p>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="tournament_id"
                                                                value="{{ $tournament->tournament_id }}">
                                                            <input type="hidden" name="category"
                                                                value="{{ $tournament->category }}"
                                                                class="showCategoryClass">
                                                            <p>{{ $tournament->category }}</p>
                                                        </td>
                                                        <td>
                                                            @if ($tournament->category === 'Seniors')
                                                                <select name="showSubCategory[]"
                                                                    class="showSubCategoryClass"
                                                                    data-show_subcategory="{{ $tournament->subCategory }}">
                                                                </select>
                                                            @else
                                                                <div
                                                                    class="select-sub-category-box-player-upcoming-tournament">
                                                                    <div class="select-btn">
                                                                        <label for="tournamentUpcomingSubCategory"
                                                                            class="btn-text mb-0">Sub Category</label>
                                                                        <input type="hidden" name="showSubCategory[]"
                                                                            id="tournamentUpcomingSubCategory">
                                                                        <span class="arrow-dwn">
                                                                            <i class="fas fa-chevron-down"></i>
                                                                        </span>
                                                                    </div>
                                                                    <ul class="selected-items selectedTournamentItem"
                                                                        data-show_subcategory="{{ $tournament->subCategory }}">
                                                                    </ul>
                                                                    <p class="tournamentSubCategoryError error"></p>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (in_array($tournament->tournament_id, $is_registered))
                                                                <button type="button"
                                                                    class="theme-btn-one registered_player">Applied</button>
                                                                <button type="button"
                                                                    class="theme-btn-two register_player tournament_withdrawl">
                                                                    Withdrawal
                                                                </button>
                                                            @else
                                                                <button type="button"
                                                                    class="theme-btn-one register_player tournament_apply_here">Apply
                                                                    Here</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3 paginator-box">
                                        {{ $tournaments->withQueryString()->links('layout.paginator') }}
                                    </div>
                                </div>
                            @else
                                <h1>No Tournament found!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- player-upcoming-tournaments-section-end -->
@endsection

@section('script')
    <script>
        const formTournamentClassElm = document.querySelectorAll(".formTournamentClass")
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on("submit", "#playerUpcomingTournamentForm", function(e) {
            e.preventDefault();
            fetchTournaments(1);
        });
        $(document).on("reset", "#playerUpcomingTournamentForm", function(e) {
            location.reload();
        })

        $(document).on("click", ".page-ul a", function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchTournaments(page);
        });

        function fetchTournaments(page) {
            var formData = {
                year: $("#upcomingTournamentYears").val(),
                month: $("#upcomingTournamentMonths").val(),
                city: $("#upcomingTournamentCity").val(),
                category: $("#upcomingTournamentCategory").val(),
                subCategory: $("#upcomingTournamentSubCategory").val(),
                stay: $("#upcomingTournamentStay").val()
            };

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: 'POST',
                url: "{{ route('players.playerUpcomingTournamentSearch') }}?page=" + page,
                data: formData,
                success: function(response) {
                    updateTournamentTable(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }


        function updateTournamentTable(data) {
            var tableBody = $('#tableBody');
            tableBody.empty();

            if (data.data.length > 0) {
                console.log(data);
                $.each(data.data, function(index, tournament) {
                    // console.log(tournament)
                    // console.log(data.is_registered)
                    var row = `<tr id="form-${tournament.tournament_id}" class="formTournamentClass">
                    <td><p><a href="${tournament.detail_url}">
                    ${tournament.tournamentName}</a></p></td>
                    <td><p>${new Date(tournament.fromDate).toLocaleDateString('en-GB')}</p></td>
                    <td><p>${tournament.academy_name}</p></td>
                    <td><p>${tournament.city}</p></td>
                    <td><p>${tournament.surface}</p></td>
                      <td>
                    <input type="hidden" name="tournament_id" value="${tournament.tournament_id}">
                    <input type="hidden" name="category" value="${tournament.category}" class="showCategoryClass">
                    <p>${tournament.category}</p>
                </td>
                <td>`;
                    if (tournament.category === 'Seniors') {
                        row +=
                            `<select name="showSubCategory[]" class="showSubCategoryClass" data-show_subcategory="${tournament.subCategory}"></select>`;
                    } else {
                        row += `
                <div class="select-sub-category-box-player-upcoming-tournament">
                    <div class="select-btn">
                        <label for="tournamentUpcomingSubCategory" class="btn-text mb-0">Sub Category</label>
                        <input type="hidden" name="showSubCategory[]" id="tournamentUpcomingSubCategory">
                        <span class="arrow-dwn"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <ul class="selected-items selectedTournamentItem" data-show_subcategory="${tournament.subCategory}"></ul>
                    <p class="tournamentSubCategoryError error"></p>
                </div>`;
                    }
                    row += `</td>
                <td>`;
                    var check_is_rgistered = data.is_registered.some(id => id === tournament.tournament_id)
                    if (check_is_rgistered) {
                        row +=
                            `<button type="button"
                                class="theme-btn-one registered_player">Applied</button>
                            <button type="button"
                                class="theme-btn-two register_player tournament_withdrawl">
                                Withdrawal
                            </button>`;
                    } else {
                        row +=
                            `<button type="button" class="theme-btn-one register_player tournament_apply_here">
                                Apply Here
                            </button>`;
                    }
                    row += '</td></tr>';
                    tableBody.append(row);
                });
                $('.paginator-box').html(data.pagination);

                // create function
                const formTournamentClassRowElm = document.querySelectorAll(".formTournamentClass")
                formTournamentClassRowElm.forEach(elm => {
                    const categoryElmValue = elm.querySelector(".showCategoryClass")?.value;
                    // console.log(categoryElmValue)
                    const btnText = elm.querySelector(".btn-text");
                    const selectBtn = elm.querySelector(".select-btn");
                    // console.log(btnText, selectBtn)

                    if (selectBtn) {
                        selectBtn.addEventListener("click", (event) => {
                            event.stopPropagation();
                            selectBtn.classList.toggle("open");
                        });
                    }

                    const subCategoryClassElm = elm.querySelector(".showSubCategoryClass");
                    const selectedTournamentItemElm = elm.querySelector(
                        ".selectedTournamentItem"
                    );
                    // console.log("subCategoryClassElm value: ", subCategoryClassElm,
                    //     "selectedTournamentItemElm value: ", selectedTournamentItemElm)

                    const elmValue = subCategoryClassElm ?
                        subCategoryClassElm.getAttribute("data-show_subcategory") :
                        selectedTournamentItemElm.getAttribute("data-show_subcategory");
                    // console.log(elmValue)

                    const elmValueSplit = elmValue ? elmValue.split(",") : [];
                    if (categoryElmValue === "Seniors") {
                        elmValueSplit.forEach((data) => {
                            // console.log(data)
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
                        const tournamentSubCategoryErrorElm = elm.querySelector(".tournamentSubCategoryError")

                        const tournamentSubCategoryValueElm = [];
                        elmValueSplit.forEach((subCategory) => {
                            // console.log(subCategory)
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
                                item.addEventListener("click", function() {
                                    addItemSelectHandler(
                                        item,
                                        tournamentSubCategoryNameElm,
                                        btnText,
                                        tournamentSubCategoryValueElm,
                                        tournamentSubCategoryErrorElm
                                    );
                                });
                            });
                        });
                    }

                    function addItemSelectHandler(
                        item,
                        tournamentSubCategoryNameElm,
                        btnText,
                        tournamentSubCategoryValueElm, tournamentSubCategoryErrorElm
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
                            tournamentSubCategoryErrorElm.textContent = "";
                        } else if (
                            checked &&
                            checked.length > 0 &&
                            !item.classList.contains("checked")
                        ) {
                            btnText.innerText = `${checked.length} Selected`;
                            tournamentSubCategoryValueIndexElm =
                                tournamentSubCategoryValueElm.indexOf(itemTextElm.innerText);
                            tournamentSubCategoryErrorElm.textContent = "";
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
                            tournamentSubCategoryErrorElm.textContent = "Please select one sub category!"
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
                })


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
                            console.log(subCategory.length)
                            const tournamentSubCategoryErrorElm = row.querySelector(
                                ".tournamentSubCategoryError")
                            if (subCategory.length === 0) {
                                tournamentSubCategoryErrorElm.textContent =
                                    "Please select one sub category!";
                                return false;
                            }

                            let formData = new FormData();
                            formData.append("tournament_id", tournamentId);
                            formData.append("category", category);
                            formData.append("subCategory", subCategory);

                            try {
                                let response = await fetch(
                                    "{{ route('player.playerRegisterTournament') }}", {
                                        method: "POST",
                                        headers: {
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                                "content"),
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
                                let response = await fetch(
                                    "{{ route('player.playerWithdrawTournament') }}", {
                                        method: "POST",
                                        headers: {
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                                "content"),
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
            } else {
                tableBody.append('<tr><td  colspan="6"><h1>No Tournament found!</h1></td></tr>');
            }
        }
    </script>
    <script>
        const playerRegisterTournamentRoute = "{{ route('player.playerRegisterTournament') }}";
        const playerWithdrawTournamentRoute = "{{ route('player.playerWithdrawTournament') }}"
    </script>
@endsection
