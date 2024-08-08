@extends('layouts.principal')


@section('title', 'Eventos')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg3 jarallax" data-background="{{ asset('build/img/banner/banner-contacto.webp') }}"
        data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('index') }}">Inicio</a></li>
                    <li><a href="{{ route('eventos') }}">Eventos</a></li>
                </ul>
                <h2>Eventos Adela de Cornejo</h2>
            </div>
        </div>
    </div>
    <section class="blog-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <!-- Botón Quitar Filtros -->
                    <div id="filter-controls" class="mb-3" style="display: none;">
                        <button id="clear-filters" class="btn btn-secondary">Quitar filtros <span
                                class="bx bx-x"></span></button>
                    </div>
                    <div class="row" id="eventos-list">
                        @foreach ($eventos as $evento)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-post mb-30">
                                    <div class="post-image">
                                        <a href="{{ route('eventos.show', $evento) }}" class="d-block">
                                            <img src="{{ $evento->image_url }}" alt="{{ $evento->title }}">
                                        </a>
                                        <div class="tag">
                                            <a href="#" class="d-block">{{ $evento->type }}</a>
                                        </div>
                                    </div>
                                    <div class="post-content">
                                        <ul class="post-meta">
                                            <li class="post-author">
                                                <img src="{{ asset('build/img/logo-adela-black.webp') }}"
                                                    class="d-inline-block rounded-circle mr-2" alt="image">
                                                <span class="d-inline-block">Adela de Cornejo</span>
                                            </li>
                                            <li><a href="#">{{ $evento->formatted_created_at }}</a></li>
                                        </ul>
                                        <h3><a href="{{ route('eventos.show', $evento) }}"
                                                class="d-inline-block">{{ $evento->title }}</a></h3>
                                        <a href="{{ route('eventos.show', $evento) }}" class="read-more-btn">Continuar
                                            Leyendo <i class='bx bx-right-arrow-alt'></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="pagination-area text-center">
                                {{ $eventos->links($paginatorView ?? null) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        <section class="widget widget_search">
                            <form id="search-form" class="search-form">
                                <label>
                                    <span class="screen-reader-text">Buscar por:</span>
                                    <input type="search" id="search-input" class="search-field" placeholder="Buscar...">
                                </label>
                                <button type="submit"><i class="bx bx-search-alt"></i></button>
                            </form>
                        </section>




                        <section class="widget widget_categories">
                            <h3 class="widget-title">Categorías</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('eventos.category', $category->id) }}">{{ $category->name }}
                                            <span class="post-count">({{ $category->events_count }})</span></a></li>
                                @endforeach
                            </ul>
                        </section>


                        <!-- Sección de Últimos Eventos -->
                        <section class="widget widget_raque_posts_thumb">
                            <h3 class="widget-title">Últimos eventos</h3>
                            @foreach ($latestEventos as $evento)
                                <article class="item">
                                    <a href="{{ route('eventos.show', $evento) }}" class="thumb">
                                        <img src="{{ $evento->image_url }}" alt="{{ $evento->title }}">
                                    </a>
                                    <div class="info">
                                        <time
                                            datetime="{{ $evento->formatted_date }}">{{ $evento->formatted_date }}</time>
                                        <h4 class="title usmall"><a
                                                href="{{ route('eventos.show', $evento) }}">{{ $evento->title }}</a></h4>
                                    </div>
                                    <div class="clear"></div>
                                </article>
                            @endforeach
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar la búsqueda AJAX
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                let query = $('#search-input').val();
                $.ajax({
                    url: '{{ route('eventos.ajaxSearch') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        query: query
                    },
                    success: function(response) {
                        let eventos = response.eventos;
                        let eventosList = $('#eventos-list');
                        eventosList.empty();

                        if (eventos.length > 0) {
                            eventos.forEach(function(evento) {
                                let eventoHtml = `
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-blog-post mb-30">
                                            <div class="post-image">
                                                <a href="${evento.show_url}" class="d-block">
                                                    <img src="${evento.image_url}" alt="${evento.title}">
                                                </a>
                                                <div class="tag">
                                                    <a href="#" class="d-block">${evento.type}</a>
                                                </div>
                                            </div>
                                            <div class="post-content">
                                                <ul class="post-meta">
                                                    <li class="post-author">
                                                        <img src="{{ asset('build/img/logo-adela-black.webp') }}" class="d-inline-block rounded-circle mr-2" alt="image">
                                                        <span class="d-inline-block">Adela de Cornejo</span>
                                                    </li>
                                                    <li><a href="#">${new Date(evento.created_at).toLocaleDateString()}</a></li>
                                                </ul>
                                                <h3><a href="${evento.show_url}" class="d-inline-block">${evento.title}</a></h3>
                                                <a href="${evento.show_url}" class="read-more-btn">Continuar Leyendo <i class='bx bx-right-arrow-alt'></i></a>
                                            </div>
                                        </div>
                                    </div>`;
                                eventosList.append(eventoHtml);
                            });

                            // Mostrar el botón "Quitar filtros"
                            $('#filter-controls').show();
                        } else {
                            eventosList.append('<p>No se encontraron eventos.</p>');
                        }
                    }
                });
            });

            // Manejar el clic en el botón "Quitar filtros"
            $('#clear-filters').on('click', function() {
                $.ajax({
                    url: '{{ route('eventos') }}',
                    method: 'GET',
                    success: function(response) {
                        let eventosList = $('#eventos-list');
                        eventosList.empty();
                        $(response).find('#eventos-list').children().each(function() {
                            eventosList.append($(this));
                        });

                        // Ocultar el botón "Quitar filtros"
                        $('#filter-controls').hide();
                    }
                });
            });
        });
    </script>
@endsection
