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
                    <h1>Players For Draw</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Players For Draw</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- show-registered-player-list-section-start -->
    <section class="patient-dashboard bg-color-3 show-registered-player-section">
        @include('layoutTwo.academySidebar')
        {{-- get stored data on the session-start --}}
        @php
            $getSessionData = Session::all();
            $getSessionData = $getSessionData['result'];
            // dd($getSessionData);
        @endphp
        {{-- get stored data on the session-end --}}
        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="manual-registration-title">
                                Players list for draw:
                            </h3>
                            @if (count($raw_data) > 0)
                                <h5 class="draw-academy-info">
                                    {{ $raw_data[0]['academy_name'] }} |
                                    {{ $raw_data[0]['category'] }} {{ $raw_data[0]['subCategory'] }}
                                </h5>
                                <p>
                                    {{ $raw_data[0]['tournamentName'] }}
                                </p>
                                <p>
                                    {{ $raw_data[0]['gender'] }} Singles {{ $raw_data[0]['player_num'] }}
                                    {{ $raw_data[0]['draw_type'] }} Draw With {{ count($raw_data) }} Players
                                </p>
                                <form action="{{ route('academy.storeDraw') }}" method="post">
                                    @csrf
                                    <div class="register-player-data mt-1 dragArea">
                                        <ul class="player-data-heading draw-prepare-data-heading">
                                            <li>Rank</li>
                                            <li>Seed</li>
                                            <li>By</li>
                                            <li>Name</li>
                                            <li>Registration Number</li>
                                            <li>Gender</li>
                                            <li>Date Of Birth</li>
                                        </ul>
                                        @foreach ($raw_data as $index => $data)
                                            <ul class="player-data-items draw-prepare-data-items dragItem"
                                                data-letter="{{ $data['interim_draw_players_tournament_id'] }}"
                                                draggable="true">
                                                <li>
                                                    <input type="hidden" name="interim_draw_id[]"
                                                        value="{{ $data['interim_draw_id'] }}">
                                                    {{ $data['rank'] }}
                                                </li>
                                                <li>
                                                    <input type="number" name="seed[]"
                                                        id="seed_{{ $data['interim_draw_players_tournament_id'] }}"
                                                        class="draw-number-input">
                                                </li>
                                                <li>
                                                    <input type="checkbox" name=""
                                                        id="by_{{ $data['interim_draw_players_tournament_id'] }}"
                                                        class="by-checkbox" value="no">
                                                    <input type="hidden" name="by[]" value="no">
                                                </li>
                                                <li>
                                                    <input type="hidden" name="player_id[]"
                                                        value="{{ $data['player_id'] }}">
                                                    <input type="hidden" name="player_num[]"
                                                        value="{{ $data['player_num'] }}">
                                                    {{ $data['player_name'] }}
                                                </li>
                                                <li>
                                                    <input type="hidden" name="tournament_id[]"
                                                        value="{{ $data['tournament_id'] }}">
                                                    {{ $data['aita_number'] }}
                                                </li>
                                                <li>
                                                    <input type="hidden" name="interim_draw_players_tournament_id[]"
                                                        value="{{ $data['interim_draw_players_tournament_id'] }}">
                                                    {{ $data['gender'] }}
                                                </li>
                                                <li>{{ date('d-M-Y', strtotime($data['dob'])) }}</li>
                                            </ul>
                                        @endforeach
                                    </div>
                                    <div class="create-draw-btn-box mt-3">
                                        <button type="submit" class="theme-btn-one">
                                            Create Draw
                                        </button>
                                    </div>
                                </form>
                            @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('popstate', async (event) => {
                try {
                    let response = await fetch("{{ route('academy.resultSessionExpire') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({})
                    });
                    debugger;
                    if (!response.ok) {
                        throw new Error('Server error: ' + response.statusText);
                    }

                    let data = await response.json();
                    console.log('Session data cleared:', data.message);
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        })
    </script>
@endsection
