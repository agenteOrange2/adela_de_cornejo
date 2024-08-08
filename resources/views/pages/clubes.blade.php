@extends('layouts.principal')

@section('title', 'Clubes')

@section('content')
<div class="page-title-area  jarallax" data-background="/build/img/clubes/banners/banner_clubes_adela_de_coernejo.webp" data-jarallax='{"speed": 0.3}'>
    <div class="container">
      <div class="page-title-content">
        <ul>
          <li><a href="/">Inicio</a></li>
          <li><a href="servicios">Servicios</a></li>
        </ul>
        <h2>Clubes</h2>
      </div>
    </div>
  </div>

  <section class="experience-area ptb-100 bg-f5faf8">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12">
          <div class="experience-content animated">
            <a name="bienvenida"></a>
            <!-- <span class="sub-title">Adela de cornejo</span> -->
            <h2>Clubes en Adela de Cornejo</h2>
            <div class="title-line_wrapper pb-3">
              <div class="title-line"></div>
              <div class="title-line-bg"></div>
            </div>
            <p>Con la finalidad de ofrecer actividades extracurriculares y fomentar el desarrollo
              de las inteligencias múltiples, el Instituto Adela de Cornejo oferta los siguientes
              clubes: </p>

            <p>Como parte de nuestra oferta y con la finalidad de promover el desarrollo de las inteligencias múltiples
              en nuestros alumnos, contamos con el servicio de clubes, con actividades extra escolares, en horario
              posterior a las clases. Entre nuestro clubes se encuentran:
            </p>

          </div>
        </div>

        <div class="col-lg-6 col-md-12">
          <div class="experience-image animated">
            <img src="/build/img/clubes/clubes_adela_de_cornejo.webp" alt="Clubes adela de cornejo">
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Start Courses Categories Area -->
  <section class="courses-categories-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/baloncesto.png" alt="icono de baloncesto">
            </div>
            <h3>Básquetbol</h3>
            <a href="/clubes/basquetbol" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/ajedrez.png" alt="icono de ajedrez">
            </div>
            <h3>Ajedrez </h3>
            <a href="/clubes/ajedrez" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/hip-hop.png" alt="icono de hip hop">
            </div>
            <h3>Hip-Hop</h3>
            <a href="/clubes/hip-hop" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/futbol.png" alt="icono de futbol">
            </div>
            <h3>Fútbol</h3>
            <a href="/clubes/futbol" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/artes.png" alt="icono de artes">
            </div>
            <h3>Artes</h3>
            <a href="/clubes/artes" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/voleibol.png" alt="icono de voleibol">
            </div>
            <h3>Voleibol</h3>
            <a href="/clubes/voleibol" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/taekwondo.png" alt="icono de taekwondo">
            </div>
            <h3>Taekwondo</h3>
            <a href="/clubes/taekwondo" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/jazz-baile.png" alt="icono">
            </div>
            <h3>Jazz</h3>
            <a href="/clubes/jazz" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/musica.png" alt="icono de música">
            </div>
            <h3>Música</h3>
            <a href="/clubes/musica" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/coro.png" alt="icono">
            </div>
            <h3>Coro</h3>
            <a href="/clubes/coro" class="link-btn"></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="single-categories-courses-box mb-30">
            <div class="icon">
              <img src="/build/img/icon/robotica.png" alt="icono de robotica">
            </div>
            <h3>Robótica</h3>
            <a href="/clubes/robotica" class="link-btn"></a>
          </div>
        </div>
        <!-- <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="pagination-area text-center">
            <span class="page-numbers current" aria-current="page">1</span>
            <a href="#" class="page-numbers">2</a>
            <a href="#" class="page-numbers">3</a>
            <a href="#" class="page-numbers">4</a>
            <a href="#" class="page-numbers">5</a>
            <a href="#" class="next page-numbers"><i class='bx bx-chevron-right'></i></a>
          </div>
        </div> -->
      </div>
    </div>

    <div id="particles-js-circle-bubble-2"></div>
  </section>
  <!-- End Courses Categories Area -->

@endsection