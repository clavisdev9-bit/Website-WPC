
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
       <link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />

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

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Teko:wght@300..700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/lib/animate/animate.min.css')}}"/>
        <link href="{{ asset('assets/frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        {{-- <link href="{{ asset('assets/frontend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/lib/select2/css/select2.css')}}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/backend/dist/libs/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('assets/frontend/css/style.css')}}" rel="stylesheet">
         
        {{-- <link href="{{ asset('assets/frontend/css/custom.css')}}" rel="stylesheet"> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     

    </head>

    <body>


        <div class="page">
            @include('frontend.layouts.partials.navbar')
            <div class="page-wrapper">
                <script src="{{ asset('assets/backend/dist/libs/jquery/jquery.min.js') }}"></script>
                @yield('content')
                @include('frontend.layouts.partials.footer')
            </div>
        </div>

        <!-- JavaScript Libraries -->
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
         {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('assets/frontend/lib/wow/wow.min.js')}}"></script>
        <script src="{{ asset('assets/frontend/lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset('assets/frontend/lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{ asset('assets/frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('assets/backend/dist/libs/select2/js/select2.full.min.js') }}"></script>
        <!-- Template Javascript -->
        <script src="{{ asset('assets/frontend/js/main.js')}}"></script>
      
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script type="module">
	import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';
    
	createChat({
		webhookUrl: 'https://workflow-clavis-flow.vwfini.easypanel.host/webhook/9ba92abb-8cd8-42b6-a18d-1ed83952cc54/chat'
	});

	
</script>


    </body>

</html>