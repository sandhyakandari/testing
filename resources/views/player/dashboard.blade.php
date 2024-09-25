@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Player-Deshboard
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
                    <h1>Player Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Player Dashboard</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- player-dashboard -->
    <section class="patient-dashboard bg-color-3 player-dashboard-section">
        @include('layoutTwo.playerSidebar')
        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="feature-content">
                        <div class="row clearfix equal_height">
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>
                                            @if ($rank)
                                                {{ $rank->rank }}
                                            @else
                                                {{ null }}
                                            @endif
                                        </h5>
                                        <p>Player Ranking</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>0/ 0</h5>
                                        <p>Career Win/ Loss</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>{{ count($played_tournaments) }}</h5>
                                        <p>Played Tournaments</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 feature-block">
                                <div class="feature-block-two">
                                    <div class="inner-box">
                                        <h5>{{ $player_data->ita_number ? $player_data->ita_number : '' }}</h5>
                                        <p>Registration Number</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-grid academy-upload-images-blocks">
                        @if (count($images) > 0)
                            <div
                                class="row clearfix  {{ count($images) < 5 ? 'player_upload_bel_five' : '' }} {{ count($images) > 4 && count($images) < 9 ? 'player_5_9_images' : null }}">
                                @foreach ($images as $image)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 news-block">
                                        <div class="news-block-one wow fadeInUp animated animated mb-3"
                                            data-wow-delay="00ms" data-wow-duration="1500ms">
                                            <div class="inner-box mb-0">
                                                <figure class="image-box">
                                                    <img src="{{ $image->image }}" alt="">
                                                </figure>
                                                <a href="{{ route('player.playerDeleteImagesStore', ['id' => $image->upload_image_id, 'p_id' => $image->player_id]) }}"
                                                    class="trash-btn">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="lower-content">
                                                <p>{{ $image->caption }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <h1></h1>
                                    {{-- <h1>No Image Found</h1> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- <div class="doctors-appointment player-dashboard-tournament">
                        <div class="title-box">
                            <h3>Upcoming Tournaments</h3>
                        </div>
                        <div class="doctors-list">
                            @if (count($tournaments) > 0)
                                <div
                                    class="{{ count($tournaments) == 1 ? 'dash_one' : '' }} {{ count($tournaments) == 2 ? 'dash_two' : '' }} {{ count($tournaments) == 3 ? 'dash_three' : '' }} {{ count($tournaments) == 4 ? 'dash_four' : '' }} {{ count($tournaments) == 5 ? 'dash_five' : '' }} {{ count($tournaments) == 6 ? 'dash_six' : '' }} {{ count($tournaments) == 7 ? 'dash_seven' : '' }} {{ count($tournaments) == 8 ? 'dash_eight' : '' }}">
                                    <div class="table-outer">
                                        <table class="doctors-table player-tournament-table">
                                            <thead class="table-header">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Academy Name</th>
                                                    <th>City/ Town</th>
                                                    <th>Surface</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tournaments as $tournament)
                                                    <tr>
                                                        <td>
                                                            <p>{{ $tournament->tournamentName }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ date('d-m-Y', strtotime($tournament->fromDate)) }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->academy_name }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->city }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $tournament->surface }}</p>
                                                        </td>
                                                        <td>
                                                            @if (in_array($tournament->tournament_id, $is_registered))
                                                                <button type="button"
                                                                    class="theme-btn-one registered_player">Applied</button>
                                                            @else
                                                                <a href="{{ route('player.playerRegisterTournament', ['id' => $tournament->tournament_id]) }}"
                                                                    class="theme-btn-one register_player">Apply Here</a>
                                                            @endif
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
                                <div class="">
                                    <h1>No tournament found yet!</h1>
                                </div>
                            @endif
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- player-dashboard -->
@endsection

@section('script')
    <script></script>
@endsection
