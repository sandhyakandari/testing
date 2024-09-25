@extends('layout.layout')

@section('title')
    Kheldhaara | Tournament
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/result_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Tournaments & Result</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Tournaments & Result</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}

    {{-- tournaments-tab-past-current-upcoming-start --}}
    <section class="current-past-upcoming-sec">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="tabs-box">
                        <h3>Tournaments</h3>
                        <ul class="current-past-upcoming-tabs" id="current-past-upcoming-tabs">
                            <li class="tab-btn tab-container-btn active" data-filter="1">Upcoming</li>
                            <li class="tab-btn tab-container-btn" data-filter="2">Current</li>
                            <li class="tab-btn tab-container-btn" data-filter="3">Past</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- tournaments-tab-past-current-upcoming-end --}}

    {{-- tournament-calendar-table-start --}}
    <section class="cart-section portfolio-section custom-result-section click-tournament active cart-section-1">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-xs-12 column">
                    <div class="search-title">
                        <p class="sec-title">Search Upcoming Tournament</p>
                    </div>
                    <form method="get" name="tournamentSearchForm">
                        <div class="filter-box">
                            <div class="filter-inner-box tournament-filter-year">
                                <div class="tournament-filter-year-form">
                                    <input type="text" name="tournamentFilterYearInput" id="tournamentFilterYearInput"
                                        value="Year" readonly placeholder="Year">
                                    <span class="arrow-up-down" id="tournamentFilterYearArrowUpDown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="filter-list tournament-filter-year-list">
                                        <li class="filter-item tournament-filter-item-year-list active">
                                            Year
                                        </li>
                                        @if (count($upcoming_tournament_years) > 0)
                                            @foreach ($upcoming_tournament_years as $year)
                                                <li class="filter-item tournament-filter-item-year-list">
                                                    {{ $year->year }}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-inner-box tournament-filter-month">
                                <div class="tournament-filter-month-form">
                                    <input type="text" name="tournamentFilterMonthInput" id="tournamentFilterMonthInput"
                                        value="Months" readonly placeholder="Months">
                                    <span class="arrow-up-down" id="tournamentFilterMonthArrowUpDown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="filter-list tournament-filter-month-list">
                                        <li class="filter-item tournament-filter-item-month-list active">
                                            Months
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            January
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            February
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            March
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            April
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            May
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            June
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            July
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            August
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            September
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            October
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            November
                                        </li>
                                        <li class="filter-item tournament-filter-item-month-list">
                                            December
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-inner-box tournament-filter-city">
                                <div class="tournament-filter-city-form">
                                    <input type="text" name="tournamentFilterCityInput" id="tournamentFilterCityInput"
                                        value="City" readonly placeholder="City" />
                                    <span class="arrow-up-down" id="tournamentFilterCityArrowUpDown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="filter-list tournament-filter-city-list">
                                        <li class="filter-item tournament-filter-item-city-list active">City</li>
                                        @if (count($upcoming_tournament_city) > 0)
                                            @foreach ($upcoming_tournament_city as $tournament)
                                                <li class="filter-item tournament-filter-item-city-list">
                                                    {{ $tournament->city }}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-inner-box tournament-filter-category">
                                <div class="tournament-filter-category-form">
                                    <input type="text" name="tournamentFilterCategoryInput"
                                        id="tournamentFilterCategoryInput" value="Player Category" readonly
                                        placeholder="Player Category" />
                                    <span class="arrow-up-down" id="tournamentFilterCategoryArrowUpDown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="filter-list tournament-filter-category-list">
                                        <li class="filter-item tournament-filter-item-category-list active">Category
                                        </li>
                                        <li class="filter-item tournament-filter-item-category-list" data-category="junior">
                                            Juniors</li>
                                        <li class="filter-item tournament-filter-item-category-list" data-category="senior">
                                            Seniors</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-inner-box tournament-filter-tour">
                                <div class="tournament-filter-tour-form">
                                    <input type="text" name="tournamentFilterTourInput" id="tournamentFilterTourInput"
                                        value="Sub Category" readonly placeholder="Sub Category" />
                                    <span class="arrow-up-down" id="tournamentFilterTourArrowUpDown">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </span>
                                    <ul class="filter-list tournament-filter-tour-list"
                                        id="upcomingTournamentPlayerSubCategory">
                                        <li class="filter-item tournament-filter-item-tour-list active">Sub Category
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-inner-box">
                                <button type="submit" class="theme-btn tournament-filter-submit-btn">
                                    Search
                                </button>
                                <button type="reset" class="theme-btn resetButton">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                    @if (count($tournaments) > 0)
                        <div class="table-outer result-table">
                            <table class="cart-table">
                                <thead class="cart-header result-cart-header">
                                    <tr>
                                        <th>
                                            Tournament Name
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="tournamentName">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="tournamentName">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Academy Name
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="name">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="name">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Player Category
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="category">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="category">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Sub Category
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="subCategory">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="subCategory">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            City
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="city">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="city">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Tournament Stat Date
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="fromDate">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="fromDate">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Last Date To Apply
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrder" data-sorting_type="asc"
                                                    data-column_name="lastDate">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrder" data-sorting_type="desc"
                                                    data-column_name="lastDate">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Factsheet
                                        </th>
                                        <th>
                                            Register
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="upcomingTournamentBody">
                                    @include('partials.tournament_rows', ['tournaments' => $tournaments])
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 paginator-box" id="upcomingPaginatorBox">
                            {{ $tournaments->withQueryString()->links('layoutTwo.paginator') }}
                        </div>
                        <inut type="hidden" name="searchitem" id="searchitem" value="0">
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                            <input type="hidden" name="hidden_column_name" id="hidden_column_name"
                                value="tournament_id">
                            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">
                        @else
                            <div class="col-xs-12 column">
                                <h1>No tournament available yet!</h1>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- tournament-calendar-table-end --}}

    {{-- current-tournament-table-start --}}
    <section class="cart-section portfolio-section custom-result-section click-tournament cart-section-2">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="search-title">
                        <p class="sec-title">Search Current Tournament</p>
                    </div>
                </div>
                <div class="academies-search-box">
                    <div class="player-search player-search-name">
                        <form method="get" name="currentTournamentSearchForm">
                            <div class="filter-box">
                                <div class="filter-inner-box tournament-filter-year">
                                    <div class="current-tournament-filter-year-form">
                                        <input type="text" name="tournamentFilterYearInput"
                                            id="currentTournamentFilterYearInput" value="Year" readonly
                                            placeholder="Year">
                                        <span class="arrow-up-down" id="currentTournamentFilterYearArrowUpDown">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                        <ul class="filter-list tournament-filter-year-list">
                                            <li class="filter-item current-tournament-filter-item-year-list active">
                                                Year
                                            </li>
                                            @if (count($current_tournament_years) > 0)
                                                @foreach ($current_tournament_years as $year)
                                                    <li class="filter-item current-tournament-filter-item-year-list">
                                                        {{ $year->year }}
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-inner-box tournament-filter-month">
                                    <div class="current-tournament-filter-month-form">
                                        <input type="text" name="tournamentFilterMonthInput"
                                            id="currentTournamentFilterMonthInput" value="Months" readonly
                                            placeholder="Months">
                                        <span class="arrow-up-down" id="currentTournamentFilterMonthArrowUpDown">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                        <ul class="filter-list tournament-filter-month-list">
                                            <li class="filter-item current-tournament-filter-item-month-list active">
                                                Months
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                January
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                February
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                March
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                April
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                May
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                June
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                July
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                August
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                September
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                October
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                November
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-month-list">
                                                December
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-inner-box tournament-filter-city">
                                    <div class="current-tournament-filter-city-form">
                                        <input type="text" name="tournamentFilterCityInput"
                                            id="currentTournamentFilterCityInput" value="City" readonly
                                            placeholder="City" />
                                        <span class="arrow-up-down" id="currentTournamentFilterCityArrowUpDown">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                        <ul class="filter-list tournament-filter-city-list">
                                            <li class="filter-item current-tournament-filter-item-city-list active">
                                                City
                                            </li>
                                            @if (count($current_tournament_cities) > 0)
                                                @foreach ($current_tournament_cities as $tournament)
                                                    <li class="filter-item current-tournament-filter-item-city-list">
                                                        {{ $tournament->city }}
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-inner-box tournament-filter-category">
                                    <div class="current-tournament-filter-category-form">
                                        <input type="text" name="tournamentFilterCategoryInput"
                                            id="currentTournamentFilterCategoryInput" value="Player Category" readonly
                                            placeholder="Player Category" />
                                        <span class="arrow-up-down" id="currentTournamentFilterCategoryArrowUpDown">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                        <ul class="filter-list tournament-filter-category-list">
                                            <li class="filter-item current-tournament-filter-item-category-list active">
                                                Category
                                            </li>
                                            <li class="filter-item current-tournament-filter-item-category-list"
                                                data-category="junior">Juniors</li>
                                            <li class="filter-item current-tournament-filter-item-category-list"
                                                data-category="senior">Seniors</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-inner-box tournament-filter-tour">
                                    <div class="current-tournament-filter-tour-form">
                                        <input type="text" name="tournamentFilterTourInput"
                                            id="currentTournamentFilterTourInput" value="Sub Category" readonly
                                            placeholder="Sub Category" />
                                        <span class="arrow-up-down" id="currentTournamentFilterTourArrowUpDown">
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span>
                                        <ul class="filter-list tournament-filter-tour-list"
                                            id="currentTournamentPlayerSubCategory">
                                            <li class="filter-item current-tournament-filter-item-tour-list active">
                                                Sub Category
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-inner-box">
                                    <button type="submit" class="theme-btn tournament-filter-submit-btn">
                                        Search
                                    </button>
                                    <button type="reset" class="theme-btn resetButton">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if (count($current_tournaments) > 0)
                    <div class="table-outer result-table">
                        <table class="cart-table">
                            <thead class="cart-header result-cart-header">
                                <tr>
                                    <th>
                                        Tournament Name
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="tournamentName">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="tournamentName">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        Academy Name
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="name">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="name">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        Player Category
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="category">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="category">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        Sub Category
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="subCategory">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="subCategory">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        City
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="city">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="city">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        Tournament Stat Date
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="fromDate">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="fromDate">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        Last Date To Apply
                                        <div class="ascending-descending-box">
                                            <button type="button" class="ascendingOrderCurrent" data-sorting_type="asc"
                                                data-column_name="lastDate">
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="descendingOrderCurrent"
                                                data-sorting_type="desc" data-column_name="lastDate">
                                                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </th>
                                    <th>
                                        Factsheet
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="currentTournamentBody">
                                @include('partials.current_tournament_rows', [
                                    'current_tournaments' => $current_tournaments,
                                ])
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 paginator-box" id="currentPaginatorBox">
                        {{ $current_tournaments->withQueryString()->links('layoutTwo.paginator') }}
                    </div>

                    <input type="hidden" name="hidden_page" id="hidden_page_current" value="1">
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name_current"
                        value="tournament_id">
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type_current" value="asc">
                @else
                    <div class="col-xs-12 column">
                        <h1>No tournament available yet!</h1>
                    </div>
                @endif
            </div>
        </div>
        {{-- </div> --}}
    </section>
    {{-- current-tournament-table-end --}}

    {{-- result-table-start --}}
    <section class="cart-section portfolio-section custom-result-section click-tournament cart-section-3">
        <div class="container-fluid container-lg">
            <div class="row">

                <div class="col-12 mb-3">
                    <div class="search-title">
                        <p class="sec-title">Search Past Tournament</p>
                    </div>
                    <div class="academies-search-box">
                        <div class="player-search player-search-name">
                            <form method="get" name="pastTournamentSearchForm">
                                <div class="filter-box">
                                    <div class="filter-inner-box tournament-filter-year">
                                        <div class="past-tournament-filter-year-form">
                                            <input type="text" name="tournamentFilterYearInput"
                                                id="pastTournamentFilterYearInput" value="Year" readonly
                                                placeholder="Year">
                                            <span class="arrow-up-down" id="pastTournamentFilterYearArrowUpDown">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </span>
                                            <ul class="filter-list tournament-filter-year-list">
                                                <li class="filter-item past-tournament-filter-item-year-list active">
                                                    Year
                                                </li>
                                                @if (count($past_tournament_years) > 0)
                                                    @foreach ($past_tournament_years as $year)
                                                        <li class="filter-item past-tournament-filter-item-year-list">
                                                            {{ $year->year }}
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter-inner-box tournament-filter-month">
                                        <div class="past-tournament-filter-month-form">
                                            <input type="text" name="tournamentFilterMonthInput"
                                                id="pastTournamentFilterMonthInput" value="Months" readonly
                                                placeholder="Months">
                                            <span class="arrow-up-down" id="pastTournamentFilterMonthArrowUpDown">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </span>
                                            <ul class="filter-list tournament-filter-month-list">
                                                <li class="filter-item past-tournament-filter-item-month-list active">
                                                    Months
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    January
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    February
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    March
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    April
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    May
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    June
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    July
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    August
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    September
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    October
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    November
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-month-list">
                                                    December
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter-inner-box tournament-filter-city">
                                        <div class="past-tournament-filter-city-form">
                                            <input type="text" name="tournamentFilterCityInput"
                                                id="pastTournamentFilterCityInput" value="City" readonly
                                                placeholder="City" />
                                            <span class="arrow-up-down" id="pastTournamentFilterCityArrowUpDown">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </span>
                                            <ul class="filter-list tournament-filter-city-list">
                                                <li class="filter-item past-tournament-filter-item-city-list active">
                                                    City
                                                </li>
                                                @if (count($past_tournament_cities) > 0)
                                                    @foreach ($past_tournament_cities as $tournament)
                                                        <li class="filter-item past-tournament-filter-item-city-list">
                                                            {{ $tournament->city }}
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter-inner-box tournament-filter-category">
                                        <div class="past-tournament-filter-category-form">
                                            <input type="text" name="tournamentFilterCategoryInput"
                                                id="pastTournamentFilterCategoryInput" value="Player Category" readonly
                                                placeholder="Player Category" />
                                            <span class="arrow-up-down" id="pastTournamentFilterCategoryArrowUpDown">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </span>
                                            <ul class="filter-list tournament-filter-category-list">
                                                <li class="filter-item past-tournament-filter-item-category-list active">
                                                    Category
                                                </li>
                                                <li class="filter-item past-tournament-filter-item-category-list"
                                                    data-category="junior">Juniors</li>
                                                <li class="filter-item past-tournament-filter-item-category-list"
                                                    data-category="senior">Seniors</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter-inner-box tournament-filter-tour">
                                        <div class="past-tournament-filter-tour-form">
                                            <input type="text" name="tournamentFilterTourInput"
                                                id="pastTournamentFilterTourInput" value="Sub Category" readonly
                                                placeholder="Sub Category" />
                                            <span class="arrow-up-down" id="pastTournamentFilterTourArrowUpDown">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </span>
                                            <ul class="filter-list tournament-filter-tour-list"
                                                id="pastTournamentPlayerSubCategory">
                                                <li class="filter-item past-tournament-filter-item-tour-list active">
                                                    Sub Category
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter-inner-box">
                                        <button type="submit" class="theme-btn tournament-filter-submit-btn">
                                            Search
                                        </button>
                                        <button type="reset" class="theme-btn resetButton">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (count($past_tournaments) > 0)
                        <div class="table-outer result-table">
                            <table class="cart-table">
                                <thead class="cart-header result-cart-header">
                                    <tr>
                                        <th>
                                            Tournament Name
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="tournamentName">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="tournamentName">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Academy Name
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="name">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="name">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Player Category
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="category">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="category">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Sub Category
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="subCategory">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="subCategory">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            City
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="city">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="city">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Tournament Stat Date
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="fromDate">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="fromDate">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Last Date To Apply
                                            <div class="ascending-descending-box">
                                                <button type="button" class="ascendingOrderPast" data-sorting_type="asc"
                                                    data-column_name="lastDate">
                                                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="descendingOrderPast"
                                                    data-sorting_type="desc" data-column_name="lastDate">
                                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th>
                                            Factsheet
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="pastTournamentBody">
                                    @include('partials.past_tournaments_rows', [
                                        'past_tournaments' => $past_tournaments,
                                    ])
                                </tbody>
                            </table>
                        </div>

                </div>
                {{-- @if (count($past_tournaments) > 30) --}}
                <div class="mt-4 paginator-box" id="pastPaginatorBox">
                    {{ $past_tournaments->withQueryString()->links('layoutTwo.paginator') }}
                </div>
                {{-- @endif --}}

                <input type="hidden" name="hidden_page" id="hidden_page_past" value="1">
                <input type="hidden" name="hidden_column_name" id="hidden_column_name_past" value="tournament_id">
                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type_past" value="asc">
            @else
                <div class="col-xs-12 column">
                    <h1>No tournament available yet!</h1>
                </div>
                @endif
            </div>
        </div>
        {{-- </div> --}}
    </section>
    {{-- result-table-end --}}
@endsection

@section('script')
    <script>
        // for current tournamet
        document.addEventListener("DOMContentLoaded", function() {
            const currentTournamentPaginatorBox = document.getElementById("currentPaginatorBox");
            document.querySelector('form[name="currentTournamentSearchForm"]').addEventListener("submit", event => {
                event.preventDefault();
                document.getElementById('hidden_page_current').value = 1; // Reset to first page
                fetch_current_data();
            });

            document.querySelector('form[name="currentTournamentSearchForm"]').addEventListener(
                'reset',
                function() {
                    location.reload();
                }
            )


            document.querySelectorAll(".ascendingOrderCurrent, .descendingOrderCurrent").forEach(element => {
                element.addEventListener("click", function(event) {
                    event.preventDefault();
                    let sort_type = element.getAttribute("data-sorting_type");
                    let sort_by = element.getAttribute("data-column_name");
                    document.getElementById("hidden_column_name_current").value = sort_by ||
                        'tournament_id';
                    document.getElementById("hidden_sort_type_current").value = sort_type || 'asc';
                    fetch_current_data();
                });
            });

            currentTournamentPaginatorBox && currentTournamentPaginatorBox.addEventListener('click', function(e) {
                if (e.target.tagName === 'A') {
                    e.preventDefault();
                    var page = new URL(e.target.href).searchParams.get('page');
                    document.getElementById('hidden_page_current').value = page;
                    fetch_current_data();
                }
            });

            async function fetch_current_data() {
                var search = {
                    tournamentFilterYearInput: document.getElementById("currentTournamentFilterYearInput")
                        ?.value,
                    tournamentFilterMonthInput: document.getElementById("currentTournamentFilterMonthInput")
                        ?.value,
                    tournamentFilterCityInput: document.getElementById("currentTournamentFilterCityInput")
                        ?.value,
                    tournamentFilterCategoryInput: document.getElementById(
                        "currentTournamentFilterCategoryInput")?.value,
                    tournamentFilterTourInput: document.getElementById("currentTournamentFilterTourInput")
                        ?.value
                };
                var sort_by = document.getElementById("hidden_column_name_current").value;
                var sort_type = document.getElementById("hidden_sort_type_current").value;
                var page = document.getElementById("hidden_page_current").value;

                var queryParams = new URLSearchParams({
                    page: page,
                    sortby: sort_by,
                    sorttype: sort_type,
                    ...search
                });

                try {
                    let response = await fetch("{{ route('ascendingCurrentTournament') }}?" + queryParams
                        .toString(), {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                    if (!response.ok) {
                        throw new Error('Server error: ' + response.statusText);
                    }

                    let data = await response.json();
                    document.getElementById("currentTournamentBody").innerHTML = "";

                    if (data.tournaments.length > 0) {
                        data.tournaments.forEach(tournament => {
                            const viewHtml = `
                    <tr class="item">
                        <td><a href="${tournament.tournament_url}">${tournament.tournamentName}</a></td>
                        <td><a href="${tournament.academy_url}">${tournament.name}</a></td>
                        <td>${tournament.category}</td>
                        <td>${tournament.subCategory}</td>
                       <!-- <td>${tournament.surface}</td> -->
                        <td>${tournament.city}</td>
                       <!-- <td>${tournament.stay}</td>-->
                        <td>${new Date(tournament.fromDate).toLocaleDateString('en-GB')}</td>
                      <!--  <td>${tournament.toDate ? new Date(tournament.toDate).toLocaleDateString('en-GB') : ''}</td>-->
                        <td>${tournament.lastDate ? new Date(tournament.lastDate).toLocaleDateString('en-GB') : ''}</td>
                        <td>${tournament.factsheet ? `<a href="${tournament.factsheet}" target="_blank" class="theme-btn factsheet-btn">Factsheet</a>` : ''}</td>
                    </tr>
                `;
                            document.getElementById('currentTournamentBody').innerHTML += viewHtml;
                        });
                        currentTournamentPaginatorBox.innerHTML = data.pagination;
                    } else {
                        const showData = `<tr><td colspan='12'>No tournament found yet!</td></tr>`;
                        document.getElementById('currentTournamentBody').innerHTML = showData;
                        currentTournamentPaginatorBox.innerHTML = '';
                    }
                } catch (error) {
                    console.log("Request error: ", error);
                }
            }
        });
    </script>

    <script>
        // for recent tournamet
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('form[name="pastTournamentSearchForm"]').addEventListener("submit", event => {
                event.preventDefault();
                document.getElementById('hidden_page_past').value = 1; // Reset to first page
                fetch_past_data();
            });

            document.querySelector('form[name="pastTournamentSearchForm"]').addEventListener(
                'reset',
                function() {
                    location.reload();
                }
            )

            document.querySelectorAll(".ascendingOrderPast, .descendingOrderPast").forEach(element => {
                element.addEventListener("click", function(event) {
                    event.preventDefault();
                    let sort_type = element.getAttribute("data-sorting_type");
                    let sort_by = element.getAttribute("data-column_name");
                    document.getElementById("hidden_column_name_past").value = sort_by ||
                        'tournament_id';
                    document.getElementById("hidden_sort_type_past").value = sort_type || 'asc';
                    fetch_past_data();
                });
            });

            document.getElementById("pastPaginatorBox").addEventListener('click', function(e) {
                if (e.target.tagName === 'A') {
                    e.preventDefault();
                    var page = new URL(e.target.href).searchParams.get('page');
                    document.getElementById('hidden_page_past').value = page;
                    fetch_past_data();
                }
            });

            async function fetch_past_data() {
                var search = {
                    tournamentFilterYearInput: document.getElementById("pastTournamentFilterYearInput")
                        .value,
                    tournamentFilterMonthInput: document.getElementById("pastTournamentFilterMonthInput")
                        .value,
                    tournamentFilterCityInput: document.getElementById("pastTournamentFilterCityInput")
                        .value,
                    tournamentFilterCategoryInput: document.getElementById(
                        "pastTournamentFilterCategoryInput").value,
                    tournamentFilterTourInput: document.getElementById("pastTournamentFilterTourInput")
                        .value
                };
                var sort_by = document.getElementById("hidden_column_name_past").value;
                var sort_type = document.getElementById("hidden_sort_type_past").value;
                var page = document.getElementById("hidden_page_past").value;

                var queryParams = new URLSearchParams({
                    page: page,
                    sortby: sort_by,
                    sorttype: sort_type,
                    ...search
                });

                try {
                    let response = await fetch("{{ route('ascendingRecentTournament') }}?" + queryParams
                        .toString(), {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                    if (!response.ok) {
                        throw new Error('Server error: ' + response.statusText);
                    }

                    let data = await response.json();
                    document.getElementById("pastTournamentBody").innerHTML = "";

                    if (data.tournaments.length > 0) {
                        data.tournaments.forEach(tournament => {
                            const viewHtml = `
                        <tr class="item">
                            <td><a href="${tournament.tournament_url}">${tournament.tournamentName}</a></td>
                            <td><a href="${tournament.academy_url}">${tournament.name}</a></td>
                            <td>${tournament.category}</td>
                            <td>${tournament.subCategory}</td>
                           <!-- <td>${tournament.surface}</td> -->
                            <td>${tournament.city}</td>
                            <!-- <td>${tournament.stay}</td> -->
                            <td>${new Date(tournament.fromDate).toLocaleDateString('en-GB')}</td>
                          <!--  <td>${tournament.toDate ? new Date(tournament.toDate).toLocaleDateString('en-GB') : ''}</td> -->
                            <td>${tournament.lastDate ? new Date(tournament.lastDate).toLocaleDateString('en-GB') : ''}</td>
                            <td>${tournament.factsheet ? `<a href="${tournament.factsheet}" target="_blank" class="theme-btn factsheet-btn">Factsheet</a>` : ''}</td>
                        </tr>
                    `;
                            document.getElementById('pastTournamentBody').innerHTML += viewHtml;
                        });
                        document.getElementById("pastPaginatorBox").innerHTML = data.pagination;
                    } else {
                        const showData = `<tr><td colspan='12'>No tournament found yet!</td></tr>`;
                        document.getElementById('pastTournamentBody').innerHTML = showData;
                        document.getElementById("pastPaginatorBox").innerHTML = '';
                    }
                } catch (error) {
                    console.log("Request error: ", error);
                }
            }
        });
    </script>

    <script>
        // for upcoming tournaments
        document.addEventListener('DOMContentLoaded', function() {

            // const resetbutton = document.getElementById('resetButton')

            document.querySelector('form[name="tournamentSearchForm"]').addEventListener('submit', function(e) {
                e.preventDefault();
                document.getElementById('hidden_page').value = 1; // Reset to first page
                document.getElementById('searchitem').value = 1;
                fetch_data();
                // resetbutton.removeAttribute('none')


            });

            document.querySelector('form[name="tournamentSearchForm"]').addEventListener(
                'reset',
                function() {
                    location.reload();
                }
            )

            document.querySelectorAll('.ascendingOrder').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    var sort_by = this.getAttribute('data-column_name');
                    var order_type = this.getAttribute('data-sorting_type')
                    document.getElementById('hidden_column_name').value = sort_by;
                    document.getElementById('hidden_sort_type').value = order_type;
                    fetch_data();
                });
            });

            document.querySelectorAll('.descendingOrder').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    var sort_by = this.getAttribute('data-column_name');
                    var order_type = this.getAttribute('data-sorting_type')
                    document.getElementById('hidden_column_name').value = sort_by;
                    document.getElementById('hidden_sort_type').value = order_type;
                    fetch_data();
                });
            });

            document.getElementById("upcomingPaginatorBox").addEventListener('click', function(e) {
                if (e.target.tagName === 'A') {
                    console.log(e.target);
                    //prompt(e.target);
                    //if(document.getElementById('searchitem').value==1)
                    //{
                    e.preventDefault();
                    var page = new URL(e.target.href).searchParams.get('page');
                    document.getElementById('hidden_page').value = page;
                    fetch_data(); //}
                    // else{
                    //fetchcurrent();
                    //}
                }
            });


            async function fetch_data() {
                var search = {
                    tournamentFilterYearInput: document.getElementById("tournamentFilterYearInput").value,
                    tournamentFilterMonthInput: document.getElementById("tournamentFilterMonthInput").value,
                    tournamentFilterCityInput: document.getElementById("tournamentFilterCityInput").value,
                    tournamentFilterCategoryInput: document.getElementById("tournamentFilterCategoryInput")
                        .value,
                    tournamentFilterTourInput: document.getElementById("tournamentFilterTourInput").value
                };
                var sort_by = document.getElementById('hidden_column_name').value;
                var sort_type = document.getElementById('hidden_sort_type').value;
                var page = document.getElementById('hidden_page').value;
                console.log(sort_by);
                console.log(sort_type);
                console.log(page);
                // console.log("page is kajal", page);
                var queryParams = new URLSearchParams({
                    page: page,
                    sortby: sort_by,
                    sorttype: sort_type,
                    ...search
                });
                // console.log("Search Params:kajal", queryParams.toString());

                try {


                    let response = await fetch("{{ route('ascendingUpcomingTournament') }}?" + queryParams
                        .toString(), {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });


                    if (!response.ok) {
                        throw new Error('Server error: ' + response.statusText);
                    }

                    let data = await response.json();
                    // console.log("data is: ", data)
                    document.getElementById('upcomingTournamentBody').innerHTML = "";
                    if (data.tournaments.length > 0) {
                        data.tournaments.forEach(tournament => {
                            // console.log(tournament);
                            const viewHtml = `
                            <tr class="item">
                                <td>
                                    <a href="${tournament.tournament_url}">
                                        ${tournament.tournamentName}
                                    </a>
                                </td>
                                <td>
                                    <a href="${tournament.academy_url}">
                                        ${tournament.name}
                                    </a>
                                </td>
                                <td>${tournament.category}</td>
                                <td>${tournament.subCategory}</td>
                                <!--<td>${tournament.surface}</td>-->
                                <td>${tournament.city}</td>
                                <!--<td>${tournament.stay}</td>-->
                                <td>${new Date(tournament.fromDate).toLocaleDateString('en-GB')}</td>
                               <!--<td>${tournament.toDate ? new Date(tournament.toDate).toLocaleDateString('en-GB') : ''}</td>-->
                                <td>${tournament.lastDate ? new Date(tournament.lastDate).toLocaleDateString('en-GB') : ''}</td>
                                <td>
                                    ${tournament.factsheet ? `<a href="${tournament.factsheet}" target="_blank" class="theme-btn factsheet-btn">Factsheet</a>` : ''}
                                </td>
                                    <td>
                                        ${sessionStorage.getItem('id') && sessionStorage.getItem('role') ? `${sessionStorage.getItem('role') === 'Player' ? `
                                                <a href="${tournament.tournament_register}" class="theme-btn tournament-register-btn">Register</a>
                                            ` : `
                                                <a href="${tournament.login_url}" class="theme-btn tournament-register-btn">Register</a>
                                            `}` : `<a href="${tournament.login_url}" class="theme-btn tournament-register-btn">Register</a>`}
                                    </td>
                            </tr>
                        `;
                            document.getElementById('upcomingTournamentBody').innerHTML += viewHtml;
                        });
                        document.getElementById("upcomingPaginatorBox").innerHTML = data.pagination;
                    } else {
                        const showData = `<tr><td colspan='12'>No tournament found yet!</td></tr>`;
                        document.getElementById('upcomingTournamentBody').innerHTML = showData;
                        document.getElementById("upcomingPaginatorBox").innerHTML = '';
                    }

                } catch (error) {
                    console.error("Request error:", error);
                }
            }
        });
    </script>
@endsection
