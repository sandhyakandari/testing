<div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{ $details->photo }}" alt="{{ $details->name }}">
            </div>

            <h3 class="profile-username text-center">{{ $details->name }}</h3>

            <p class="text-muted text-center">{{ $details->aita_number }}</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Owner Name</b> <a class="float-right">{{ $details->owner_name }}</a>
                </li>
                <li class="list-group-item">
                    <b>Register Player</b> <a class="float-right">{{ count($registered_players) }}</a>
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
            <strong><i class="fas fa-pencil-alt mr-1"></i> Phone</strong>

            <p class="text-muted">
                +{{ $details->country_code }} {{ $details->phone }}
            </p>

            <hr>

            <strong><i class="fas fa-book mr-1"></i> Email</strong>

            <p class="text-muted">{{ $details->email }}</p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">
                <span class="tag tag-danger">{{ $details->city }}</span>
                <span class="tag tag-info">{{ $details->state }}</span>
                <span class="tag tag-success">{{ $details->pin }}</span>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
