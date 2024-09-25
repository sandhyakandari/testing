<div class="single-tab-content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="content">
                <div class="title">
                    <h3><strong>Tournament Details</strong></h3>
                </div>
                <ul class="info-box info-box-detail row equal-height">
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Academy Name: </b>{{ $tournament->name }}
                        </div>
                    </li>
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Academy Address: </b>{{ $tournament->address }}
                        </div>
                    </li>
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Surface: </b> {{ $tournament->surface }}
                        </div>
                    </li>
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Location: </b> {{ $tournament->city }}
                        </div>
                    </li>
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Category: </b> {{ $tournament->category }}
                        </div>
                    </li>
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Sub Category: </b> {{ $tournament->subCategory }}
                        </div>
                    </li>
                    @if ($tournament->whatsapp)
                        <li class="col-md-4">
                            <div class="col-info">
                                <b>Whatsapp: </b>
                                <a href="{{ $tournament->whatsapp }}" target="_blank">
                                    Whatsapp
                                </a>
                            </div>
                        </li>
                    @endif
                    <li class="col-md-4">
                        <div class="col-info">
                            <b>Stay Facilities: </b> {{ $tournament->stay }}
                        </div>
                    </li>
                    @if ($tournament->price)
                        <li class="col-md-4">
                            <div class="col-info">
                                <b>Price Money: </b> {{ $tournament->price }}
                            </div>
                        </li>
                    @endif
                    @if ($tournament->factsheet)
                        <li class="col-md-4">
                            <div class="col-info">
                                <b>Factsheet: </b> <a href="{{ $tournament->factsheet }}" target="_blank">Factsheet</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
