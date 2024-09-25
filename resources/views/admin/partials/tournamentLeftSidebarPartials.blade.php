<div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center tournament-profile">
                <img class="profile-user-img img-fluid img-circle" src="{{ $tournament->imageOne }}"
                    alt="{{ $tournament->tournamentName }}">
            </div>

            <h3 class="profile-username text-center">
                {{ $tournament->captionOne }}
            </h3>

            <p class="text-muted text-center">{{ $tournament->category }}</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Category</b> <a class="float-right">{{ $tournament->category }}</a>
                </li>
                <li class="list-group-item">
                    <b>Sub Category</b> <a class="float-right">{{ $tournament->subCategory }}</a>
                </li>
            </ul>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- About Me Box -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($tournament->whatsapp)
                <strong><i class="fas fa-pencil-alt mr-1"></i>Whatsapp</strong>
                <a href="{{ $tournament->whatsapp }}" target="_blank" class="text-muted">
                    {{ $tournament->whatsapp }}
                </a>
                <hr>
            @endif
            @if ($tournament->city)
                <strong><i class="fas fa-book mr-1"></i>City</strong>
                <p class="text-muted">{{ $tournament->city }}</p>
                <hr>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
