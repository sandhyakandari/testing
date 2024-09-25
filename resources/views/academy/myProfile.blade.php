@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | My-Profile
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
                    <h1>My Profile</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>My Profile</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- academy-profile-section-start -->
    <section class="patient-dashboard bg-color-3 player-dashboard-section player-myProfile-section academy-profile-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing my-profile">
                        <div class="single-box player-profile-single-box">
                            <div class="title-box player-profile-edit">
                                <h3>Information</h3>
                                <div class="edit-cancel-btn">
                                    <button type="button" id="academyEditProfileBtn" class="theme-btn-one">
                                        Edit Profile
                                    </button>
                                    <button type="button" class="cancel-btn" id="academyCancelEditProfileBtn" disabled>
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            <div class="inner-box">
                                <form action="{{ route('academy.storeAcademyProfile') }}" method="post"
                                    name="academyProfileForm">
                                    @csrf
                                    <div class="row clearfix">
                                        <input type="hidden" name="academy_id" value="{{ $details->academy_id }}">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Academy name*</label>
                                            <input type="text" name="name" id="academyName"
                                                placeholder="Enter academy name" value="{{ $details->name }}" readonly />
                                            <p class="error" id="academyNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Owner name*</label>
                                            <input type="text" name="owner_name" id="owner_name"
                                                placeholder="Enter owner name" value="{{ $details->owner_name }}"
                                                readonly />
                                            <p class="error" id="owner_nameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group form-stay">
                                            <p>Stay Facility: </p>
                                            <input type="radio" id="stay_yes" name="stay" value="Yes"
                                                {{ $details->stay == 'Yes' ? 'checked' : '' }} disabled />
                                            <label for="stay_yes">Yes</label>
                                            <input type="radio" id="stay_no" name="stay" value="No"
                                                {{ $details->stay == 'No' ? 'checked' : '' }} disabled />
                                            <label for="stay_no">No</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="academyEmail" placeholder="Email"
                                                value="{{ $details->email }}" readonly />
                                            <p class="error" id="academyEmailError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Mobile number</label>
                                            {{-- <input type="hidden" name="countryCode" value="{{ $details->country_code }}"
                                            id="academyCountryCode"> --}}
                                            <input type="tel" name="phone" id="academyPhone"
                                                placeholder="Mobile number" value="{{ $details->phone }}" maxlength=""
                                                minlength="10" readonly />
                                            <p class="error" id="academyPhoneError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Number of courts</label>
                                            <select name="no_of_courts" id="numberOfCourts"
                                                class="form-control form-select-input" disabled>
                                                <option value="{{ $details->no_of_court }}">
                                                    {{ $details->no_of_court }}
                                                </option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="15 <">15 < </option>
                                            </select>
                                            <p class="error" id="no_of_courtsError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Hard</label>
                                            <select name="hard" id="hard" class="form-control form-select-input"
                                                disabled>
                                                <option value="{{ $details->hard }}">{{ $details->hard }}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="15 <">15 < </option>
                                            </select>
                                            <p class="error" id="hardError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Clay</label>
                                            <select name="clay" id="clay" class="form-control form-select-input"
                                                disabled>
                                                <option value="{{ $details->clay }}">{{ $details->clay }}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="15 <">15 < </option>
                                            </select>
                                            <p class="error" id="clayError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Grass</label>
                                            <select name="grass" id="grass" class="form-control form-select-input"
                                                disabled>
                                                <option value="{{ $details->grass }}">{{ $details->grass }}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="15 <">15 < </option>
                                            </select>
                                            <p class="error" id="grassError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="academyAddress"
                                                placeholder="address" value="{{ $details->address }}" readonly />
                                            <p class="error" id="academyAddressError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>City</label>
                                            <input type="text" name="city" id="academyCity" placeholder="City"
                                                value="{{ $details->city }}" readonly />
                                            <p class="error" id="academyCityError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Pin</label>
                                            <input type="text" name="pin" id="academyPin" placeholder="Pin Code"
                                                value="{{ $details->pin }}" maxlength="6" readonly />
                                            <p class="error" id="academyPinError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>State</label>
                                            <select name="state" id="academyState" class="form-select-input" disabled>
                                                <option value="{{ $details->state }}">{{ $details->state }}</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="error" id="academyStateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Website URL</label>
                                            <input type="text" name="web" id="academyWeb"
                                                placeholder="Website URL" value="{{ $details->web }}" readonly />
                                            <p class="error" id="academyWebError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Geo Location</label>
                                            <input type="text" name="geo_location" id="academyGeoLocation"
                                                placeholder="Geo Location" value="{{ $details->geo_location }}"
                                                readonly />
                                            <p class="error" id="academyGeoLocationError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Registration Number</label>
                                            @if ($details->aita_number !== null)
                                                <input type="text" name="aita" id="academy_aita"
                                                    placeholder="Registration Number" value="{{ $details->aita_number }}"
                                                    readonly />
                                            @else
                                                <input type="text" name="aita" id="have_not_academy_aita"
                                                    placeholder="Registration Number" value="{{ $details->aita_number }}"
                                                    readonly />
                                            @endif
                                            <p class="error" id="academy_aitaError"></p>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>About Academy</label>
                                            <textarea name="aboutAcademy" id="aboutAcademy" readonly>
                                                {{ $details->aboutAcademy }}
                                            </textarea>
                                            <p class="error" id="aboutAcademyError"></p>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Facilities</label>
                                            <textarea name="aboutDescription" id="aboutDescription" readonly>
                                                {{ $details->aboutDescription }}
                                            </textarea>
                                            <p class="error" id="aboutDescriptionError"></p>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Our Team</label>
                                            <textarea name="ourTeam" id="ourTeam" readonly>
                                                {{ $details->our_team }}
                                            </textarea>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Training Programmes</label>
                                            <textarea name="trainingProgrammes" id="trainingProgrammes" readonly>
                                                {{ $details->training_programmes }}
                                            </textarea>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Our Achievements</label>
                                            <textarea name="ourAchievements" id="ourAchievements" readonly>
                                                {{ $details->our_achievements }}
                                            </textarea>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one" id="academyEditProfileSubmitBtn"
                                                disabled>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="web-link-map">
                            @if ($details->web)
                                <div class="weburl mb-3">
                                    <p>
                                        <b>Website URL:</b>
                                        <a href="{{ $details->web }}" target="_blank">
                                            {{ $details->web }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if ($details->geo_location)
                                <div class="map-box-large">
                                    <div class="map" id="map" data-geo-location="{{ $details->geo_location }}">
                                    </div>
                                    <div id="map-link" class="map-link"></div>
                                </div>
                            @endif
                        </div>
                        <p class="mt-5">
                            <span class="text-danger">
                                Note*: If you need to change email or registration number drop an email to kheldhara.com
                            </span>
                        </p>
                        <div class="single-box">
                            <div class="title-box">
                                <h3>Update Email</h3>
                            </div>
                            <div class="inner-box">
                                <form action="{{ route('academy.academyEmailUpdate') }}" method="post"
                                    name="updateEmailForm">
                                    @csrf
                                    <div class="row clearfix">
                                        <input type="hidden" name="academy_id" value="{{ $details->academy_id }}">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Current Email</label>
                                            <input type="email" name="currentEmail"
                                                placeholder="Enter your current email" id="currentEmail">
                                            <p class="error" id="currentEmailError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>New Email</label>
                                            <input type="email" name="newEmail" placeholder="Enter your new email"
                                                id="newEmail">
                                            <p class="error" id="newEmailError"></p>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Brief condition</label>
                                            <textarea name="message" placeholder="Write your not..." id="briefCondition"></textarea>
                                            <p class="error" id="briefConditionError"></p>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if ($details->aita_number !== null)
                            <div class="single-box">
                                <div class="title-box">
                                    <h3>Update Registration Number</h3>
                                </div>
                                <div class="inner-box">
                                    <form action="{{ route('academy.academyAITANumberUpdate') }}" method="post"
                                        name="updateAITAForm">
                                        @csrf
                                        <div class="row clearfix">
                                            <input type="hidden" name="academy_id" value="{{ $details->academy_id }}">
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label>Current Registration Number</label>
                                                <input type="text" name="currentAita"
                                                    placeholder="Enter your current Registration number" id="currentAita">
                                                <p class="error" id="currentAitaError"></p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label>New Registration Number</label>
                                                <input type="text" name="newAita"
                                                    placeholder="Enter your new Registration number" id="newAita">
                                                <p class="error" id="newAitaError"></p>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label>Brief condition</label>
                                                <textarea name="message" placeholder="Write your not..." id="aitaCondition"></textarea>
                                                <p class="error" id="aitaConditionError"></p>
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <button type="submit" class="theme-btn-one">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- academy-profile-section-end -->
@endsection

@section('script')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt5DYIAisGK-fooNcWeIlp3snMUkqhhFA"></script> --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt5DYIAisGK-fooNcWeIlp3snMUkqhhFA&libraries=places"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let aboutAcademyEditor, aboutDescriptionEditor, ourTeamEditor, trainingProgrammesEditor,
                ourAchivementsEditor;

            ClassicEditor
                .create(document.querySelector('#aboutAcademy'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .then(editor => {
                    aboutAcademyEditor = editor;
                    const toolbarElement = editor.ui.view.toolbar.element;
                    toolbarElement.style.display = 'none';
                    editor.enableReadOnlyMode('initialLoad');
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#aboutDescription'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .then(editor => {
                    aboutDescriptionEditor = editor;
                    const toolbarElement = editor.ui.view.toolbar.element;
                    toolbarElement.style.display = 'none';
                    editor.enableReadOnlyMode('initialLoad');
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#ourTeam'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .then(editor => {
                    ourTeamEditor = editor;
                    const toolbarElement = editor.ui.view.toolbar.element;
                    toolbarElement.style.display = 'none';
                    editor.enableReadOnlyMode('initialLoad');
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#trainingProgrammes'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .then(editor => {
                    trainingProgrammesEditor = editor;
                    const toolbarElement = editor.ui.view.toolbar.element;
                    toolbarElement.style.display = 'none';
                    editor.enableReadOnlyMode('initialLoad');
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#ourAchievements'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .then(editor => {
                    ourAchivementsEditor = editor;
                    const toolbarElement = editor.ui.view.toolbar.element;
                    toolbarElement.style.display = 'none';
                    editor.enableReadOnlyMode('initialLoad');
                })
                .catch(error => {
                    console.error(error);
                });

            document.getElementById('academyEditProfileBtn').addEventListener('click', () => {
                aboutAcademyEditor.disableReadOnlyMode('initialLoad');
                aboutDescriptionEditor.disableReadOnlyMode('initialLoad');
                ourTeamEditor.disableReadOnlyMode('initialLoad');
                trainingProgrammesEditor.disableReadOnlyMode('initialLoad');
                ourAchivementsEditor.disableReadOnlyMode('initialLoad');

                aboutAcademyEditor.ui.view.toolbar.element.style.display = 'flex';
                aboutDescriptionEditor.ui.view.toolbar.element.style.display = 'flex';
                ourTeamEditor.ui.view.toolbar.element.style.display = 'flex';
                trainingProgrammesEditor.ui.view.toolbar.element.style.display = 'flex';
                ourAchivementsEditor.ui.view.toolbar.element.style.display = 'flex';
            });

            document.getElementById('academyCancelEditProfileBtn').addEventListener('click', () => {
                aboutAcademyEditor.enableReadOnlyMode('initialLoad');
                aboutDescriptionEditor.enableReadOnlyMode('initialLoad');
                ourTeamEditor.enableReadOnlyMode('initialLoad');
                trainingProgrammesEditor.enableReadOnlyMode('initialLoad');
                ourAchivementsEditor.enableReadOnlyMode('initialLoad');

                aboutAcademyEditor.ui.view.toolbar.element.style.display = 'none';
                aboutDescriptionEditor.ui.view.toolbar.element.style.display = 'none';
                ourTeamEditor.ui.view.toolbar.element.style.display = 'none';
                trainingProgrammesEditor.ui.view.toolbar.element.style.display = 'none';
                ourAchivementsEditor.ui.view.toolbar.element.style.display = 'none';
            });
        });
    </script>

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
