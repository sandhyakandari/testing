@extends('layout.layout')

@section('title')
    Kheldhaara | Academy Detail
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/about_us_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">{{ $academy->name }}</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Academy Detail</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}

    {{-- academy-detail-section start --}}
    <section class="event-details academy-detail-section">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="event-details-content academy-detail-content">
                        <div class="content-style-one">
                            <figure class="img-box">
                                <img src="{{ $academy->photo }}" alt="{{ $academy->name }}">
                            </figure>
                            <div class="top-content academy-info">
                                <div class="sec-title academy-name">{{ $academy->name }}</div>
                                <ul class="info-box">
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        {{ $academy->city }}, {{ $academy->state }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="we-are-section we-are-academy-detail-section">
                            <div class="custom-tab-title custom-academy-detail-title">
                                <ul class="tab-title clearfix academy-detail-tab-title">
                                    <li data-tab-name="details" class="active">
                                        <div class="single-btn custom-single-btn">
                                            <div class="text">About Us</div>
                                        </div>
                                    </li>
                                    <li data-tab-name="facilities">
                                        <div class="single-btn  custom-single-btn">
                                            <div class="text">Facilities</div>
                                        </div>
                                    </li>
                                    @if ($academy->our_team)
                                        <li data-tab-name="ourTeam">
                                            <div class="single-btn  custom-single-btn">
                                                <div class="text">Our Team</div>
                                            </div>
                                        </li>
                                    @endif
                                    @if ($academy->training_programmes)
                                        <li data-tab-name="trainingProgrammes">
                                            <div class="single-btn  custom-single-btn">
                                                <div class="text">Training Programmes</div>
                                            </div>
                                        </li>
                                    @endif
                                    @if ($academy->our_achievements)
                                        <li data-tab-name="ourAchievements">
                                            <div class="single-btn  custom-single-btn">
                                                <div class="text">Our Achievements</div>
                                            </div>
                                        </li>
                                    @endif
                                    @if (count($recent_tournaments) > 0)
                                        <li data-tab-name="recentTournaments">
                                            <div class="single-btn  custom-single-btn">
                                                <div class="text">Recent Tournaments</div>
                                            </div>
                                        </li>
                                    @endif
                                    <li data-tab-name="review1">
                                        <div class="single-btn  custom-single-btn">
                                            <div class="text">Gallery</div>
                                        </div>
                                    </li>
                                    <li data-tab-name="contact">
                                        <div class="single-btn custom-single-btn">
                                            <div class="text">Contact</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-details-content academy-details-content">
                                <div class="tab-content" id="details">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            @if ($academy->aboutAcademy)
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="content">
                                                        {{-- <div class="title">
                                                                <strong>About Us</strong>
                                                            </div> --}}
                                                        <div class="text">
                                                            {!! $academy->aboutAcademy !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <div class="title">
                                                        <h3>No about academy found yet!</h3>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="facilities">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            @if ($academy->aboutDescription)
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="content">
                                                        {{-- <div class="title">
                                                                <strong>Academy Facilities</strong>
                                                            </div> --}}
                                                        <div class="text">
                                                            <p>
                                                                {!! $academy->aboutDescription !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <div class="title">
                                                        <h3>No facilities found yet!</h3>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="ourTeam">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="content">
                                                    <div class="text">
                                                        <p>
                                                            {!! $academy->our_team !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="trainingProgrammes">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="content">
                                                    <div class="text">
                                                        <p>
                                                            {!! $academy->training_programmes !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="ourAchievements">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="content">
                                                    <div class="text">
                                                        <p>
                                                            {!! $academy->our_achievements !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="recentTournaments">
                                    <div class="related-event overlay-style-two recent-tournaments">
                                        @if (count($recent_tournaments) > 0)
                                            <div class="related-event-carousel">
                                                @foreach ($recent_tournaments as $tournament)
                                                    <div class="single-upcoming-event single-item">
                                                        <div class="image img-box">
                                                            <figure>
                                                                <img src="{{ $tournament->imageOne }}"
                                                                    alt="{{ $tournament->tournamentName }}">
                                                            </figure>
                                                            <div class="overlay">
                                                                <div class="overlay-content">
                                                                    <div class="content">
                                                                        <a class="link-btn"
                                                                            href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                            <i class="fa fa-link"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="date">
                                                                <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                                                                {{ date('M', strtotime($tournament->fromDate)) }}
                                                            </div>
                                                        </div>
                                                        <div class="lower-content">
                                                            <h4>
                                                                <a
                                                                    href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                    {{ $tournament->tournamentName }}
                                                                </a>
                                                            </h4>
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
                                                            <div class="link">
                                                                <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}"
                                                                    class="theme-btn-two">
                                                                    Read More
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content" id="review1">
                                    <div class="news-section blog-grid blog-page overlay-style-one">
                                        @if (count($academy_imgs) > 0)
                                            <div class="row">
                                                @foreach ($academy_imgs as $img)
                                                    <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                                                        <div class="single-news-content inner-box">
                                                            <figure class="image-box">
                                                                <img src="{{ $img->image }}" alt="">
                                                                <!--Overlay Box-->
                                                                <div class="overlay-box">
                                                                    <div class="overlay-inner">
                                                                        <div class="content">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </figure>
                                                            <div class="lower-content">
                                                                <p class="mb-0">
                                                                    {{ $img->caption }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="title">
                                                        <h3>No Image Found Yet!</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content" id="contact">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="img-box">
                                                    <img src="{{ $academy->photo }}" alt="{{ $academy->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12">
                                                <div class="content">
                                                    <div class="title">
                                                        <h3>
                                                            <strong>
                                                                Contact Info
                                                            </strong>
                                                        </h3>
                                                    </div>
                                                    <ul class="info-box info-box-detail row equal-height">
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Contact: </b>{{ $academy->name }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Owner: </b>{{ $academy->owner_name }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Phone: </b> {{ $academy->phone }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Email: </b> {{ $academy->email }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Stay facility: </b>{{ $academy->stay }}
                                                            </div>
                                                        </li>
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Number of courts: </b>{{ $academy->no_of_court }}
                                                            </div>
                                                        </li>
                                                        @if ($academy->clay != null)
                                                            <li class="col-md-4">
                                                                <div class="col-info">
                                                                    <b>Clay courts: </b>{{ $academy->clay }}
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if ($academy->grass != null)
                                                            <li class="col-md-4">
                                                                <div class="col-info">
                                                                    <b>Grass courts: </b>{{ $academy->grass }}
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if ($academy->hard != null)
                                                            <li class="col-md-4">
                                                                <div class="col-info">
                                                                    <b>Hard courts: </b>{{ $academy->hard }}
                                                                </div>
                                                            </li>
                                                        @endif
                                                        @if ($academy->web != null)
                                                            <li class="col-md-4">
                                                                <div class="col-info">
                                                                    <b>Website: </b>
                                                                    <a href="{{ $academy->web }}" target="_blank">
                                                                        {{ $academy->web }}
                                                                    </a>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        <li class="col-md-4">
                                                            <div class="col-info">
                                                                <b>Address: </b> {{ $academy->city }},
                                                                {{ $academy->state }},
                                                                {{ $academy->pin }}
                                                                India
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                @if ($academy->geo_location != null)
                                                    <div class="map-box-large">
                                                        <div class="map" id="map"
                                                            data-geo-location="{{ $academy->geo_location }}">
                                                        </div>
                                                        <div id="map-link" class="map-link"></div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="related-event overlay-style-two recent-tournaments">
                            <div class="sec-title">Upcoming Tournaments</div>
                            @if (count($upcoming_tournaments) > 0)
                                <div class="related-event-carousel">
                                    @foreach ($upcoming_tournaments as $tournament)
                                        <div class="single-upcoming-event single-item">
                                            <div class="image img-box">
                                                <figure>
                                                    <img src="{{ $tournament->imageOne }}"
                                                        alt="{{ $tournament->tournamentName }}">
                                                </figure>
                                                <div class="overlay">
                                                    <div class="overlay-content">
                                                        <div class="content">
                                                            <a class="link-btn"
                                                                href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                                <i class="fa fa-link"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="date">
                                                    <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                                                    {{ date('M', strtotime($tournament->fromDate)) }}
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <h4>
                                                    <a
                                                        href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                        {{ $tournament->tournamentName }}
                                                    </a>
                                                </h4>
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
                                                <div class="link">
                                                    <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}"
                                                        class="theme-btn-two">
                                                        Read More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h1>No upcoming tournament found yet!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- academy-detail-section end --}}
@endsection

@section('script')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt5DYIAisGK-fooNcWeIlp3snMUkqhhFA&libraries=places"></script>

    <script>
        function showMap(lat, lng) {
            var coord = {
                lat: lat,
                lng: lng
            };
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: coord,
                disableDefaultUI: false,
                streetViewControl: false,
                fullscreenControl: true,
            });

            var marker = new google.maps.Marker({
                position: coord,
                map: map
            });

            var mapLinkUrl = `https://www.google.com/maps/search/?api=1&query=${lat},${lng}`;

            if (google.maps.places) {
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: coord,
                    radius: 50
                }, function(results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK && results[0]) {
                        var placeName = results[0].name || "Place";
                        var mapLinkContainer = document.getElementById('map-link');
                        mapLinkContainer.innerHTML = `
                    <div class="large-map-link">
                        <div class="map-lan-log">${lat} ${lng}</div>
                        <p>${placeName}</p>
                        <a href="${mapLinkUrl}" target="_blank" class="large-map-link__link">View Large Map</a>
                    </div>
                `;
                    } else {
                        // console.error("No place name found.");
                        var mapLinkContainer = document.getElementById('map-link');
                        mapLinkContainer.innerHTML = `
                    <div class="large-map-link">
                        <div class="map-lan-log">${lat} ${lng}</div>
                        <a href="${mapLinkUrl}" target="_blank" class="large-map-link__link">View Large Map</a>
                    </div>
                `;
                    }
                });
            } else {
                // console.error("Google Places library not loaded.");
                var mapLinkContainer = document.getElementById('map-link');
                mapLinkContainer.innerHTML = `
            <div class="large-map-link">
                <div class="map-lan-log">${lat} ${lng}</div>
                <a href="${mapLinkUrl}" target="_blank" class="large-map-link__link">View Large Map</a>
            </div>
        `;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const mapId = document.getElementById('map');
            if (mapId) {
                var geoLocation = mapId.getAttribute('data-geo-location');
                if (geoLocation) {
                    var coordinates = geoLocation.split(',');
                    var lat = parseFloat(coordinates[0]);
                    var lng = parseFloat(coordinates[1]);
                    showMap(lat, lng);
                } else {
                    console.error("No geo location data found.");
                }
            }
        });
    </script>
@endsection
