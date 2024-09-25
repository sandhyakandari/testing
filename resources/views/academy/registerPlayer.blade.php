@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Registered-Player
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
                    <h1>Registered Player</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Registered Player</li>
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
                            @if (count($register_players) > 0)
                                <div
                                    class="{{ count($register_players) == 1 ? 'one' : '' }} {{ count($register_players) == 2 ? 'two' : '' }} {{ count($register_players) == 3 ? 'three' : '' }} {{ count($register_players) == 4 ? 'four' : '' }} {{ count($register_players) == 5 ? 'five' : '' }} {{ count($register_players) == 6 ? 'six' : '' }} {{ count($register_players) == 7 ? 'seven' : '' }} {{ count($register_players) == 8 ? 'eight' : '' }} {{ count($register_players) == 9 ? 'nine' : '' }} {{ count($register_players) == 10 ? 'ten' : '' }} {{ count($register_players) == 11 ? 'eleven' : '' }} {{ count($register_players) == 12 ? 'twelve' : '' }} {{ count($register_players) == 13 ? 'thirteen' : '' }} {{ count($register_players) == 14 ? 'fourteen' : '' }} {{ count($register_players) == 15 ? 'fifteen' : '' }} {{ count($register_players) == 16 ? 'sixteen' : '' }}">
                                    <div class="table-outer">
                                        <table class="cart-table">
                                            <thead class="cart-header">
                                                <tr>
                                                    <th>Tournament Name</th>
                                                    <th>Name</th>
                                                    <th>Rank</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>City/ Town</th>
                                                    <th>Surface</th>
                                                    <th>Action</th>
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
                                                        <td>
                                                            <a
                                                                href="{{ route('playerDetail', ['id' => $register_player->player_id]) }}">
                                                                {{ $register_player->first_name }}
                                                                {{ $register_player->middle_name }}
                                                                {{ $register_player->last_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $register_player->rank }}</td>
                                                        <td>{{ $register_player->category }}</td>
                                                        <td>{{ $register_player->sub_category }}</td>
                                                        <td>{{ $register_player->city }}</td>
                                                        <td>{{ $register_player->surface }}</td>
                                                        <td>
                                                            @if ($register_player->status === 'unapprove')
                                                                <a href="{{ route('academy.approvedPlayer', ['id' => $register_player->register_id]) }}"
                                                                    class="toggle-btn">
                                                                    <input type="checkbox" name="approvedCheckbox"
                                                                        id="{{ $register_player->register_id }}">
                                                                    <label
                                                                        for="{{ $register_player->register_id }}"></label>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('academy.dissapprovePlayer', ['id' => $register_player->register_id]) }}"
                                                                    class="toggle-btn">
                                                                    <input type="checkbox" name="approvedCheckbox"
                                                                        id="{{ $register_player->register_id }}" checked>
                                                                    <label
                                                                        for="{{ $register_player->register_id }}"></label>
                                                                </a>
                                                                {{-- <button type="button" class="toggle-btn">
                                                                    <input type="checkbox" name="" id=""
                                                                        checked>
                                                                    <label for=""></label>
                                                                </button> --}}
                                                            @endif
                                                        </td>
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
    <!-- registered-player-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
