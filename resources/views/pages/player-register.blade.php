@extends('layout.layout')

@section('title')
    Kheldhaara | Player-Registeration
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title centred custom-page-banner-section"
        style="background-image:url({{ asset('assets/images/academies/4.jpg') }})">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Player Registration</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Registeration</li>
                </ul>
            </div>
        </div>
        </div>
    </section>
    <section class="blank-box"></section>
    <!-- page-title end -->

    <!-- custom-complete-registration-section-start -->
    <section class="contact-section bg-light custom-player-registration">
        <div class="container-fluid container-lg">
            <div class="row">
                <form action="{{ route('player.registerFun') }}" method="post" enctype="multipart/form-data"
                    name="playerCompleteRegister">
                    @csrf
                    <div class="custom-ita-registration-details mb-3">
                        <h4 class="form-section">
                            <i class="fa fa-home"></i>
                            AITA Registration Detail
                        </h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="ita_number">AITA Registration Number (If available)</label>
                                    <input type="text" class="form-control form-input" id="ita_number"
                                        placeholder="Enter AITA Registration Number" value="" name="ita_number" />
                                </fieldset>
                                <p class="error" id="itaNumberError"></p>
                            </div>
                        </div>

                        <h4 class="form-section"><i class="fa fa-home"></i> Personal Information </h4>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="first-name">First Name</label><span>*</span>
                                    <input type="text" class="form-control form-input" id="firstName"
                                        placeholder="Enter First Name" value="" name="firstName">
                                </fieldset>
                                <p class="error" id="firstNameError"></p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input type="text" class="form-control form-input" id="middleName"
                                        placeholder="Enter Middle Name" value="" name="middleName">
                                </fieldset>
                                <p class="error" id="middleNameError"></p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="last-name">Last Name</label><span>*</span>
                                    <input type="text" class="form-control form-input" id="lastName"
                                        placeholder="Enter Last Name" value="" name="lastName">
                                </fieldset>
                                <p class="error" id="lastNameError"></p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="guardianName">Guardian Name
                                        <span class="text-danger">*</span>:</label>
                                    <input type="text" class="form-control form-input" id="guardianName"
                                        name="guardianName" placeholder="Enter Your Guardian Name" value="">
                                    <p class="error" id="guardianNameError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="dateValue">Date of Birth</label><span>*</span>
                                    <input type="date" id="dateValue" class="form-control form-input"
                                        placeholder="Enter Date of Birth" name="dob" value="" autocomplete="off">
                                </fieldset>
                                <p class="error" id="dobError"></p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <fieldset class="form-group floating-label-form-group">
                                    <p style="margin-bottom:.5rem;">Gender</p>
                                    <input type="radio" id="male" class="" name="gender[]" value="Male"
                                        checked>
                                    <label for="male">Male</label>
                                    <input type="radio" id="female" class="" name="gender[]" value="Female">
                                    <label for="female">Female</label>
                                </fieldset>
                                <p class="error" id="dobError"></p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="mobileNumber">
                                        Mobile Number
                                        <span class="text-danger">*</span>:
                                    </label>
                                    <input type="tel" class="form-control form-input" id="mobileNumber"
                                        name="phone" placeholder="Enter Your Mobile Number" maxlength="10"
                                        minlength="10" value="{{ $query->phone }}" readonly>
                                    <p class="error" id="mobileNumberError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="email">E-mail Address <span class="text-danger">*</span></label>
                                    <input type="email" id="email" class="form-control form-input"
                                        placeholder="E-mail Address" name="email" value="{{ $query->email }}"
                                        readonly />
                                    <p class="error" id="emailError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Profile Photo <span class="text-danger">*</span><br>
                                    <span class="text-danger">(Accepted File formats for uploads: png, jpg, jpeg)
                                    </span>
                                    <input type="file" id="photo" name="photo" class="form-control form-input"
                                        accept=".png,.jpg,jpeg" />
                                    <p class="error" id="photoError"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-ita-registration-details mb-3">
                        <h4 class="form-section"><i class="fa fa-home"></i>Location</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="addressLine1">Address Line 1
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-input" id="addressLine1"
                                        name="address_line_1" placeholder="Enter Your Address Line 1">
                                    <p class="error" id="addressLineOneError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="addressLine2">Address Line 2 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-input" id="addressLine2"
                                        name="address_line_2" placeholder="Enter Your Address Line 2">
                                    <p class="error" id="addressLineTwoError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="district">District <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-input" id="district" name="district"
                                        placeholder="Enter Your District Name" value="">
                                    <p class="error" id="districtError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="playerPin">Pin Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-input" id="playerPin" name="pin"
                                        placeholder="Enter Your Pin Code" value="" maxlength="6">
                                    <p class="error" id="playerPinError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="state"> State <span class="text-danger">*</span></label>
                                    <select name="state" class="form-control form-input" id="state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="error" id="stateError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="country"> Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-input" id="country" name="country"
                                        placeholder="Enter Your Country Name" value="India">
                                    <p class="error" id="countryError"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-ita-registration-details">
                        <h4 class="form-section mb-2">TERMS &amp; CONDITIONS </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="checkbox">
                                    <label for="hereBy" style="margin-bottom: 0px;">
                                        <input type="checkbox" id="hereBy" name="hereBy" />
                                        <span style="font-size: 14px;">
                                            I/We hereby undertake that the information and documents supplied are correct
                                            and solely responsible for all the details provided in registration form.
                                        </span>
                                    </label>
                                    <p class="error" id="hereByError"></p>
                                    <label for="abideTermsConditions" style="margin-bottom: 0px;">
                                        <input type="checkbox" name="abideTermsConditions" id="abideTermsConditions">
                                        <span style="font-size: 14px;">
                                            I/We also agree to abide by all the terms and conditions of the registration of
                                            academies/Players and website usage.
                                        </span>
                                    </label>
                                    <p class="error" id="abideTermsConditionsError"></p>
                                    <label for="disputeShall" style="margin-bottom: 0px;">
                                        <input type="checkbox" id="disputeShall" name="disputeShall" />
                                        <span style="font-size: 14px;">
                                            I/We understand that failure in any of the above undertaking may lead to
                                            suspension of Academy/Player registration.
                                        </span>
                                    </label>
                                    <p class="error" id="disputeShallError"></p>
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
                        <button type="reset" class="btn btn-danger">
                            <i class="pe-mi-close"></i>
                            Cancel
                        </button>
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
