@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Manual-sRegistered-Player
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
                    <h1>Manual Registered Player</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Manual Registered Player</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- registered-player-list-section-start -->
    <section class="patient-dashboard bg-color-3 registered-player-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="text-right">
                                <a href="{{ route('academy.academyPlayerRegistration') }}" class="theme-btn-one">
                                    Registration
                                </a>
                            </div> --}}
                            <h3 class="manual-registration-title">Manual Registered Player</h3>
                            @if (count($register_players) > 0)
                                <div
                                    class="{{ count($register_players) == 1 ? 'one' : '' }} {{ count($register_players) == 2 ? 'two' : '' }} {{ count($register_players) == 3 ? 'three' : '' }} {{ count($register_players) == 4 ? 'four' : '' }} {{ count($register_players) == 5 ? 'five' : '' }} {{ count($register_players) == 6 ? 'six' : '' }} {{ count($register_players) == 7 ? 'seven' : '' }} {{ count($register_players) == 8 ? 'eight' : '' }} {{ count($register_players) == 9 ? 'nine' : '' }} {{ count($register_players) == 10 ? 'ten' : '' }} {{ count($register_players) == 11 ? 'eleven' : '' }} {{ count($register_players) == 12 ? 'twelve' : '' }} {{ count($register_players) == 13 ? 'thirteen' : '' }} {{ count($register_players) == 14 ? 'fourteen' : '' }} {{ count($register_players) == 15 ? 'fifteen' : '' }} {{ count($register_players) == 16 ? 'sixteen' : '' }}">
                                    <div class="table-outer">
                                        <table class="cart-table">
                                            <thead class="cart-header">
                                                <tr>
                                                    <th>Tournament Name</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Registration Number</th>
                                                    <th>Rank</th>
                                                    <th>State</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($register_players as $register_player)
                                                    <tr class="item">
                                                        <td>
                                                            <a
                                                                href="{{ route('tournamentDetail', ['id' => $register_player->tournament_id]) }}">
                                                                {{ $register_player->tournamentName }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $register_player->name }}</td>
                                                        <td>{{ $register_player->gender }}</td>
                                                        <td>{{ date('d-M-Y', strtotime($register_player->dob)) }}</td>
                                                        <td>{{ $register_player->aita_number }}</td>
                                                        <td>{{ $register_player->rank }}</td>
                                                        <td>{{ $register_player->state }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3 paginator-box">
                                        {{ $register_players->withQueryString()->links('layout.paginator') }}
                                    </div>
                                </div>
                            @else
                                <h1 class="no_register_player">No player register with us!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- registered-player-list-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
