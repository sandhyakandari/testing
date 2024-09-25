@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Edit-Tournament
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
                    <h1>Edit Tournament</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Edit Tournament</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- edit-tournament-section-start -->
    <section class="patient-dashboard bg-color-3 create-tournament-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing my-profile">
                        <div class="single-box player-profile-single-box">
                            <div class="title-box">
                                <h3>Update Tournament</h3>
                            </div>
                            <div class="inner-box create-tournament-inner-box">
                                <form action="{{ route('academy.storeEditTournament') }}" method="post"
                                    name="editTournamentForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $tournament->tournament_id }}">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label for="">Tournament Category*</label>
                                            <select name="tournamentCategory" id="tournamentCategory"
                                                class="form-control form-select-input">
                                                <option value="{{ $tournament->tournamentCategory }}">
                                                    {{ $tournament->tournamentCategory }}
                                                </option>
                                                <option value="Talent Series (TS) (7 Days)">Talent Series (TS) (7 Days)
                                                </option>
                                                <option value="Championship Series (CS) (3 Days)">Championship Series (CS)
                                                    (3 Days)</option>
                                                <option value="Championship Series (CS) (7 Days)">Championship Series (CS)
                                                    (7 Days)</option>
                                                <option value="National Series (NS)">National Series (NS)</option>
                                                <option value="Nationals- Hard Court">Nationals- Hard Court</option>
                                                <option value="Nationals- Clay Court">Nationals- Clay Court</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <p class="error" id="tournamentCategoryError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Tournament name*</label>
                                            <input type="text" name="tournamentName" id="tournamentName"
                                                placeholder="Enter tournament name"
                                                value="{{ $tournament->tournamentName }}" />
                                            <p class="error" id="tournamentNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Academy name*</label>
                                            <input type="text" name="academyName" id="tournamentAcademyName"
                                                placeholder="Enter academy name" value="{{ $academy->name }}" readonly />
                                            <p class="error" id="tournamentAcademyNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label for="">Player Category*</label>
                                            <select name="category" id="tournamentPlayerCategory"
                                                class="form-control form-select-input">
                                                <option value="{{ $tournament->category }}">
                                                    {{ $tournament->category }}
                                                </option>
                                            </select>
                                            <p class="error" id="tournamentPlayerCategoryError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label for="">Sub Category*</label>
                                            <div class="select-sub-category-box">
                                                <div class="select-btn">
                                                    <label for="tournamentSubCategory" class="btn-text">Sub Category</label>
                                                    <input type="hidden" name="subCategory[]" id="tournamentSubCategory"
                                                        value="{{ $tournament->subCategory }}">
                                                    <span class="arrow-dwn">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                                <ul class="selected-items" id="selectedSubCategoryItemUl">
                                                </ul>
                                            </div>
                                            <p class="error" id="tournamentSubCategoryError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Surface*</label>
                                            <select name="surface" id="tournamentSurface"
                                                class="form-control form-select-input">
                                                <option value="{{ $tournament->surface }}">
                                                    {{ $tournament->surface }}
                                                </option>
                                                <option value="Hard">Hard</option>
                                                <option value="Clay">Clay</option>
                                                <option value="Grass">Grass</option>
                                            </select>
                                            <p class="error" id="tournamentSurfaceError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>City/ Town*</label>
                                            <input type="text" name="city" id="tournamentCity"
                                                placeholder="Enter city/ town name" value="{{ $tournament->city }}" />
                                            <p class="error" id="tournamentCityError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>From Date*</label>
                                            <input type="date" name="date" id="tournamentDate"
                                                class="form-control form-select-input" placeholder="Date"
                                                value="{{ $tournament->fromDate }}" />
                                            <p class="error" id="tournamentDateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Till Date</label>
                                            <input type="date" name="toDate" id="tournamentToDate"
                                                class="form-control form-select-input" placeholder="Till Date"
                                                value="{{ $tournament->toDate }}" />
                                            <p class="error" id="tournamentToDateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Last date to apply</label>
                                            <input type="date" name="lastDate" class="form-control form-select-input"
                                                id="tournamentLastDate" placeholder="Last date to apply"
                                                value="{{ $tournament->lastDate }}" />
                                            <p class="error">Please follow guidelines as per AITA rules.</p>
                                            <p class="error" id="tournamentLastDateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group stayBoxYesNo">
                                            <p>Stay Facility</p>
                                            <input type="radio" value="No" name="stay" id="stayNo"
                                                {{ $tournament->stay === 'No' ? 'checked' : '' }}>
                                            <label for="stayNo">No</label>
                                            <input type="radio" value="Yes" name="stay" id="stayYes"
                                                {{ $tournament->stay === 'Yes' ? 'checked' : '' }}>
                                            <label for="stayYes">Yes</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Prize Money</label>
                                            <input type="text" name="price" class="" id="tournamentPrice"
                                                placeholder="Prize Money" value="{{ $tournament->price }}" />
                                            <p class="error" id="tournamentPriceError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Whatsapp Link</label>
                                            <input type="text" name="whatsapp" id="tournamentWhatsappLink"
                                                placeholder="Enter whatsapp link" value="{{ $tournament->whatsapp }}" />
                                            <p class="error" id="tournamentWhatsappLinkError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>
                                                @if($tournament->imageOne)
                                                Image:<a href="{{$tournament->imageOne}}" target="_blank">img1</a>
                                                @endif 
                                            </label>
                                            <input type="file" name="imageOne" class="form-control"
                                                placeholder="Image" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image Caption</label>
                                            <input type="text" name="captionOne" id="tournamentCaptionOne"
                                                placeholder="Enter Image Caption"
                                                value="{{ $tournament->captionOne }}" />
                                            <p class="error" id="tournamentCaptionOneError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image:
                                            @if($tournament->imageTwo)
                                                Image:<a href="{{$tournament->imageTwo}}" target="_blank">img2</a>
                                                @endif 
                                            </label>
                                            <input type="file" name="imageTwo" class="form-control"
                                                placeholder="Image" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image Caption</label>
                                            <input type="text" name="captionTwo" id="tournamentCaptionTwo"
                                                placeholder="Enter Image Caption"
                                                value="{{ $tournament->captionTwo }}" />
                                            <p class="error" id="tournamentCaptionTwoError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image
                                                @if($tournament->imageThree)
                                                <a href="{{$tournament->imageThree}}" target="_blank">img3</a>
                                                @endif 
                                            </label>
                                            <input type="file" name="imageThree" class="form-control"
                                                placeholder="Image" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image Caption</label>
                                            <input type="text" name="captionThree" id="tournamentCaptionThree"
                                                placeholder="Enter Image Caption"
                                                value="{{ $tournament->captionThree }}" />
                                            <p class="error" id="tournamentCaptionThreeError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Factsheet
                                            @if($tournament->factsheet)
                                                <a href="{{$tournament->factsheet}}" target="_blank">factsheet</a>
                                                @endif 
                                            </label>
                                            <input type="file" name="factsheet" class="form-control"
                                                placeholder="Factsheet" accept=".pdf,.jpeg,.jpg" />
                                            <p class="error" id="">Please follow factsheet as per tournament
                                                format.</p>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- edit-tournament-section-end -->
@endsection

@section('script')
    <script>
        const tournamentPlayerCategoryIdValue = document.getElementById("tournamentPlayerCategory").value;
        const tournamentSubCategoryIdValue = document.getElementById("tournamentSubCategory").value;
        // console.log(tournamentSubCategoryIdValue)
    </script>
@endsection
