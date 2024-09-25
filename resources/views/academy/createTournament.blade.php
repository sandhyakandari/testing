@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Create-Tournament
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
                    <h1>Create Tournament</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Create Tournament</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- create-tournament-section-start -->
    <section class="patient-dashboard bg-color-3 create-tournament-section">
        @include('layoutTwo.academySidebar')

        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing my-profile">
                        <div class="single-box player-profile-single-box">
                            <div class="title-box">
                                <h3>Tournament</h3>
                            </div>
                            <div class="inner-box create-tournament-inner-box">
                                <form action="{{ route('academy.storeTournament') }}" method="post"
                                    name="createTournamentForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label for="">Tournament Category*</label>
                                            <select name="tournamentCategory" id="tournamentCategory"
                                                class="form-control form-select-input">
                                                <option value="">Tournament Category</option>
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
                                                placeholder="Enter tournament name" value="" />
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
                                                <option value="">Player Category</option>
                                                {{-- <option value="Boy's">Boy's</option>
                                                <option value="Girl's">Girl's</option>
                                                <option value="Senior's">Senior's</option> --}}
                                            </select>
                                            <p class="error" id="tournamentPlayerCategoryError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label for="">Sub Category*</label>
                                            <div class="select-sub-category-box">
                                                <div class="select-btn">
                                                    <label for="tournamentSubCategory" class="btn-text">Sub Category</label>
                                                    <input type="hidden" name="subCategory[]" id="tournamentSubCategory">
                                                    <span class="arrow-dwn">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </span>
                                                </div>
                                                <ul class="selected-items" id="selectedSubCategoryItemUl">
                                                    {{-- <li class="selected-item-list">
                                                        <span class="checkbox">
                                                            <i class="fa fa-check check-icon"></i>
                                                        </span>
                                                        <span class="item-text">Under 12</span>
                                                    </li>
                                                    <li class="selected-item-list">
                                                        <span class="checkbox">
                                                            <i class="fa fa-check check-icon"></i>
                                                        </span>
                                                        <span class="item-text">Under 14</span>
                                                    </li>
                                                    <li class="selected-item-list">
                                                        <span class="checkbox">
                                                            <i class="fa fa-check check-icon"></i>
                                                        </span>
                                                        <span class="item-text">Under 16</span>
                                                    </li>
                                                    <li class="selected-item-list">
                                                        <span class="checkbox">
                                                            <i class="fa fa-check check-icon"></i>
                                                        </span>
                                                        <span class="item-text">Under 18</span>
                                                    </li> --}}
                                                </ul>
                                            </div>
                                            <p class="error" id="tournamentSubCategoryError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Surface*</label>
                                            <select name="surface" id="tournamentSurface"
                                                class="form-control form-select-input">
                                                <option value="">Surface</option>
                                                <option value="Hard">Hard</option>
                                                <option value="Clay">Clay</option>
                                                <option value="Grass">Grass</option>
                                            </select>
                                            <p class="error" id="tournamentSurfaceError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>City/ Town*</label>
                                            <input type="text" name="city" id="tournamentCity"
                                                placeholder="Enter city/ town name" value="" />
                                            <p class="error" id="tournamentCityError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>From Date*</label>
                                            <input type="date" name="date" id="tournamentDate"
                                                class="form-control form-select-input" placeholder="Date" />
                                            <p class="error" id="tournamentDateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Till Date</label>
                                            <input type="date" name="toDate" id="tournamentToDate"
                                                class="form-control form-select-input" placeholder="Till Date" />
                                            <p class="error" id="tournamentToDateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Last date to apply</label>
                                            <input type="date" name="lastDate" class="form-control form-select-input"
                                                id="tournamentLastDate" placeholder="Last date to apply" />
                                            <p class="error">Please follow guidelines as per AITA rules.</p>
                                            <p class="error" id="tournamentLastDateError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group stayBoxYesNo">
                                            <p>Stay Facility</p>
                                            <input type="radio" value="No" name="stay" id="stayNo" checked>
                                            <label for="stayNo">No</label>
                                            <input type="radio" value="Yes" name="stay" id="stayYes">
                                            <label for="stayYes">Yes</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Prize Money</label>
                                            <input type="text" name="price" class="" id="tournamentPrice"
                                                placeholder="Prize Money" />
                                            <p class="error" id="tournamentPriceError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Whatsapp Link</label>
                                            <input type="text" name="whatsapp" id="tournamentWhatsappLink"
                                                placeholder="Enter whatsapp link" value="" />
                                            <p class="error" id="tournamentWhatsappLinkError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image</label>
                                            <input type="file" name="imageOne" class="form-control"
                                                placeholder="Image" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image Caption</label>
                                            <input type="text" name="captionOne" id="tournamentCaptionOne"
                                                placeholder="Enter Image Caption" value="" />
                                            <p class="error" id="tournamentCaptionOneError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image</label>
                                            <input type="file" name="imageTwo" class="form-control"
                                                placeholder="Image" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image Caption</label>
                                            <input type="text" name="captionTwo" id="tournamentCaptionTwo"
                                                placeholder="Enter Image Caption" value="" />
                                            <p class="error" id="tournamentCaptionTwoError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image</label>
                                            <input type="file" name="imageThree" class="form-control"
                                                placeholder="Image" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Image Caption</label>
                                            <input type="text" name="captionThree" id="tournamentCaptionThree"
                                                placeholder="Enter Image Caption" value="" />
                                            <p class="error" id="tournamentCaptionThreeError"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Factsheet</label>
                                            <input type="file" name="factsheet" class="form-control"
                                                placeholder="Factsheet" accept=".pdf,.jpeg,.jpg" />
                                            <p class="error" id="">Please follow factsheet as per tournament
                                                format.</p>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="theme-btn-one">
                                                Add
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
    <!-- create-tournament-section-end -->
@endsection

@section('script')
    <script>
        // const selectBtn = document.querySelector(".select-btn"),
        //     items = document.querySelectorAll(".selected-item-list");

        // selectBtn.addEventListener("click", () => {
        //     selectBtn.classList.toggle("open");
        // });

        // const tournamentSubCategoryElm = document.querySelector("#tournamentSubCategory[name = 'subCategory[]']")
        // // console.log(tournamentSubCategoryElm)
        // const tournamentSubCategoryValueElm = tournamentSubCategoryElm.value = []
        // items.forEach(item => {
        //     item.addEventListener("click", () => {
        //         item.classList.toggle("checked");

        //         let checked = document.querySelectorAll(".checked"),
        //             btnText = document.querySelector(".btn-text");
        //         const itemTextElm = item.querySelector(".item-text")

        //         let tournamentSubCategoryValueIndexElm = "";
        //         if (checked && checked.length > 0 && item.classList.contains("checked")) {
        //             btnText.innerText = `${checked.length} Selected`;
        //             tournamentSubCategoryValueElm.push(itemTextElm.innerText);
        //         } else if (checked && checked.length > 0 && !item.classList.contains("checked")) {
        //             btnText.innerText = `${checked.length} Selected`;
        //             tournamentSubCategoryValueIndexElm = tournamentSubCategoryValueElm.indexOf(
        //                 itemTextElm.innerText);
        //             tournamentSubCategoryValueElm.splice(tournamentSubCategoryValueIndexElm,
        //                 tournamentSubCategoryValueIndexElm !== -1 ? 1 : 0)
        //             // console.log(tournamentSubCategoryValueElm)
        //         } else {
        //             tournamentSubCategoryValueIndexElm = tournamentSubCategoryValueElm.indexOf(
        //                 itemTextElm.innerText);
        //             tournamentSubCategoryValueElm.splice(tournamentSubCategoryValueIndexElm,
        //                 tournamentSubCategoryValueIndexElm !== -1 ? 1 : 0)
        //             btnText.innerText = "Sub Category";
        //         }
        //         // console.log(tournamentSubCategoryValueElm)
        //     });
        // })
    </script>
@endsection
