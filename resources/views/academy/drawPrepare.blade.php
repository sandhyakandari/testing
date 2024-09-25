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
                            <h3 class="manual-registration-title">
                                Registered Player: {{ $drawGender }},
                                {{ $subCategory }}
                            </h3>
                            @if ($errors->any())
                                <div class="card">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <p class="manual-registration-title">{{ $tournament->tournamentName }}</p>
                            <form action="{{ route('academy.drawCreate') }}" method="post" name="finalDrawPrepareForm">
                                @csrf
                                <input type="hidden" name="subCategory" value="{{ $subCategory }}">
                                <input type="hidden" name="tournament_id" value="{{ $tournament->tournament_id }}">
                                <div class="main-qualify-radio-group mb-2">
                                    <div class="radio-group-senior">
                                        <input type="radio" name="drawType" class="draw-type-main-qualify" id="main"
                                            value="Main">
                                        <label class="theme-btn-one" for="main">Main</label>
                                    </div>
                                    <div class="radio-group-senior">
                                        <input type="radio" name="drawType" class="draw-type-main-qualify" id="qualify"
                                            value="Qualify">
                                        <label class="theme-btn-one" for="qualify">Qualify</label>
                                    </div>
                                    <p class="error draw-type-error mb-2" id="drawTypeError"></p>
                                </div>
                                <div class="main-qualify-draw-type mb-2">
                                    <div class="radio-group-senior">
                                        <input type="radio" name="playerNum" class="playerNumMainQualify" id="fourPlayers"
                                            value="4 Players">
                                        <label class="theme-btn-one" for="fourPlayers">4 Players</label>
                                    </div>
                                    <div class="radio-group-senior">
                                        <input type="radio" name="playerNum" class="playerNumMainQualify"
                                            id="eightPlayers" value="8 Players">
                                        <label class="theme-btn-one" for="eightPlayers">8 Players</label>
                                    </div>
                                    <div class="radio-group-senior">
                                        <input type="radio" name="playerNum" class="playerNumMainQualify"
                                            id="sixteenPlayers" value="16 Players">
                                        <label class="theme-btn-one" for="sixteenPlayers">16 Players</label>
                                    </div>
                                    <div class="radio-group-senior">
                                        <input type="radio" name="playerNum" class="playerNumMainQualify"
                                            id="thirtyTwoPlayers" value="32 Players">
                                        <label class="theme-btn-one" for="thirtyTwoPlayers">32 Players</label>
                                    </div>
                                    <div class="radio-group-senior">
                                        <input type="radio" name="playerNum" class="playerNumMainQualify"
                                            id="sixtyFourPlayers" value="64 Players">
                                        <label class="theme-btn-one" for="sixtyFourPlayers">64 Players</label>
                                    </div>
                                    <p class="error draw-type-error mb-2" id="numberOfPlayerError"></p>
                                </div>
                                <button type="submit"
                                    class="theme-btn-one submit-create-draw main-qualify-create-draw-btn">
                                    Draw
                                </button>
                                <p class="error draw-type-error mb-0" id="isPlayerCheckboxError"></p>
                                <button type="button" class="check-all mt-3">
                                    <input type="checkbox" name="" class="not-checked" id="checkall">
                                    <label for="checkall">Check All</label>
                                </button>
                                <div class="register-player-data mt-1">
                                    <ul class="player-data-heading draw-prepare-data-heading">
                                        <li>Select</li>
                                        <li>S.No</li>
                                        <li>Name</li>
                                        <li>Rank</li>
                                        <li>Registration Number</li>
                                        <li>Gender</li>
                                        <li>Date Of Birth</li>
                                    </ul>
                                    @if (count($players) > 0)
                                        <div class="table-outer" id="">
                                            @foreach ($players as $index => $player)
                                                <ul class="player-data-items draw-prepare-data-items">
                                                    <li>
                                                        <input type="checkbox" name="checkbox_p_{{ $player->player_id }}"
                                                            id="checkbox-p_{{ $player->player_id }}"
                                                            class="isPlayerCheckbox" value="p_{{ $player->player_id }}">
                                                    </li>
                                                    <li>{{ $index + 1 }}</li>
                                                    <li>
                                                        {{ $player->first_name }}
                                                        {{ $player->middle_name }}
                                                        {{ $player->last_name }}
                                                    </li>
                                                    <li>{{ $player->rank }}</li>
                                                    <li>{{ $player->ita_number }}</li>
                                                    <li>
                                                        <input type="hidden" name="gender[]"
                                                            value="{{ $player->gender }}">
                                                        {{ $player->gender }}
                                                    </li>
                                                    <li>{{ date('d-M-Y', strtotime($player->dob)) }}</li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($manual_registered_players) > 0)
                                        <div class="table-outer" id="">
                                            @foreach ($manual_registered_players as $index => $player)
                                                <ul class="player-data-items draw-prepare-data-items">
                                                    <li>
                                                        <input type="checkbox"
                                                            name="checkbox_m_{{ $player->manual_register_id }}"
                                                            id="checkbox-m_{{ $player->manual_register_id }}"
                                                            class="isPlayerCheckbox"
                                                            value="m_{{ $player->manual_register_id }}">
                                                    </li>
                                                    <li>{{ count($players) > 0 ? count($players) + $index + 1 : $index + 1 }}
                                                    </li>
                                                    <li>{{ $player->name }}</li>
                                                    <li>{{ $player->rank }}</li>
                                                    <li>{{ $player->aita_number }}</li>
                                                    <li>
                                                        <input type="hidden" name="gender[]"
                                                            value="{{ $player->gender }}">
                                                        {{ $player->gender }}
                                                    </li>
                                                    <li>{{ date('d-M-Y', strtotime($player->dob)) }}</li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if(!$msg && count($manual_registered_players)==0 && count($players)==0)
                                      <h3>No player avilable in this category</h3>
                                      @endif
                                    @if($msg)
                                    <h3>{{$msg}}</h3>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- show-registered-player-list-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
