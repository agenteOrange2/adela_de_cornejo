@extends('layouts.principal')


@section('title', 'Admision Primaria')

@section('content')
    <div class="page-title-area  jarallax" data-jarallax='{"speed": 0.3}'
        data-background="/build/img/banner/banner-admisiones.webp">
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/oferta-academica">Oferta Académica</a></li>
                </ul>
                <h2>Admision - Primaria</h2>

            </div>
        </div>
    </div>

    <!-- Start Experience Area -->
    <section class="experience-area ptb-50 bg-f5faf8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="experience-content animated">
                        <span class="sub-title">Adela de cornejo</span>
                        <h2>Primaria</h2>
                        <div class="title-line_wrapper">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <p class="text-justify pt-3">Nuestro programa educativo está basado en el desarrollo de
                            inteligencias
                            múltiples y
                            con un programa
                            bilingüe de excelente calidad, a lo que sumamos los programas educativos de vanguardia para un
                            óptimo
                            avance académico para nuestros alumnos. Nuestro programa se complementa con clases
                            extracurriculares como
                            computación, educación física y música.
                        </p>
                        <h5>Servicios</h5>
                        <ul class="features-list">
                            <li><span><i class="bx bx-check"></i>Bilingüe</span></li>
                            <li><span><i class="bx bx-check"></i>Educación física </span></li>
                            <li><span><i class="bx bx-check"></i>Taller de valores</span></li>
                            <li><span><i class="bx bx-check"></i>Taller de arte y manualidades</span></li>
                            <li><span><i class="bx bx-check"></i>Actividades despues de la escuela</span></li>
                            <li><span><i class="bx bx-check"></i>Estancia</span></li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg col-md-12">
                    <a href="/build/img/galeria/Instalacion.webp" data-toggle="lightbox" data-gallery="hidden-images"
                        class="col-6 col-sm-6 pb-3">
                        <img src="/build/img/galeria/Instalacion.webp" class="img-fluid">
                    </a>

                </div>
            </div>
        </div>

        <div class="health-coaching-shape3"><img src="/build/img/logo-adela-black.png" alt="image"></div>
    </section>
    <!-- End Experience Area -->

    <section class="pt-10 header tabs-admision">
        <div class="container-fluid pt-4 p-column">
            <div class="col-lg-12 col-md-12">
                <div class="tab products-details-tab">
                    <div class="row tabs_admisiones">
                        <div class="col-lg-3 col-md-12">
                            <ul class="tabs">
                                <li><a href="#" data-plantel-id="1" class="plantel-link">
                                        <div class="dot"></div> Calendario Triunfo
                                    </a></li>
                                <li><a href="#" data-plantel-id="2" class="plantel-link">
                                        <div class="dot"></div> Calendario Iv Siglos
                                    </a></li>
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="tab-content" id="pdf-container">
                                <!-- Aquí se cargarán los PDFs -->
                            </div>
                            <div id="loader" class="d-none flex justify-center items-center my-4">
                                <span class="loader"></span>
                                <p>Cargando...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sección nueva Admsión --}}
    <section class="ptb-15 header tabs-admision">
        <div class="container-fluid py-4 p-column">
            <div class="col-lg-12 col-md-12">
                <div class="tab products-details-tab">
                    <div class="row tabs_admisiones">
                        <div class="col-lg-3 col-md-12">
                            <ul class="tabs">
                                <li><a href="#">
                                        <div class="dot"></div> Metodologías del aprendizaje
                                    </a></li>

                                <li><a href="#">
                                        <div class="dot"></div> Valores y Virtudes
                                    </a></li>

                                <li><a href="#">
                                        <div class="dot"></div> Inglés como segundo idioma
                                    </a></li>
                                <li><a href="#">
                                        <div class="dot"></div> Ambientes de aprendizaje
                                    </a></li>                                
                            </ul>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="tab-content">
                                <div class="tabs-item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="pt-10 text-center text-md-start text-lg-start">Metodología del
                                                aprendizaje</h4>
                                            <div class="title-line_wrapper pb-3">
                                                <div class="title-line"></div>
                                                <div class="title-line-bg"></div>
                                            </div>
                                            <p class="font-italic text-muted mb-2">En nuestro Creative Lab, un espacio de
                                                aprendizaje, les
                                                permite
                                                aplicar conocimientos jugando de forma interdisciplinar utilizando
                                                diferentes escenarios.
                                            </p>

                                            ‍
                                            <p class="font-italic text-muted mb-2"> Creamos situaciones centradas en el
                                                alumno, basadas en
                                                retos
                                                reales, para llevarles a resolver problemas
                                                y pensar de forma creativa a través del juego. <br>
                                                Nuestros alumnos aprenden a través de 9 áreas de conocimiento: ciencia,
                                                danza, narración,
                                                ciudadanía,
                                                jardinería, música, arte, comunicación y alfabetización.</p>

                                            ‍
                                            <p class="font-italic text-muted mb-2">Ámbitos:
                                            </p>
                                            ‍
                                            <p class="font-italic text-muted mb-2">Desarrollar el pensamiento crítico, el
                                                pensamiento
                                                creativo y
                                                habilidades de colaboración.
                                                Construir su propio conocimiento.
                                                Fomentar el autoaprendizaje.
                                                Expresar emociones e ideas
                                                Tecnología para expresar y compartir ideas.
                                            </p>
                                            <p class="font-italic text-muted mb-2">
                                                ¡Estamos preparando a diseñadores del futuro!</p>

                                        </div>
                                    </div>
                                </div>

                                <div class="tabs-item">
                                    <div class="products-details-tab-content">
                                        <h5 class="pt-10 pb-3 text-center text-md-start text-lg-start">Valores y virtudes
                                        </h5>
                                        <div class="title-line_wrapper pb-3">
                                            <div class="title-line"></div>
                                            <div class="title-line-bg"></div>
                                        </div>
                                        <p class="font-italic text-muted mb-2">Con nuestro programa de virtudes NET, se
                                            desarrollan
                                            estrategias y
                                            herramientas que facilitan la educación socioemocional y formación humana en los
                                            alumnos. Se
                                            promueven
                                            ambientes positivos que a través de estas estrategias suscitan el dinamismo de
                                            virtudes.
                                            Se muestra el bien con ejemplos concretos para que el alumno reconozca los
                                            beneficios y se
                                            motive
                                            libremente a realizarlos. Se promueve una disciplina firme, y amable a la vez,
                                            tomando en
                                            cuenta la
                                            necesidad de identidad y pertenencia.</p>
                                    </div>
                                </div>

                                <div class="tabs-item">
                                    <div class="products-details-tab-content">
                                        <h5 class="pt-10 pb-3 text-center text-md-start text-lg-start">Inglés como segundo
                                            idioma</h5>
                                        <div class="title-line_wrapper pb-3">
                                            <div class="title-line"></div>
                                            <div class="title-line-bg"></div>
                                        </div>
                                        <p class="font-italic text-muted mb-2">En Adela de Cornejo, los alumnos amplían su
                                            vocabulario
                                            y aprenden el uso
                                            correcto del inglés, a un nivel alto, más allá de lo funcional. Esto se logra
                                            recursos de
                                            lectura
                                            utilizados alumnos nativos en escuelas de países de habla inglesa.</p>
                                    </div>
                                </div>

                                <div class="tabs-item">
                                    <div class="products-details-tab-content">
                                        <h5 class="pt-10 pb-3 text-center text-md-start text-lg-start">Ambientes de
                                            aprendizaje</h5>
                                        <div class="title-line_wrapper pb-3">
                                            <div class="title-line"></div>
                                            <div class="title-line-bg"></div>
                                        </div>
                                        <p class="font-italic text-muted mb-2">Educamos en todo momento, espacio y
                                            ambiente. Cualquier
                                            oportunidad, dentro y fuera del salón de clases, se aprovecha para desarrollar
                                            una
                                            intervención
                                            educativa-formativa.Contamos con diversos recursos que nos apoyan en este
                                            proceso:

                                            Ambientes y espacios formativos, flexibles, interactivos y colaborativos, que
                                            propician el
                                            aprendizaje
                                            personal, trascendente y comunitario. ‍
                                            Materiales educativos físicos y digitales, que ayudan a potenciar las
                                            capacidades del alumno
                                            según el
                                            perfil de egreso esperado.‍
                                            Tecnología educativa, con la que se favorece la investigación y la producción de
                                            contenidos
                                            y soluciones
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- Sección nueva Admsión --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const plantelLinks = document.querySelectorAll('.plantel-link');
            const pdfContainer = document.getElementById('pdf-container');
            const loader = document.getElementById('loader');

            // Obtener el ID del nivel educativo desde la variable de Blade
            const levelId = @json($levelId);

            plantelLinks.forEach(link => {
                link.addEventListener('click', async function(event) {
                    event.preventDefault();
                    const plantelId = this.getAttribute('data-plantel-id');

                    try {
                        loader.classList.remove('d-none');
                        pdfContainer.innerHTML = ''; // Clear existing PDFs

                        const response = await fetch(
                            `/get-pdfs-by-plantel-and-level?plantel_id=${plantelId}&level_id=${levelId}`
                        );
                        const data = await response.json();

                        const carousel = document.createElement('div');
                        carousel.classList.add('courses-categories-slides', 'owl-carousel',
                            'owl-theme', 'm-0');
                        pdfContainer.appendChild(carousel);

                        data.forEach(pdf => {
                            const pdfElement = document.createElement('div');
                            pdfElement.classList.add('pdf-single', 'text-center',
                                'py-3');
                            pdfElement.innerHTML = `
                        <a href="/storage/${pdf.file_path}" target="_blank">
                            <div class="card_pdf">
                                <img src="/build/img/icon/pdf.png" alt="${pdf.name}" class="img-pdf" width="70">
                                <div class="pdf-description pt-2">
                                    <h3 class="fs-6">${pdf.name}</h3>
                                </div>
                            </div>
                        </a>`;
                            carousel.appendChild(pdfElement);
                        });

                        // Reinitialize Owl Carousel
                        $(document).ready(function() {
                            $('.courses-categories-slides').owlCarousel({
                                loop: false,
                                margin: 10,
                                nav: true,
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 5
                                    }
                                }
                            });
                        });

                    } catch (error) {
                        console.error('Error fetching PDFs:', error);
                        pdfContainer.innerHTML =
                            '<p>Error al cargar los PDFs. Inténtalo de nuevo más tarde.</p>';
                    } finally {
                        // Hide loader after content is loaded or in case of an error
                        loader.classList.add('d-none');
                    }
                });
            });
        });
    </script>

@endsection
