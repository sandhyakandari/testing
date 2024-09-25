@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Recent-Tournament
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
                    <h1>Recent Tournament</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Recent Tournament</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- registered-player-section-start -->
    <section class="patient-dashboard bg-color-3 registered-player-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="row">
                        <div class="col-sm-12">
                            @if (count($tournaments) > 0)
                                <div
                                    class="{{ count($tournaments) == 1 ? 'one' : '' }} {{ count($tournaments) == 2 ? 'two' : '' }} {{ count($tournaments) == 3 ? 'three' : '' }} {{ count($tournaments) == 4 ? 'four' : '' }} {{ count($tournaments) == 5 ? 'five' : '' }} {{ count($tournaments) == 6 ? 'six' : '' }} {{ count($tournaments) == 7 ? 'seven' : '' }} {{ count($tournaments) == 8 ? 'eight' : '' }} {{ count($tournaments) == 9 ? 'nine' : '' }} {{ count($tournaments) == 10 ? 'ten' : '' }} {{ count($tournaments) == 11 ? 'eleven' : '' }} {{ count($tournaments) == 12 ? 'twelve' : '' }} {{ count($tournaments) == 13 ? 'thirteen' : '' }} {{ count($tournaments) == 14 ? 'fourteen' : '' }} {{ count($tournaments) == 15 ? 'fifteen' : '' }} {{ count($tournaments) == 16 ? 'sixteen' : '' }}">
                                    <div class="table-outer">
                                        <table class="cart-table">
                                            <thead class="cart-header">
                                                <tr>
                                                    <th>TOURNAMENT NAME</th>
                                                    <th>WINNER</th>
                                                    <th>RUNNER UP</th>
                                                    <th>CATEGORY</th>
                                                    <th>CITY/ TOWN</th>
                                                    <th>SURFACE</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tournaments as $index => $tournament)
                                                    <tr class="item">
                                                        <td>
                                                            <a
                                                                href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                {{ $tournament->tournamentName }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{ $tournament->winner_first_name }}
                                                            {{ $tournament->winner_middle_name }}
                                                            {{ $tournament->winner_last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $tournament->runner_up_first_name }}
                                                            {{ $tournament->runner_up_middle_name }}
                                                            {{ $tournament->runner_up_last_name }}
                                                        </td>
                                                        <td>{{ $tournament->category }}</td>
                                                        <td>{{ $tournament->city }}</td>
                                                        <td>{{ $tournament->surface }}</td>
                                                        <td>
                                                            <form
                                                                action="{{ route('academy.storeTournamentImage', ['id' => $tournament->tournament_id]) }}"
                                                                class="tournamentImageForm" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="file" name="tournamentImage"
                                                                id="tournamentImage{{$index}}" accept="image/*" required>
                                                                <label for="tournamentImage{{$index}}">Choose File</label>
                                                                <button type="submit" class="theme-btn-one">Submit</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3 paginator-box">
                                        {{ $tournaments->withQueryString()->links('layout.paginator') }}
                                    </div>
                                </div>
                            @else
                                <h1 class="no_recent_tour">No tournament found yet!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- registered-player-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
