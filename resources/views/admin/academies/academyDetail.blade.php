@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Academy-Detail
@endsection

@section('style')
    <style>
        .academy-box {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .academy-box img {
            width: 100%;
            height: 100%;
            object-position: top;
            object-fit: cover;
        }

        .map {
            height: 300px;
            width: 100%;
        }

        .map-box-large {
            display: block;
            position: relative;
        }

        .map-link {
            position: absolute;
            top: 0;
            left: 0;
        }

        .large-map-link {
            background-color: #fff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            margin-top: 8px;
            margin-left: 8px;
            padding: 10px;
        }

        .map-lan-log {
            color: #222;
            font-weight: 800;
        }

        .large-map-link p {
            font-size: 13px;
            margin-bottom: 0;
        }

        .large-map-link__link {
            color: #061a3a;
            transition: all 0.7s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $details->name }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('admin.partials.academyLeftSidebarPartials', ['details' => $details])

                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#activity" data-toggle="tab">
                                            Info & Activity
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#timeline" data-toggle="tab">
                                            Images
                                        </a>
                                    </li>
                                    @if ($details->aboutAcademy)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#settings" data-toggle="tab">
                                                About Academy
                                            </a>
                                        </li>
                                    @endif
                                    @if ($details->aboutDescription)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#features" data-toggle="tab">
                                                Features
                                            </a>
                                        </li>
                                    @endif
                                    @if ($details->our_team)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#our_team" data-toggle="tab">
                                                Our Team
                                            </a>
                                        </li>
                                    @endif
                                    @if ($details->training_programmes)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#training_programmes" data-toggle="tab">
                                                Training Programmes
                                            </a>
                                        </li>
                                    @endif
                                    @if ($details->our_achievements)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#our_achievements" data-toggle="tab">
                                                Our Achievements
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- academy-info-&-activity -->
                                    <div class="active tab-pane" id="activity">
                                        @include('admin.partials.academyInfoActivityPartials', [
                                            'details' => $details,
                                            'host_tournaments' => $host_tournaments,
                                        ])
                                    </div>
                                    <!-- /.academy-info-&-activity -->
                                    <!-- /.academy-images-->
                                    <div class="tab-pane" id="timeline">
                                        @include('admin.partials.academyImagesPartials', [
                                            'details' => $details,
                                            'academy_images' => $academy_images,
                                        ])
                                    </div>
                                    <!-- /.academy-images-->

                                    {{-- about academy --}}
                                    @if ($details->aboutAcademy)
                                        <div class="tab-pane" id="settings">
                                            <div class="about-academy">
                                                {!! $details->aboutAcademy !!}
                                            </div>
                                            @if ($details->geo_location)
                                                <div class="map-box-large">
                                                    <div class="map" id="map"
                                                        data-geo-location="{{ $details->geo_location }}">
                                                    </div>
                                                    <div id="map-link" class="map-link"></div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    {{-- academy-features --}}
                                    @if ($details->aboutDescription)
                                        <div class="tab-pane" id="features">
                                            <div class="about-academy">
                                                {!! $details->aboutDescription !!}
                                            </div>
                                        </div>
                                    @endif
                                    {{-- academy-our-team --}}
                                    @if ($details->our_team)
                                        <div class="tab-pane" id="our_team">
                                            <div class="about-academy">
                                                {!! $details->our_team !!}
                                            </div>
                                        </div>
                                    @endif
                                    {{-- academy-training-programmes --}}
                                    @if ($details->training_programmes)
                                        <div class="tab-pane" id="training_programmes">
                                            <div class="about-academy">
                                                {!! $details->training_programmes !!}
                                            </div>
                                        </div>
                                    @endif
                                    {{-- academy-our-achievements --}}
                                    @if ($details->our_achievements)
                                        <div class="tab-pane" id="our_achievements">
                                            <div class="about-academy">
                                                {!! $details->our_achievements !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->
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
