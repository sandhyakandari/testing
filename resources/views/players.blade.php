@extends('layout.layout')

@section('title')
    Kheldhaara | Players
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url('{{ asset('assets/images/players_banner.jpg') }}');">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Players</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Players</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}


    {{-- player-grid-start --}}
    <section class="event-grid overlay-style-two sec-pad-2 custom-top-ranked-players player-page-section">
        <div class="container-fluid container-lg">
            <div class="last-update-date">
                <span>Last Updated: </span>
                <span>
                    @if ($date)
                        {{ date('d-m-Y', strtotime($date->date)) }}
                    @else
                        No update yet
                    @endif
                </span>
            </div>
            <div class="row">
                <div class="dropdown-box">
                    <form method="get" class="form-top-player" onsubmit="return false;" name="topPlayerFormSubmit">
                        <div class="search-by-name-aita">
                            <input type="search" name="name" placeholder="Search Name, Registration No., City, State"
                                id="playerNameSearch" class="form-control">
                            <span class="search-icon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <select class="dependent-dropdown" name="category" id="category">
                            <option value="">Select Category</option>
                        </select>
                        <select id="subCategory" name="subCategory" class="dependent-dropdown">
                            <option value="">Select Sub Category</option>
                        </select>
                        <button class="theme-btn select-category-btn">Search</button>
                        <button class="theme-btn select-category-btn" id="resetFilters">Reset</button>
                        {{-- <a href="{{ route('players') }}" class="theme-btn select-category-btn" id>Reset</a> --}}
                    </form>
                    <div class="form-top-player">
                        <span>
                            <a href="javascript:void(0)" class="top-10-players">Top 10</a>
                        </span>
                        <span>
                            <a href="javascript:void(0)" class="top-100-players">1-100</a>
                        </span>
                        <span>
                            <a href="{{ route('players') }}">100+</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($players) > 0)
                    {{-- dd($players); --}}
                    <div class="col-12 col-lg-9">
                        <div class="top-player-content">
                            <div class="row equal-height player-list" id="showPlayerData">
                                @if (count($players) > 0)
                                    @foreach ($players as $player)
                                        {{-- @php
                                dd($players);
                                @endphp --}}
                                        <div class="col-4 col-md-3 col-lg-2">
                                            <div class="single-cause-content inner-box player-info-box">
                                                <div class="single-upcoming-event single-item">
                                                    <div class="image img-box">
                                                        <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                            <figure>
                                                                <img src="{{ $player->photo }}"
                                                                    alt=" {{ $player->first_name }}
                                                            {{-- {{ $player->middle_name }} --}}
                                                            {{ $player->last_name }}">
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                            {{ $player->first_name }}
                                                            {{ $player->middle_name ?? '' }}
                                                            {{ $player->last_name }}
                                                        </a>
                                                    </div>
                                                    {{--  <p>{{ $player->rank }}</p>
                                                --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        <div class="mt-4 paginator-box" id="topPlayerPaginationBox">
                            {{ $players->withQueryString()->links('layoutTwo.paginator') }}
                        </div>
                        <div class="mt-4 paginator-box" id="search_resultpage">

                        </div>

                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="title">
                                <h3>No players available yet!</h3>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 col-lg-3">
                    <div class="rank-data">
                        <div class="section-title">
                            <p>Players Data</p>
                            <ul class="category-list">
                                @php
                                    $cat_boys = categoryChange('Boy');
                                    $cat_girl = categoryChange('Girl');
                                    $cat_senior = categoryChange('Senior');
                                    $sub_cat_men = categoryChange('Men');
                                    $sub_cat_wemen = categoryChange('Women');
                                    $sub_cat_slug_12 = subCategoryChange('Under 12');
                                    $sub_cat_slug_14 = subCategoryChange('Under 14');
                                    $sub_cat_slug_16 = subCategoryChange('Under 16');
                                    $sub_cat_slug_18 = subCategoryChange('Under 18');
                                @endphp
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_boys, 'sub_category' => $sub_cat_slug_12]) }}">
                                        Boy Under 12
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_girl, 'sub_category' => $sub_cat_slug_12]) }}">
                                        Girl Under 12
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_boys, 'sub_category' => $sub_cat_slug_14]) }}">
                                        Boy Under 14
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_girl, 'sub_category' => $sub_cat_slug_14]) }}">
                                        Girl Under 14
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_boys, 'sub_category' => $sub_cat_slug_16]) }}">
                                        Boy Under 16
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_girl, 'sub_category' => $sub_cat_slug_16]) }}">
                                        Girl Under 16
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_boys, 'sub_category' => $sub_cat_slug_18]) }}">
                                        Boy Under 18
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_girl, 'sub_category' => $sub_cat_slug_18]) }}">
                                        Girl Under 18
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_senior, 'sub_category' => $sub_cat_men]) }}">
                                        Senior Men
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('rank', ['category' => $cat_senior, 'sub_category' => $sub_cat_wemen]) }}">
                                        Senior Women
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- player-grid-end --}}
@endsection

@section('script')
    {{-- player search functionality with ajax --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector("form[name='topPlayerFormSubmit']").addEventListener("submit", event => {
                event.preventDefault()
                document.getElementById("topPlayerPaginationBox").style.display = 'none';
                document.getElementById("search_resultpage").style.display = 'block';
                document.getElementById("hidden_page").value = 1;
                console.log('indise form submit');
                // `<div id='search_resultpage'></div>`;
                fetchTopPlayer()
            })
            document.getElementById("resetFilters").addEventListener("click", () => {
                window.location = "{{ route('players') }}";
                document.getElementById("playerNameSearch").value = "";
                document.getElementById("category").value = "";
                document.getElementById("subCategory").value = "";
                document.getElementById("topPlayerPaginationBox").style.display = 'block';
                document.getElementById("search_resultpage").style.display = 'none';
                console.log(document.getElementById('topPlayerPaginationBox'));

                //fetchTopPlayer();
            })
            //23-07 test

            //document.getElementById("topPlayerPaginationBox").addEventListener("click", e => {
            document.getElementById("search_resultpage").addEventListener("click", e => {
                console.log('inside search resultpage');
                if (e.target.tagName === "A") {
                    e.preventDefault()
                    var page = new URL(e.target.href).searchParams.get('page');
                    console.log('this is page value', page);

                    document.getElementById("hidden_page").value = page;
                    fetchTopPlayer()
                }
            })


            async function fetchTopPlayer() {
                var search = {
                    name: document.getElementById("playerNameSearch").value,
                    category: document.getElementById("category").value,
                    subCategory: document.getElementById("subCategory").value
                };
                var page = document.getElementById("hidden_page").value;
                console.log(search, page, 'this is inside fetch top player');
                var queryParams = new URLSearchParams({
                    page: page,
                    ...search,
                });

                try {
                    let response = await fetch("{{ route('playerSearch') }}?" + queryParams.toString(), {
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
                    console.log(data)
                    document.getElementById("showPlayerData").innerHTML = "";

                    if (data.players.length > 0) {
                        data.players.forEach(player => {
                            const viewHtml = `
                            <div class="col-4 col-md-3 col-lg-2">
                                <div class="single-cause-content inner-box player-info-box">
                                    <div class="single-upcoming-event single-item">
                                        <div class="image img-box">
                                            <a href="${player.playerDetailUrl}">
                                                <figure>
                                                    <img src="${player.photo}"
                                                        alt="${player.first_name}
                                                    ${player.middle_name ? player.middle_name : ' '}
                                                    ${player.last_name}">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="">
                                            <a href="${player.playerDetailUrl}">
                                                ${player.first_name}
                                                    ${player.middle_name ? player.middle_name : ' '}
                                                    ${player.last_name}
                                                    
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            document.getElementById("showPlayerData").innerHTML += viewHtml;
                        })
                        // document.getElementById("topPlayerPaginationBox").innerHTML = data.pagination;
                        document.getElementById("search_resultpage").innerHTML = data.pagination;
                    } else {
                        document.getElementById("showPlayerData").innerHTML = `<h1>No Player Found Yet!</h1>`;
                        //document.getElementById("topPlayerPaginationBox").innerHTML = "";
                        document.getElementById("search_resultpage").innerHTML = "";
                    }
                } catch (error) {
                    console.log("Request error: ", error);
                }
            }
        })
    </script>
    {{-- top player functionality --}}
    <script>
        $(document).ready(function() {
            $('.top-10-players').click(function(e) {
                e.preventDefault();
                var category = $(this).text();
                // console.log(category)
                $.ajax({
                    type: "GET",
                    url: "{{ route('topTenPlayer') }}",
                    success: function(response) {
                        updatePlayerList(response.players, response.player_ranking, response
                            .result);
                        updatePagination();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('.top-100-players').click(function(e) {
                e.preventDefault();
                var category = $(this).text();
                // console.log(category)
                $.ajax({
                    type: "GET",
                    url: "{{ route('topHundredPlayers') }}",
                    success: function(response) {
                        updatePlayerList(response.players, response.player_ranking, response
                            .result);
                        updatePagination();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            function updatePagination() {
                $('.paginator-box').empty();
            }

            function updatePlayerList(players, player_ranking, result) {
                $('.player-list').empty();
                console.log(players);
                console.log('udate playerlist');
                var basePlayerDetailUrl = "{{ route('playerDetail', ['id' => '']) }}";
                if (players.length > 0) {
                    players.forEach(function(player) {
                        var playerId = player.player_id;
                        var playerDetailUrl = basePlayerDetailUrl + playerId;
                        let playermiddle = player.middle_name ? player.middle_name : '';
                        var playerHtml = '<div class="col-4 col-md-3 col-lg-3">' +
                            '<div class="single-cause-content inner-box player-info-box">' +
                            '<div class="single-upcoming-event single-item">' +

                            '<div class="image img-box">' +
                            '<a href="' + basePlayerDetailUrl + player.player_id + '">' +
                            '<figure>' +
                            '<img src="' + player.photo + '" alt="" />' +
                            '</figure>' +
                            '</a>' +
                            '</div>' +
                            '<div class="">' +
                            '<a href="' + basePlayerDetailUrl + player.player_id + '">' +
                            player.first_name + ' ' + playermiddle + ' ' + player.last_name +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        $('.player-list').append(playerHtml);
                    });
                } else {
                    console.log('inside elase');
                    document.getElementById("showPlayerData").innerHTML = ` <div class="row">
                        <div class="col-12">
                            <div class="title">
                                <h3>No players available yet!</h3>
                            </div>
                        </div>
                    </div>`;

                }
            }
        });
    </script>
@endsection
