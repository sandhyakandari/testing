@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Manual-Registration
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
                    <h1>Manual Registration</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Manual Registration</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- manul-registration-section-start -->
    <section class="patient-dashboard bg-color-3 manual-registration">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing change-password custom-manual-registration">
                        <div class="single-box">
                            <div class="title-box">
                                <h3>Manual Registration</h3>
                            </div>
                            <div class="inner-box">
                                <form action="{{ route('academy.playerRegisterByAcademy') }}" method="post"
                                    name="manualEntryForm">
                                    @csrf
                                    <input type="hidden" name="tournament_id" value="{{ $tournament->tournament_id }}">
                                    <div class="row clearfix">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Regd Number (If any)</label>
                                            <input type="text" name="aita_number" id="manual_enter_aita_number">
                                            <p class="error" id="manual_enter_aita_numberError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Rank (If any)</label>
                                            <input type="text" name="rank_number" id="manual_enter_rank_number">
                                            <p class="error" id="manual_enter_rank_numberError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Tournament Name</label>
                                            <input type="text" name="tournamentName" id="manualEnterTournamentName"
                                                value="{{ $tournament->tournamentName }}" readonly>
                                            <p class="error" id="manualEnterTournamentNameError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="manualEnterName">
                                            <p class="error" id="manualEnterNameError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group form-sub-cat"
                                            id="tournamentSubCategory">
                                            <label for="subCategory" class="form-main-sub-cat">
                                                Select Subcategories:
                                            </label>
                                            @foreach ($subcat as $index => $sub_category)
                                                @php
                                                    // dd($subcat[0]);
                                                    $input_type = 'checkbox';
                                                    if (
                                                        trim($sub_category) === 'Men' ||
                                                        trim($sub_category) === 'Women'
                                                    ) {
                                                        $input_type = 'radio';
                                                    }
                                                    $category = 'Juniors';
                                                    if (
                                                        trim($sub_category) === 'Men' ||
                                                        trim($sub_category) === 'Women'
                                                    ) {
                                                        $category = 'Seniors';
                                                    }
                                                @endphp
                                                <input type="hidden" name="category" value="{{ $category }}">
                                                <input type="{{ $input_type }}" name="subCategories[]"
                                                    value="{{ $sub_category }}"
                                                    class="{{ $input_type === 'checkbox' ? 'checkbox-juniors' : '' }}"
                                                    id="{{ str_replace(' ', '_', $sub_category) }}"
                                                    {{ $input_type === 'radio' ? ($subcat[0] ? 'checked' : '') : '' }}>
                                                <label for="{{ str_replace(' ', '_', $sub_category) }}">
                                                    {{ $sub_category }}
                                                </label>
                                            @endforeach
                                            <p class="error" id="manualSubCategoryErrorElm"></p>
                                        </div>

                                        @if (trim($subcat[0]) === 'Men' || trim($subcat[0]) === 'Women')
                                        @else
                                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                                <p>Gender</p>
                                                <input type="radio" name="gender" value="Male" id="male" checked>
                                                <label for="male" class="radio">Male</label>
                                                <input type="radio" name="gender" id="female" value="Female">
                                                <label for="female" class="radio">Female</label>
                                            </div>
                                        @endif

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Date Of Birth</label>
                                            <input type="date" name="dob" id="manualEnterDob"
                                                class="form-control form-date-input">
                                            <p class="error" id="manualEnterDobError"></p>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>State</label>
                                            <select name="state" id="manual_enter_state" class="form-control">
                                                <option value="">Select State</option>
                                                @forelse ($states as $state)
                                                    <option value="{{ $state->abbreviation }}">
                                                        {{ $state->name }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <p class="error" id="manual_enter_stateError"></p>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one">
                                                Register
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
    <!-- manul-registration-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
