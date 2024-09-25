@extends('layout.layout')

@section('title')
    Kheldhaara | Tournament Detail
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/about_us_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">{{ $tournament->tournamentName }}</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Tournament Detail</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}

    {{-- tournament-detail-section start --}}
    <section class="event-details academy-detail-section">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="event-details-content academy-detail-content">
                        <div class="content-style-one">
                            <figure class="img-box">
                                <img src="{{ $tournament->imageOne }}" alt="{{ $tournament->tournamentName }}">
                                <div class="date">
                                    <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                                    {{ date('M', strtotime($tournament->fromDate)) }}
                                </div>
                            </figure>
                            <div class="top-content academy-info">
                                <div class="sec-title academy-name">
                                    {{ $tournament->tournamentName }}
                                </div>
                                <ul class="info-box">
                                    <li>
                                        <i class="fa fa-clock-o"></i>
                                        {{ date('d-m-Y', strtotime($tournament->fromDate)) }}
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        {{ $tournament->city }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="we-are-section we-are-academy-detail-section">
                            <div class="custom-tab-title custom-academy-detail-title">
                                <ul class="tab-title clearfix academy-detail-tab-title">
                                    <li data-tab-name="details" class="active">
                                        <div class="single-btn custom-single-btn">
                                            <div class="text">Tournament</div>
                                        </div>
                                    </li>
                                    @if (Session()->has('id'))
                                        <li data-tab-name="totalEntries">
                                            <div class="single-btn custom-single-btn">
                                                <div class="text">Total Entries</div>
                                            </div>
                                        </li>
                                        <li data-tab-name="tournamentResult">
                                            <div class="single-btn custom-single-btn">
                                                <div class="text">Result</div>
                                            </div>
                                        </li>
                                        <li data-tab-name="tournamentDraw" class="checkIsDrawCreated"
                                            data-tournament_id="{{ $tournament->tournament_id }}"
                                            data-tournament_sub_category="{{ $tournament->subCategory }}">
                                            <div class="single-btn custom-single-btn">
                                                <div class="text">Draw</div>
                                            </div>
                                        </li>
                                    @endif

                                    <li data-tab-name="review">
                                        <div class="single-btn custom-single-btn">
                                            <div class="text">Gallery</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-details-content academy-details-content">
                                {{-- tournament-partials-start --}}
                                <div class="tab-content" id="details">
                                    @include('partials.tournament_detail_tournament_details_partials', [
                                        'tournament' => $tournament,
                                    ])
                                </div>
                                {{-- tournament-partials-end --}}
                                @if (Session()->has('id'))
                                    {{-- total-entries-partials-start --}}
                                    <div class="tab-content" id="totalEntries">
                                        @include('partials.tournament_detail_entries_partials', [
                                            'get_entries' => $get_entries,
                                        ])
                                    </div>
                                    {{-- total-entries-partials-end --}}
                                    {{-- result-partial-start --}}
                                    <div class="tab-content" id="tournamentResult">
                                        @include('partials.tournament_detail_draw_result_partials')
                                    </div>
                                    {{-- result-partial-end --}}
                                    {{-- draw-partial-start --}}
                                    <div class="tab-content" id="tournamentDraw">
                                        @include('partials.tournament_detail_draw_partials')
                                    </div>
                                    {{-- draw-partial-end --}}
                                @endif
                                {{-- gallery-partials-start --}}
                                <div class="tab-content" id="review">
                                    @include('partials.tournament_detail_gallery_partials', [
                                        'tournament' => $tournament,
                                    ])
                                </div>
                                {{-- gallery-partials-end --}}
                            </div>
                        </div>
                        <div class="related-event overlay-style-two recent-tournaments">
                            @include('partials.tournament_detail_upcoming_tournament_partials', [
                                'upcoming_tournaments' => $upcoming_tournaments,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- tournament-detail-section end --}}
@endsection

@section('script')
    <script>
        const hasDrawRouteElm = "{{ route('hasDraw') }}"
        const checkTypeOfDrawRoute = "{{ route('checkTypeOfDraw') }}"
        const fetchDrawDataRoute = "{{ route('fetchDrawData') }}"
    </script>
@endsection
