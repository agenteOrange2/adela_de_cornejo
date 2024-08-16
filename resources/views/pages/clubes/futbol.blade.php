@extends('layouts.principal')

@section('title', 'Club de Fútbol')


@section('content')

    <div class="page-title-area item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/clubes">Clubes</a></li>
                </ul>
                <h2>Fútbol Soccer</h2>
            </div>
        </div>
    </div>


    <!-- Start Product Details Area -->
    <section class="product-details-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="products-details-image">
                        <ul class="slickslide">
                            <li>
                                <a href="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo.webp') }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo.webp') }}"
                                        alt="Instalaciones">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_2.webp') }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_2.webp') }}"
                                        alt="Canchas de basquet">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_3.webp') }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_3.webp') }}"
                                        alt="Alumnos jugando">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_4.webp') }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_4.webp') }}"
                                        alt="Tiros libres">
                                </a>
                            </li>

                            <li>
                                <a href="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_5.webp') }}"
                                    data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_5.webp') }}"
                                        alt="Tiros libres">
                                </a>
                            </li>
                        </ul>

                        <div class="slick-thumbs">
                            <ul>
                                <li><img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo.webp') }}"
                                        alt="club de futbol adela de cornejo 1"></li>
                                <li><img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_2.webp') }}"
                                        alt="club de futbol adela de cornejo 2"></li>
                                <li><img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_3.webp') }}"
                                        alt="club de futbol adela de cornejo 3"></li>
                                <li><img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_4.webp') }}"
                                        alt="club de futbol adela de cornejo 4"></li>
                                <li><img src="{{ asset('/build/img/clubes/futbol/futbol_adeladecornejo_5.webp') }}"
                                        alt="club de futbol adela de cornejo 5"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="product-details-desc">
                        <h3>Club de Fútbol Soccer</h3>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                    </div>

                    <p class="py-3">En nuestro club de fútbol, Adela, los niños se sumergen en el emocionante mundo del
                        fútbol. Adquieren habilidades deportivas, dominan estrategias de juego y se mantienen activos de una
                        manera divertida. Participan en partidos, demostrando su espíritu de equipo y respeto tanto por los
                        compañeros como por los oponentes. Forjan nuevas amistades y cultivan valores como la perseverancia
                        y el juego limpio. Nuestro club de fútbol es un espacio seguro y acogedor donde su hijo puede crecer
                        y desarrollar su pasión por el fútbol.</p>



                    <div class="custom-icon-club">
                        <span>Aprenderas:</span>

                        <div class="py-5 iconos-club text-center text-md-center text-lg-start">
                            <img src="/build/img/icon/futbol.png" alt="Balón de fútbol" width="100">
                            <img src="/build/img/icon/jugador-de-futbol.png" alt="Jugador de fubtol" width=" 100">
                            <img src="/build/img/icon/jugadores-de-futbol.png" alt="Vestimenta de fubtol" width="100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="tab products-details-tab">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <ul class="tabs">
                                <li><a href="#">
                                        <div class="dot"></div> Beneficios
                                    </a></li>

                                <li><a href="#">
                                        <div class="dot"></div> Requisitos
                                    </a></li>

                                <li><a href="#">
                                        <div class="dot"></div> Horarios
                                    </a></li>
                            </ul>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="tab-content">
                                <div class="tabs-item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8 col-md-8">
                                            <h4 class="pt-50 text-center text-md-start text-lg-start">Beneficios</h4>
                                            <div class="title-line_wrapper pb-3">
                                                <div class="title-line"></div>
                                                <div class="title-line-bg"></div>
                                            </div>
                                            <div class="club-list">
                                                <ul>
                                                    <li class="requisito-list">
                                                        <p>Ayuda a socializar.</p>
                                                        <i class='bx bxs-chess'></i>
                                                    </li>
                                                    <li class="requisito-list">
                                                        <p>Beneficia la salud.</p><i class='bx bxs-chess'></i>
                                                    </li>
                                                    <li class="requisito-list">
                                                        <p>Estimula la coordinación motora.</p><i class='bx bxs-chess'></i>
                                                    </li>
                                                    <li class="requisito-list">
                                                        <p>Aumenta la fuerza en las piernas y la resistencia.</p><i
                                                            class='bx bxs-chess'></i>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-lg-4 col-md-4 text-center pt-70">
                                            <img src="/build/img/icon/futbol.png" alt="Club de futbol" class="balon"
                                                id="balon">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabs-item">
                                    <div class="products-details-tab-content">
                                        <h5 class="pt-50 pb-3 text-center text-md-start text-lg-start">Requisitos:</h5>
                                        <div class="title-line_wrapper pb-3">
                                            <div class="title-line"></div>
                                            <div class="title-line-bg"></div>
                                        </div>
                                        <div class="club-list">
                                            <ul>
                                                <li class="requisito">
                                                    <p>Tenis para jugar fútbol rápdido. </p>
                                                </li>
                                                <li class="requisito">
                                                    <p>Ropa cómoda</p>
                                                </li>
                                                <li class="requisito">
                                                    <p>En caso de entrar a torneo el costo del uniforme</p>
                                                </li>
                                                <li class="requisito">
                                                    <p>Espinilleras</p>
                                                </li>
                                                <li class="requisito">
                                                    <p>En caso de torneo, comprar uniforme (Costo Aprox: $450.00)</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabs-item">
                                    <div class="container">
                                        <div class="titulo-club">
                                            <p class="text-md-center text-lg-start">Cancha de Fútbol</p>
                                            <p class="text-md-center text-end text-lg-start">Instructor: Roberto Arciniega
                                            </p>
                                        </div>
                                        <table class="table table-bordered table-striped table-responsive-stack"
                                            id="tableOne">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="th-club text-start text-md-center text-lg-center">Horario
                                                    </th>
                                                    <th class="th-club text-start text-md-center text-lg-center">Lunes</th>
                                                    <th class="th-club text-start text-md-center text-lg-center">Martes
                                                    </th>
                                                    <th class="th-club text-start text-md-center text-lg-center">Miercoles
                                                    </th>
                                                    <th class="th-club text-start text-md-center text-lg-center">Jueves
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody-club">
                                                <tr>
                                                    <td class="text-center">03:00 - 04:00 pm</td>
                                                    <td class="text-center">Fútbol Primaria</td>
                                                    <td class="text-center">Fútbol Secundaria - Prepa</td>
                                                    <td class="text-center">Fútbol Primaria</td>
                                                    <td class="text-center">Fútbol Secundaria - Prepa</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="related-products">
            <div class="container">
                <div class="section-title text-left">
                    <h2>Otros Club</h2>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-product-box mb-30">
                            <div class="product-image">
                                <a href="single-product.html">
                                    <img src="/build/img/galeria/instalacioensx1024.webp" alt="image">
                                    <img src="/build/img/galeria/instalacioensx1024.webp" alt="image">
                                </a>

                                <a href="#" class="add-to-cart-btn">Ver Club<i class='bx bx-low-vision'></i></a>
                            </div>

                            <div class="product-content">
                                <h3><a href="single-product.html">Jazz</a></h3>

                                <div class="price">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam amet ad possimus
                                        cupiditate
                                        praesentium, maxime vero adipisci magni consequatur! Quis!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-product-box mb-30">
                            <div class="product-image">
                                <a href="single-product.html">
                                    <img src="/build/img/galeria/instalacioensx1024.webp" alt="image">
                                    <img src="/build/img/galeria/instalacioensx1024.webp" alt="image">
                                </a>

                                <a href="#" class="add-to-cart-btn">Ver Club<i class='bx bx-low-vision'></i></a>
                            </div>

                            <div class="product-content">
                                <h3><a href="single-product.html">Hip-Hop</a></h3>

                                <div class="price">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde ipsa dignissimos
                                        dolorum id ipsam
                                        aspernatur quas et ullam autem provident.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-product-box mb-30">
                            <div class="product-image">
                                <a href="single-product.html">
                                    <img src="/build/img/galeria/instalacioensx1024.webp" alt="image">
                                    <img src="/build/img/galeria/Instalacion.webp" alt="image">
                                </a>

                                <a href="#" class="add-to-cart-btn">Ver Club<i class='bx bx-low-vision'></i></a>
                            </div>

                            <div class="product-content">
                                <h3><a href="single-product.html">Ajedrez</a></h3>

                                <div class="price">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit laborum incidunt
                                        fugit minus
                                        consectetur eligendi sequi libero in, quos aperiam.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details Area -->
@endsection
