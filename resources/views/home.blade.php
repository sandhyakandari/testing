@extends('layout.layout')

@section('title')
    Kheldhaara | Home
@endsection

@section('content')
    {{-- Main Slider --}}
    <section class="main-slider custom-main-slider">
        <div class="main-slider-carousel owl-carousel owl-theme slide-nav">
          
            @foreach($slides as $slide)
              
              <div class="slide" style="background-image:url({{ asset('assets/'. $slide->img_path) }})">
                  <div class="container-fluid container-lg">
                        <div class="content">
                            <h1>{{$slide->title}}</h1>
                        </div>
                  </div>
               </div>
               @endforeach
        </div>
    </section>
    <div class="empty-box"></div>
    {{-- End Main Slider --}}


    <!-- about-style-two -->
    <section class="about-style-two sec-pad custom-about-section">
        <div class="container-fluid container-lg">
            <div class="sec-title centred">
                OUR AMBITION IS TO DELIVER <span>TENNIS <br />FOR FUTURE</span> GENERATIONS
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 about-column">
                    <div class="about-content">
                        <div class="head-content">
                            <div class="text">
                                <p>
                                    At Kheldhaara, we are dedicated to bringing together all sports-oriented
                                    individuals—Players, Coaches, Academies/Clubs and their fans—to manage their sports
                                    records seamlessly
                                    and to assist the Sports Community with ease through our advanced system-enabled
                                    services.
                                </p>
                                </p><br><br>
                            </div>
                            
                            @if (!session()->has('role') && !session()->has('id'))
                                <div class="link"><a href="{{ route('getLogin') }}" class="theme-btn">Get Started</a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 img-column">
                    <figure class="img-box">
                        <img src="{{ asset('assets/images/home_about.jpg') }}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- about-style-two -->

    <!-- upcoming-tournaments-section -->
    <section class="cart-section portfolio-section custom-this-week-tournaments-section">
        <div class="container-fluid container-lg">
            <ul class="sec-title">
                <li class="li-upcoming-tournaments">Upcoming tournaments</li>
            </ul>
            <div class="mixed-gallery-section">
               {{--
                <ul class="tab-container dropdown">
                    <li class="tab-btn dropdown dropdown-toggle activeTabBtn" id="dropdownUpcomingTournaments"
                        data-toggle="dropdown" data-role="button" data-filter="12">Juniors
                        <ul class="tab-container-junior dropdown-menu" aria-labelledby="dropdownUpcomingTournaments"
                            id="boysJuniorPlayerBtn">
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn activeTabBtn"
                                data-role="button" data-activeTab="junior" data-filter="12" data-subcategory="Under 12">
                                Under 12
                            </li>
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn" data-role="button"
                                data-filter="14" data-activeTab="junior" data-subcategory="Under 14">
                                Under 14
                            </li>
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn" data-role="button"
                                data-filter="16" data-activeTab="junior" data-subcategory="Under 16">
                                Under 16
                            </li>
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn" data-role="button"
                                data-filter="18" data-activeTab="junior" data-subcategory="Under 18">
                                Under 18
                            </li>
                        </ul>
                    </li>
                    <li class="tab-btn tab-container-btn subCategoryBtn check-tournament-btn" data-role="button"
                        data-filter="2" data-subcategory="Men's">
                        Men
                    </li>
                    <li class="tab-btn tab-container-btn subCategoryBtn check-tournament-btn" data-role="button"
                        data-filter="3" data-subcategory="Women's">
                        Women
                    </li>
                </ul>
                   --}}
                     <ul class="tab-container dropdown">
                    <li class="tab-btn dropdown dropdown-toggle activeTabBtn" id="dropdownUpcomingTournaments"
                        data-toggle="dropdown" data-role="button" data-filter="12">Juniors
                        <ul class="tab-container-junior dropdown-menu" aria-labelledby="dropdownUpcomingTournaments"
                            id="boysJuniorPlayerBtn">
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn activeTabBtn"
                                data-role="button" data-activeTab="juniors" data-filter="12" data-subcategory="Under 12">
                                Under 12
                            </li>
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn" data-role="button"
                                data-filter="14" data-activeTab="juniors" data-subcategory="Under 14">
                                Under 14
                            </li>
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn" data-role="button"
                                data-filter="16" data-activeTab="juniors" data-subcategory="Under 16">
                                Under 16
                            </li>
                            <li class="dropdown-item tab-btn subCategoryBtn check-tournament-btn" data-role="button"
                                data-filter="18" data-activeTab="juniors" data-subcategory="Under 18">
                                Under 18
                            </li>
                        </ul>
                    </li>
                    <li class="tab-btn tab-container-btn subCategoryBtn check-tournament-btn" data-role="button"
                        data-filter="2" data-subcategory="Men">
                        Men
                    </li>
                    <li class="tab-btn tab-container-btn subCategoryBtn check-tournament-btn" data-role="button"
                        data-filter="3" data-subcategory="Women">
                        Women
                    </li>
                </ul>

                <div class="row items-container clearfix">
                    <div class="col-12 masonry-item tab-item-col active">
                        
                            <h3 id="tournament-title">Junior's Championship - Under 12</h3>
                            <div class="col-xs-12 column">
                                <div class="table-outer custom_scoll_f">
                                    <table class="cart-table">
                                        <thead class="cart-header">
                                            <tr>
                                                <th>Tournament Name</th>
                                                <th>Academy Name</th>
                                                <th>Player Category</th>
                                                <th>Sub Category</th>
                                                <th>City</th>
                                                <th>Tournament Start Date</th>
                                                <th>Last Date To Apply</th>
                                                <th>Factsheet</th>
                                                <th>Register</th>     
					                        </tr>
                                        </thead>
                                        @if (count($fetchUpcomingTournaments) > 0)
                                        <tbody id="championshipData">
                                            @include('partials.home_upcoming_tournament_rows', [
                                                'fetchUpcomingTournaments' => $fetchUpcomingTournaments,
                                            ])
                                        </tbody>
                                            @else
                                            <tbody id="championshipData">
                                                <tr class="item">
                                                    <td colspan="9" style="text-align:center;">No tournament found in junior Under 12</td>
                                                </tr>
                                            </tbody>
                                            @endif
                                    </table>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="tab-more centred">
                    <a href="{{ route('tournamentCalendar') }}" class="tab-more-links">View Full Calendar</a>
                </div>
            </div>
        </div>
    </section>
    {{-- <p><a href="https://www.itftennis.com/en/" target="_blank">https://www.itftennis.com/en/</a></p>
    <p><a href="https://www.daviscup.com/en/home.aspx" target="_blank">https://www.daviscup.com/en/home.aspx</a></p>
    <p><a href="https://aitatennis.com/" target="_blank">https://aitatennis.com/</a></p> --}}
    <!-- upcoming-tournaments-section end -->


    <!-- Recent-Tournaments-Result-start -->
    {{-- <section class="event-grid overlay-style-two ranking-result">
        <div class="container-fluid container-lg">
            <ul class="section-title">
                <li>Recent Tournaments Result</li>
                <li><a href="{{ route('tournamentCalendar') }}" class="tab-btn">Check All</a></li>
            </ul>
            @if (count($recent_tournament_data) > 0)
                <ul class="tab-recent-result recent-result-btn-container">
                    <li class="dropdown tab-btn recent-result-btn dropdown-toggle active" id="dropdownRecentTournaments"
                        data-toggle="dropdown" data-tab="12">Junior's
                        <ul class="recent-result-btn-container-junior dropdown-menu"
                            aria-labelledby="dropdownRecentTournaments">
                            <li class="dropdown-item tab-btn recent-result-junior-player-btn fetchRecentTournament"
                                data-tab="12" data-category="Junior's" data-subcategory="Under 12">
                                Under 12
                            </li>
                            <li class="dropdown-item tab-btn recent-result-junior-player-btn fetchRecentTournament"
                                data-tab="14" data-category="Junior's" data-subcategory="Under 12">
                                Under 14
                            </li>
                            <li class="dropdown-item tab-btn recent-result-junior-player-btn fetchRecentTournament"
                                data-tab="16" data-category="Junior's" data-subcategory="Under 12">
                                Under 16
                            </li>
                            <li class="dropdown-item tab-btn recent-result-junior-player-btn fetchRecentTournament"
                                data-tab="18" data-category="Junior's" data-subcategory="Under 12">
                                Under 18
                            </li>
                        </ul>
                    </li>
                    <li class="tab-btn recent-result-btn fetchRecentTournament" data-tab="2" data-category="Senior's"
                        data-subcategory="Women's">
                        Women's
                    </li>
                    <li class="tab-btn recent-result-btn fetchRecentTournament" data-tab="3" data-category="Senior's"
                        data-subcategory="Men's">
                        Men's
                    </li>
                </ul>
                <div class="recent-result-content">
                    <div class="equal-height recent-result-12 recent-result recent-result-active">
                        <div class="three-column-carousel" id="recentTournament">
                            @include('partials.home_recent_tournament_rows', [
                                'recent_tournament_data' => $recent_tournament_data,
                            ])
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section> --}}
    <!-- Recent-Tournaments-Result end -->

    <!-- Academies section start -->
    <section class="event-grid overlay-style-two sec-pad-2 bg-light custom-academy">
        <div class="container-fluid container-lg">
            <ul class="sec-title d-flex justify-content-between">
                <li>Academies </li>
                <li><a href="{{ route('academies') }}" class="tab-btn">Check All</a></li>
            </ul>
            @if (count($fetchacademic_datas) > 0)
                
                <div class="row">
                    <div class="five-item-carousel">
                    @foreach ($fetchacademic_datas as $fetchacademic_data)
                        <div class="item col-lg-12 col-sm-12 p-1">
                            <div class="single-upcoming-event single-item">
                                <div class="image img-box tennis-item set-bg"
                                    data-setbg="{{ $fetchacademic_data->photo }}">
                                    <div class="overlay">
                                        <div class="overlay-content">
                                            <div class="content">
                                                <a
                                                    href="{{ route('academyDetail', ['id' => $fetchacademic_data->academy_id]) }}">
                                                    {{ $fetchacademic_data->name }}
                                                </a>
                                                <p>
                                                    {!! $limitedText = implode(' ', array_slice(explode(' ', $fetchacademic_data->aboutAcademy), 0, 30)) !!}
                                                </p>
                                                <a href="{{ route('academyDetail', ['id' => $fetchacademic_data->academy_id]) }}"
                                                    class="academy-link">
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="si-text">
                                        <h5>
                                            <a
                                                href="{{ route('academyDetail', ['id' => $fetchacademic_data->academy_id]) }}">
                                                {{ $fetchacademic_data->name }}
                                            </a>
                                        </h5>
                                        <ul>
                                            <li><i class="fa fa-globe"></i>{{ $fetchacademic_data->state }}</li>
                                            <li><i class="fa fa-globe"></i>{{ $fetchacademic_data->city }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                </div>
                </div>
                {{-- end code--}}
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="sec-title">
                            <h3>No academy found yet!</h3>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Academies section end -->

 <!-- top-ranked-players section start -->
    <section class="event-grid overlay-style-two sec-pad-2 custom-top-ranked-players ">
        <div class="container-fluid container-lg">
            <ul class="sec-title">
                <li>
                    <ul class="top-ranked-player-title">
                        <li>Rankings: Top-ranked players</li>
                         {{-- add ranking date by sandhya--}}
                        <li><span>Last Updated: </span> <span>
                            @if($ranking_date)
                            {{ date('d-m-Y',strtotime($ranking_date->date))}}
                            @else
                            02-03-2024
                            @endif
                        </span></li>
                        {{--end ranking date by sandhya --}}
                    </ul>

                </li>
                <li><a href="{{ route('players') }}" class="tab-btn">Check All</a></li>
            </ul>

            <ul class="dropdown tab-top-ranking-player top-ranking-btn-container ">
                <li class="dropdown tab-btn top-ranking-player-btn dropdown-toggle " id="girlPlayerDropdownMenu"
                    data-toggle="dropdown" data-tab="g-12">Girl's
                    <ul class="top-ranking-btn-container-junior-girl dropdown-menu" id="girlPlayerDropdownList"
                        aria-labelledby="girlPlayerDropdownMenu">
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-12">Under 12
                        </li>
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-14">Under 14
                        </li>
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-16">Under 16
                        </li>
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-18">Under 18
                        </li>
                    </ul>
                </li>
                <li class="dropdown tab-btn top-ranking-player-btn dropdown-toggle" id="playerDropdownMenu"
                    data-toggle="dropdown" data-tab="12">Boy's
                    <ul class="top-ranking-btn-container-junior dropdown-menu" id="playerDropdownList"
                        aria-labelledby="playerDropdownMenu">
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="12">Under 12</li>
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="14">Under 14</li>
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="16">Under 16</li>
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="18">Under 18</li>
                    </ul>
                </li>
                <li class="tab-btn top-ranking-player-btn" data-tab="2">Women</li>
                <li class="tab-btn top-ranking-player-btn" data-tab="3">Men</li>
            </ul>
           
            <div class="top-player-content player-page-section">
              
                <div class="equal-height top-ranking-player-g-12 top-ranking top-ranking-player-active col-12">
                    <div class="five-item-carousel">
                        @foreach ($girlsUnder12 as $player)
                            <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>

                        @endforeach
                        
                    </div>
                    @if(count($girlsUnder12)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
                <div class="equal-height top-ranking-player-g-14 top-ranking col-12">
                    <div class="five-item-carousel">
                        @foreach ($girlsUnder14 as $player)
                            <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                        
                         
                        @endforeach

                    </div>
                    @if(count($girlsUnder14)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
                <div class="equal-height top-ranking-player-g-16 top-ranking  col-12">
                    <div class="five-item-carousel">
                        @foreach ($girlsUnder16 as $player)
                        <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                      @endforeach
                    </div>
                    @if(count($girlsUnder16)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
                <div class="equal-height top-ranking-player-g-18 top-ranking col-12">
                    <div class="five-item-carousel">
                        @foreach ($girlsUnder18 as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>

                        @endforeach
                    </div>
                    @if(count($girlsUnder18)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
                <div class="equal-height top-ranking-player-12 top-ranking col-12">
                    <div class="five-item-carousel">
                        @foreach ($boysUnder12 as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                    @if(count($boysUnder12)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="equal-height top-ranking-player-14 top-ranking  col-12">
                    <div class="five-item-carousel">
                            @foreach ($boysUnder14 as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                    @if(count($boysUnder14)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="equal-height top-ranking-player-16 top-ranking col-12">
                    <div class="five-item-carousel">
                            @foreach ($boysUnder16 as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                    @if(count($boysUnder16)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="equal-height top-ranking-player-18 top-ranking col-12">
                    <div class="five-item-carousel">
                        @foreach ($boysUnder18 as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>
                @if(count($boysUnder18)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="equal-height top-ranking-player-3 top-ranking col-12">
                    <div class="five-item-carousel">
                        @foreach ($mens as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>
                @if(count($mens)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="equal-height top-ranking-player-2 top-ranking col-12">
                    <div class="five-item-carousel">
                        @foreach ($womens as $player)
                                    <div class="item col-12">
                                        <div class="single-cause-content inner-box player-info-box">
                                            <div class="single-upcoming-event single-item">
                                                <div class="image img-box">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        <figure>
                                                            <img src="{{ $player->photo }}"
                                                                alt=" {{$player->name}}
                                                            
                                                            ">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                                        {{$player->name}}
                                                        
                                                        
                                                    </a>
                                                </div>
                                                <p>{{ $player->rank }}</p>
                                              
                                            </div>
                                        </div>
                                    </div>
                    @endforeach
                </div>
                @if(count($womens)==0)
                        <div class="row">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h3>No Top ranked player found yet!</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- top-ranked-players section end -->


   {{--
    <!-- top-ranked-players section start -->
    <section class="event-grid overlay-style-two sec-pad-2 custom-top-ranked-players">
        <div class="container-fluid container-lg">
            <ul class="sec-title">
                <li>
                    <ul class="top-ranked-player-title">
                        <li>Rankings: Top-ranked players</li>
                        <li><span>Last Updated: </span> <span>{{ date('d-m-Y', strtotime($ranking_date->date))   }}</span></li>
                    </ul>
                </li>
                <li><a href="{{ route('players') }}" class="tab-btn">Check All</a></li>
            </ul>

            <ul class="dropdown tab-top-ranking-player top-ranking-btn-container">
                <li class="dropdown tab-btn top-ranking-player-btn dropdown-toggle " id="girlPlayerDropdownMenu"
                    data-toggle="dropdown" data-tab="g-12">Girls's
                    <ul class="top-ranking-btn-container-junior-girl dropdown-menu" id="girlPlayerDropdownList"
                        aria-labelledby="girlPlayerDropdownMenu">
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-12">Under 12
                        </li>
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-14">Under 14
                        </li>
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-16">Under 16
                        </li>
                        <li class="dropdown-item tab-btn top-ranking-junior-girl-player-btn" data-tab="g-18">Under 18
                        </li>
                    </ul>
                </li>
                <li class="dropdown tab-btn top-ranking-player-btn dropdown-toggle" id="playerDropdownMenu"
                    data-toggle="dropdown" data-tab="12">Boy's
                    <ul class="top-ranking-btn-container-junior dropdown-menu" id="playerDropdownList"
                        aria-labelledby="playerDropdownMenu">
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="12">Under 12</li>
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="14">Under 14</li>
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="16">Under 16</li>
                        <li class="dropdown-item tab-btn top-ranking-junior-player-btn" data-tab="18">Under 18</li>
                    </ul>
                </li>
                <li class="tab-btn top-ranking-player-btn" data-tab="2">Women's</li>
                <li class="tab-btn top-ranking-player-btn" data-tab="3">Men's</li>
            </ul>
            
            <div class="top-player-content">
                <div class="equal-height top-ranking-player-g-12 top-ranking top-ranking-player-active">
                    <div class="four-column-carousel">
                        @foreach ($girls as $girl)
                            <div class="single-cause-content inner-box">
                                <div class="single-upcoming-event single-item">
                                    <div class="championships-name">
                                        {{ $girl->name }}
                                    </div>
                                    <div class="image img-box flex-width">
                                        <a href="{{ route('players') }}">
                                            <figure>
                                                <img src="{{ $girl->photo }}" alt="">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="lower-content flex-width">
                                        <a href="{{ route('players') }}">
                                            <ul class="player-info">
                                                <li><b>Rank:</b> {{ $girl->rank }}</li>
                                                <li><b>Category:</b> {{ $girl->category }} {{ $girl->sub_category }}</li>
                                        
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="equal-height top-ranking-player-g-14 top-ranking ">
                    <div class="four-column-carousel">
                        @foreach ($girlsUnder14 as $girl)
                            <br />
                            <div class="single-cause-content inner-box">
                                <div class="single-upcoming-event single-item">
                                    <div class="championships-name">
                                        {{ $girl->name }}
                                    </div>
                                    <div class="image img-box flex-width">
                                        <a href="{{ route('players') }}">
                                            <figure>
                                                <img src="{{ $girl->photo }}" alt="">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="lower-content flex-width">
                                        <a href="{{ route('players') }}">
                                            <ul class="player-info">
                                                <li><b>Rank:</b> {{ $girl->rank }}</li>
                                                <li><b>Category:</b> {{ $girl->category }} {{ $girl->sub_category }}</li>
        
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="equal-height top-ranking-player-g-16 top-ranking ">
                    <div class="four-column-carousel">
                        @foreach ($girlsUnder16 as $girl)
                        <br />
                        <div class="single-cause-content inner-box">
                            <div class="single-upcoming-event single-item">
                                <div class="championships-name">
                                    {{ $girl->name }}
                                </div>
                                <div class="image img-box flex-width">
                                    <a href="{{ route('players') }}">
                                        <figure>
                                            <img src="{{ $girl->photo }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="lower-content flex-width">
                                    <a href="{{ route('players') }}">
                                        <ul class="player-info">
                                            <li><b>Rank:</b> {{ $girl->rank }}</li>
                                            <li><b>Category:</b> {{ $girl->category }} {{ $girl->sub_category }}</li>
                                            <li><b>City</b> Haryana</li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="equal-height top-ranking-player-g-18 top-ranking ">
                    <div class="four-column-carousel">
                        @foreach ($girlsUnder18 as $girl)
                        <br />
                        <div class="single-cause-content inner-box">
                            <div class="single-upcoming-event single-item">
                                <div class="championships-name">
                                    {{ $girl->name }}
                                </div>
                                <div class="image img-box flex-width">
                                    <a href="{{ route('players') }}">
                                        <figure>
                                            <img src="{{ $girl->photo }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="lower-content flex-width">
                                    <a href="{{ route('players') }}">
                                        <ul class="player-info">
                                            <li><b>Rank:</b> {{ $girl->rank }}</li>
                                            <li><b>Category:</b> {{ $girl->category }} {{ $girl->sub_category }}</li>
    
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="equal-height top-ranking-player-12 top-ranking">
                    <div class="four-column-carousel">
                        @foreach ($boysUnder12 as $boy)
                        <br />
                        <div class="single-cause-content inner-box">
                            <div class="single-upcoming-event single-item">
                                <div class="championships-name">
                                    {{ $boy->name }}
                                </div>
                                <div class="image img-box flex-width">
                                    <a href="{{ route('players') }}">
                                        <figure>
                                            <img src="{{ $boy->photo }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="lower-content flex-width">
                                    <a href="{{ route('players') }}">
                                        <ul class="player-info">
                                            <li><b>Rank:</b> {{ $boy->rank }}</li>
                                            <li><b>Category:</b> {{ $boy->category }} {{ $boy->sub_category }}</li>
    
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="equal-height top-ranking-player-14 top-ranking ">
                    <div class="four-column-carousel">
                            @foreach ($boysUnder14 as $boy)
                            <br />
                            <div class="single-cause-content inner-box">
                                <div class="single-upcoming-event single-item">
                                    <div class="championships-name">
                                        {{ $boy->name }}
                                    </div>
                                    <div class="image img-box flex-width">
                                        <a href="{{ route('players') }}">
                                            <figure>
                                                <img src="{{ $boy->photo }}" alt="">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="lower-content flex-width">
                                        <a href="{{ route('players') }}">
                                            <ul class="player-info">
                                                <li><b>Rank:</b> {{ $boy->rank }}</li>
                                                <li><b>Category:</b> {{ $boy->category }} {{ $boy->sub_category }}</li>
    
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="equal-height top-ranking-player-16 top-ranking ">
                    <div class="four-column-carousel">
                            @foreach ($boysUnder16 as $boy)
                            <br />
                            <div class="single-cause-content inner-box">
                                <div class="single-upcoming-event single-item">
                                    <div class="championships-name">
                                        {{ $boy->name }}
                                    </div>
                                    <div class="image img-box flex-width">
                                        <a href="{{ route('players') }}">
                                            <figure>
                                                <img src="{{ $boy->photo }}" alt="">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="lower-content flex-width">
                                        <a href="{{ route('players') }}">
                                            <ul class="player-info">
                                                <li><b>Rank:</b> {{ $boy->rank }}</li>
                                                <li><b>Category:</b> {{ $boy->category }} {{ $boy->sub_category }}</li>
                            
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="equal-height top-ranking-player-18 top-ranking ">
                    <div class="four-column-carousel">
                        @foreach ($boysUnder18 as $boy)
                        <br />
                        <div class="single-cause-content inner-box">
                            <div class="single-upcoming-event single-item">
                                <div class="championships-name">
                                    {{ $boy->name }}
                                </div>
                                <div class="image img-box flex-width">
                                    <a href="{{ route('players') }}">
                                        <figure>
                                            <img src="{{ $boy->photo }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="lower-content flex-width">
                                    <a href="{{ route('players') }}">
                                        <ul class="player-info">
                                            <li><b>Rank:</b> {{ $boy->rank }}</li>
                                            <li><b>Category:</b> {{ $boy->category }} {{ $boy->sub_category }}</li>
                                        
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
                <div class="equal-height top-ranking-player-2 top-ranking">
                    <div class="four-column-carousel">
                        @foreach ($mens as $men)
                        <br />
                        <div class="single-cause-content inner-box">
                            <div class="single-upcoming-event single-item">
                                <div class="championships-name">
                                    {{ $men->name }}
                                </div>
                                <div class="image img-box flex-width">
                                    <a href="{{ route('players') }}">
                                        <figure>
                                            <img src="{{ $men->photo }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="lower-content flex-width">
                                    <a href="{{ route('players') }}">
                                        <ul class="player-info">
                                            <li><b>Rank:</b> {{ $men->rank }}</li>
                                            <li><b>Category:</b> {{ $men->category }} {{ $men->sub_category }}</li>
                                            <li><b>City</b> Haryana</li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
                <div class="equal-height top-ranking-player-3 top-ranking">
                    <div class="four-column-carousel">
                        @foreach ($womens as $women)
                        <br />
                        <div class="single-cause-content inner-box">
                            <div class="single-upcoming-event single-item">
                                <div class="championships-name">
                                    {{ $women->name }}
                                </div>
                                <div class="image img-box flex-width">
                                    <a href="{{ route('players') }}">
                                        <figure>
                                            <img src="{{ $women->photo }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="lower-content flex-width">
                                    <a href="{{ route('players') }}">
                                        <ul class="player-info">
                                            <li><b>Rank:</b> {{ $women->rank }}</li>
                                            <li><b>Category:</b> {{ $women->category }} {{ $women->sub_category }}</li>
                                        </ul>
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                    @endforeach
                    @if(count($womens)<0)
                    @endif
                </div>
                </div>
            </div>
        </div>
    </section>
      --}}
    <!-- top-ranked-players section end -->
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const fetchRecentTournamentElm = document.querySelectorAll(".fetchRecentTournament")
            if (fetchRecentTournamentElm) {
                fetchRecentTournamentElm.forEach(btn => {
                    btn.addEventListener("click", event => {
                        event.preventDefault()
                        const attrValue = event.target.getAttribute("data-subcategory")
                        fetchRecentTournamentHandler(attrValue)
                        async function fetchRecentTournamentHandler(attrValue) {
                            var queryParams = new URLSearchParams({
                                sub_category: attrValue,
                            });

                            let response = await fetch(
                                "{{ route('fetchRecentTournamentResult') }}?" +
                                queryParams.toString(), {
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })

                            if (!response.ok) {
                                throw new Error('Server error: ' + response.statusText);
                            }

                            let data = await response.json();
                            // console.log("data is: ", data.tournaments)

                            document.getElementById("recentTournament").innerHTML = ""

                            if (data.tournaments.length > 0) {
                                data.tournaments.forEach(tournament => {
                                    console.log(tournament)
                                    const html = `
                                        <div class="single-cause-content inner-box recent-tournament-custom-block">
                                            <figure class="image-box">
                                                <img src="${tournament.imageOne}" alt="${tournament.tournamentName}">
                                                <div class="overlay-box custom-overlay-box">
                                                    <div class="overlay-inner custom-overlay-inner">
                                                        <div class="content custom-content">
                                                            <button class="link recent_tournament_result_photo">
                                                                <i class="icon fa fa-link"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="date custom-date">
                                                    <span>${new Date(tournament.fromDate).getDate()}</span>
                                                    ${new Date(tournament.fromDate).toLocaleString('default', { month: 'long' })}
                                                </div>
                                            </figure>
                                            <div class="lower-content recent-tournaments-lower-content">
                                                <h4><a href="${tournament.tournamentDetailUrl}">${tournament.tournamentName}</a></h4>
                                                <ul class="info-box">
                                                    <li class="recent=tournament-winner-runnerup">
                                                        <ul class="recent-tournament recent-tournament-winner">
                                                            <li>
                                                                <i class="fa fa-user"></i>
                                                                ${tournament.winner_first_name}
                                                                ${tournament.winner_middle_name}
                                                                ${tournament.winner_last_name}
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-user"></i>Rohani
                                                            </li>
                                                        </ul>
                                                        <ul class="recent-tournament recent-tournament-runnerup">
                                                            <li>
                                                                <i class="fa fa-user"></i>Mohan
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-user"></i>Mohani
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-map-marker"></i>
                                                        ${tournament.city}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    `;
                                    document.getElementById("recentTournament")
                                        .innerHTML += html;
                                })
                            } else {
                                document.getElementById("recentTournament").innerHTML =
                                    "No Tournaments Result Found Yet!"
                            }
                        }
                    })
                })
            }
        })
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const subCategoryBtnElm = document.querySelectorAll(
                ".subCategoryBtn");
            if (subCategoryBtnElm) {
                subCategoryBtnElm.forEach(btn => {
                    btn.addEventListener("click", event => {
                        event.preventDefault()
                        const attrValue = event.target.getAttribute("data-subcategory")
                        // console.log(attrValue)
                        fetchEarlistGirlChampionship(attrValue)
                        async function fetchEarlistGirlChampionship(attrValue) {
                            var queryParams = new URLSearchParams({
                                sub_category: attrValue
                            });

                            let response = await fetch(
                                "{{ route('fetchEarliestTournament') }}?" +
                                queryParams.toString(), {
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })

                            if (!response.ok) {
                                throw new Error('Server error: ' + response.statusText);
                            }

                            let data = await response.json();
                            document.getElementById("championshipData").innerHTML = "";
                            document.getElementById("tournament-title").innerText = "";
                            if (data.tournaments.length > 0) {
                                document.getElementById("tournament-title").innerText =   `${data.tournaments[0].category} Championship - ${ attrValue}`;
                                    ;
                                data.tournaments.forEach(tournament => {
                                   
                                           const html = `
                                        <tr class="item">
                                            <td>
                                                <a href="${tournament.tournamentDetailUrl}">
                                                    ${tournament.tournamentName}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="${tournament.academyDetailUrl}">${tournament.name}</a>
                                            </td>
                                            <td>${tournament.category}</td>
                                            <td>${tournament.subCategory}</td>
                                            <td>${tournament.city}</td>
                                            <td>${new Date(tournament.fromDate).toLocaleDateString('en-US')}</td>
                                            <td>${tournament.lastDate ? new Date(tournament.lastDate).toLocaleDateString('en-GB'):null}</td>
                                            <td>
                                                ${tournament.factsheet ? `<a href="${tournament.factsheet}" target="_blank" class="theme-btn factsheet-btn">Factsheet</a>` : ''}
                                            </td>
                                            <td>
                                            ${sessionStorage.getItem('id') && sessionStorage.getItem('role') ? `${sessionStorage.getItem('role') === 'Player' ? `
                                            <a href="${tournament.tournament_register}" class="theme-btn tournament-register-btn">Register</a>
                                            ` : `
                                            <a href="${tournament.login_url}" class="theme-btn tournament-register-btn">Register</a>
                                            `}` : `<a href="${tournament.login_url}" class="theme-btn tournament-register-btn">Register</a>`}
                                            </td>
                                        </tr>
                                    `;

                                    document.getElementById("championshipData")
                                        .innerHTML += html;
                                })
                            } else {
                                document.getElementById("championshipData").innerHTML =`<tr class="item">
                                                    <td colspan="9" style="text-align:center;">No tournament found yet!</td>
                                                </tr>`
                                    ;
                            }
                        }
                    })

                })
            }
        })
    </script>

     <script>
    document.addEventListener('DOMContentLoaded', function () {
    const dropdownMenu = document.querySelector('#playerDropdownMenu');
    const dropdownList = document.querySelector('#playerDropdownList');

    if (dropdownMenu && dropdownList) { 
        dropdownMenu.addEventListener('click', function(event) {
            event.stopPropagation();
            console.log(event.target);
            console.log(event.currentTarget);
            
            if (dropdownList.classList.contains('show')) {
                dropdownList.classList.remove('show');
            } else {
                dropdownList.classList.add('show');
            }
        });

        document.addEventListener('click', function(event) {
            if (!dropdownMenu.contains(event.target)) {
                dropdownList.classList.remove('show');
            }
        });
    } else {
        console.error(' #playerDropdownMenu or #playerDropdownList not');
    }
});
</script>


     {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
     {{--
      <script>
         document.addEventListener('DOMContentLoaded', function () {
             const topRankingBtnJuniorGirlContainer = document.querySelector('#playerDropdownMenu');
             if (topRankingBtnJuniorGirlContainer) { // Check if element is selected
                topRankingBtnJuniorGirlContainer.addEventListener('click', function(event) {
                    if (event.target && event.target.children[0].classList.contains('show')) {
                        const items = event.target.children[0].classList.remove('show');
                    }else{
                        event.target.children[0].classList.add('show');
                    }
                });
            } else {
                console.error('Element not found: .top-ranking-btn-container-junior-girl');
            }
         });
     </script>  --}}
@endsection
