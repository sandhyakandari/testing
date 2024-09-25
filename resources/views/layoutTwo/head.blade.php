<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <!-- Fav Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('assets/images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/layoutTwo/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/layoutTwo/css/responsive.css') }}" rel="stylesheet">


    {{-- intltelinpt css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

    {{-- custom-css --}}
    <link rel="stylesheet" href="{{ asset('assets/layoutTwo/css/custom.css') }}">

    @if (url()->current() === route('academy.drawPage'))
        <link rel="stylesheet" href="{{ asset('assets/layoutTwo/css/draw.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/layoutTwo/css/update_player_status.css') }}">
    @endif

</head>


<body>
