@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Academies
@endsection

@section('style')
    <style>
        .card-header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .card-header-box h3 {
            flex-basis: 50%;
        }

        .card-header-box .form-box-date {
            flex-basis: 50%;
            display: flex;
            justify-content: end;
            align-items: center;
        }

        .card-header-box .form-box-date .update-date-form {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .card-header-box form .form-group {
            margin-bottom: 0;
        }

        .card-header-box form .form-group:last-child {
            margin-top: 30px;
        }

        .card-header-box form input,
        .card-header-box form label {
            display: block;
        }

        .delete-btn-box {
            margin-top: 30px;
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
                        <h1>Rank</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">
                                <form action="{{ route('admin.importRankings') }}" method="POST" name="rankingUpdateForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="addUpdateRanking">Add/ Update Rank</label>
                                    <input type="file" name="file" id="addUpdateRanking"
                                        style="display: none;"accept=".csv" required>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Add/ Update
                                    </button>
                                </form>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h3 class="card-title">Player Rank List</h3>
                                <div class="form-box-date">
                                    <form action="{{ route('admin.rankAddedDate') }}" method="post"
                                        class="update-date-form">
                                        @csrf
                                        <div class="form-group mr-2">
                                            <label for="date">Updated Date</label>
                                            <input type="date" name="date" id="date" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                    <div class="delete-btn-box ml-2">
                                        <form action="{{ route('admin.deleteRankAllData') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="delete_data" value="delete">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Player Name</th>
                                            <th>Reg Number</th>
                                            <th>DOB</th>
                                            <th>State</th>
                                            <th>Total Points</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ranks as $index => $rank)
                                            <tr>
                                                <td>{{ $rank->rank }}</td>
                                                <td>{{ $rank->name }}</td>
                                                <td>{{ $rank->aita_number }}</td>
                                                <td>{{ date('d-m-Y', strtotime($rank->dob)) }}</td>
                                                <td>{{ $rank->state }}</td>
                                                <td>{{ $rank->score }}</td>
                                                {{-- <td>
                                                    <a href="{{ route('admin.updateRanking', ['r_id' => $rank->rank_id]) }}"
                                                        class="btn btn-block btn-primary btn-sm" title="Update Rank">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.deleteRanking', ['r_id' => $rank->rank_id]) }}"
                                                        class="btn btn-block btn-danger btn-sm" title="Delete Rank">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Player Name</th>
                                            <th>Reg Number</th>
                                            <th>DOB</th>
                                            <th>State</th>
                                            <th>Total Points</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
                "buttons": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
