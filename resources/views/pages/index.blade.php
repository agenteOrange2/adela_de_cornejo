@extends('layouts.principal')


@section('title', 'Inicio')

@section('meta_description', 'Bienvenido a la página principal de Adela de Cornejo.')

{{-- Facebook --}}
@section('og:title', 'Inicio | Adela de Cornejo')
@section('og:description', 'Bienvenido a la página principal de Adela de Cornejo.')
@section('og:image', 'https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp')

{{-- Twitter --}}
@section('twitter:title', 'Inicio | Adela de Cornejo')
@section('twitter:description', 'Bienvenido a la página principal de Adela de Cornejo.')
@section('twitter:image', 'https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp')

@section('content')
    @include('layouts.templates.slider')

    <!-- Start About Area -->
    <section class="about-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        <img src="/build/img/nosotros/Nosotros.webp" class="shadow" alt="Instituto Adela Estudiantes">
                        <img src="/build/img/nosotros/nosotros-aprendiendo.webp" class="shadow" alt="Alumnos de Excelencia">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        <span class="sub-title">Nuestra institución</span>
                        <h2>Instituto Adela de Cornejo</h2>
                        <div class="title-line_wrapper pb-4 pt-2">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <h6 class="sub-h6">Creando grandes estudiantes, transformando futuros</h6>
                        <p class="pb-4">Somos una institución que se distingue por brindar un servicio educativo
                            integral de calidad.
                            Ofrecemos un alto nivel académico, excelentes y amplias instalaciones, atención
                            personalizada además de grupos reducidos, todos con el objetivo primordial de formar alumnos
                            exitosos en su entorno social, escolar y familiar.
                        </p>

                        <div class="features-text pb-4">
                            <h5><i class='bx bx-planet'></i>Nuestro sistema de enseñanza, basado en competencias</h5>
                            <p>Propicia el desarrollo de inteligencias múltiples, las capacidades, habilidades y
                                creatividad que cada alumn@ posee en lo particular</p>
                        </div>

                        <a href="{{ route('adela-de-cornejo') }}" class="default-btn"><i
                                class='bx bx-move-horizontal icon-arrow before'></i><span class="label">Sobre Nosotros</span><i
                                class="bx bx-move-horizontal icon-arrow after"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div id="particles-js-circle-bubble-4"></div>
    </section>
    <!-- End About Area -->

    <!-- Seccion -->

    <section class="course-area p-relative  pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 f-left">
                    <div class="section-title mb-50 text-left">
                        <h2 class="pb-3">
                            Oferta Académica
                        </h2>
                        <div class="title-line_wrapper">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                    </div>
                </div>
                <div class="row course-main-items" style="position:relative ; height:auto;">
                    <div class="col-xl-4 col-lg-4 col-md-6 grid-item c-2">
                        <div class="adela-course-main-wrapper mb-30">
                            <div class="course-cart">
                                <div class="course-info-wrapper">
                                    <div class="cart-info-body">
                                        <span class="category-color category-color-1"><a
                                                href="{{ route('admision.preescolar') }}">Preescolar</a></span>
                                        <a href="{{ route('admision.preescolar') }}">
                                            <h3>PREESCOLAR</h3>
                                        </a>
                                        <div class="cart-lavel">
                                            <h5>Edad : <span>3 a 5 años</span></h5>
                                            <p>En preescolar ofrecemos los siguientes servicios: </p>
                                        </div>
                                        <div class="info-cart-text">
                                            <ul class="ul-list">
                                                <li><i class='bx bx-check'></i>Educación Bilingüe</li>
                                                <li><i class='bx bx-check'></i>Servicio de estancia</li>
                                                <li><i class='bx bx-check'></i>Clases extraacadémicas</li>
                                                <li><i class='bx bx-check'></i>Disponibilidad de horario</li>
                                            </ul>
                                        </div>
                                        <div class="course-action">
                                            <a href="{{ route('admision.preescolar') }}" class="view-details-btn">Información Preescolar <i class='bx bx-right-arrow-alt'></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adela-course-thumb w-img">
                                <a href="{{ route('admision.preescolar') }}"><img
                                        src="/build/img/oferta/Adela-oferta-preescolar.jpg"
                                        alt="Preescolar Adela de cornejo"></a>
                            </div>
                            <div class="adela-course-wraper">
                                <div class="adela-course-heading">
                                    <a href="{{ route('admision.preescolar') }}" class="course-link-color-1">PREESCOLAR</a>
                                </div>
                                <div class="adela-course-text">
                                    <h3><a href="{{ route('admision.preescolar') }}">PREESCOLAR</a>
                                    </h3>
                                </div>
                                <div class="adela-course-meta">
                                    <div class="d-flex align-items-center adela-course-tutor">
                                        <img src="{{ asset('build/img/logo-adela-black.webp') }}" alt="Adela de cornejo logo negro">
                                        <span>Adela de Cornejo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="adela-course-footer">
                                <div class="d-flex align-items-center course-lessson-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.471" height="16.471"
                                        viewBox="0 0 16.471 16.471">
                                        <g id="blackboar09" transform="translate(-0.008)">
                                            <path id="Path_01" data-name="Path 101"
                                                d="M16,1.222H8.726V.483a.483.483,0,1,0-.965,0v.74H.491A.483.483,0,0,0,.008,1.7V13.517A.483.483,0,0,0,.491,14H5.24L4.23,15.748a.483.483,0,1,0,.836.483L6.354,14H7.761v1.99a.483.483,0,0,0,.965,0V14h1.407l1.288,2.231a.483.483,0,1,0,.836-.483L11.247,14H16a.483.483,0,0,0,.483-.483V1.7A.483.483,0,0,0,16,1.222Zm-.483.965v8.905H.973V2.187Zm0,10.847H.973v-.976H15.514Z"
                                                fill="#575757"></path>
                                        </g>
                                    </svg>
                                    <span class="ms-2">Oferta Académica</span>
                                </div>                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 grid-item c-2">
                        <div class="adela-course-main-wrapper mb-30">
                            <div class="course-cart">
                                <div class="course-info-wrapper">
                                    <div class="cart-info-body">
                                        <span class="category-color category-color-2"><a
                                                href="{{ route('admision.primaria') }}">Primaria</a></span>
                                        <a href="{{ route('admision.primaria') }}">
                                            <h3>PRIMARIA</h3>
                                        </a>
                                        <div class="cart-lavel">
                                            <h5>Edad : <span>6 a 12 años</span></h5>
                                            <p>En Primaria ofrecemos los siguientes servicios:</p>
                                        </div>
                                        <div class="info-cart-text">
                                            <ul class="ul-list">
                                                <li><i class='bx bx-check'></i>Educación Bilingüe</li>
                                                <li><i class='bx bx-check'></i>Servicio de estancia</li>
                                                <li><i class='bx bx-check'></i>Clases extraacadémicas</li>
                                                <li><i class='bx bx-check'></i>Disponibilidad de horario</li>
                                            </ul>
                                        </div>
                                        <div class="course-action">
                                            <a href="{{ route('admision.primaria') }}" class="view-details-btn">Información Primaria<i class='bx bx-right-arrow-alt'></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adela-course-thumb w-img">
                                <a href="{{ route('admision.primaria') }}"><img
                                        src="{{asset('/build/img/oferta/Adela-oferta-primaria.jpg')}}" alt="Oferta Academica Adela de cornejo Primaria Ciudad Juárez"></a>
                            </div>
                            <div class="adela-course-wraper">
                                <div class="adela-course-heading">
                                    <a href="{{ route('admision.primaria') }}" class="course-link-color-1">PRIMARIA</a>
                                </div>
                                <div class="adela-course-text">
                                    <h3><a href="{{ route('admision.primaria') }}">
                                            PRIMARIA</a>
                                    </h3>
                                </div>
                                <div class="adela-course-meta">
                                    <div class="d-flex align-items-center adela-course-tutor">
                                        <img src="{{ asset('build/img/logo-adela-black.webp') }}" alt="Oferta Academica Adela de cornejo Primaria Ciudad Juárez">
                                        <a href="{{ route('admision.primaria') }}"><span>Adela de Cornejo</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="adela-course-footer">
                                <div class="d-flex align-items-center course-lessson-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.471" height="16.471"
                                        viewBox="0 0 16.471 16.471">
                                        <g id="blackboar09" transform="translate(-0.008)">
                                            <path id="Path_01" data-name="Path 101"
                                                d="M16,1.222H8.726V.483a.483.483,0,1,0-.965,0v.74H.491A.483.483,0,0,0,.008,1.7V13.517A.483.483,0,0,0,.491,14H5.24L4.23,15.748a.483.483,0,1,0,.836.483L6.354,14H7.761v1.99a.483.483,0,0,0,.965,0V14h1.407l1.288,2.231a.483.483,0,1,0,.836-.483L11.247,14H16a.483.483,0,0,0,.483-.483V1.7A.483.483,0,0,0,16,1.222Zm-.483.965v8.905H.973V2.187Zm0,10.847H.973v-.976H15.514Z"
                                                fill="#575757"></path>
                                        </g>
                                    </svg>
                                    <span class="ms-2">Oferta Académica</span>
                                </div>                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 grid-item c-2">
                        <div class="adela-course-main-wrapper mb-30">
                            <div class="course-cart">
                                <div class="course-info-wrapper">
                                    <div class="cart-info-body">
                                        <span class="category-color category-color-3"><a
                                                href="{{ route('admision.secundaria') }}">Secundaria</a></span>
                                        <a href="{{ route('admision.secundaria') }}">
                                            <h3>SECUNDARIA</h3>
                                        </a>
                                        <div class="cart-lavel">
                                            <h5>Edad : <span>12 a 15 años</span></h5>
                                            <p>En Secundaria ofrecemos los siguientes servicios:</p>
                                        </div>
                                        <div class="info-cart-text">
                                            <ul class="ul-list">
                                                <li><i class='bx bx-check'></i>Educación Bilingüe</li>
                                                <li><i class='bx bx-check'></i>Servicio de estancia</li>
                                                <li><i class='bx bx-check'></i>Clases extraacadémicas</li>
                                                <li><i class='bx bx-check'></i>Disponibilidad de horario</li>
                                            </ul>
                                        </div>
                                        <div class="course-action">
                                            <a href="{{ route('admision.secundaria') }}" class="view-details-btn">Información Primaria<i class='bx bx-right-arrow-alt'></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adela-course-thumb w-img">
                                <a href="{{ route('admision.secundaria') }}"><img
                                        src="/build/img/oferta/Adela-oferta-secundaria.jpg" alt="Oferta Academica Adela de cornejo Secundaria Ciudad Juárez"></a>
                            </div>
                            <div class="adela-course-wraper">
                                <div class="adela-course-heading">
                                    <a href="{{ route('admision.secundaria') }}"
                                        class="course-link-color-1">SECUNDARIA</a>
                                </div>
                                <div class="adela-course-text">
                                    <h3><a href="{{ route('admision.secundaria') }}">SECUNDARIA</a>
                                    </h3>
                                </div>
                                <div class="adela-course-meta">

                                    <div class="d-flex align-items-center  adela-course-tutor">
                                        <img src="{{ asset('build/img/logo-adela-black.webp') }}" alt="Adela de cornejo logo negro">
                                        <a href="{{ route('admision.secundaria') }}"><span>Adela de Cornejo</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="adela-course-footer">
                                <div class="d-flex align-items-center  course-lessson-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.471" height="16.471"
                                        viewBox="0 0 16.471 16.471">
                                        <g id="blackboar09" transform="translate(-0.008)">
                                            <path id="Path_01" data-name="Path 101"
                                                d="M16,1.222H8.726V.483a.483.483,0,1,0-.965,0v.74H.491A.483.483,0,0,0,.008,1.7V13.517A.483.483,0,0,0,.491,14H5.24L4.23,15.748a.483.483,0,1,0,.836.483L6.354,14H7.761v1.99a.483.483,0,0,0,.965,0V14h1.407l1.288,2.231a.483.483,0,1,0,.836-.483L11.247,14H16a.483.483,0,0,0,.483-.483V1.7A.483.483,0,0,0,16,1.222Zm-.483.965v8.905H.973V2.187Zm0,10.847H.973v-.976H15.514Z"
                                                fill="#575757"></path>
                                        </g>
                                    </svg>
                                    <span class="ms-2">Oferta Académica</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Mission Area -->
    <section class="mission-area ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="mission-content">
                <div class="section-title text-left">
                    <span class="sub-title">Ciclo Escolar 2022 - 2023</span>
                    <h2 class="pb-3">Admisiones</h2>
                    <div class="title-line_wrapper">
                        <div class="title-line"></div>
                        <div class="title-line-bg"></div>
                    </div>
                </div>

                <div class="mission-slides owl-carousel owl-theme">
                    <div>
                        <h3>Preescolar</h3>
                        <p>Las preinscripciones a cualquiera de nuestros grados son en el mes de febrero, aunque, los
                            padres de familia interesados pueden solicitar información a través de nuestros medios de
                            contacto durante los 365 días del año; </p>
                        <p>para ingresar a nuestro instituto, se deben cubrir cuotas de inscripción, material y seguro,
                            cuota de eventos, costo de libros, costo de uniformes y costo de cuadernillo de tareas,
                            actividad extraescolar y estancia.</p>
                        <a href="{{ route('admision.preescolar') }}" class="default-btn"><i
                                class='bx bx-user-pin icon-arrow before'></i><span class="label">Más Información sobre Preescolar</span><i
                                class="bx bx-user-pin icon-arrow after"></i></a>
                    </div>

                    <div>
                        <h3>Primaria</h3>
                        <p>Las preinscripciones a cualquiera de nuestros grados son en el mes de febrero, aunque, los
                            padres de familia interesados pueden solicitar información a través de nuestros medios de
                            contacto durante los 365 días del año; </p>
                        <p>para ingresar a nuestro instituto, se deben cubrir cuotas de inscripción, material y seguro,
                            cuota de eventos, costo de libros, costo de uniformes y costo de cuadernillo de tareas,
                            actividad extraescolar y estancia.</p>
                        <a href="{{ route('admision.primaria') }}" class="default-btn"><i
                                class='bx bx-user-pin icon-arrow before'></i><span class="label">Más Información sobre Primaria</span><i
                                class="bx bx-user-pin icon-arrow after"></i></a>
                    </div>

                    <div>
                        <h3>Secundaria</h3>
                        <p>Las preinscripciones a cualquiera de nuestros grados son en el mes de febrero, aunque, los
                            padres de familia interesados pueden solicitar información a través de nuestros medios de
                            contacto durante los 365 días del año; </p>
                        <p>para ingresar a nuestro instituto, se deben cubrir cuotas de inscripción, material y seguro,
                            cuota de eventos, costo de libros, costo de uniformes y costo de cuadernillo de tareas,
                            actividad extraescolar y estancia.</p>
                        <a href="{{ route('admision.secundaria') }}" class="default-btn"><i
                                class='bx bx-user-pin icon-arrow before'></i><span class="label">Más Información sobre Secundaria</span><i
                                class="bx bx-user-pin icon-arrow after"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Mission Area -->
    
    <!-- Start Courses Categories Area -->
    <section class="courses-categories-area bg-image pt-100 pb-70">
        <div class="container">
            <div class="section-title text-left">
                <span class="sub-title">Ofrecemos los siguientes</span>
                <h2 class="pb-3">Servicios</h2>
                <div class="title-line_wrapper">
                    <div class="title-line"></div>
                    <div class="title-line-bg"></div>
                </div>                
            </div>

            <div class="courses-categories-slides owl-carousel owl-theme">
                <div class="single-categories-courses-box mb-30">
                    <div class="icon">
                        <img src="{{asset('/build/img/nosotros/guitarra.png')}}" alt="Clubes Instituto Adela de cornejo">
                    </div>
                    <h3>Clubes</h3>
                    <span>Clubes recreativos</span>

                    <a href="{{ route('clubes') }}" class="link-btn"></a>
                </div>

                <div class="single-categories-courses-box mb-30">
                    <div class="icon">
                        <img src="{{asset('/build/img/nosotros/gestion-del-tiempo.png')}}" alt="Estancias para nuestros alumnado en el instituto">
                    </div>
                    <h3>Estancias </h3>
                    <span>Estancias a todo momento</span>

                    <a href="{{ route('estancia') }}" class="link-btn"></a>
                </div>

                <div class="single-categories-courses-box mb-30">
                    <div class="icon">
                        <img src="{{asset('/build/img/nosotros/nutricion.png')}}" alt="Cafetería para los alumnos de adela de cornejo">
                    </div>
                    <h3>Cafetería</h3>
                    <span>Diversidad en los platillos</span>

                    <a href="{{ route('cafeteria') }}" class="link-btn"></a>
                </div>

                <div class="single-categories-courses-box mb-30">
                    <div class="icon">
                        <img src="{{asset('/build/img/nosotros/estudiando.png')}}" alt="Cursos de Regularización Adela de Cornejo">
                    </div>
                    <h3>Regularización</h3>
                    <span>Clases especiales</span>

                    <a href="{{ route('regularizacion') }}" class="link-btn"></a>
                </div>                
            </div>
        </div>

        <div id="particles-js-circle-bubble-2"></div>
    </section>

    <!-- Start Courses Area -->
    <section class="courses-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-left">
                <span class="sub-title">Últimos</span>
                <h2 class="pb-3">Avisos y Eventos</h2>
                <div class="title-line_wrapper">
                    <div class="title-line"></div>
                    <div class="title-line-bg"></div>
                </div>
                {{-- <a href="#" class="default-btn"><i class='bx bx-show-alt icon-arrow before'></i><span class="label">Ver todos</span><i class="bx bx-show-alt icon-arrow after"></i></a> --}}
            </div>

            <div class="shorting-menu">
                <button class="filter" data-filter="all">Todos ({{ count($avisos) + count($eventos) }})</button>
                <button class="filter" data-filter=".avisos">Avisos ({{ count($avisos) }})</button>
                <button class="filter" data-filter=".eventos">Eventos ({{ count($eventos) }})</button>
            </div>

            <div class="shorting">
                <div class="row">
                    @foreach ($avisos as $aviso)
                        <div class="col-lg-4 col-md-6 mix avisos">
                            <div class="single-courses-box mb-30">
                                <div class="courses-image">
                                    <a href="{{ route('avisos.show', $aviso) }}" class="d-block"><img
                                            src="{{ $aviso->image }}" alt="aviso-{{ $aviso->title }}"></a>
                                </div>
                                <div class="courses-content">
                                    <h3><a href="{{ route('avisos.show', $aviso) }}"
                                            class="d-inline-block">{{ Str::limit($aviso->title, 20) }}</a></h3>
                                    <p>{{ Str::limit($aviso->excerpt, 50) }}</p>
                                </div>

                                <div class="courses-box-footer">
                                    <ul>
                                        <li class="students-number">
                                            Publicación:
                                        </li>

                                        <li class="courses-lesson">
                                            <i class='bx bx-book-open'></i> {{ $aviso->formatted_created_at }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($eventos as $evento)
                        <div class="col-lg-4 col-md-6 mix eventos">
                            <div class="single-courses-box mb-30">
                                <div class="courses-image">
                                    <a href="{{ route('eventos.show', $evento) }}" class="d-block">
                                        <img
                                            src="{{ $evento->image }}" alt="evento {{ $evento->title }}">
                                    </a>

                                    <div class="courses-tag">
                                        <a href="{{ route('eventos.show', $evento) }}"
                                            class="d-block">{{ $evento->type }}</a>
                                    </div>
                                </div>
                                <div class="courses-content">
                                    <h3><a href="{{ route('eventos.show', $evento) }}"
                                            class="d-inline-block">{{ Str::limit($evento->title, 20) }}</a></h3>
                                    <p>{{ Str::limit($evento->excerpt, 50) }}</p>
                                </div>
                                <div class="courses-box-footer">
                                    <ul>
                                        <li class="students-number">
                                            Publicación:
                                        </li>

                                        <li class="courses-lesson">
                                            <i class='bx bx-book-open'></i>
                                            {{ $evento->formatted_created_at }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Courses Area -->
@endsection
