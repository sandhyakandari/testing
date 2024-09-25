@extends('layout.layout')

@section('title')
    Kheldhaara | Academies
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/academy_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Academies</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Academies</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}


    {{-- academies-grid-start --}}
    <section class="news-section blog-grid blog-page overlay-style-one sec-pad-2 academies-section">
        <div class="container-fluid container-lg">
            <div class="row">
                @if (count($academies) > 0)
                    <div class="col-12 mb-3">
                        <div class="academies-search-box">
                            <div class="player-search player-search-name">
                                <form action="{{ route('academySearch') }}" method="post" id="">
                                    @csrf
                                    <div class="form-input-box">
                                        <input type="search" name="search" placeholder="Search Name/ City/ State"
                                            value="{{ $search ? $search : '' }}" id="" class="form-control">
                                        <span class="search-icon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                    <div class="form-button academy-reset-button">
                                        <button type="submit" class="theme-btn">Search</button>
                                        <button type="button" class="theme-btn"
                                            onclick="window.location.href='{{ route('academies') }}'">
                                            Reset
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @foreach ($academies as $index => $academy)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 news-column">
                            <div class="single-news-content inner-box">
                                <figure class="image-box">
                                    <img src="{{ $academy->photo }}" alt="">
                                    <!--Overlay Box-->
                                    <div class="overlay-box">
                                        <div class="overlay-inner">
                                            <div class="content">
                                                <a href="{{ route('academyDetail', ['id' => $academy->academy_id]) }}"
                                                    class="link">
                                                    <i class="icon fa fa-link"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <div class="lower-content">
                                    <h4><a
                                            href="{{ route('academyDetail', ['id' => $academy->academy_id]) }}">{{ $academy->name }}</a>
                                    </h4>
                                    <ul>
                                        <li><b>City: </b> {{ $academy->city }}</li>
                                        {{-- <li><b>Pin: </b> {{ $academy->pin }}</li> --}}
                                        <li><b>State: </b> {{ $academy->state }}</li>
                                        {{-- <li><b>AITA: </b> {{ $academy->aita_number }}</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-3 paginator-box">
                        {{ $academies->withQueryString()->links('layout.paginator') }}
                    </div>
                @else
                    <div class="col-12">
                        <h1>No academy found yet!</h1>
                    </div>
                @endif
            </div>
        </div>
    </section>
    {{-- academies-grid-end --}}
@endsection

@section('script')
    <script></script>
@endsection
