@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Tournament-Detail
@endsection

@section('style')
    <style>
        .tournament-profile {
            width: 150px;
            height: 150px;
            overflow: hidden;
            margin-inline: auto;
        }

        .tournament-profile img {
            width: 100%;
            height: 100%;
        }

        .tournaments-images {
            height: 200px;
        }

        .tournaments-images img {
            height: 100%;
            object-fit: cover;
            object-position: center;
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
                        <h1 class="m-0">{{ $tournament->tournamentName }}
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
                    @include('admin.partials.tournamentLeftSidebarPartials', ['tournament' => $tournament])
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#activity" data-toggle="tab">
                                            Activity
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#gallery" data-toggle="tab">
                                            Gallery
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#matches" data-toggle="tab">
                                            Matches
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#result" data-toggle="tab">
                                            Result
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    {{-- tournament-activity-start --}}
                                    <div class="active tab-pane" id="activity">
                                        @include('admin.partials.tournamentActivityPartials', [
                                            'tournament' => $tournament,
                                        ])
                                    </div>
                                    <!-- /.tournament-activity-end -->
                                    {{-- tournament-gallery-start --}}
                                    <div class="tab-pane" id="gallery">
                                        @include('admin.partials.tournamentGalleryPartials', [
                                            'tournament' => $tournament,
                                            'get_tournament_images' => $get_tournament_images,
                                        ])
                                    </div>
                                    <!-- /.tournament-gallery-end -->
                                    {{-- tournament-matches --}}
                                    <div class="tab-pane" id="matches">
                                        @include('admin.partials.tournamentMatchesPartials')
                                    </div>
                                    {{-- tournament-matches-end --}}
                                    <!-- /.tab-pane -->
                                    {{-- tournament-result --}}
                                    <div class="tab-pane" id="result">
                                        @include('admin.partials.tournamentResultPartials')
                                    </div>
                                    <!-- /.tournament-result-end -->
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
            $("#example").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "searching": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
