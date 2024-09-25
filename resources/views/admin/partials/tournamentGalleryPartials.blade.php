<div class="post">
    <div class="row">
        @if (count($get_tournament_images) > 0)
            @foreach ($get_tournament_images as $tournament_image)
                <div class="col-sm-4">
                    <div class="academy-box mb-3">
                        <img class="img-fluid" src="{{ $tournament_image->image }}" alt="Photo">
                    </div>
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
