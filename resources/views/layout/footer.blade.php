<!-- main-footer -->
<footer class="main-footer custom-main-footer">
    <div class="container-fluid container-lg">
        <div class="footer-content">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 footer-column">
                    <div class="logo-widget footer-widget">
                        <figure class="logo-box">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-fluid">
                            </a>
                        </figure>
                        <div class="text-justify">
                            <p class="text-white">Fuel your tennis passion with Kheldhaara! Elevate your game through
                                our innovative
                                platform connecting players and top academies. Join now, compete in thrilling
                                tournaments, and unleash your true potential. Become a champion – your tennis journey
                                begins here!</p>
                        </div>
                        <ul class="footer-social">
                            <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 offset-lg-1 footer-column">
                    <div class="service-widget footer-widget">
                        <div class="footer-title">Quick Links</div>
                        <ul class="list">
                            <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                            <li><a href="{{ route('tournamentCalendar') }}">Tournaments</a></li>
                            <li><a href="{{ route('academies') }}">Academies</a></li>
                            <li><a href="{{ route('players') }}">Players</a></li>
                            {{-- <li><a href="{{ route('results') }}">Result</a></li> --}}
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-widget">
                    <div class="contact-widget footer-widget">
                        <div class="footer-title">Contact Us</div>
                        <div class="text">
                            {{-- <p>Flat 20, Reynolds Neck, North Helenaville, India</p>
                            <p>+91 99-5877-3407</p> --}}
                            <p>info@kheldhaara.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->


<!-- footer-bottom -->
<div class="footer-bottom">
    <div class="container-fluid container-lg">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 column">
                <div class="copyright">
                    <a href="javascript:void(0)">
                        KHELDHAARA
                    </a>
                    &copy; 2024 All Right Reserved
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 column">
                <ul class="footer-nav">
                    <li><a href="{{ route('termsCondition') }}">Terms of Service</a></li>
                    <li><a href="{{ route('importantPolicy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- footer-bottome end -->




<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-long-arrow-up"></span>
</button>
