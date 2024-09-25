@extends('admin.layout.layout')

@section('title')
    Kheldhaara | Admin | Edit Slider
@endsection

@section('style')

@endsection

@section('content')
    <div class="content-wrapper">
        <!--header content start-->
        <div class="content-header">
            <div clas="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Slider</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--end content header-->

        <section class="content">
            <div class='container-fluid'>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                    <form class="form-horizontal" action="{{ route('admin.storeSlider') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" name="id" value="{{$slide->id}}" hidden>   
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" placeholder="{{$slide->title}}"
                                                        name="bannertitle" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="image" class="col-sm-2 col-form-label">Selected Image:<img src="{{asset('assets/'.$slide->img_path)}}" width="40px" height="30px"> </label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div> 
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection

