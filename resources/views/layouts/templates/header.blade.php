    <!-- Start Header Area -->
    <header class="header-area p-relative">
        <div class="top-header top-header-adela">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-6 col-lg-3 col-md-3 col-sm-6 text-center d-none d-lg-block">
                        <ul class="top-header-contact-info ">
                            <li class="phone">
                                Campus Triunfo:&nbsp; <br>
                                <a href="tel:+526566115020">656-611-50-20</a> <i class='bx bx-phone-call'></i>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-3 col-md-3 col-sm-6 text-center d-none d-lg-block">
                        <ul class="top-header-contact-info ">
                            <li class="phone">
                                Campus IV Siglos:&nbsp; <br>
                                <a href="tel:+526566115070">656-611-50-70</a><i class='bx bx-phone-call'></i>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-12 social-block align-items-center">
                        <div class="top-header-social">
                            <span>Siguenos:</span>
                            <a href="https://www.facebook.com/adeladecornejo" target="_blank"><i
                                    class='bx bxl-facebook'></i></a>
                            <a href="https://www.linkedin.com/company/instituto-adela-de-cornejo/about/"
                                target="_blank"><i class='bx bxl-linkedin'></i></a>
                            <a href="https://www.instagram.com/adela_de_cornejo/" target="_blank"><i
                                    class='bx bxl-instagram'></i></a>
                        </div>
                        <ul class="top-header-login-register">


                            @if (Auth::check())
                                <ul class="top-header-login-register">
                                    <li><a href="/admin">Bienvenido, {{ Auth::user()->name }}</a></li>

                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="#"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class='bx bx-log-out'></i> Cerrar sesión
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <ul class="top-header-login-register">
                                    <li><a href="{{ route('login') }}"><i class='bx bx-log-in'></i> Ingresar</a></li>
                                </ul>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Navbar Area -->
        <div class="navbar-area navbar-style-three">
            <div class="raque-responsive-nav">
                <div class="container">
                    <div class="raque-responsive-menu">
                        <div class="logo">
                            <a href="/">
                                <img src="/build/img/logo-adela-black.png" class="black-logo"
                                    alt="Adela de cornejo logo negro" width="35%">
                                <img src="/build/img/logo-adela-white.png" class="white-logo"
                                    alt="Adela de cornejo logo blanco" width="35%">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="raque-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="/">
                            <img src="/build/img/logo-adela-black.png" class="black-logo"
                                alt="Adela de cornejo logo negro" width="120px">
                            <img src="/build/img/logo-adela-white.png" class="white-logo"
                                alt="Adela de cornejo logo blanco" width="120px">
                        </a>

                        <div class="collapse navbar-collapse mean-menu">
                            <ul class="navbar-nav">

                                <li class="nav-item"><a href="/"
                                        class="nav-link {{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>

                                <li class="nav-item"><a href="{{ route('adela-de-cornejo') }}"
                                        class="nav-link {{ request()->is('adela-de-cornejo*') ? 'active' : '' }}">Adela
                                        de cornejo
                                        <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="/adela-de-cornejo#bienvenida">Bienvenida</a>
                                        </li>
                                        <li class="nav-item"><a href="/adela-de-cornejo#quienes">Quienes somos</a>
                                        </li>
                                        <li class="nav-item"><a href="/adela-de-cornejo#modeloeducativo">Modelo
                                                Educativo Usado</a></li>
                                        <li class="nav-item"><a href="/adela-de-cornejo#modeloeducativo">Misión y
                                                Visión</a></li>
                                        <li class="nav-item"><a class="nav-link">Campus <i
                                                    class='bx bx-chevron-right'></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a href="{{ route('pages.campus.triunfo') }}"
                                                        class="nav-link">Campus
                                                        Triunfo
                                                    </a></li>

                                                <li class="nav-item"><a href="{{ route('pages.campus.ivsiglos') }}"
                                                        class="nav-link">Campus
                                                        IV Siglos
                                                    </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('oferta-academica') }}"
                                        class="nav-link {{ request()->is('oferta-academica*') || request()->is('admision-preescolar*') || request()->is('admision-primaria*') || request()->is('admision-secundaria*') || request()->is('admisiones*') ? 'active' : '' }}">
                                        Oferta Académica<i class='bx bx-chevron-down'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('admision.preescolar') }}"
                                                class="nav-link {{ request()->is('admision-preescolar*') ? 'active' : '' }}">Preescolar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admision.primaria') }}"
                                                class="nav-link {{ request()->is('admision-primaria*') ? 'active' : '' }}">Primaria</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admision.secundaria') }}"
                                                class="nav-link {{ request()->is('admision-secundaria*') ? 'active' : '' }}">Secundaria</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admisiones') }}"
                                                class="nav-link {{ request()->is('admisiones*') ? 'active' : '' }}">Admisiones</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item"><a href="#"
                                        class="nav-link {{ request()->is('clubes*') || request()->is('estancia*') || request()->is('cafeteria*') || request()->is('regularizacion*') ? 'active' : '' }}">Servicios
                                        <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item {{ request()->is('clubes*') ? 'active' : '' }}"><a
                                                href="{{ route('clubes') }}" class="nav-link">Clubes</a></li>
                                        <li class="nav-item {{ request()->is('estancia*') ? 'active' : '' }}"><a
                                                href="{{ route('estancia') }}" class="nav-link">Estancia</a></li>
                                        <li class="nav-item {{ request()->is('cafeteria*') ? 'active' : '' }}"><a
                                                href="{{ route('cafeteria') }}" class="nav-link">Cafetería</a>
                                        </li>
                                        <li class="nav-item {{ request()->is('regularizacion*') ? 'active' : '' }}"><a
                                                href="{{ route('regularizacion') }}"
                                                class="nav-link">Regularización</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="#"
                                        class="nav-link {{ request()->is('eventos*') || request()->is('avisos*') ? 'active' : '' }}">Eventos
                                        y Avisos <i class='bx bx-chevron-down'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('eventos') }}"
                                                class="nav-link {{ request()->is('eventos*') ? 'active' : '' }}">Eventos
                                            </a>
                                        </li>
                                        @auth
                                        <li class="nav-item">
                                            <a href="{{ route('avisos') }}"
                                                class="nav-link {{ request()->is('avisos*') ? 'active' : '' }}">Avisos
                                            </a>
                                        </li>
                                        @endauth
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="/contacto"
                                        class="nav-link {{ request()->is('contacto*') ? 'active' : '' }}">Contáctanos</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->

        <!-- Start Sticky Navbar Area -->
        <div class="navbar-area navbar-style-three header-sticky">
            <div class="raque-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="/">
                            <img src="/build/img/logo-adela-black.png" class="black-logo"
                                alt="Adela de cornejo logo negro" width="120px">
                            <img src="/build/img/logo-adela-white.png" class="white-logo"
                                alt="Adela de cornejo logo blanco" width="120px">
                        </a>

                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a href="/"
                                        class="nav-link {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                                </li>

                                <li class="nav-item"><a href="{{ route('adela-de-cornejo') }}"
                                        class="nav-link {{ request()->is('adela-de-cornejo*') ? 'active' : '' }}">Adela
                                        de cornejo
                                        <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="/adela-de-cornejo#bienvenida">Bienvenida</a>
                                        </li>
                                        <li class="nav-item"><a href="/adela-de-cornejo#quienes">Quienes somos</a>
                                        </li>

                                        <li class="nav-item"><a href="/adela-de-cornejo#modeloeducativo">Modelo
                                                Educativo Usado</a></li>
                                        <li class="nav-item"><a href="/adela-de-cornejo#modeloeducativo">Misión y
                                                Visión</a></li>

                                        <li class="nav-item"><a href="#" class="nav-link">Planteles <i
                                                    class='bx bx-chevron-right'></i></a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a href="{{ route('pages.campus.triunfo') }}"
                                                        class="nav-link">Campus
                                                        Triunfo
                                                    </a></li>

                                                <li class="nav-item"><a href="{{ route('pages.campus.ivsiglos') }}"
                                                        class="nav-link">Campus
                                                        IV Siglos
                                                    </a></li>
                                            </ul>
                                        </li>


                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="/oferta-academica"
                                        class="nav-link {{ request()->is('oferta-academica*') || request()->is('admision-preescolar*') || request()->is('admision-primaria*') || request()->is('admision-secundaria*') || request()->is('admisiones*') ? 'active' : '' }}">
                                        Oferta Académica<i class='bx bx-chevron-down'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ route('admision.preescolar') }}"
                                                class="nav-link {{ request()->is('admision-preescolar*') ? 'active' : '' }}">Preescolar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admision.primaria') }}"
                                                class="nav-link {{ request()->is('admision-primaria*') ? 'active' : '' }}">Primaria</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admision.secundaria') }}"
                                                class="nav-link {{ request()->is('admision-secundaria*') ? 'active' : '' }}">Secundaria</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admisiones') }}"
                                                class="nav-link {{ request()->is('admisiones*') ? 'active' : '' }}">Admisiones</a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="nav-item"><a href="#"
                                        class="nav-link {{ request()->is('clubes*') || request()->is('estancia*') || request()->is('cafeteria*') || request()->is('regularizacion*') ? 'active' : '' }}">Servicios
                                        <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item {{ request()->is('clubes*') ? 'active' : '' }}"><a
                                                href="{{ route('clubes') }}" class="nav-link">Clubes</a></li>
                                        <li class="nav-item {{ request()->is('estancia*') ? 'active' : '' }}"><a
                                                href="{{ route('estancia') }}" class="nav-link">Estancia</a></li>
                                        <li class="nav-item {{ request()->is('cafeteria*') ? 'active' : '' }}"><a
                                                href="{{ route('cafeteria') }}" class="nav-link">Cafetería</a>
                                        </li>
                                        <li class="nav-item {{ request()->is('regularizacion*') ? 'active' : '' }}"><a
                                                href="{{ route('regularizacion') }}"
                                                class="nav-link">Regularización</a></li>

                                    </ul>
                                </li>

                                <li class="nav-item"><a href="#"
                                        class="nav-link {{ request()->is('eventos*') || request()->is('avisos*') ? 'active' : '' }}">Eventos
                                        y avisos <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="{{ route('eventos') }}"
                                                class="nav-link {{ request()->is('eventos*') ? 'active' : '' }}">Eventos</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('avisos') }}"
                                                class="nav-link {{ request()->is('avisos*') ? 'active' : '' }}">Avisos</a>
                                        </li>
                                    </ul>
                                </li>



                                <li class="nav-item"><a href="/contacto" class="nav-link">Contáctanos</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Sticky Navbar Area -->

    </header>
    <!-- End Header Area -->
