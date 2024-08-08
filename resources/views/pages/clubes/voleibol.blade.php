@extends('layouts.principal')

@section('title', 'Club de Voleibol ')


@section('content')
<div class="page-title-area item-bg4 jarallax" data-jarallax='{"speed": 0.3}'>
    <div class="container">
      <div class="page-title-content">
        <ul>
          <li><a href="/">Inicio</a></li>
          <li><a href="/clubes">Clubes</a></li>
        </ul>
        <h2>Voleibol</h2>
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
                <a href="{{ asset('/build/img/clubes/voleibol/voleibol.webp') }}" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol">
                  <img src="{{ asset('/build/img/clubes/voleibol/voleibol.webp') }}" alt="Equipo de Voleibol">
                </a>
              </li>
              <li> 
                <a href="{{ asset('/build/img/clubes/voleibol/voleibol_2.webp') }}" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol">
                  <img src="{{ asset('/build/img/clubes/voleibol/voleibol_2.webp') }}" alt="Equipo de Voleibol">
                </a>
              </li>
              <li>
                <a href="{{ asset('/build/img/clubes/voleibol/voleibol_3.webp') }}" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol">
                  <img src="{{ asset('/build/img/clubes/voleibol/voleibol_3.webp') }}"
                    alt="Equipo de Voleibol">
                  </a>
                </li>
              <li>
                <a href="{{ asset('/build/img/clubes/voleibol/voleibol_4.webp') }}" data-toggle="lightbox"
                  data-gallery="galeria-basquetbol">
                  <img src="{{ asset('/build/img/clubes/voleibol/voleibol_4.webp') }}"
                    alt="Tiros libres">
                  </a>
                </li>
                <li>
                  <a href="{{ asset('/build/img/clubes/voleibol/voleibol_5.webp') }}" data-toggle="lightbox"
                    data-gallery="galeria-basquetbol">
                    <img src="{{ asset('/build/img/clubes/voleibol/voleibol_5.webp') }}"
                      alt="Tiros libres">
                    </a>
                  </li>
            </ul>

            <div class="slick-thumbs">
              <ul>
                <li><img src="{{ asset('/build/img/clubes/voleibol/voleibol.webp') }}" alt="Club de Voleibol"></li>
                <li><img src="{{ asset('/build/img/clubes/voleibol/voleibol_2.webp') }}" alt="Club de Voleibol"></li>
                <li><img src="{{ asset('/build/img/clubes/voleibol/voleibol_3.webp') }}" alt="Club de Voleibol"></li>
                <li><img src="{{ asset('/build/img/clubes/voleibol/voleibol_4.webp') }}" alt="Club de Voleibol"></li>
                <li><img src="{{ asset('/build/img/clubes/voleibol/voleibol_5.webp') }}" alt="Club de Voleibol"></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12">
          <div class="product-details-desc">
            <h3>Club de Voleibol</h3>
            <div class="title-line_wrapper pb-3">
              <div class="title-line"></div>
              <div class="title-line-bg"></div>
            </div>
          </div>

          <p class="py-3">En nuestro club de voleibol, Adela, los niños se sumergen en el emocionante mundo del voleibol. Adquieren habilidades deportivas, se familiarizan con tácticas de juego y se mantienen activos de una forma amena y enérgica. Participan en partidos, demostrando un gran espíritu de equipo y respeto hacia sus compañeros y rivales. Forjan nuevas amistades y refuerzan valores importantes como el juego limpio y la perseverancia. Nuestro club de voleibol es un espacio seguro y animado donde su hijo puede crecer y cultivar su amor por el voleibol.</p>



          <div class="custom-icon-club">
            <span>Aprenderas:</span>

            <div class="py-5 iconos-club text-center text-md-center text-lg-start">
              <img src="/build/img//icon/voleibol.png" alt="Club de Voleibol" width="100">
              <img src="/build/img//icon/cuadra.png" alt="Tiro de voleibol" width=" 100">
              <img src="/build/img//icon/colocar.png" alt="Colocar voleibol" width="100">
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
                            <p>Fomenta valores y trabajo en equipo.</p>
                            <i class='bx bxs-chess'></i>
                          </li>
                          <li class="requisito-list">
                            <p>Aumenta capacidad motora.</p><i class='bx bxs-chess'></i>
                          </li>
                          <li class="requisito-list">
                            <p>Desarrollo coordinación ojo - mano.</p><i class='bx bxs-chess'></i>
                          </li>
                          <li class="requisito-list">
                            <p>Aumenta la resistencia.</p><i class='bx bxs-chess'></i>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <div class="col-lg-4 col-md-4 text-center pt-70">
                      <img src="/build/img//icon/voleibol.png" alt="Club de Voleibol" class="balon" id="balon">
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
                          <p>Tenis para jugar Voleibol</p>
                        </li>
                        <li class="requisito">
                          <p>Ropa Cómoda</p>
                        </li>
                        <li class="requisito">
                          <p>Comprar Uniforme en caso de participar en torneo.</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="tabs-item">
                  <div class="container">
                    <div class="titulo-club">
                      <p class="text-md-center text-lg-start">Cancha de basquetbol</p>
                      <p class="text-md-center text-end text-lg-start">Instructor: Diego Armendáriz</p>
                    </div>
                    <table class="table table-bordered table-striped table-responsive-stack" id="tableOne">
                      <thead class="thead-dark">
                        <tr>
                          <th class="th-club text-start text-md-center text-lg-center">Horario</th>
                          <th class="th-club text-start text-md-center text-lg-center">Martes</th>
                          <th class="th-club text-start text-md-center text-lg-center">Jueves</th>
                        </tr>
                      </thead>
                      <tbody class="tbody-club">
                        <tr>
                          <td class="text-center">03:00 - 04:00 pm</td>
                          <td class="text-center">Voleibol Primaria</td>
                          <td class="text-center">Voleibol Primaria</td>
                        </tr>
                        <tr>
                          <td class="text-center">04:00 - 05:00 pm</td>
                          <td class="text-center">Voleibol Secundaria</td>
                          <td class="text-center">Voleibol Secundaria</td>
                        </tr>
                        <tr>
                          <td class="text-center">05:00 - 06:00 pm</td>
                          <td class="text-center">Voleibol Preparatoria</td>
                          <td class="text-center">Voleibol Preparatoria</td>
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