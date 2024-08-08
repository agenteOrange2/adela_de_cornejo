<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <meta name="description" content="@yield('meta_description', 'Instituto Adela de Cornejo Somos una institución que oferta un servicio educativo bilingüe en los niveles educativos de preescolar, primaria y secundaria. Ofrecemos un servicio de alta calidad académica accesible para nuestra comunidad Ciudad Juárez')">

    <!-- Meta Tags for Open Graph (Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="@yield('title') | Adela de Cornejo">
    <meta property="og:description" content="Instituto Adela de Cornejo Somos una institución que oferta un servicio educativo bilingüe en los niveles educativos de preescolar, primaria y secundaria. Ofrecemos un servicio de alta calidad académica accesible para nuestra comunidad Ciudad Juárez">
    <meta property="og:image" content="@yield('og:image', asset('https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Adela de Cornejo">

    <!-- Meta Tags for Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title') | Adela de Cornejo">
    <meta name="twitter:description" content="Instituto Adela de Cornejo Somos una institución que oferta un servicio educativo bilingüe en los niveles educativos de preescolar, primaria y secundaria. Ofrecemos un servicio de alta calidad académica accesible para nuestra comunidad Ciudad Juárez">
    <meta name="twitter:image" content="@yield('twitter:image', asset('https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp'))">
    <meta name="twitter:site" content="@yourTwitterHandle">
    <meta name="twitter:creator" content="@yourTwitterHandle">

    <title>@yield('title') | Adela de Cornejo</title>
    <!-- General CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/bootstrap.min.css') }}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/viewer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
    <!-- Este es el archivo donde está el estilo del loader -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>
    @include('layouts.templates.preloader')

    @include('layouts.templates.header')

    @yield('content')

    @section('planteles')
        @include('layouts.templates.planteles')
    @show

    @include('layouts.templates.footer')

    <!-- JS -->
    @yield('js')

    <!-- Scripts -->
    <script src="{{ asset('build/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('build/assets/js/button-social.js') }}"></script>
    <script src="{{ asset('build/assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/viewer.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('build/assets/js/main.js') }}"></script>

    <!-- Fancybox JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: [
                    "zoom",
                    "slideShow",
                    "fullScreen",
                    "thumbs",
                    "close"
                ],
                thumbs: {
                    autoStart: true,
                    axis: 'x'
                },
                loop: true,
                protect: true
            });
        });
    </script>

</body>

</html>
