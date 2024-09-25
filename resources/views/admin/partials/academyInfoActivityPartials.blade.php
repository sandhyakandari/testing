<div class="post">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Academy Name</b> <a class="float-right">{{ $details->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Registration Number</b> <a class="float-right">{{ $details->aita_number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Stay Facility</b> <a class="float-right">{{ $details->stay }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Number Of Courts</b> <a class="float-right">{{ $details->no_of_court }}</a>
                        </li>
                        @if ($details->hard)
                            <li class="list-group-item">
                                <b>Hard Courts</b> <a class="float-right">{{ $details->hard }}</a>
                            </li>
                        @endif
                        @if ($details->clay)
                            <li class="list-group-item">
                                <b>Clay Courts</b> <a class="float-right">{{ $details->clay }}</a>
                            </li>
                        @endif
                        @if ($details->grass)
                            <li class="list-group-item">
                                <b>Grass Courts</b> <a class="float-right">{{ $details->grass }}</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>Address</b> <a class="float-right">{{ $details->address }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>City</b> <a class="float-right">{{ $details->city }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Pin</b> <a class="float-right">{{ $details->pin }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>State</b> <a class="float-right">{{ $details->state }}</a>
                        </li>
                    </ul>
                </div>
                @if ($host_tournaments)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tournaments</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Surface</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($host_tournaments as $index => $tournament)
                                        <tr>
                                            <td>
                                                <a
                                                    href="{{ route('admin.tournamentDetail', ['id' => $tournament->tournament_id]) }}">
                                                    {{ $tournament->tournamentName }}
                                                </a>
                                            </td>
                                            <td>{{ $tournament->category }}</td>
                                            <td>{{ $tournament->subCategory }}</td>
                                            <td>{{ $tournament->surface }}</td>
                                            <td>{{ $tournament->city }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
