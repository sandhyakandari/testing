@if (count($get_entries) > 0)
    <div class="news-section blog-grid blog-page overlay-style-one">
        <div class="row">
            @foreach ($get_entries as $index => $player)
                <div class="col-lg-4 col-md-6 col-sm-12 news-column">
                    <div class="single-news-content inner-box">
                        <figure class="image-box">
                            <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                <img src="{{ $player->photo }}"
                                    alt="{{ $player->first_name }} {{ $player->middle_name }} {{ $player->last_name }}">
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <div class="content">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </figure>
                        <div class="lower-content">
                            <a href="{{ route('playerDetail', ['id' => $player->player_id]) }}">
                                {{ $player->first_name }}
                                {{ $player->middle_name }}
                                {{ $player->last_name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
