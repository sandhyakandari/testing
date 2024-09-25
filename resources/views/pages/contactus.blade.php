@extends('layout.layout')

@section('title')
    Kheldhaara | Contact
@endsection

@section('content')
    <!-- page-title -->
    <section class="page-title centred custom-page-banner-section"
        style="background-image:url({{ asset('assets/images/academies/4.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Contact Us</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    <!-- page-title end -->


    <!-- contact-section -->
    <section class="contact-section bg-light">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 contact-column">
                    <div class="contact-info">
                        <div class="contact-title">Get In Touch</div>
                        <div class="row">
                            <div class="column">
                                <!-- <div class="left-column single-info centred">
                                    <div class="icon-box"><i class="flaticon-map"></i></div>
                                    <h5>Address</h5>
                                    <div class="text">P6 12th Street, Olive Building Newyork, USA</div>
                                </div> -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 column">
                                <div class="right-column single-info">
                                    <div class="icon-box"><i class="flaticon-mail"></i></div>
                                    <h5>Email</h5>
                                    <div class="text">info@kheldhaara.com</div>
                                </div>
                                <!-- <div class="right-column single-info">
                                    <div class="icon-box"><i class="flaticon-phone-call-1"></i></div>
                                    <h5>Phone No</h5>
                                    <div class="text">+91 99506 78900 </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 contact-column">
                    <div class="contact-form-area">
                        <div class="contact-title">Send Us A Message</div>
                        <form method="post" action="{{route('contactus')}}" id="contact-form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Name *</label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Email *</label>
                                    <input type="email" name="email" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Subject *</label>
                                    <input type="text" name="subject" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label>Phone *</label>
                                    <input type="text" name="phone" required>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Messsage *</label>
                                    <textarea name="message"></textarea>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="theme-btn" type="submit" name="submit-form">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
@endsection

@section('script')
    <script></script>
@endsection
