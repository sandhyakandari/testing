@extends('layout.layout')

@section('title')
    Kheldhaara | Academy-Registeration
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title centred custom-page-banner-section"
        style="background-image:url({{ asset('assets/images/academies/4.jpg') }})">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Academy Registration</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Registeration</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    <!-- page-title end -->

    <!-- custom-complete-registration-section-start -->
    <section class="contact-section bg-light custom-player-registration">
        <div class="container-fluid container-lg">
            <div class="row">
                <form action="{{ route('academy.registerFun') }}" method="post" enctype="multipart/form-data"
                    name="academyCompleteRegister">
                    @csrf
                    <div class="custom-ita-registration-details mb-3">
                        <h4 class="form-section"><i class="fa fa-home"></i> Academy Information </h4>
                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-3">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="academyName">Academy Name</label><span>*</span>
                                    <input type="text" class="form-control form-input" id="academyName"
                                        placeholder="Enter Academy Name" value="{{ $query->name }}" name="academyName"
                                        readonly>
                                </fieldset>
                                <p class="error" id="academyNameError"></p>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="ownerManagerName">Owner/ Manager Name
                                        <span class="text-danger">*</span>:</label>
                                    <input type="text" class="form-control form-input" id="ownerManagerName"
                                        name="ownerManagerName" placeholder="Enter Owner/ Manager Name">
                                    <p class="error" id="ownerManagerNameError"></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyMobileNumber">
                                        Mobile Number
                                        <span class="text-danger">*</span>:
                                    </label>
                                    {{-- <input type="hidden" name="countryCode" id="countryCode"> --}}
                                    <input type="tel" class="form-control form-input" id="academyMobileNumber"
                                        name="phone" placeholder="Enter Mobile Number" maxlength="" minlength="10"
                                        value="{{ $query->phone }}" readonly>
                                    <p class="error" id="academyMobileNumberError"></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyEmail">E-mail Address <span class="text-danger">*</span></label>
                                    <input type="email" id="academyEmail" class="form-control form-input"
                                        placeholder="Enter E-mail" name="email" value="{{ $query->email }}" readonly />
                                    <p class="error" id="academyEmailError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="numberOfCourts">Number of courts <span class="text-danger">*</span>:</label>
                                    <select name="courtsCount" id="numberOfCourts"
                                        class="form-control form-input numberSelectInput">
                                        <option value="">No. of courts</option>
                                        <option value="0">0</option>
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
                                        <option value="> 15">> 15</option>
                                    </select>
                                    <p class="error" id="numberOfCourtsError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="hard">Hard Courts:</label>
                                    <select name="hard" id="hard" class="form-control form-input numberSelectInput">
                                        <option value="">Hard</option>
                                        <option value="0">0</option>
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
                                        <option value="> 15">> 15 </option>
                                    </select>
                                    <p class="error" id="hardError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="clay">Clay Courts:</label>
                                    <select name="clay" id="clay"
                                        class="form-control form-input numberSelectInput">
                                        <option value="">Clay</option>
                                        <option value="0">0</option>
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
                                        <option value="> 15">> 15 </option>
                                    </select>
                                    <p class="error" id="clayError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="grass">Grass Courts:</label>
                                    <select name="grass" id="grass"
                                        class="form-control form-input numberSelectInput">
                                        <option value="">Grass</option>
                                        <option value="0">0</option>
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
                                        <option value="> 15">> 15 </option>
                                    </select>
                                    <p class="error" id="grassError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12"></div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyAddress">Address<span class="text-danger">*</span>:</label>
                                    <input type="text" class="form-control form-input" id="academyAddress"
                                        name="address" placeholder="Enter Address" value="">
                                    <p class="error" id="academyAddressError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyCity">City<span class="text-danger">*</span>:</label>
                                    <input type="text" class="form-control form-input" id="academyCity"
                                        name="city" placeholder="Enter City" value="">
                                    <p class="error" id="academyCityError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyPin">Pin<span class="text-danger">*</span>:</label>
                                    <input type="text" class="form-control form-input" id="academyPin" name="pin"
                                        placeholder="Enter Pin" maxlength="6" value="">
                                    <p class="error" id="academyPinError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyState">State<span class="text-danger">*</span>:</label>
                                    <select name="state" class="form-control form-input" id="academyState">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="error" id="academyStateError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="academyPhoto">Academy Photo (If any):</label>
                                    <input type="file" id="academyPhoto" name="photo"
                                        class="form-control form-input" accept=".png,.jpg,jpeg" />
                                    <span class="text-danger">
                                        (Accepted File formats for uploads: png, jpg, jpeg)
                                    </span>
                                    <p class="error" id="academyPhotoError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <p>Stay Facility: </p>
                                    <input type="radio" id="stay_yes" name="stay" value="Yes" />
                                    <label for="stay_yes">Yes</label>
                                    <input type="radio" id="stay_no" name="stay" value="No" checked />
                                    <label for="stay_no">No</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="academyWeb">Academy Website (If any):</label>
                                    <input type="text" class="form-control form-input" id="academyWeb" name="web"
                                        placeholder="Enter Website URL" value="">
                                    <p class="error" id="academyWebError"></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-3">
                                <div class="form-group">
                                    <label for="geoLocation">Geo Location (If available):</label>
                                    <input type="text" class="form-control form-input" id="geoLocation"
                                        name="geo_location" placeholder="Enter Geo Location" value="">
                                    <p class="error" id="geoLocationError"></p>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section">
                            <i class="fa fa-home"></i>
                            AITA Registration Detail
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="aita_number">AITA Registration Number (If available):</label>
                                    <input type="text" class="form-control form-input" id="aita_number"
                                        placeholder="Enter AITA Registration Number" name="aita_number" />
                                </fieldset>
                                <p class="error" id="aitaAcademyNumberError"></p>
                            </div>
                        </div>
                    </div>
                    <div class="custom-ita-registration-details">
                        <h4 class="form-section mt-4 mb-2">TERMS &amp; CONDITIONS </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="checkbox">
                                    <label for="academyHereBy" style="margin: 0">
                                        <input type="checkbox" id="academyHereBy" name="hereBy" />
                                        <span style="font-size: 14px;">
                                            I/We hereby undertake that the information and documents supplied by User are
                                            correct and solely responsible for all the details provided in form.
                                        </span>
                                    </label>
                                    <p class="error" id="academyHereByError" style="margin: 0"></p>
                                </fieldset>
                                <fieldset class="checkbox">
                                    <label for="abideTermsConditions" style="margin: 0">
                                        <input type="checkbox" name="abideTermsConditions" id="abideTermsConditions">
                                        <span style="font-size: 14px;">
                                            I/We also agree to abide by all the terms and conditions of the registration of
                                            academies/Players.
                                        </span>
                                    </label>
                                    <p class="error" id="abideTermsConditionsError" style="margin: 0"></p>
                                </fieldset>
                                <fieldset class="checkbox">
                                    <label for="academyDisputeShall" style="margin: 0">
                                        <input type="checkbox" id="academyDisputeShall" name="disputeShall" />
                                        <span style="font-size: 14px;">
                                            I/We understand that failure in any of the above undertaking may lead to
                                            suspension of Academy/Player registration.
                                        </span>
                                    </label>
                                    <p class="error" id="academyDisputeShallError" style="margin: 0"></p>
                                </fieldset>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="pe-mi-close"></i>
                            <b>Submit</b>
                        </button>
                        <a href="#">
                            <button type="reset" class="btn btn-danger">
                                <i class="pe-mi-close"></i>
                                Cancel
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- custom-complete-registration-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
