@extends('layouts.principal')


@section('title', $evento->title)
@section('title', $evento->title)
@section('meta_description', $evento->excerpt)
@section('meta_image', asset('storage/' . $evento->image_path))


@section('content')

    <div class="page-title-area item-bg3 jarallax"
        data-background="{{ $bannerImage ? asset('storage/' . $bannerImage) : asset('build/img/banner/banner-contacto.webp') }}"
        data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('index') }}">Inicio</a></li>
                    <li><a href="{{ route('eventos') }}">Eventos</a></li>
                </ul>
                <h2>{{ $evento->title }}</h2>
            </div>
        </div>
    </div>

    <!-- Start Events Details Area -->
    <section class="events-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="events-details-header">
                        <a href="{{ route('eventos') }}" class="back-all-events"><i class='bx bx-chevrons-left'></i>
                            Regresar
                            a los eventos</a>
                        <h3>{{ $evento->title }}</h3>

                        <div class="events-meta">
                            <ul>
                                <li>
                                    <i class='bx bx-folder-open'></i>
                                    <span>Plantel</span>
                                    <ul class="d-flex flex-column">
                                        @foreach ($evento->planteles as $plantel)
                                            <li class="p-0">
                                                <a
                                                    href="{{ route('eventos.plantel', $plantel->id) }}">{{ $plantel->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <i class='bx bx-group'></i>
                                    <span>Fecha</span>
                                    {{ $evento->formatted_date }}
                                </li>
                                <li>
                                    <i class='bx bx-calendar'></i>
                                    <span>Horario</span>
                                    {{ $evento->formatted_start_time }} - {{ $evento->formatted_end_time }}
                                </li>
                                <li>
                                    <i class='bx bx-calendar'></i>
                                    <span>Evento</span>
                                    {{ $evento->type }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="events-details">
                        <div class="products-details-image">
                            <ul class="slickslide">
                                <li>
                                    <a href="{{ asset('storage/' . $evento->image_path) }}" data-fancybox="gallery"
                                        data-caption="{{ $evento->title }}">
                                        <img src="{{ asset('storage/' . $evento->image_path) }}"
                                            alt="{{ $evento->title }}">
                                    </a>
                                </li>
                                @foreach ($galleryImages as $image)
                                    <li>
                                        <a href="{{ asset('storage/' . $image->path) }}" data-fancybox="gallery"
                                            data-caption="{{ basename($image->path) }}">
                                            <img src="{{ asset('storage/' . $image->path) }}"
                                                alt="{{ basename($image->path) }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="slick-thumbs">
                                <ul>
                                    <li><img src="{{ asset('storage/' . $evento->image_path) }}" alt="image"></li>
                                    @foreach ($galleryImages as $image)
                                        <li><img src="{{ asset('storage/' . $image->path) }}" alt="image"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="events-details-desc">
                            <p>{!! $evento->description !!}
                            </p>
                        </div>
                        <div class="event-details-desc">
                            <div class="event-footer">
                                <div class="event-tags">
                                    <span><i class="bx bx-purchase-tag"></i></span>
                                @foreach ($evento->eventCategories as $category)                                    
                                        <a
                                            href="{{ route('eventos.category', $category->id) }}">{{ $category->name }},
                                        </a>                                    
                                @endforeach                                    
                                </div>

                                <div class="event-share text-end">
                                    <ul class="social">
                                        <li><span>Compartir:</span></li>
                                        <li> <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('eventos.show', $evento)) }}"
                                            target="_blank"><i
                                                    class="bx bxl-facebook"></i></a></li>
                                        <li> <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('eventos.show', $evento)) }}&text={{ urlencode($evento->title) }}"
                                            target="_blank"><i
                                                    class="bx bxl-twitter"></i></a></li>
                                        <li><a href="https://api.whatsapp.com/send?text={{ urlencode($evento->title . ' ' . route('eventos.show', $evento)) }}"
                                            target="_blank"><i
                                                    class="bx bxl-whatsapp"></i></a></li>                                        
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="contenido-videos mt-5 text-md-center modal-play">
                            <div class="row">
                                @foreach ($videos as $video)
                                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                        <a href="{{ $video->url }}"
                                            class="video-btn popup-youtube modal-video-adela video-a">
                                            <div class="card--recipe" data-tilt data-tilt-perspective="900"
                                                data-tilt-max="5" data-tilt-easing="cubic-bezier(.1,.22,.49,.95)">
                                                <img class="card--recipe__img"
                                                    src="https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp" />

                                                <div class="card--recipe__video">
                                                    <video preload="none" src="https://karstenmarijnissen.nl/coop.mp4" loop
                                                        muted="muted"></video>
                                                </div>

                                                <div class="card--recipe__play">

                                                    <img
                                                        src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/372262/Play.svg" />

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="events-info-links">
                            Area Tags
                            <a href="#">+ Google Calendar</a>
                            <a href="#">+ iCal Export</a>
                        </div> --}}

                        <div class="raque-post-navigation">
                            @if ($prevEvento)
                                <div class="prev-link-wrapper">
                                    <div class="info-prev-link-wrapper">
                                        <a href="{{ route('eventos.show', $prevEvento->slug) }}">
                                            <span class="image-prev">
                                                <img src="{{ asset($prevEvento->image) }}" alt="{{ $evento->title }}">
                                                <span class="post-nav-title">Anterior</span>
                                            </span>

                                            <span class="prev-link-info-wrapper">
                                                <span class="prev-title">{{ $prevEvento->title }}</span>
                                                <span class="meta-wrapper">
                                                    <span class="date-post">{{ $prevEvento->formatted_date }}</span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($nextEvento)
                                <div class="next-link-wrapper">
                                    <div class="info-next-link-wrapper">
                                        <a href="{{ route('eventos.show', $nextEvento->slug) }}">
                                            <span class="next-link-info-wrapper">
                                                <span class="next-title">{{ $nextEvento->title }}</span>
                                                <span class="meta-wrapper">
                                                    <span class="date-post">{{ $nextEvento->formatted_date }}</span>
                                                </span>
                                            </span>

                                            <span class="image-next">
                                                <img src="{{ asset($nextEvento->image) }}" alt="{{ $evento->title }}">
                                                <span class="post-nav-title">Siguiente</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        <section class="widget widget_events_details">
                            <h3 class="widget-title">Detalles del evento</h3>

                            <ul>
                                <li><span>Hora de inicio:</span> {{ $evento->formatted_start_time }} -
                                    {{ $evento->formatted_date }}</li>
                                <li><span>Hora de fin:</span> {{ $evento->formatted_end_time }} -
                                    {{ $evento->formatted_date }}</li>
                                <li><span>Categoría:</span>
                                    <ul>
                                        @foreach ($evento->eventCategories as $category)
                                            <li>
                                                <a
                                                    href="{{ route('eventos.category', $category->id) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </section>

                        <section class="widget widget_events_details">
                            <h3 class="widget-title">Organizador</h3>
                            <ul>
                                <li><span>Organizador:</span> {{ $evento->organizer }} </li>
                            </ul>
                        </section>

                        <section class="widget widget_events_details">
                            <h3 class="widget-title">Ubicación</h3>

                            <ul>
                                <li><a href="{{ $evento->maps }}" target="_blank"><i class='bx bxs-map'></i>
                                        {{ $evento->location }}</a></li>
                            </ul>
                        </section>
                        <section class="widget widget_contact">
                            <div class="text">
                                <div class="icon">
                                    <i class='bx bxl-whatsapp'></i>
                                </div>
                                <span>Contacto vía WhatsApp</span>
                                <a href="https://api.whatsapp.com/send?phone=+526561214356&text=Necesito%20mas%20informaci%C3%B3n"
                                    target="_blank">656 121 4356</a>
                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Events Details Area -->


@endsection
