@foreach ($recent_tournament_data as $tournament)
    <div class="single-cause-content inner-box recent-tournament-custom-block">
        <figure class="image-box">
            <img src="{{ $tournament->imageOne }}" alt="{{ $tournament->tournamentName }}">
            <!--Overlay Box-->
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
                <span>{{ date('d', strtotime($tournament->fromDate)) }}</span>
                {{ date('M', strtotime($tournament->fromDate)) }}
            </div>
        </figure>
        <div class="lower-content recent-tournaments-lower-content">
            <h4>
                <a href="{{ route('tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                    {{ $tournament->tournamentName }}
                </a>
            </h4>
            <ul class="info-box">
                <li class="recent=tournament-winner-runnerup">
                    <ul class="recent-tournament recent-tournament-winner">
                        <li>
                            <i class="fa fa-user"></i>
                            {{ $tournament->winner_first_name }}&nbsp;{{ $tournament->winner_last_name }}
                        </li>
                        <li>
                            <i class="fa fa-user"></i>
                            Runner Up
                        </li>
                    </ul>
                    <ul class="recent-tournament recent-tournament-runnerup">
                        <li>
                            <i class="fa fa-user"></i>
                            {{ $tournament->runnerup_first_name }}&nbsp;{{ $tournament->runnerup_last_name }}
                        </li>
                        <li>
                            <i class="fa fa-user"></i>
                            Runner Up
                        </li>
                    </ul>
                </li>
                <li><i class="fa fa-map-marker"></i>{{ $tournament->city }}</li>
            </ul>
        </div>
    </div>
@endforeach
