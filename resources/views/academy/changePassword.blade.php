@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Change-Password
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
                    <h1>Change Password</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Change Password</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- academy-change-password-section-start -->
    <section class="patient-dashboard bg-color-3 player-dashboard-section player-change-password academy-change-password">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing change-password custom-change-password">
                        <div class="single-box">
                            <div class="title-box">
                                <h3>Change Password</h3>
                            </div>
                            <div class="inner-box">
                                <form action="{{ route('academy.storeAcademyChangePassword') }}" method="post"
                                    name="changePasswordForm">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Current Password</label>
                                            <input type="password" name="currentPassword" id="currentPassword">
                                            <p class="error" id="currentPasswordError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>New Password</label>
                                            <input type="password" name="newPassword" id="newPassword">
                                            <p class="error" id="newPasswordError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="confirmPassword" id="confirmPassword">
                                            <p class="error" id="confirmPasswordError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one">Save Change</button>
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
    <!-- academy-change-password-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
