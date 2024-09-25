@include('admin.layout.head')
@include('sweetalert::alert')

@include('admin.layout.navbar')

@include('admin.layout.sidebar')

@yield('content')

@include('admin.layout.footer')

@yield('script')

@include('admin.layout.script')
