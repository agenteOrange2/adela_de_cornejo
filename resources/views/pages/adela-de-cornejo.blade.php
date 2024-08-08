
@extends('layouts.principal')

@section('title', 'Nosotros')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area  jarallax" data-background="/build/img/banner/banner-contacto.webp" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li>Adela de Cornejo</li>
                </ul>
                <h2 class="text-uppercase">Adela de Cornejo</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Experience Area -->
    <a name="bienvenida"></a>
    <section class="experience-area ptb-100 bg-f5faf8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="experience-content animated">
                        <a name="bienvenida"></a>
                        <span class="sub-title">Adela de cornejo</span>
                        <h2>Bienvenida</h2>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <p>Somos una institución que se distingue por su servicio educativo integral de calidad. Para
                            nosotros, nuestros alumnos son lo más importante, por lo que ofrecemos un alto nivel
                            académico, excelentes y amplias instalaciones, atención personalizada, todo con el objetivo
                            primordial de formar personas exitosas en su entorno social, escolar y familiar.
                        </p>
                        <ul class="features-list">
                            <li><span><i class="bx bx-check"></i>Vanguardia en la educación</span></li>
                            <li><span><i class="bx bx-check"></i> Años de experiencia</span></li>
                            <li><span><i class="bx bx-check"></i> Docentes capacitados</span></li>
                            <li><span><i class="bx bx-check"></i> Formación Bilingüe</span></li>
                            <li><span><i class="bx bx-check"></i> Accesible</span></li>
                            <li><span><i class="bx bx-check"></i> Clases de calidad</span></li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="experience-image animated">
                        <img src="/build/img/nosotros/Nosotros.webp" alt="Adela de cornejo">
                    </div>
                </div>
            </div>

            <!-- Start Story Area -->
            <a name="quienes"></a>
            <section class="story-area pt-100 pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="section-title text-left">
                                <h2>¿Quiénes somos?</h2>
                                <div class="title-line_wrapper pb-3">
                                    <div class="title-line"></div>
                                    <div class="title-line-bg"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12">
                            <div class="story-content animated">

                                <p>Somos una institución que oferta un servicio educativo bilingüe en los niveles
                                    educativos de preescolar, primaria y secundaria. Ofrecemos un servicio de alta
                                    calidad académica accesible para nuestra comunidad.
                                </p>
                            </div>
                        </div>
                        <!-- Acordeon -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            <div class="number-accordion background-color-blue">
                                                <div>1</div>
                                            </div>
                                            Preparamos a nuestros alumnos para la vida
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            con nuestro modelo educativo y pedagógico enfocado en potenciar sus talentos
                                            y capacidades y desarrollar gradualmente competencias.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            <div class="number-accordion background-color-blue">
                                                <div>2</div>
                                            </div>
                                            Formamos niños y jóvenes felices
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            Que disfrutan de su experiencia en el colegio, que conviven y crecen de
                                            forma sana en un entorno que potencia sus talentos y cuida de su corazón.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            <div class="number-accordion background-color-blue">
                                                <div>3</div>
                                            </div>
                                            Formamos con virtudes y valores
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            Que ayudan a los alumnos a adaptarse al cambio, elegir el bien, ser felices
                                            contando con el respaldo y la fuerza de la fe cristiana.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                            <div class="number-accordion background-color-blue">
                                                <div>4</div>
                                            </div>
                                            Nuestros alumnos aprenden en dos idiomas
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingFour">
                                        <div class="accordion-body">
                                            Logran un alto dominio del idioma que les permite estudiar y desempeñarse
                                            profesionalmente en una segunda lengua.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                            <div class="number-accordion background-color-blue">
                                                <div>5</div>
                                            </div>
                                            Acompañamos a nuestros alumnos y a sus familias
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingFive">
                                        <div class="accordion-body">
                                            Con trato personalizado para guiarlos y apoyarlos con base en sus
                                            necesidades y circunstancias.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Acordeon -->
                        <!-- Acordeon -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseSix">
                                            <div class="number-accordion background-color-blue">
                                                <div>6</div>
                                            </div>
                                            Fomentamos la innovación y la creación de soluciones

                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingSix">
                                        <div class="accordion-body">
                                            Con metodologías, recursos y tecnologías que permiten el aprendizaje
                                            cooperativo y experiencial.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                                            <div class="number-accordion background-color-blue">
                                                <div>7</div>
                                            </div>
                                            Potenciamos el liderazgo de nuestros alumnos
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingSeven">
                                        <div class="accordion-body">
                                            Para que ejerzan un liderazgo cristiano y de servicio en el que se potencia
                                            el pensamiento crítico y la capacidad de cambiar el mundo que les rodea.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingEight">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEight"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseEight">
                                            <div class="number-accordion background-color-blue">
                                                <div>8</div>
                                            </div>
                                            Potenciamos el liderazgo de nuestros alumnos
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingEight">
                                        <div class="accordion-body">
                                            Para que ejerzan un liderazgo cristiano y de servicio en el que se potencia
                                            el pensamiento crítico y la capacidad de cambiar el mundo que les rodea.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNine"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseNine">
                                            <div class="number-accordion background-color-blue">
                                                <div>9</div>
                                            </div>
                                            Tenemos amplia experiencia en el sector educativo
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingNine">
                                        <div class="accordion-body">
                                            Contamos con años de trabajo dedicado a la educación. Contamos con la experiencia y calidad que nos respaldan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Acordeon -->
                    </div>
                </div>
            </section>
            <!-- End Story Area -->





        </div>

        <div class="health-coaching-shape3"><img src="/build//img/logo-adela-black.png" alt="image"></div>
    </section>
    <!-- End Experience Area -->



    <!-- Start Story Area -->
    <a name="modeloeducativo"></a>
    <section class="story-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-12 model-e mode-title mb-50 animated">
                    <div class="section-title text-left model-color">
                        <h2>Modelo Educativo usado</h2>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 mt-sm-5">
                    <div class="story-content ms-3 me-3 animated">
                        <h3>Modelo Educativo usado</h3>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <p>Nuestro sistema de enseñanza, basado en competencias, propicia el desarrollo de inteligencias
                            múltiples, las capacidades, habilidades y creatividad que cada alumn@ posee en lo
                            particular. Ofrecemos un sistema 100% bilingüe, con un programa completo de actividades
                            extraescolares, deportivas y culturales.
                        </p>
                        <h3>Misión</h3>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <p>Somos una institución que proporciona una educación integral de calidad a nuestros alumnos,
                            todo con la finalidad de impactar, desde nuestra esfera de actuación, el contexto social,
                            familiar y personal de cada uno de ellos, motivándolos a ser mejores personas y a descubrir
                            sus propias capacidades y habilidades para desarrollarse con infinitas posibilidades.
                        </p>
                        <h3>Visión</h3>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>

                        <p>Ser una institución educative multi-competente, que fomente un entorno positivo en donde
                            nuestros alumnus puedan deesarrollarse en el ámbito personal y social, generando futuros
                            ciudadanos comprometidos con su comunidad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Story Area -->
    @endsection