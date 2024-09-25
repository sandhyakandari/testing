@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Registered-Player-List
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
                    <h1>Registered Player List</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Registered Player List</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- show-registered-player-list-section-start -->
    <section class="patient-dashboard bg-color-3 show-registered-player-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form name="fetchRegisteredPlayer" method="post" class="mb-3">
                                @csrf
                                <select name="tournament_id" id="tournamentCategory" class="form-control form-select-input">
                                    <option value="">Tournament Name</option>
                                    @if (count($tournaments) > 0)
                                        @foreach ($tournaments as $index => $tournament)
                                            <option value="{{ $tournament->tournament_id }}">
                                                {{ $tournament->tournamentName }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </form>
                            <div class="create-draw-box" id="create-draw-box">
                                <form action="{{ route('academy.drawPrepare') }}" class="create-draw-form"
                                    name="createDrawForTournament">
                                    <div class="for-tournament-name">
                                        <label>Tournament Name*</label>
                                        <input type="hidden" name="id" value="" />
                                        <p class="createDrawTournamentName">Tournament Name</p>
                                    </div>
                                    <div id="gender_dropdown">
                                    <select name="gender" class="form-control form-select-input create-draw-select"
                                        id="create-draw-select">
                                        <option value="">Player Type</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    </div>
                                    <div class="radio-group" id="radio-group">
                                    </div>
                                    <p class="error draw-type-error" id="drawTypeError"></p>
                                    <button type="submit" class="theme-btn-one submit-create-draw">Draw</button>
                                </form>
                            </div>
                            <h3 class="manual-registration-title">Registered Player List</h3>
                            <div class="register-player-data">
                                <ul class="player-data-heading">
                                    <li>S.No</li>
                                    <li>Name</li>
                                    <li>Rank</li>
                                    <li>Registration Number</li>
                                    <li>Gender</li>
                                    <li>Date Of Birth</li>
                                </ul>
                                @if (count($portal_registered_players) > 0)
                                    <div class="table-outer" id="playerRegisterData"
                                        data-portalRegisteredPlayer="{{ $portal_registered_players }}">
                                        @foreach ($portal_registered_players as $index => $register_player)
                                            <ul class="player-data-items">
                                                <li>{{ $index + 1 }}</li>
                                                <li>
                                                    {{ $register_player->first_name }}
                                                    {{ $register_player->middle_name }}
                                                    {{ $register_player->last_name }}
                                                </li>
                                                <li>{{ $register_player->rank }}</li>
                                                <li>{{ $register_player->ita_number }}</li>
                                                <li>{{ $register_player->gender }}</li>
                                                <li>{{ date('d-M-Y', strtotime($register_player->dob)) }}</li>
                                            </ul>
                                        @endforeach
                                    </div>
                                @endif
                                @if (count($manual_registered_player) > 0)
                                    <div class="table-outer manual-registered-player" id="manual-registered-player"
                                        data-manualRegisteredPlayer="{{ $manual_registered_player }}">
                                        @foreach ($manual_registered_player as $index => $register_player)
                                            <ul class="player-data-items">
                                                <li>{{ count($portal_registered_players) > 0 ? count($portal_registered_players) + $index + 1 : $index + 1 }}
                                                </li>
                                                <li>{{ $register_player->name }}</li>
                                                <li>{{ $register_player->rank }}</li>
                                                <li>{{ $register_player->aita_number }}</li>
                                                <li>{{ $register_player->gender }}</li>
                                                <li>{{ date('d-M-Y', strtotime($register_player->dob)) }}</li>
                                            </ul>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- show-registered-player-list-section-end -->
@endsection

@section('script')
    <script>
        const fetchRegisteredPlayerRoute = "{{ route('academy.fetchRegisteredPlayerDataOnTournament') }}";
    </script>
@endsection
