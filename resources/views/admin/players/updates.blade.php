@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Player-Update
@endsection

@section('style')
    <style>
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
                        <h1 class="m-0">Update Eamil</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active">
                                        <form class="form-horizontal" action="{{ route('admin.playerEmailUpdate') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="player_id" value="{{ $player->player_id }}">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $player->first_name }} {{ $player->middle_name }} {{ $player->last_name }}"
                                                        required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Current Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $player->email }}"
                                                        name="cEmail" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">New Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="" name="nEmail"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Update</button>
                                                </div>
                                            </div>
                                        </form>
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
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update AITA Number</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active">
                                        <form class="form-horizontal" action="{{ route('admin.playerAitaUpdate') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="player_id" value="{{ $player->player_id }}">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $player->first_name }} {{ $player->middle_name }} {{ $player->last_name }}"
                                                        required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Current AITA
                                                    Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"
                                                        value="{{ $player->ita_number }}" name="Cita_number" required
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">New AITA
                                                    Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value=""
                                                        name="nita_number" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Update</button>
                                                </div>
                                            </div>
                                        </form>
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
    <script></script>
@endsection
