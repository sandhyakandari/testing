@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Tournament
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
                    <h1>Tournament</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Tournament</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- current-upcoming-tournament-section-start -->
    <section class="patient-dashboard bg-color-3 registered-player-section recent-upcoming-tournament-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="row">
                        <div class="col-sm-12 recent-tour-col">
                            <h2>Current Tournaments</h2>
                            @if (count($current_tournaments) > 0)
                                <div class="table-outer">
                                    <table class="cart-table">
                                        <thead class="cart-header">
                                            <tr>
                                                <th>TOURNAMENT NAME</th>
                                                <th>CATEGORY</th>
                                                <th>CITY/ TOWN</th>
                                                <th>SURFACE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($current_tournaments as $index => $tournament)
                                                <tr class="item">
                                                    <td>
                                                        <a
                                                            href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                            {{ $tournament->tournamentName }}
                                                        </a>
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
                                                                id="tournamentImage" accept="image/*" required>
                                                            <label for="tournamentImage">Choose File</label>
                                                            <button type="submit" class="theme-btn-one">Submit</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3 paginator-box">
                                    {{ $current_tournaments->withQueryString()->links('layout.paginator') }}
                                </div>
                            @else
                                <h1 class="no_current_tour" style="margin-bottom: 990px;">No tournament found yet!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- current-upcoming-tournament-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
