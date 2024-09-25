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


    <!-- player-myProfile-section-start -->
    <section class="patient-dashboard bg-color-3 player-dashboard-section player-myProfile-section">
        @include('layoutTwo.playerSidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing my-profile">
                        <div class="single-box player-profile-single-box">
                            <div class="title-box player-profile-edit">
                                <h3>Information</h3>
                                <div class="edit-cancel-btn">
                                    <button type="button" id="editProfileBtn" class="theme-btn-one">
                                        Edit Profile
                                    </button>
                                    <button type="button" class="cancel-btn" id="cancelEditProfileBtn" disabled>
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            <div class="inner-box">
                                <form action="{{ route('player.storeMyProfile') }}" method="post" name="playerProfileForm">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Username*</label>
                                            <input type="text" name="userName" id="userName"
                                                value="{{ $details->name }}" readonly />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>First name*</label>
                                            <input type="text" name="firstName" id="firstName"
                                                placeholder="Enter your first name" value="{{ $details->first_name }}"
                                                readonly />
                                            <p class="error" id="firstNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Middle name</label>
                                            <input type="text" name="middleName" id="middleName"
                                                placeholder="Enter your middle name" value="{{ $details->middle_name }}"
                                                readonly />
                                            <p class="error" id="middleNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Last name</label>
                                            <input type="text" name="lastName" id="lastName"
                                                placeholder="Enter your last name" value="{{ $details->last_name }}"
                                                readonly />
                                            <p class="error" id="lastNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Guardian Name</label>
                                            <input type="text" name="guardianName" id="guardianName"
                                                placeholder="Enter your guardian name" value="{{ $details->guardian_name }}"
                                                readonly />
                                            <p class="error" id="guardianNameError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" placeholder="Email"
                                                value="{{ $details->email }}" readonly />
                                            <p class="error" id="emailError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Mobile number</label>
                                            <input type="text" name="phone" id="phone" placeholder="Mobile number"
                                                value="{{ $details->phone }}" maxlength="10" minlength="10" readonly />
                                            <p class="error" id="phoneError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Date of birth</label>
                                            <input type="date" name="dob" id="dob" class="input-date"
                                                placeholder="Date of birth" value="{{ $details->dob }}" readonly />
                                            <p class="error" id="dobError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Address</label>
                                            <input type="text" name="address_1" id="address_1" placeholder="Address"
                                                value="{{ $details->address_1 }}" readonly />
                                            <p class="error" id="address_1_Error"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Address</label>
                                            <input type="text" name="address_2" id="address_2" placeholder="Address"
                                                value="{{ $details->address_2 }}" readonly />
                                            <p class="error" id="address_2_Error"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>District</label>
                                            <input type="text" name="district" id="district" placeholder="District"
                                                value="{{ $details->district }}" readonly />
                                            <p class="error" id="districtError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Pin Code</label>
                                            <input type="text" name="pin" id="playerPin"
                                                placeholder="Enter your pin code" value="{{ $details->pin }}" readonly />
                                            <p class="error" id="playerPinError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>State</label>
                                            <select name="state" id="state" class="form-select-input" disabled>
                                                <option value="{{ $details->state }}">{{ $details->state }}</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="error" id="stateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Country</label>
                                            <input type="text" name="country" id="country" placeholder="Country"
                                                value="{{ $details->country }}" readonly />
                                            <p class="error" id="countryError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Registration Number</label>
                                            @if ($details->ita_number !== null)
                                                <input type="text" name="aita" id="aita"
                                                    placeholder="Registration Number" value="{{ $details->ita_number }}"
                                                    readonly />
                                            @else
                                                <input type="text" name="aita" id="haveNotAita"
                                                    placeholder="Registration Number" value="" readonly />
                                            @endif

                                            <p class="error" id="aitaError"></p>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one" id="playerEditProfileBtn"
                                                disabled>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                <form action="{{ route('player.playerEmailUpdate') }}" method="post"
                                    name="updateEmailForm">
                                    @csrf
                                    <div class="row clearfix">
                                        <input type="hidden" name="player_id" value="{{ $details->player_id }}">
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

                        @if ($details->ita_number !== null)
                            <div class="single-box">
                                <div class="title-box">
                                    <h3>Update Registration Number</h3>
                                </div>
                                <div class="inner-box">
                                    <form action="{{ route('player.playerAITANumberUpdate') }}" method="post"
                                        name="updateAITAForm">
                                        @csrf
                                        <div class="row clearfix">
                                            <input type="hidden" name="player_id" value="{{ $details->player_id }}">
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
    <!-- player-myProfile-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
