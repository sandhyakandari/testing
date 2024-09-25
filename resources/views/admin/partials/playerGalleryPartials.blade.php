<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ $details->photo }}"
            alt="{{ $details->first_name }} {{ $details->middle_name }}
                {{ $details->last_name }}">
        <span class="username">
            <p>{{ $details->first_name }} {{ $details->middle_name }}
                {{ $details->last_name }}</p>
        </span>
    </div>
    <!-- /.user-block -->
    <div class="row">
        @if (count($player_images) > 0)
            @foreach ($player_images as $player_image)
                <div class="col-sm-4">
                    <div class="academy-box mb-3">
                        <img class="img-fluid" src="{{ $player_image->image }}" alt="Photo">
                    </div>
                    <p>{{ $player_image->caption }}</p>
                </div>
            @endforeach
        @else
            <div class="col-sm-12">
                <h1>No Image Found</h1>
            </div>
        @endif
        <!-- /.col -->
    </div>
</div>
