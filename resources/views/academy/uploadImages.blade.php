@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Upload-Images
@endsection

@section('content')
    <!--page-title-two-->
    <section class="page-title-two">
        <div class="title-box centred bg-color-2">
            <div class="pattern-layer">
                <div class="pattern-1"
                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-70.png') }});"></div>
                <div class="pattern-2"
                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-71.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="title">
                    <h1>Upload Images</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Upload Images</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- academy-upload-images-section-start -->
    <section class="doctors-dashboard bg-color-3 academy-upload-img-section">
        @include('layoutTwo.academySidebar')


        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="add-listing my-profile">
                        <div class="single-box">
                            <div class="title-box">
                                <h3>Upload Images</h3>
                            </div>
                            <div class="inner-box">
                                <div class="profile-title">
                                    <figure class="image-box">
                                        <img src="{{ $academy_image }}" alt="{{ $academy_name }}">
                                    </figure>
                                    <div class="upload-photo">
                                        <form action="{{ route('academy.uploadImages') }}" method="POST"
                                            enctype="multipart/form-data" name="uploadImages">
                                            @csrf
                                            <div class="form-group">
                                                <input type="file" name="image" id="image"
                                                    class="form-control-fils" accept="image/png, image/jpeg, image/jpg">
                                                <span>Allowed JPG, JPEG, and PNG.</span>
                                                <p class="error" id="imageError"></p>
                                            </div>
                                            <div class="form-group caption-input mb-3">
                                                <label for="caption">Caption</label>
                                                <input type="text" name="caption" id="caption" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Upload" class="theme-btn-one">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-grid academy-upload-images-blocks">
                        @if (count($images) > 0)
                            <div class="row clearfix {{ count($images) < 5 ? 'upload_bel_five' : '' }}">
                                @foreach ($images as $image)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 news-block">
                                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="00ms"
                                            data-wow-duration="1500ms">
                                            <div class="inner-box">
                                                <figure class="image-box">
                                                    <img src="{{ $image->image }}" alt="">
                                                </figure>
                                                <a href="{{ route('academy.academyDeleteImages', ['id' => $image->upload_academy_images_id, 'a_id' => $image->academy_id]) }}"
                                                    class="trash-btn">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="lower-content">
                                                <p>{{ $image->caption }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>No Image Found</h1>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- academy-upload-images-section-end -->
@endsection

@section('script')
    <script></script>
@endsection
