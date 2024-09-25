<div class="post">
    @if ($tournament->imageOne || $tournament->imageTwo || $tournament->imageThrees)
        <div class="row">
            @if ($tournament->imageOne)
                <div class="col-sm-4">
                    <div class="academy-box mb-3 tournaments-images">
                        <img class="img-fluid w-100 d-block" src="{{ $tournament->imageOne }}" alt="Photo">
                    </div>
                    @if ($tournament->captionOne)
                        <p class="text-muted">
                            {{ $tournament->captionOne }}
                        </p>
                    @endif
                </div>
            @endif
            @if ($tournament->imageTwo)
                <div class="col-sm-4">
                    <div class="academy-box mb-3 tournaments-images">
                        <img class="img-fluid w-100 d-block" src="{{ $tournament->imageTwo }}" alt="Photo">
                    </div>
                    @if ($tournament->captionTwo)
                        <p class="text-muted">
                            {{ $tournament->captionTwo }}
                        </p>
                    @endif
                </div>
            @endif
            @if ($tournament->imageThree)
                <div class="col-sm-4">
                    <div class="academy-box mb-3 tournaments-images">
                        <img class="img-fluid w-100 d-block" src="{{ $tournament->imageThree }}" alt="Photo">
                    </div>
                    @if ($tournament->captionThree)
                        <p class="text-muted">
                            {{ $tournament->captionThree }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Tournament Name</b> <a class="float-right">{{ $tournament->tournamentName }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Academy Name</b> <a class="float-right">{{ $tournament->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Category</b> <a class="float-right">{{ $tournament->category }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sub Category</b> <a class="float-right">{{ $tournament->subCategory }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Surface</b> <a class="float-right">{{ $tournament->surface }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>City</b> <a class="float-right">{{ $tournament->city }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tournament Start Date</b> <a
                                class="float-right">{{ date('d-m-Y', strtotime($tournament->fromDate)) }}</a>
                        </li>
                        @if ($tournament->toDate)
                            <li class="list-group-item">
                                <b>Tournament End Date</b> <a
                                    class="float-right">{{ date('d-m-Y', strtotime($tournament->toDate)) }}</a>
                            </li>
                        @endif
                        @if ($tournament->lastDate)
                            <li class="list-group-item">
                                <b>Last Date To Apply</b> <a
                                    class="float-right">{{ date('d-m-Y', strtotime($tournament->lastDate)) }}</a>
                            </li>
                        @endif

                        <li class="list-group-item">
                            <b>Stay Facilities</b> <a class="float-right">{{ $tournament->stay }}</a>
                        </li>
                        @if ($tournament->price)
                            <li class="list-group-item">
                                <b>Prize Money</b> <a class="float-right">{{ $tournament->price }}</a>
                            </li>
                        @endif
                        @if ($tournament->whatsapp)
                            <li class="list-group-item">
                                <b>Whatsapp Link</b> <a href="{{ $tournament->whatsapp }}" target="_blank"
                                    class="float-right">{{ $tournament->whatsapp }}</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>Status</b> <a class="float-right">{{ $tournament->status }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
