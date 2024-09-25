<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.reg-btn').click(function() {
            // Get the target content ID from the data attribute
            var targetId = $(this).data('target');
            // Hide all content divs
            $('.reg-display').removeClass('active');
            // Show the content div corresponding to the clicked menu link
            $('#' + targetId).addClass('active');
        });
    });
</script>


{{-- js --}}
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.js') }}"></script>
<script src="{{ asset('assets/js/validation.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZQiiFTOGpm2qHVZmZY1s-aEnmHDhqKgk"></script>
{{-- <script src="{{ asset('assets/js/html5lightbox/html5lightbox.js') }}"></script> --}}
<script src="{{ asset('assets/js/gmaps.js') }}"></script>
<script src="{{ asset('assets/js/map-helper.js') }}"></script>
<script src="{{ asset('assets/js/isotope.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countTo.js') }}"></script>
{{-- intel-tel-input --}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<!-- main-js -->
<script src="{{ asset('assets/js/script.js') }}"></script>
{{-- custom.js --}}
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/players.js') }}"></script>
{{-- Validations --}}
<script src="{{ asset('assets/js/custom-validations.js') }}"></script>
{{-- logged-user --}}
<script src="{{ asset('assets/js/logged-user/player.js') }}" type="module"></script>
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
@if (url()->current() === route('tournamentDetail'))
    <script src="{{ asset('assets/js/tournament_detail_draw.js') }}"></script>
@endif

</body>

</html>
