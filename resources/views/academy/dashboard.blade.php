@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Academy-Deshboard
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
                    <h1>Academy Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Academy Dashboard</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- player-dashboard -->
    <section class="patient-dashboard bg-color-3 player-dashboard-section">
        @include('layoutTwo.academySidebar')
        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="feature-content">
                        <div class="row clearfix equal_height">
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>{{ $academy_data->no_of_court }}</h5>
                                        <p>Number Of Courts</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>{{ count($registered_players) }}</h5>
                                        <p>Register Player</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>{{ $upcoming_tournaments->where('status', 'done')->count() }}</h5>
                                        <p>Organized Tournaments</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>{{ $academy_data->aita_number }}</h5>
                                        <p>Registration Number</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="doctors-appointment player-dashboard-tournament">
                        <div class="title-box">
                            <h3>Upcoming Tournaments</h3>
                        </div>
                        <div class="doctors-list">
                            @if (count($upcoming_tournaments) > 0)
                                <div
                                    class="{{ count($upcoming_tournaments) == 1 ? 'aca_dash_one' : '' }} {{ count($upcoming_tournaments) == 2 ? 'aca_dash_two' : '' }} {{ count($upcoming_tournaments) == 3 ? 'aca_dash_three' : '' }} {{ count($upcoming_tournaments) == 4 ? 'aca_dash_four' : '' }} {{ count($upcoming_tournaments) == 5 ? 'aca_dash_five' : '' }} {{ count($upcoming_tournaments) == 6 ? 'aca_dash_six' : '' }} {{ count($upcoming_tournaments) == 7 ? 'aca_dash_seven' : '' }} {{ count($upcoming_tournaments) == 7 ? 'aca_dash_eight' : '' }} {{ count($upcoming_tournaments) == 7 ? 'aca_dash_nine' : '' }}">
                                    <div class="table-outer">
                                        <table class="doctors-table player-tournament-table">
                                            <thead class="table-header">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Category</th>
                                                    <th>Surface</th>
                                                    <th>No. Of Courts</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($upcoming_tournaments as $index => $tournament)
                                                    <tr>
                                                        <td>
                                                            <p>
                                                                <a
                                                                    href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                    {{ $tournament->tournamentName }}
                                                                </a>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ date('d-m-Y', strtotime($tournament->fromDate)) }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->category }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->surface }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->no_of_court }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->city }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3 paginator-box">
                                        {{ $upcoming_tournaments->withQueryString()->links('layout.paginator') }}
                                    </div>
                                </div>
                            @else
                                <h1 class="no_academy-dash">No tournament found yet!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- player-dashboard -->
@endsection

@section('script')
    <script></script>
@endsection
