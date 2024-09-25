@extends('layout.layout')

@section('title')
    Kheldhaara | Players
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/players_banner.jpg') }});">
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
                <span>Last Updated: </span> <span>10/03/2024</span>
            </div>
            @if (count($players) > 0)
                <div class="row">
                    <div class="dropdown-box">
                        <form action="{{ route('playerSearch') }}" method="POST" class="form-top-player">
                            @csrf
                            <div class="search-by-name-aita">
                                <input type="search" name="name" placeholder="Search Name or AITA No."
                                    id="playerNameSearch" class="form-control" value="{{ $name }}">
                                <span class="search-icon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <select class="dependent-dropdown" name="category" id="category">
                                <option value="">{{ $category }}</option>
                                {{-- <option value="Girl">Girl's</option>
                            <option value="Boy">Boy's</option>
                            <option value="Men">Men's</option>
                            <option value="Women">Women's</option> --}}
                            </select>
                            <select id="subCategory" name="subCategory" class="dependent-dropdown">
                                <option value="">{{ $subCategory }}</option>
                                {{-- <option value="Under 12">Under 12</option>
                            <option value="Under 14">Under 14</option>
                            <option value="Under 16">Under 16</option>
                            <option value="Under 18">Under 18</option> --}}
                            </select>
                            <button class="theme-btn select-category-btn">Search</button>
                        </form>
                        <div class="form-top-player">
                            {{-- <select name="" id="" class="dependent-dropdown">
                            <option value="">Select</option>
                            <option value="Top 10">Top 10</option>
                            <option value="11 - 100">11 - 100</option>
                            <option value="100+">100+</option>
                        </select> --}}
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
                <div class="top-player-content">
                    <div class="row equal-height player-list">
                        @foreach ($players as $player)
                            <div class="col-4 col-md-3 col-lg-2">
                                <div class="single-cause-content inner-box player-info-box">
                                    <div class="single-upcoming-event single-item">
                                        <div class="">
                                            <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                {{ $player->first_name }}
                                                {{ $player->middle_name }}
                                                {{ $player->last_name }}
                                            </a>
                                        </div>
                                        <div class="image img-box">
                                            <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                <figure>
                                                    <img src="{{ $player->photo }}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="lower-content">
                                            @foreach ($player_ranking as $player_rank)
                                                @if ($player_rank->ita_number == $player->ita_number)
                                                    @if (in_array($player->ita_number, $result))
                                                        <a
                                                            href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                            {{ $player_rank->rank }}
                                                        </a>
                                                    @else
                                                        <a></a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 paginator-box">
                    {{ $players->withQueryString()->links('layout.paginator') }}
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
        </div>
    </section>
    {{-- player-grid-end --}}
@endsection

@section('script')
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
        });

        function updatePlayerList(players, player_ranking, result) {
            $('.player-list').empty();

            var basePlayerDetailUrl = "{{ route('playerDetail', ['id' => '']) }}";

            players.forEach(function(player) {
                var playerId = player.player_id;
                var playerDetailUrl = basePlayerDetailUrl + playerId;

                var playerHtml = '<div class="col-4 col-md-3 col-lg-2">' +
                    '<div class="single-cause-content inner-box player-info-box">' +
                    '<div class="single-upcoming-event single-item">' +
                    '<div class="">' +
                    '<a href="' + basePlayerDetailUrl + player.player_id + '">' +
                    player.first_name + ' ' + player.middle_name + ' ' + player.last_name +
                    '</a>' +
                    '</div>' +
                    '<div class="image img-box">' +
                    '<a href="' + basePlayerDetailUrl + player.player_id + '">' +
                    '<figure>' +
                    '<img src="' + player.photo + '" alt="" />' +
                    '</figure>' +
                    '</a>' +
                    '</div>' +
                    '<div class="lower-content">';

                player_ranking.forEach(function(player_rank) {
                    if (player_rank.ita_number == player.ita_number) {
                        if (result.includes(player.ita_number)) {
                            playerHtml +=
                                '<a href="' + basePlayerDetailUrl + player.player_id + '">' +
                                player_rank.rank +
                                '</a>';
                        } else {
                            playerHtml += '<a></a>';
                        }
                    }
                });

                playerHtml += '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('.player-list').append(playerHtml);
            });
        }
    </script>
@endsection
