@extends('layout.layout')

@section('title')
    Kheldhaara | Rank
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/players_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Rank</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Rank</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}

    <section class="rank-section">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="table">
                        @if (count($ranks) > 0)
                            <div class="table-outer">
                                <table class="cart-table">
                                    <thead class="cart-header">
                                        <tr>
                                            <th>Rank</th>
                                            <th>Player Name</th>
                                            <th>Registration No.</th>
                                            <th>DOB</th>
                                            <th>State</th>
                                            <th>Total Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ranks as $rank)
                                            <tr class="item">
                                                <td>{{ $rank->rank }}</td>
                                                <td>{{ $rank->name }}</td>
                                                <td>{{ $rank->aita_number }}</td>
                                                <td>{{ date('d-m-Y', strtotime($rank->dob)) }}</td>
                                                <td>{{ $rank->state }}</td>
                                                <td>{{ $rank->score }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-outer">
                                <h1>No player available yet!</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script></script>
@endsection
