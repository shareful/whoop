<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>@yield('title')</title>
	<meta name="keywords" content="@yield('keywords')">
	<meta name="description" content="@yield('description')">

	<link rel="icon" href="{{ asset('favicon.ico') }}">

	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

	@yield('styles')

	<link rel="stylesheet" href="{{ asset('front_assets/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('front_assets/owlcarousel/assets/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('front_assets/owlcarousel/assets/owl.theme.default.min.css') }}">

	<link href="{{ asset('front_assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('front_assets/css/web-style.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('front_assets/css/style_custom.css') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
	</script>
</head>
<body @yield('body_attr')>