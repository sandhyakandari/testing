<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ $details->photo }}" alt="Academy Image">
        <span class="username">
            <p>{{ $details->name }}</p>
        </span>
    </div>
    <!-- /.user-block -->
    <div class="row">
        @if (count($academy_images) > 0)
            @foreach ($academy_images as $academy_image)
                <div class="col-sm-4">
                    <div class="academy-box mb-3">
                        <img class="img-fluid" src="{{ $academy_image->image }}" alt="{{ $details->name }}">
                    </div>
                    <p class="text-muted">{{ $academy_image->caption }}</p>
                </div>
            @endforeach
        @else
            <div class="col-sm-12">
                <h1 class="text-muted">No Image Found</h1>
            </div>
        @endif
        <!-- /.col -->
    </div>
</div>
