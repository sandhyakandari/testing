@extends('layout.layout')

@section('title')
    Kheldhaara | About Us
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/about_us_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">About Us</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}


    <!-- about-section -->
    <section class="about-style-two sec-pad custom-about-section">
        <div class="container-fluid container-lg">
            <div class="sec-title centred">
                OUR AMBITION IS TO DELIVER <span>TENNIS <br />FOR FUTURE</span> GENERATIONS
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 about-column">
                    <div class="about-content">
                        <div class="top-content">
                            <div class="text">
                                <h3>
                                    Welcome to Kheldhaara
                                </h3>
                                <br>
                                <p>
                                    At Kheldhaara,we are dedicated to bringing together all sports-oriented
                                    individuals—Players, Coaches, Academies/Clubs and their fans—to manage their sports records seamlessly
                                    and to assist the Sports Community with ease through our advanced system-enabled
                                    services.
                                    <!-- <h3>
                                                    Team
                                                </h3> -->
                                </p>

                                <br><br>
                                <p>
                                    At Kheldhaara, our team is a dynamic blend of sports enthusiasts and tech innovators,
                                    all dedicated to transforming the way the sports community interacts and thrives. Our
                                    diverse group includes former athletes, experienced coaches, sports academy
                                    administrators, and passionate sports fans, all united by a common goal: to enhance the
                                    sports experience for everyone involved.
                                    <br><br><br><br><br><br>
                                </p>

                            </div>
                            <!-- <ul class="list">
                                                <li>Convallis ligula ligula gravida tristique.</li>
                                                <li>Lobortis massa fringilla odio.</li>
                                            </ul><br> -->
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 img-column">
                    <figure class="img-box"><img src="{{ asset('assets/images/home_about.jpg') }}" alt="">
                    </figure>
                </div>
                <div class="lower-content ">
                    <div class="row">
                        <div class="column">
                            <div class="single-item">
                                <div class="number">01</div>
                                <h4><a href="#">Our Expertise</a></h4>
                                <div class="text">
                                    <p>
                                        <b>Players:</b> Our team understands the needs of players firsthand, providing tools
                                        that help them track and manage their performance records and training schedules
                                        with ease.<br>
                                        <b>Academies/Clubs:</b> Our team supports academies in organizing and managing
                                        tournaments, streamlining administrative tasks, and enhancing communication with
                                        players and coaches. We offer solutions that allow coaches to efficiently manage
                                        their teams, plan training sessions, and monitor player progress.<br>

                                        <b>Sports Fans:</b> We cater to sports fans by creating a platform that keeps them
                                        connected with their favorite players and teams, providing real-time updates and
                                        engaging content.

                                    </p>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-6 col-sm-12 column"> -->
                        <div class="column">
                            <div class="single-item">
                                <div class="number">02</div>
                                <h4><a href="#">Our Commitment</a></h4>
                                <div class="text">
                                    We are committed to leveraging the latest technology to create a seamless and efficient
                                    platform that meets the needs of the entire sports community. From innovative record
                                    management to advanced tournament organization tools, our tech-enabled services are
                                    designed to simplify and enhance the sports experience for everyone.
                                    <br><br>
                                    Join us at <b>Kheldhaara</b> and discover how our dedicated team is revolutionizing the
                                    way Players, coaches, academies, and sports fans connect and thrive. Together, we are
                                    building a stronger, more connected sports community.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about-section end -->

    {{-- rules and regulations start --}}
    {{-- <section class="news-section blog-details bg-light blog-page sec-pad-2 custom-about-rule-reg-section">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-sm-12 content-side">
                    <div class="blog-details-content custom-rule-reg-details">
                        <div class="content-style-one custom-rule-reg-content">
                            <div class="sec-title">1. Administration and regulation</div>
                            <div class="text">
                                <p>
                                    Excepteur sint occaecat cupidatat proid ent sunt culpa qui officia derunt mollit anmlab
                                    rum sed perspic iatis unde omnis is natus error sit voluptatem.accusantium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.tium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </div>
                        <div class="content-style-one custom-rule-reg-content">
                            <div class="sec-title">2. Organising international competitions</div>
                            <div class="text">
                                <p>
                                    Excepteur sint occaecat cupidatat proid ent sunt culpa qui officia derunt mollit anmlab
                                    rum sed perspic iatis unde omnis is natus error sit voluptatem.accusantium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.tium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </div>
                        <div class="content-style-one custom-rule-reg-content">
                            <div class="sec-title">3. Structuring the game</div>
                            <div class="text">
                                <p>
                                    Excepteur sint occaecat cupidatat proid ent sunt culpa qui officia derunt mollit anmlab
                                    rum sed perspic iatis unde omnis is natus error sit voluptatem.accusantium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.tium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </div>
                        <div class="content-style-one custom-rule-reg-content">
                            <div class="sec-title">4. Developing the game</div>
                            <div class="text">
                                <p>
                                    Excepteur sint occaecat cupidatat proid ent sunt culpa qui officia derunt mollit anmlab
                                    rum sed perspic iatis unde omnis is natus error sit voluptatem.accusantium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.tium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </div>
                        <div class="content-style-one custom-rule-reg-content">
                            <div class="sec-title">5. Promoting the game</div>
                            <div class="text">
                                <p>
                                    Excepteur sint occaecat cupidatat proid ent sunt culpa qui officia derunt mollit anmlab
                                    rum sed perspic iatis unde omnis is natus error sit voluptatem.accusantium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.tium dolore mque
                                    laudant totam rem aperiam. eaque ipsa quae Lorem ipsum dolor sit amet.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- rules and regulations end --}}
@endsection

@section('script')
    <script></script>
@endsection
