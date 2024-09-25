@extends('layout.layout')

@section('title')
    Kheldhaara | Player Detail
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/about_us_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">
                    {{ $player->first_name }}
                    {{ $player->middle_name }}
                    {{ $player->last_name }}
                </div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Player Detail</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}

    @php
        // $age = \Carbon\Carbon::parse($player->dob)
        //     ->diff(\Carbon\Carbon::now())
        //     ->format('%y years, %m months and %d days');
        $birthDate = new \DateTime($player->dob);
        $today = new \DateTime('today');
        $age = $birthDate->diff($today)->y;
        // dd($age);
        $gender = $player->gender;
        $playerId = $player->player_id;
    @endphp
    {{-- <p>Age: {{ $age }}</p>
<p>Gender: {{ $gender }}</p>
<p>idd: {{ $playerId }}</p> --}}

    {{-- player-detail-section start --}}
    <section class="event-details academy-detail-section player-detail-section">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="event-details-content">
                        <div class="content-style-one">
                            <figure class="img-box">
                                <img src="{{ $player->photo }}"
                                    alt="{{ $player->first_name }} {{ $player->middle_name }} {{ $player->last_name }}">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="player-info">
                        <div class="top-content academy-info">
                            <div class="sec-title academy-name">
                                {{ $player->first_name }} {{ $player->middle_name }} {{ $player->last_name }}
                            </div>
                            <ul class="info-box info-box-detail row equal-height">
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Points</b> 0
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Category</b>
                                        @if ($age <= 18)
                                            Juniors
                                        @elseif ($age > 18)
                                            Seniors
                                        @else
                                            Category not specified!
                                        @endif
                                    </div>
                                </li>
                                {{-- <p>{{ $age }}</p> --}}
                                @if ($ranking)
                                    @foreach ($ranking as $rank)
                                        <li class="col-md-4">
                                            <div class="col-info">
                                                <b>Sub Category</b> {{ $rank->sub_category }}
                                                <br>
                                                <b>Rank</b> {{ $rank->rank }}


                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>State</b> {{ $player->state }}
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Country</b> {{ $player->country }}
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Pin code</b> {{ $player->pin }}
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Total matches played</b> 0
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Win</b> {{ $win_count }}
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <div class="col-info">
                                        <b>Loss</b> 0
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="event-details-content academy-detail-content">
                        <div class="we-are-section we-are-academy-detail-section">
                            <div class="custom-tab-title custom-academy-detail-title">
                                <ul class="tab-title clearfix academy-detail-tab-title">
                                    <li data-tab-name="details" class="active">
                                        <div class="single-btn custom-single-btn">
                                            <div class="text">Overview</div>
                                        </div>
                                    </li>
                                    <li data-tab-name="review">
                                        <div class="single-btn custom-single-btn">
                                            <div class="text">Matches</div>
                                        </div>
                                    </li>
                                    <li data-tab-name="review1">
                                        <div class="single-btn  custom-single-btn">
                                            <div class="text">Activity</div>
                                        </div>
                                    </li>
                                    <li data-tab-name="gallery">
                                        <div class="single-btn  custom-single-btn">
                                            <div class="text">Gallery</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-details-content academy-details-content">
                                <div class="tab-content" id="details">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="content">
                                                    <div class="title">
                                                        <h3><strong>Personal Details</strong></h3>
                                                    </div>
                                                    <ul class="info-box info-box-detail row equal-height">
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Age:</b> {{ $age }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>District:</b> {{ $player->district }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>State:</b> {{ $player->state }}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="review">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="content">
                                                    <div class="title">
                                                        <h3><strong>Matches</strong></h3>
                                                    </div>
                                                    <div class="table-outer">
                                                        <table class="cart-table">
                                                            <thead class="cart-header">
                                                                <tr>
                                                                    <th>Year</th>
                                                                    <th>Total Matches</th>
                                                                    <th>Win/ Loss</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="item">
                                                                    <td>
                                                                        <a href="">
                                                                            2023
                                                                        </a>
                                                                    </td>
                                                                    <td>0</td>
                                                                    <td>0/0</td>
                                                                </tr>
                                                                <tr class="item">
                                                                    <td>
                                                                        <a href="">
                                                                            2022
                                                                        </a>
                                                                    </td>
                                                                    <td>0</td>
                                                                    <td>0/0</td>
                                                                </tr>
                                                                <tr class="item">
                                                                    <td>
                                                                        <a href="">
                                                                            2021
                                                                        </a>
                                                                    </td>
                                                                    <td>0</td>
                                                                    <td>0/0</td>
                                                                </tr>
                                                                <tr class="item">
                                                                    <td>
                                                                        <a href="">
                                                                            2020
                                                                        </a>
                                                                    </td>
                                                                    <td>0</td>
                                                                    <td>0/0</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="review1">
                                    <div class="news-section blog-grid blog-page overlay-style-one tournament-activity">
                                        @if (count($tournaments) > 0)
                                            <div class="row">
                                                @foreach ($tournaments as $tournament)
                                                    {{-- {{ dd($tournament->tournamentName) }} --}}
                                                    <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                                                        <div class="single-upcoming-event single-item">
                                                            <div class="image img-box">
                                                                <figure>
                                                                    <img src="{{ $tournament->imageOne }}"
                                                                        alt="{{ $tournament->tournamentName }}">
                                                                </figure>
                                                                <div class="overlay">
                                                                    <div class="overlay-content">
                                                                        <div class="content">
                                                                            <a class="link-btn"
                                                                                href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                                <i class="fa fa-link"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="date">
                                                                    <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                                                                    {{ date('M', strtotime($tournament->fromDate)) }}
                                                                </div>
                                                            </div>
                                                            <div class="lower-content">
                                                                <h4>
                                                                    <a
                                                                        href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                        {{ $tournament->tournamentName }}
                                                                    </a>
                                                                </h4>
                                                                <ul class="info-box">
                                                                    <li>
                                                                        <i class="fa fa-clock-o"></i>
                                                                        {{ date('d-m-Y', strtotime($tournament->fromDate)) }}
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa fa-map-marker"></i>
                                                                        {{ $tournament->city }}
                                                                    </li>
                                                                </ul>
                                                                <div class="link"><a
                                                                        href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}"
                                                                        class="theme-btn-two">
                                                                        Read More
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="title">
                                                        <h3>No Activity Found Yet!</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content" id="gallery">
                                    <div class="news-section blog-grid blog-page overlay-style-one">
                                        @if (count($player_imgs) > 0)
                                            <div class="row">
                                                @foreach ($player_imgs as $img)
                                                    <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                                                        <div class="single-news-content inner-box">
                                                            <figure class="image-box">
                                                                <img src="{{ $img->image }}" alt="">
                                                                <!--Overlay Box-->
                                                                <div class="overlay-box">
                                                                    <div class="overlay-inner">
                                                                        <div class="content">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </figure>
                                                            <div class="lower-content">
                                                                <p class="mb-0">
                                                                    {{ $img->caption }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="title">
                                                        <h3>No Image Found Yet!</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="related-event overlay-style-two recent-tournaments">
                                <div class="sec-title">Recent Played Tournaments</div>
                                @if (count($recent_tournaments) > 0)
                                    <div class="related-event-carousel">
                                        @foreach ($recent_tournaments as $tournament)
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <figure>
                                                        <img src="{{ $tournament->imageOne }}"
                                                            alt="{{ $tournament->tournamentName }}">
                                                    </figure>
                                                    <div class="overlay">
                                                        <div class="overlay-content">
                                                            <div class="content">
                                                                <a class="link-btn"
                                                                    href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                    <i class="fa fa-link"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="date">
                                                        <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                                                        {{ date('M', strtotime($tournament->fromDate)) }}
                                                    </div>
                                                </div>
                                                <div class="lower-content">
                                                    <h4>
                                                        <a
                                                            href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                            {{ $tournament->tournamentName }}
                                                        </a>
                                                    </h4>
                                                    <ul class="info-box">
                                                        <li>
                                                            <i class="fa fa-clock-o"></i>
                                                            {{ date('d-m-Y', strtotime($tournament->fromDate)) }}
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-map-marker"></i>
                                                            {{ $tournament->city }}
                                                        </li>
                                                    </ul>
                                                    <div class="link">
                                                        <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}"
                                                            class="theme-btn-two">
                                                            Read More
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="title">
                                                <h3>No recent tournaments found yet!</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    {{-- player-detail-section end --}}
@endsection

@section('script')
    <script></script>
@endsection
