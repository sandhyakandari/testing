@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Tournament-History
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
                    <h1>Tournament History</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Tournament History</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- player-tournament-history-section-start -->
    <section class="patient-dashboard bg-color-3 player-tournament-history-section">
        @include('layoutTwo.playerSidebar')
        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="clinic-section">
                        <div class="row clearfix">
                            <div class="col-sm-12 content-side">
                                <div class="wrapper list">
                                    @if (count($applied_tournaments) > 0)
                                        <div
                                            class="{{ count($applied_tournaments) == 1 ? 'h_one' : null }} {{ count($applied_tournaments) == 2 ? 'h_two' : null }} {{ count($applied_tournaments) == 3 ? 'h_three' : null }} {{ count($applied_tournaments) == 4 ? 'h_four' : null }}">
                                            <div class="clinic-list-content list-item">
                                                @foreach ($applied_tournaments as $tournament)
                                                    <div class="clinic-block-one">
                                                        <div class="inner-box">
                                                            <div class="pattern">
                                                                <div class="pattern-1"
                                                                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-24.png') }});">
                                                                </div>
                                                                <div class="pattern-2"
                                                                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-25.png') }});">
                                                                </div>
                                                            </div>
                                                            <figure class="image-box">
                                                                <img src="{{ asset('assets/layoutTwo/images/history.jpg') }}"
                                                                    alt="">
                                                            </figure>
                                                            <div class="content-box">
                                                                <div class="like-box">
                                                                    <a href="{{ route('tournamentDetail',['id'=>$tournament->tournament_id]) }}">
                                                                        <i class="far fa-heart"></i>
                                                                    </a>
                                                                </div>
                                                                <ul class="name-box clearfix">
                                                                    <li class="name">
                                                                        <h3>
                                                                            <a href="{{ route('tournamentDetail',['id'=>$tournament->tournament_id]) }}">
                                                                                {{ $tournament->tournamentName }}
                                                                            </a>
                                                                        </h3>
                                                                    </li>
                                                                    <li><i class="icon-Trust-1"></i></li>
                                                                    <li><i class="icon-Trust-2"></i></li>
                                                                </ul>
                                                                <div class="text">
                                                                    <p>
                                                                    {{$tournament->subCategory}} ,
                                                                       {{$tournament->category}}
                                                                      
                                                                    </p>
                                                                </div>
                                                                <ul class="winner-runner-up">
                                                                    <li>
                                                                        <b>Winner:</b> {{ $tournament->winner_first_name }}
                                                                        {{ $tournament->winner_middle_name }}
                                                                        {{ $tournament->winner_last_name }}
                                                                    </li>
                                                                    <li>
                                                                        <b>Runner up:</b>
                                                                        {{ $tournament->runner_up_first_name }}
                                                                        {{ $tournament->runner_up_middle_name }}
                                                                        {{ $tournament->runner_up_last_name }}
                                                                    </li>
                                                                </ul>
                                                                <div class="location-box">
                                                                    <p><i class="fas fa-map-marker-alt"></i>
                                                                        {{ $tournament->city }}
                                                                    </p>
                                                                </div>
                                                                <div class="btn-box">
                                                                    <a href="{{ route('tournamentDetail',['id'=>$tournament->tournament_id]) }}">
                                                                        Visit Now
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="mt-3 paginator-box">
                                                {{ $applied_tournaments->withQueryString()->links('layout.paginator') }}
                                            </div>
                                        </div>
                                    @else
                                        <h1 class="no_tournament_history">No tournament found yet!</h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- player-tournament-history-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
