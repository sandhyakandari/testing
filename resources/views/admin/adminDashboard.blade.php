@extends('admin.layout.layout')

@section('title')
    Dashboard
@endsection

@section('style')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $players }}</h3>

                                <p>Players</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-bag"></i> --}}
                            </div>
                            <a href="{{ route('admin.playerList') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $academies }}</h3>

                                <p>Academy</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-stats-bars"></i> --}}
                            </div>
                            <a href="{{ route('admin.academyList') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $tournaments }}</h3>
                                <p>Tournaments</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-person-add"></i> --}}
                            </div>
                            <a href="{{ route('admin.tournamentsList') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$visitors}}</h3>
                                      
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-pie-graph"></i> --}}
                            </div>
                            <a href="{{route('admin.Visitors')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
@endsection
