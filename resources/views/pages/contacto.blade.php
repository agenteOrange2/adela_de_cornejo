@extends('layouts.principal')

@section('title', 'Contacto')

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg2 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li>Contacto</li>
                </ul>
                <h2>Contáctanos</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Contact Info Area -->
    <section class="contact-info-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box mb-30">
                        <div class="icon">
                            <i class='bx bx-envelope'></i>
                        </div>

                        <h3>Correo electrónico</h3>
                        <p><a href="mailto:direccion@adeladecornejo.com">direccion@adeladecornejo.com</a></p>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box mb-30">
                        <div class="icon">
                            <i class='bx bx-map'></i>
                        </div>

                        <h3>Campus Triunfo:</h3>
                        <div class="box-contenido-contacto text-start">
                            <ul class="list-group">
                                <li class="list-group">
                                    <a href="tel:+526566115070" class="color-contact"><span class="fw-bold">Tel :
                                        </span> (656)-611-50-70</a>
                                    <a href="https://goo.gl/maps/ju6azYRdGxVLFaNy9" target="_blank"><span
                                            class="fw-bold color-contact">Dirección : </span> Plutarco Elias
                                        Calles
                                        228, Col. 2da. Burócrata, CP 32340</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box mb-30">
                        <div class="icon">
                            <i class='bx bx-map'></i>
                        </div>

                        <h3>Campus IV Siglos:</h3>
                        <div class="box-contenido-contacto text-start">
                            <ul class="list-group">
                                <li class="list-group">
                                    <a href="tel:+526566115070" class="color-contact"><span class="fw-bold">Tel :
                                        </span>(656)-611-50-20</a>
                                    <a href="https://goo.gl/maps/HTKT4czESHr9C1ox8" target="_blank"><span
                                            class="fw-bold color-contact">Dirección : </span>Calzada del Río 9950,
                                        Col. Partido Senecú.</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="particles-js-circle-bubble-2"></div>
    </section>
    <!-- End Contact Info Area -->

    <!-- Start Contact Area -->
    <section class="contact-area pb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Contáctanos</span>
                <h2>Envíanos un mensaje</h2>
                <p>Solicite mayor información, visite el colegio privado bilingüe de Ciudad Juárez de excelencia</p>
            </div>

            <div class="contact-form">
                <form id="contactForm" method="POST" action="{{route('contacto.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" 
                                    data-error="Por favor ingresa tu nombre" placeholder="Nombre">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" 
                                    data-error="Por favor ingresa tu correo electrónico"
                                    placeholder="Correo electrónico">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" 
                                    data-error="Por favor ingresa tu teléfono" class="form-control"
                                    placeholder="Teléfono">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <input type="text" name="msg_subject" id="msg_subject" class="form-control" 
                                    data-error="Por favor ingrese tu asunto" placeholder="Asunto">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="5"
                                    data-error="Escribe tu mensaje" placeholder="Mensaje"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <button type="submit" class="default-btn"><i
                                    class='bx bx-paper-plane icon-arrow before'></i><span class="label">Envíar</span><i
                                    class="bx bx-paper-plane icon-arrow after"></i></button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="particles-js-circle-bubble-3"></div>
        <div class="contact-bg-image"><img src="/build/img/map.png" alt="image"></div>
    </section>
    <!-- End Contact Area -->
@endsection