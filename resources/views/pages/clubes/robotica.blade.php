@extends('layouts.principal')

@section('title', 'Club de Robótica')


@section('content')
<div class="page-title-area item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
      <div class="page-title-content">
        <ul>
          <li><a href="/">Inicio</a></li>
          <li><a href="/clubes">Clubes</a></li>
        </ul>
        <h2>Robótica</h2>
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
              <li> <a href="/build/img//banner/Aulas-banner.webp?image-1" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol">
                  <img src="/build/img//banner/Aulas-banner.webp?image-1" alt="Instalaciones">
                </a></li>
              <li> <a href="/build/img//galeria/instalacioensx1024.webp?image-2" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol">
                  <img src="/build/img//galeria/instalacioensx1024.webp?image-2" alt="Canchas de basquet">
                </a></li>
              <li><a href="/build/img//galeria/Aulasx1200.webp?image-3" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol"><img src="/build/img//galeria/Instalacion.webp?image-3"
                    alt="Alumnos jugando"></a></li>
              <li><a href="/build/img//galeria/Aulasx1200.webp?image-4" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol"><img src="/build/img//galeria/Instalacion.webp?image-4"
                    alt="Tiros libres"></a></li>
            </ul>

            <div class="slick-thumbs">
              <ul>
                <li><img src="/build/img//galeria/Instalacion.webp" alt="image"></li>
                <li><img src="/build/img//galeria/instalacioensx1024.webp" alt="image"></li>
                <li><img src="/build/img//galeria/Instalacion.webp" alt="image"></li>
                <li><img src="/build/img//galeria/Instalacion.webp" alt="image"></li>
                <li><img src="/build/img//galeria/Instalacion.webp" alt="image"></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12">
          <div class="product-details-desc">
            <h3>Club de Robótica</h3>
            <div class="title-line_wrapper pb-3">
              <div class="title-line"></div>
              <div class="title-line-bg"></div>
            </div>
          </div>
          En nuestro club de robótica, Adela, los niños descubren el fascinante mundo de la robótica. Aquí, tienen la oportunidad de construir sus propios robots, entender cómo funcionan y aprender a programarlos. Nuestro club es también un lugar donde los niños pueden resolver problemas, trabajar en equipo y valorar el pensamiento creativo y lógico de los demás. Crean nuevas amistades y cultivan habilidades y valores importantes para el futuro, como la perseverancia y la innovación. Nuestro club de robótica es un espacio seguro y estimulante donde su hijo puede crecer y desarrollar su pasión por la tecnología.</p>



          <div class="custom-icon-club">
            <span>Aprenderas:</span>

            <div class="py-5 iconos-club text-center text-md-center text-lg-start">
              <img src="/build/img//icon/robot.png" alt="Club de Robótica" width="100">
              <img src="/build/img//icon/robotica.png" alt="Aprendiendo Robotica" width="100">
              <img src="/build/img//icon/asistente-de-robot.png" alt="Taller de robotica" width=" 100">
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
                            <p>Aumenta la capacidad de análisis.</p>
                            <i class='bx bxs-chess'></i>
                          </li>
                          <li class="requisito-list">
                            <p>Desarrolla el pensamiento lógico.</p><i class='bx bxs-chess'></i>
                          </li>
                          <li class="requisito-list">
                            <p>Estimula la creatividad.</p><i class='bx bxs-chess'></i>
                          </li>
                          <li class="requisito-list">
                            <p>Desarrolla capacidades de expresión.</p><i class='bx bxs-chess'></i>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <div class="col-lg-4 col-md-4 text-center pt-70">
                      <img src="/build/img//icon/robot.png" alt="Club de Robótica" class="balon" id="balon">
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
                          <p>En clase se tiene una charla sobre los materiales a utilizar.</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="tabs-item">
                  <div class="container">
                    <div class="titulo-club">
                      <p class="text-md-center text-lg-start">Por definir</p>
                      <p class="text-md-center text-end text-lg-start">Instructor: Por definir</p>
                    </div>
                    <!-- <table class="table table-bordered table-striped table-responsive-stack" id="tableOne">
                      <thead class="thead-dark">
                        <tr>
                          <th class="th-club text-start text-md-center text-lg-center">Horario</th>
                          <th class="th-club text-start text-md-center text-lg-center">Miércoles</th>
                          <th class="th-club text-start text-md-center text-lg-center">Viernes</th>
                        </tr>
                      </thead>
                      <tbody class="tbody-club">
                        <tr>
                          <td class="text-center">03:00 - 04:00 pm</td>
                          <td class="text-center">Preescolar - Primaria</td>
                          <td class="text-center">Preescolar - Primaria</td>
                        </tr>
                        <tr>
                          <td class="text-center">04:00 - 05:00 pm</td>
                          <td class="text-center">Secundaria - Prepa</td>
                          <td class="text-center">Secundaria - Prepa</td>
                        </tr>
                      </tbody>
                    </table> -->
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
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam amet ad possimus cupiditate
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
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde ipsa dignissimos dolorum id ipsam
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
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit laborum incidunt fugit minus
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