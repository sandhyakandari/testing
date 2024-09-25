<div class="sec-title">Upcoming Tournaments</div>
@if (count($upcoming_tournaments) > 0)
    <div class="related-event-carousel">
        @foreach ($upcoming_tournaments as $tournament)
            <div class="single-upcoming-event single-item">
                <div class="image img-box">
                    <figure>
                        <img src="{{ $tournament->imageOne }}" alt="{{ $tournament->tournamentName }}">
                    </figure>
                    <div class="overlay">
                        <div class="overlay-content">
                            <div class="content">
                                <a class="link-btn"
                                    href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                    <i class="fa fa-link"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                        {{ date('M', strtotime($tournament->fromDate)) }}
                    </div>
                </div>
                <div class="lower-content">
                    <h4>
                        <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                            {{ $tournament->tournamentName }}
                        </a>
                    </h4>
                    <ul class="info-box">
                        <li>
                            <i class="fa fa-clock-o"></i>
                            {{ date('H:i:s', strtotime($tournament->fromDate)) }}
                        </li>
                        <li>
                            <i class="fa fa-map-marker"></i>
                            {{ $tournament->city }}
                        </li>
                    </ul>
                    <div class="link">
                        <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}"
                            class="theme-btn-two">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="title">
                <h3>No tournament found yet!</h3>
            </div>
        </div>
    </div>
@endif
