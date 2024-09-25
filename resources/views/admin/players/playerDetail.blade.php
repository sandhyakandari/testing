@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Academy-Detail
@endsection

@section('style')
    <style>
        .player-img {
            width: 150px;
            height: 150px;
            overflow: hidden;
            margin-inline: auto;
        }

        .player-img img {
            width: 100%;
            height: 100%;
            object-position: center;
            object-fit: cover;
        }

        .academy-box {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .academy-box img {
            width: 100%;
            height: 100%;
            object-position: top;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $details->first_name }} {{ $details->middle_name }} {{ $details->last_name }}
                        </h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('admin.partials.player-left-sidebar-partials', [
                        'details' => $details,
                    ])
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#gallery" data-toggle="tab">
                                            Gallery
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pastTournaments" data-toggle="tab">
                                            Past Tournaments
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#upcomingTournaments" data-toggle="tab">
                                            Upcomin Tournaments
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tournamentsResult" data-toggle="tab">
                                            Result
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Gallery-tab -->
                                    <div class="active tab-pane" id="gallery">
                                        @include('admin.partials.playerGalleryPartials', [
                                            'details' => $details,
                                            'player_images' => $player_images,
                                        ])
                                    </div>
                                    <!-- /.Gallery-tab-end -->

                                    <!-- /.Past-tournaments-pane -->
                                    <div class="tab-pane" id="pastTournaments">
                                        @include('admin.partials.playerPastTournamentPartials', [
                                            'details' => $details,
                                        ])
                                    </div>
                                    <!-- /.Past-tournaments-pane-end -->

                                    <!-- /.Past-tournaments-pane -->
                                    <div class="tab-pane" id="upcomingTournaments">
                                        @include('admin.partials.playerUpcomingTournamentPartials', [
                                            'details' => $details,
                                        ])
                                    </div>
                                    <!-- /.Past-tournaments-pane-end -->

                                    <div class="tab-pane" id="tournamentsResult">
                                        @include('admin.partials.playerResultPartials', [
                                            'details' => $details,
                                        ])
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "searching": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(function() {
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "searching": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(function() {
            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "searching": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script></script>
@endsection
