@extends('layouts.principal')


@section('title', $aviso->title)


@section('content')

    <div class="page-title-area item-bg3 jarallax" data-background="{{ asset('build/img/banner/banner-contacto.webp') }}"
        data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('index') }}">Inicio</a></li>
                    <li><a href="{{ route('avisos') }}">Aviso</a></li>
                </ul>
                <h2>{{ $aviso->title }}</h2>
            </div>
        </div>
    </div>

    <!-- Start Events Details Area -->
    <section class="events-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="events-details-header">
                        <a href="{{ route('avisos') }}" class="back-all-events"><i class='bx bx-chevrons-left'></i> Regresar
                            a los avisos</a>
                        <h3>{{ $aviso->title }}</h3>

                        <ul class="events-info-meta d-none">
                            <li><i class="flaticon-timetable"></i> {{ $aviso->created_at->isoFormat('D MMM Y') }}</li>
                        </ul>

                        <div class="events-meta">
                            <ul>
                                <li>
                                    <i class='bx bx-group'></i>
                                    <span>Fecha de publicación</span>
                                    {{ $aviso->formatted_created_at }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="events-details">
                        <div class="events-details-image">
                            <img src="{{ $aviso->image }}" alt="Aviso {{ $aviso->title }}">
                        </div>

                        <div class="events-details-desc">
                            {!! $aviso->body !!}
                        </div>
                        <div class="raque-post-navigation">
                            @if ($prevAviso)
                                <div class="prev-link-wrapper">
                                    <div class="info-prev-link-wrapper">
                                        <a href="{{ route('avisos.show', $prevAviso->slug) }}">
                                            <span class="image-prev">
                                                <img src="{{ asset($prevAviso->image) }}" alt="{{ $aviso->title }}">
                                                <span class="post-nav-title">Anterior</span>
                                            </span>

                                            <span class="prev-link-info-wrapper">
                                                <span class="prev-title">{{ $prevAviso->title }}</span>
                                                <span class="meta-wrapper">
                                                    <span class="date-post">{{ $prevAviso->formatted_created_at }}</span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($nextAviso)
                                <div class="next-link-wrapper">
                                    <div class="info-next-link-wrapper">
                                        <a href="{{ route('avisos.show', $nextAviso->slug) }}">
                                            <span class="next-link-info-wrapper">
                                                <span class="next-title">{{ $nextAviso->title }}</span>
                                                <span class="meta-wrapper">
                                                    <span class="date-post">{{ $nextAviso->formatted_created_at }}</span>
                                                </span>
                                            </span>

                                            <span class="image-next">
                                                <img src="{{ asset($nextAviso->image) }}" alt="{{ $aviso->title }}">
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
                        @if ($pdfs->isNotEmpty())
                        <section class="widget widget_events_details">
                            <h3 class="widget-title">Descargas</h3>
                            <ul>
                                @foreach ($pdfs as $pdf)
                                <li class="download">
                                    <i class="bx bxs-file-pdf"></i>
                                    <a href="{{ asset($pdf->path) }}" download="{{ $pdf->name }}">{{ $pdf->display_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                        @endif                                                        
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Events Details Area -->
@endsection
