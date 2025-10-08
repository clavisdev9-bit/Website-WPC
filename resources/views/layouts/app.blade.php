<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
	<title>{{ $title }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
	<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">

<!-- Android / Favicon -->
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">

<!-- Manifest -->
<link rel="manifest" href="{{ asset('favicon/manifest.json') }}">

<!-- Windows Tiles -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#ffffff">

	<!-- CSS files -->
<link href="{{ asset('assets/backend/dist/css/tabler.min.css?1738096685') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/backend/dist/css/tabler-flags.min.css?1738096685') }}." rel="stylesheet"/>
	<link href="{{ asset('assets/backend/dist/css/tabler-socials.min.css?1738096685') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/backend/dist/css/tabler-payments.min.css?1738096685') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/backend/dist/css/tabler-vendors.min.css?1738096685') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/backend/dist/css/tabler-marketing.min.css?1738096685') }}" rel="stylesheet"/>
   <link href="{{ asset('assets/backend/dist/css/demo.min.css?1738096685') }}" rel="stylesheet"/>
   <link href="{{ asset('assets/backend/dist/libs/fontawesome-free/css/all.min.css') }}" rel="stylesheet"/>

   <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link href="{{ asset('assets/backend/dist/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/backend/dist/libs/sweetalert2/animate.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
	<style>
		@import url('https://rsms.me/inter/inter.css');
	</style>
</head>
<body>
<script src="{{ asset('assets/backend/dist/js/demo-theme.min.js?1738096685') }}"></script>
<div class="page">
	@include('layouts.partials.sidebar')
	<div class="page-wrapper">
		<script src="{{ asset('assets/backend/dist/libs/jquery/jquery.min.js') }}"></script>
		@yield('content')
		@include('layouts.partials.footer')
	</div>
</div>
	<!-- Libs JS -->
	<script src="{{ asset('assets/backend/dist/libs/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/sweetalert2/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/select2/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('assets/backend/dist/libs/jquery-ui/jquery-ui.min.js') }}"></script>
	<link href="{{ asset('assets/backend/dist/libs/jquery-ui/jquery-ui.css') }}" rel="stylesheet">

	<script src="{{ asset('assets/backend/dist/libs/apexcharts/dist/apexcharts.min.js?1738096685') }}" defer></script>
	<script src="{{ asset('assets/backend/dist/libs/jsvectormap/dist/jsvectormap.min.js?1738096685') }}" defer></script>
	<script src="{{ asset('assets/backend/dist/libs/jsvectormap/dist/maps/world.js?1738096685') }}" defer></script>
	<script src="{{ asset('assets/backend/dist/libs/jsvectormap/dist/maps/world-merc.js?1738096685') }}" defer></script>
	<script src="{{ asset('assets/backend/dist/js/tabler.min.js?1738096685') }}" defer></script>
	<script src="{{ asset('assets/backend/dist/js/demo.min.js?1738096685') }}" defer></script>
    {{-- @vite('resources/js/resource/js/alertings.js') --}}
</body>
</html>