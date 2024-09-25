<!-- main-footer -->
<footer class="main-footer custom-main-footer">
    <div class="footer-top main-footer-top">
        <div class="auto-container">
            <div class="widget-section">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                                </a>
                            </figure>
                            <div class="text">
                                <p>Fuel your tennis passion with Kheldhaara! Elevate your game through our innovative
                                    platform connecting players and top academies. Join now, compete in thrilling
                                    tournaments, and unleash your true potential. Become a champion – your tennis
                                    journey
                                    begins here!</p>
                            </div>
                            <ul class="footer-social">
                                <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h3>Quick Links</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links clearfix">
                                    <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                                    <li><a href="{{ route('tournamentCalendar') }}">Tournaments</a></li>
                                    <li><a href="{{ route('academies') }}">Academies</a></li>
                                    <li><a href="{{ route('players') }}">Players</a></li>
                                    {{-- <li><a href="{{ route('results') }}">Result</a></li> --}}
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget contact-widget">
                            <div class="widget-title">
                                <h3>Contact Us</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list">
                                    {{-- <p>Flat 20, Reynolds Neck, North Helenaville, India</p>
                                    <p>+91 99-5877-3407</p> --}}
                                    <p>info@kheldhaara.com</p>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <div class="copyright pull-left">
                    <p>
                        <a href="javascript:void(0)">
                            KHELDHAARA
                        </a>
                        &copy; 2024 All Right Reserved
                    </p>
                </div>
                <ul class="footer-nav pull-right clearfix">
                    <li><a href="{{ route('termsCondition') }}">Terms of Service</a></li>
                    <li><a href="{{ route('importantPolicy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->


<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>
</div>
