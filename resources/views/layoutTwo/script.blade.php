<!-- jequery plugins -->
<script src="{{ asset('assets/layoutTwo/js/jquery.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/owl.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/wow.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/validation.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/appear.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/scrollbar.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/tilt.jquery.js') }}"></script>
<script src="{{ asset('assets/layoutTwo/js/jquery.nice-select.min.js') }}"></script>
{{-- intel-tel-input --}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

<!-- main-js -->
<script src="{{ asset('assets/layoutTwo/js/script.js') }}"></script>

{{-- player.js --}}
<script src="{{ asset('assets/layoutTwo/js/player/player.js') }}" type="module"></script>
{{-- for only player --}}
@if (Session()->get('role') === 'Player')
    <script src="{{ asset('assets/layoutTwo/js/player/onlyPlayer.js') }}"></script>
@endif

{{-- academy.js --}}
<script src="{{ asset('assets/layoutTwo/js/academy/academy.js') }}" type="module"></script>

@if (url()->current() === route('academy.showRegisteredPlayerList'))
    <script src="{{ asset('assets/layoutTwo/js/academy/showRegisteredPlayerList.js') }}"></script>
@endif

@if (url()->current() === route('academy.drawPrepare'))
    <script src="{{ asset('assets/layoutTwo/js/academy/interimDrawPrepare.js') }}"></script>
@endif

@if (url()->current() === route('academy.createDraw'))
    <script src="{{ asset('assets/layoutTwo/js/academy/dragAndDrop.js') }}"></script>
@endif

<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
</body>

</html>
