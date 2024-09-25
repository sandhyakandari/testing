@extends('admin.layout.layout')



@section('title')

    Kheldhaara | Admin | Add Image for Slider

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

                        <h1 class="m-0">Add New Slider </h1>

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

                                        <form class="form-horizontal" action="{{ route('admin.storeSlider') }}"

                                            method="POST" enctype="multipart/form-data">

                                            @csrf



                                            <div class="form-group row">

                                                <label for="" class="col-sm-2 col-form-label">Title</label>

                                                <div class="col-sm-10">

                                                    <input type="text" class="form-control" value=""

                                                        name="bannertitle" required >

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <label for="image" class="col-sm-2 col-form-label">Select Image</label>

                                                <div class="col-sm-10">

                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <div class="offset-sm-2 col-sm-10">

                                                    <button type="submit" class="btn btn-success">Add</button>

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

                        <h1 class="m-0">All Sliders</h1>

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

                              <table class="table table-bordered table-striped">

                                <thead>

                                    <tr>

                                        <th>title</th>

                                        <th>img</th>

                                        <th>Edit</th>

                                        <th>Delete</th>

                                    </tr>

                                </thead>

                                <tbody>

                                     @foreach($slides as $slide)

                                       <tr data-item-id="{{$slide->id}}">

                                        <td>{{$slide->title}}</td>

                                        <td><img src="{{asset('assets/'.$slide->img_path)}}" height="30px" width="50px"></td>

                                        <td><button  class="btn btn-primary edit-btn">Edit</button></td>

                                        <td><button  class="btn btn-danger del-btn">Delete</button></td>

                                      </tr>

                                    @endforeach

                                        

                                </tbody>

                              </table>

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

   

   document.querySelectorAll('.edit-btn').forEach(function(btn){

       btn.addEventListener('click',function(){

        let id=this.closest('tr').getAttribute('data-item-id');

        window.location.href="{{route("admin.editSlide",["id"=>':id']) }}".replace(':id',id);

       })

   })  



   document.querySelectorAll('.del-btn').forEach(function(btn){

        btn.addEventListener('click',function(){

            let id=this.closest('tr').getAttribute('data-item-id');

           window.location.href = "{{ route("admin.deleteSlide", ["id" =>':id']) }}".replace(':id',id);

   

        })

   })



    </script>

@endsection

