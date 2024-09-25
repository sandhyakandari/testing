@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Tournaments
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
                        <h1 class="m-0">Tournaments</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tournament List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="download-data">
                                    <a href="{{ route('admin.tournamentDownloadCsv') }}" class="btn btn-primary btn-sm"
                                        title="Download CSV">
                                        Download CSV
                                    </a>
                                </div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>City</th>
                                            <th>Detail</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tournaments as $index => $tournament)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $tournament->tournamentName }}</td>
                                                <td>{{ $tournament->category }}</td>
                                                <td>{{ $tournament->city }}</td>
                                                <td>
                                                    <a href="{{ route('admin.tournamentDetail', ['id' => $tournament->tournament_id]) }}"
                                                        class="btn btn-primary btn-sm" title="Detail">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.tournamentDelete', ['id' => $tournament->tournament_id]) }}"
                                                        class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>City</th>
                                            <th>Detail</th>
                                            <th>Action</th>
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
