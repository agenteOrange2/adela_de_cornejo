@extends('layouts.principal')

@section('title', 'Admisiones')

@section('content')
<div class="page-title-area jarallax" data-jarallax='{"speed": 0.3}'
    data-background="/build/img/banner/banner-admisiones.webp">
    <div class="container">
      <div class="page-title-content">
        <ul>
          <li><a href="oferta-academica">Oferta Académica</a></li>
          <li>Admisiones</li>
        </ul>
        <h2 class="text-uppercase">Admisiones</h2>
      </div>
    </div>
  </div>

  <section class="experience-area ptb-100 bg-f5faf8">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-8 col-9 px-3">
          <h4> Puede realizar la inscripción de sus hij@s al Instituto Adela de Cornejo mediante los siguientes
            procedimientos:
          </h4>

          <h5 class="pt-5">Agendando una cita directamente en el campus de tu elección:</h5>

          <ul class="pt-3">
            <li>Campus IV Siglos: Teléfono 6566115070
            </li>
            <li>Campus Triunfo: Teléfono 6566115020
            </li>
          </ul>

          <h2>Documentación requerida</h2>
          <div class="new-comers-content">
            <ul class="new-comers-list">
              <li>
                <i class='bx bx-receipt'></i>
                Dos copias de acta de nacimiento del menor.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Una copia de cartilla de vacunación.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                4 fotografías tamaño infantil, a blanco y negro o a color.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Copia de comprobante de domicilio.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Copia de identificación de padre y madre o tutor del menor
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Dos fotografías de cada personal autorizada a recoger al menor.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Llenado de ficha de inscripción.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Firma de reglamento.
              </li>
              <li>
                <i class='bx bx-receipt'></i>
                Comprobante de estudios.
              </li>
            </ul>
          </div>

        </div>
        <div class="col-12 col-md-4 col-4 px-3  pt-4 pt-md-0">
          <h3>Conoce nuestra oferta educativa</h3>
          <div class="title-line_wrapper pb-3">
            <div class="title-line"></div>
            <div class="title-line-bg"></div>
          </div>

          <div class="content-btn-oferta">
            <a href="/admision-preescolar" class="text-uppercase btn-oferta-e btn-rojo">Preescolar</a>
            <a href="/admision-primaria" class="text-uppercase btn-oferta-e btn-azul">Primaria</a>
            <a href="/admision-secundaria" class="text-uppercase btn-oferta-e btn-amarillo">Secundaria</a>
          </div>

          <div class="logo">
            <img src="/build/img/logo-adela-black.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection