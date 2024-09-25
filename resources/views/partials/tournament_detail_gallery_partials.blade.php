@if ($tournament->imageOne || $tournament->imageTwo || $tournament->imageThree)
    <div class="news-section blog-grid blog-page overlay-style-one">
        <div class="row">
            @if ($tournament->imageOne)
                <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                    <div class="single-news-content inner-box">
                        <figure class="image-box">
                            <img src="{{ $tournament->imageOne }}" alt="{{ $tournament->captionOne }}">
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
                                {{ $tournament->captionOne }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($tournament->imageTwo)
                <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                    <div class="single-news-content inner-box">
                        <figure class="image-box">
                            <img src="{{ $tournament->imageTwo }}" alt="{{ $tournament->captionTwo }}">
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
                                {{ $tournament->captionTwo }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($tournament->imageThree)
                <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                    <div class="single-news-content inner-box">
                        <figure class="image-box">
                            <img src="{{ $tournament->imageThree }}" alt="{{ $tournament->captionThree }}">
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
                                {{ $tournament->captionThree }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
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
