<div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center player-img">
                <img class="profile-user-img img-fluid img-circle" src="{{ $details->photo }}"
                    alt="{{ $details->first_name }} {{ $details->middle_name }} {{ $details->last_name }}">
            </div>

            <h3 class="profile-username text-center">
                {{ $details->first_name }} {{ $details->middle_name }} {{ $details->last_name }}
            </h3>

            @if ($details->ita_number)
                <p class="text-muted text-center">{{ $details->ita_number }}</p>
            @endif

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Guardian Name</b> <a class="float-right">{{ $details->guardian_name }}</a>
                </li>
                <li class="list-group-item">
                    <b>Date Of Birth</b>
                    <a class="float-right">
                        {{ date('d-m-Y', strtotime($details->dob)) }}
                    </a>
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
                {{ $details->phone }}
            </p>
            <hr>

            <strong><i class="fas fa-book mr-1"></i> Email</strong>
            <p class="text-muted">{{ $details->email }}</p>
            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
            <p class="text-muted">
                <span class="tag tag-danger">{{ $details->address_1 }}</span>
                <span class="tag tag-info">{{ $details->address_2 }}</span>
                <span class="tag tag-success">{{ $details->district }}</span>
                <span class="tag tag-success">{{ $details->state }}</span>
                <span class="tag tag-success">{{ $details->country }}</span>
                <span class="tag tag-success">{{ $details->pin }}</span>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
