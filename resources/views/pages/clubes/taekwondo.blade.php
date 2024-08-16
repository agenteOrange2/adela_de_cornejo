@extends('layouts.principal')

@section('title', 'Club de Taekwondo')


@section('content')
    <div class="page-title-area item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="/$RECYCLE.BIN">Inicio</a></li>
                    <li><a href="/clubes">Clubes</a></li>
                </ul>
                <h2>Taekwondo</h2>
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
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo.webp') }}" data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/taekwondo/taekwondo.webp') }}" alt="Instalaciones">
                                </a>
                            </li>
                            <li> 
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo_2.webp') }}" data-fancybox="gallery">
                                    <img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_2.webp') }}" alt="Canchas de basquet">
                                </a>
                            </li>
                            <li>
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo_3.webp') }}" data-fancybox="gallery">
                                    <img
                                        src="{{ asset('/build/img/clubes/taekwondo/taekwondo_3.webp') }}" alt="Alumnos jugando">
                                    </a>
                                </li>
                            <li>
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo_4.webp') }}" data-fancybox="gallery">
                                    <img
                                        src="{{ asset('/build/img/clubes/taekwondo/taekwondo_4.webp') }}" alt="Equipo de Taekwondo">
                                    </a>
                            </li>
                            <li>
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo_5.webp') }}" data-fancybox="gallery">
                                    <img
                                        src="{{ asset('/build/img/clubes/taekwondo/taekwondo_5.webp') }}" alt="Equipo de Taekwondo">
                                    </a>
                            </li>

                            <li>
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo_6.webp') }}" data-fancybox="gallery">
                                    <img
                                        src="{{ asset('/build/img/clubes/taekwondo/taekwondo_6.webp') }}" alt="Equipo de Taekwondo">
                                    </a>
                            </li>

                            <li>
                                <a href="{{ asset('/build/img/clubes/taekwondo/taekwondo_7.webp') }}" data-fancybox="gallery">
                                    <img
                                        src="{{ asset('/build/img/clubes/taekwondo/taekwondo_7.webp') }}" alt="Equipo de Taekwondo">
                                    </a>
                            </li>
                        </ul>

                        <div class="slick-thumbs">
                            <ul>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo.webp') }}" alt="Club de Taekwondo 1"></li>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_2.webp') }}" alt="Club de Taekwondo 2"></li>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_3.webp') }}" alt="Club de Taekwondo 3"></li>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_4.webp') }}" alt="Club de Taekwondo 4"></li>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_5.webp') }}" alt="Club de Taekwondo 5"></li>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_6.webp') }}" alt="Club de Taekwondo 6"></li>
                                <li><img src="{{ asset('/build/img/clubes/taekwondo/taekwondo_7.webp') }}" alt="Club de Taekwondo 7"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="product-details-desc">
                        <h3>Club de Taekwondo</h3>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                    </div>

                    <p class="py-3">En nuestro club de taekwondo, Adela, los niños se adentran en el mundo del taekwondo
                        de una manera segura y emocionante. Practican técnicas de defensa personal, mejoran su coordinación
                        y aumentan su condición física. A través de la práctica constante, aprenden a tener disciplina,
                        respeto por los demás y autocontrol. El club también es un lugar donde los niños hacen nuevas
                        amistades y cultivan valores como la perseverancia y la confianza en sí mismos. Nuestro club de
                        taekwondo es un espacio seguro donde su hijo puede crecer, aprender y desarrollar su pasión por las
                        artes marciales.</p>



                    <div class="custom-icon-club">
                        <span>Aprenderas:</span>

                        <div class="py-5 iconos-club text-center text-md-center text-lg-start">
                            <img src="/build/img//icon/taekwondo.png" alt="Club de Taekwondo" width="100">
                            <img src="/build/img//icon/patada-taekwondo.png" alt="Patada de Taekwondo" width=" 100">
                            <img src="/build/img//icon/Uniforme-taekwondo.png" alt="Uniforme Taekwondo" width="100">
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
                                                        <p>Fomenta valores y disciplina.</p>
                                                        <i class='bx bxs-chess'></i>
                                                    </li>
                                                    <li class="requisito-list">
                                                        <p>Desarrolla el autocontrol.</p><i class='bx bxs-chess'></i>
                                                    </li>
                                                    <li class="requisito-list">
                                                        <p>Mejora el desarrollo físico y crecimiento.</p><i
                                                            class='bx bxs-chess'></i>
                                                    </li>
                                                    <li class="requisito-list">
                                                        <p>Estimula la autoconfianza.</p><i class='bx bxs-chess'></i>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="col-lg-4 col-md-4 text-center pt-70">
                                            <img src="/build/img//icon/Uniforme-taekwondo.png" alt="Club de Taekwondo"
                                                class="balon" id="balon">
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
                                                    <p>Compra de Dobok.</p>
                                                </li>
                                                <li class="requisito">
                                                    <p>Compra de Cinta.</p>
                                                </li>
                                                <li class="requisito">
                                                    <p>Compra de protección (careta, guantes, peto, etc.)</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabs-item">
                                    <div class="container">
                                        <div class="titulo-club">
                                            <p class="text-md-center text-lg-start">Club de Taekwondo</p>
                                            <p class="text-md-center text-end text-lg-start">Instructor: Giovanni Medina
                                            </p>
                                        </div>
                                        <table class="table table-bordered table-striped table-responsive-stack"
                                            id="tableOne">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="th-club text-start text-md-center text-lg-center">Horario
                                                    </th>
                                                    <th class="th-club text-start text-md-center text-lg-center">Martes
                                                    </th>
                                                    <th class="th-club text-start text-md-center text-lg-center">Jueves
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody-club">
                                                <tr>
                                                    <td class="text-center">02:30 - 03:30 pm</td>
                                                    <td class="text-center">Kinder</td>
                                                    <td class="text-center">Kinder</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">03:30 - 04:30 pm</td>
                                                    <td class="text-center">Primaria - Secundaria</td>
                                                    <td class="text-center">Primaria - Secundaria</td>
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
                                    <img src="/build/img//galeria/instalacioensx1024.webp" alt="image">
                                    <img src="/build/img//galeria/instalacioensx1024.webp" alt="image">
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
                                    <img src="/build/img//galeria/instalacioensx1024.webp" alt="image">
                                    <img src="/build/img//galeria/instalacioensx1024.webp" alt="image">
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
                                    <img src="/build/img//galeria/instalacioensx1024.webp" alt="image">
                                    <img src="/build/img//galeria/Instalacion.webp" alt="image">
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
