@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Academies
@endsection

@section('style')
    <style>
        .success-btn {
            border: none;
            min-height: 0px;
        }

        .custom-control.custom-checkbox {
            padding-left: 0px;
        }

        .custom-control-label {
            border: none;
        }

        .custom-control-label::before {
            left: 0;
        }

        .custom-control-label::after {
            left: 0;
        }

        .custom-switch.custom-switch-off-success .custom-control-input~.custom-control-label::after {
            left: unset;
            right: calc(1.25rem + 2px);
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
                        <h1 class="m-0">Academy</h1>
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
                                <h3 class="card-title">Academy List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="download-data">
                                    <a href="{{ route('admin.academyDownloadCsv') }}" class="btn btn-primary btn-sm"
                                        title="Download CSV">
                                        Download CSV
                                    </a>
                                </div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Detail</th>
                                            <th>Approve</th>
                                            <th>Show on Homepage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($academies as $index => $academy)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $academy->name }}
                                                </td>
                                                <td>{{ $academy->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.academyDetail', ['id' => $academy->academy_id]) }}"
                                                        class="btn btn-primary btn-sm" title="Detail">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($academy->publish == 0)
                                                        <a href="{{ route('admin.academyPublish', ['id' => $academy->academy_id]) }}"
                                                            class="custom-control custom-switch {{ $academy->publish === 0 ? 'custom-switch-off-danger' : 'custom-switch-off-success' }}"
                                                            title="{{ $academy->publish === 0 ? 'Unpublished' : 'Published' }}">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="unCheckedCheckbox" value="{{ $academy->publish }}"
                                                                id="customSwitch_{{ $academy->academy_id }}">
                                                            <span class="custom-control-label"
                                                                for="customSwitch_{{ $academy->academy_id }}"></span>
                                                        </a>
                                                    @elseif ($academy->publish == 1)
                                                        <a href="{{ route('admin.academyUnpublish', ['id' => $academy->academy_id]) }}"
                                                            class="custom-control custom-switch custom-switch-off-success success-btn"
                                                            title="Published">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="checkedCheckbox" value="{{ $academy->publish }}"
                                                                id="customSwitch_{{ $academy->academy_id }}" checked>
                                                            <span class="custom-control-label"
                                                                for="customSwitch_{{ $academy->academy_id }}"></span>
                                                        </a>
                                                    @else
                                                        <button type="button" class="custom-control" title="Published">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="error checkbox" value="" id="">
                                                            <span class="custom-control-label" for=""></span>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        @if ($academy->show_on_home == 'yes')
                                                            <form method="POST"
                                                                action="{{ route('admin.academyHideHomepage', ['id' => $academy->academy_id]) }}">
                                                                @csrf
                                                                <input
                                                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                                    type="checkbox"
                                                                    id="customCheckbox_{{ $academy->academy_id }}"
                                                                    title="Yes" checked="">
                                                                <button type="submit"
                                                                    for="customCheckbox_{{ $academy->academy_id }}"
                                                                    title="Yes" class="custom-control-label"></button>
                                                            </form>
                                                        @elseif($academy->show_on_home == 'no')
                                                            <form method="post"
                                                                action="{{ route('admin.academyShowHomepage', ['id' => $academy->academy_id]) }}">
                                                                @csrf
                                                                <input
                                                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                                    type="checkbox" title="No"
                                                                    id="customCheckbox_{{ $academy->academy_id }}">
                                                                <button type="submit"
                                                                    for="customCheckbox_{{ $academy->academy_id }}"
                                                                    class="custom-control-label" title="No"></button>
                                                            </form>
                                                        @else
                                                            <input
                                                                class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                                type="checkbox">
                                                            <label for="" class="custom-control-label"></label>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.academyUpdates', ['id' => $academy->academy_id]) }}"
                                                        class="btn btn-primary btn-sm" title="Update">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Detail</th>
                                            <th>Approve</th>
                                            <th>Show on Homepage</th>
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

    <script></script>
@endsection
