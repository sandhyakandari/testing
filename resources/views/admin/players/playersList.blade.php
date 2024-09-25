@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Players
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
                        <h1 class="m-0">Players</h1>
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
                                <h3 class="card-title">Players List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="d-flex">
                                    <!-- <div class="col-md-6"> -->
                                    <div class="download-data mr-auto">
                                        <a href="{{ route('admin.playerDownloadCsv') }}" class="btn btn-primary btn-sm"
                                            title="Download CSV">
                                            Download CSV
                                        </a>
                                    </div>
                                    <!-- </div> -->
                                    <div class="p-2">
                                        <section class="content">
                                            <select class="form-control" id="filter">
                                                <option value="all">All Category</option>
                                                <optgroup label="Boys">
                                                    <option value="boys_under_12">Boys Under 12</option>
                                                    <option value="boys_under_14">Boys Under 14</option>
                                                    <option value="boys_under_16">Boys Under 16</option>
                                                    <option value="boys_under_18">Boys Under 18</option>
                                                </optgroup>
                                                <optgroup label="Girls">
                                                    <option value="girls_under_12">Girls Under 12</option>
                                                    <option value="girls_under_14">Girls Under 14</option>
                                                    <option value="girls_under_16">Girls Under 16</option>
                                                    <option value="girls_under_18">Girls Under 18</option>
                                                </optgroup>
                                                <option value="men">Men</option>
                                                <option value="women">Women</option>
                                            </select>
                                        </section>
                                    </div>
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
                                        @foreach ($players as $index => $player)
                                            <tr data-age="{{ $player->age }}" data-gender="{{ $player->gender }}">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $player->first_name }} {{ $player->middle_name }}
                                                    {{ $player->last_name }}</td>
                                                <td>{{ $player->email }}</td>
                                                <td>
                                                    <a href="{{ route('admin.playerDetail', ['id' => $player->player_id]) }}"
                                                        class="btn btn-primary btn-sm" title="Detail">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($player->publish == 0)
                                                        <a href="{{ route('admin.playerPublish', ['id' => $player->player_id]) }}"
                                                            class="custom-control custom-switch custom-switch-off-danger"
                                                            title="Unpublished">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="unCheckedCheckbox" value="{{ $player->publish }}"
                                                                id="customSwitch_{{ $player->player_id }}">
                                                            <span class="custom-control-label"
                                                                for="customSwitch_{{ $player->player_id }}"></span>
                                                        </a>
                                                    @elseif($player->publish == 1)
                                                        <a href="{{ route('admin.playerUnpublish', ['id' => $player->player_id]) }}"
                                                            class="custom-control custom-switch custom-switch-off-success success-btn"
                                                            title="Published">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="checkedCheckbox" value="{{ $player->publish }}"
                                                                id="customSwitch_{{ $player->player_id }}" checked>
                                                            <span class="custom-control-label"
                                                                for="customSwitch_{{ $player->player_id }}"></span>
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                            class="custom-control custom-switch custom-switch-off-success success-btn"
                                                            title="Published">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="unCheckedCheckbox" value=""
                                                                id="customSwitch_{{ $player->player_id }}">
                                                            <span class="custom-control-label"
                                                                for="customSwitch_{{ $player->player_id }}"></span>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        @if ($player->show_on_home == 'yes')
                                                            <form method="POST"
                                                                action="{{ route('admin.playerHideHomepage', ['id' => $player->player_id]) }}">
                                                                @csrf
                                                                <input
                                                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                                    type="checkbox"
                                                                    id="customCheckbox_{{ $player->player_id }}"
                                                                    title="Yes" checked="">
                                                                <button type="submit"
                                                                    for="customCheckbox_{{ $player->player_id }}"
                                                                    title="Yes" class="custom-control-label"></button>
                                                            </form>
                                                        @elseif($player->show_on_home == 'no')
                                                            <form method="post"
                                                                action="{{ route('admin.playerShowHomepage', ['id' => $player->player_id]) }}">
                                                                @csrf
                                                                <input
                                                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                                                    type="checkbox" title="No"
                                                                    id="customCheckbox_{{ $player->player_id }}">
                                                                <button type="submit"
                                                                    for="customCheckbox_{{ $player->player_id }}"
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
                                                    <a href="{{ route('admin.playerUpdates', ['id' => $player->player_id]) }}"
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
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false
            });

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var selectedCategory = $('#filter').val();
                    var age = parseInt(table.row(dataIndex).node().getAttribute('data-age'));
                    var gender = table.row(dataIndex).node().getAttribute('data-gender');
                    var show = false;

                    if (selectedCategory === 'all') {
                        show = true;
                    } else if (selectedCategory === 'boys_under_12' && age <= 12 && gender === 'Male') {
                        show = true;
                    } else if (selectedCategory === 'boys_under_14' && age > 12 && age <= 14 && gender ===
                        'Male') {
                        show = true;
                    } else if (selectedCategory === 'boys_under_16' && age > 14 && age <= 16 && gender ===
                        'Male') {
                        show = true;
                    } else if (selectedCategory === 'boys_under_18' && age > 16 && age <= 18 && gender ===
                        'Male') {
                        show = true;
                    } else if (selectedCategory === 'girls_under_12' && age <= 12 && gender === 'Female') {
                        show = true;
                    } else if (selectedCategory === 'girls_under_14' && age > 12 && age <= 14 && gender ===
                        'Female') {
                        show = true;
                    } else if (selectedCategory === 'girls_under_16' && age > 14 && age <= 16 && gender ===
                        'Female') {
                        show = true;
                    } else if (selectedCategory === 'girls_under_18' && age > 16 && age <= 18 && gender ===
                        'Female') {
                        show = true;
                    } else if (selectedCategory === 'men' && age > 18 && gender === 'Male') {
                        show = true;
                    } else if (selectedCategory === 'women' && age > 18 && gender === 'Female') {
                        show = true;
                    }

                    return show;
                }
            );

            $('#filter').change(function() {
                table.draw();
            });
        });
    </script>
@endsection