@extends('layouts.principal')

@section('title', 'Eventos')

@section('content')
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
                    <!-- Sección para mostrar filtros aplicados -->
                    @if (request('filter'))
                        <div id="applied-filters" class="mb-3">
                            <strong>Filtros aplicados:</strong>
                            <ul class="list-inline">
                                @if (request('filter.categories.id'))
                                    <li class="list-inline-item">
                                        Categoría:
                                        {{ $categories->firstWhere('id', request('filter.categories.id'))->name }}
                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar
                                            filtro</a>
                                    </li>
                                @endif
                                @if (request('filter.title'))
                                    <li class="list-inline-item">
                                        Título: "{{ request('filter.title') }}"
                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar
                                            filtro</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <!-- Botón para quitar todos los filtros -->
                        <div class="mb-3">
                            <a href="{{ route('eventos') }}" class="btn btn-secondary">Quitar todos los filtros</a>
                        </div>
                    @endif

                    <div id="eventos-list" class="row">
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
                        <!-- Formulario de búsqueda -->
                        <section class="widget widget_search">
                            <form class="search-form" action="{{ route('eventos') }}" method="GET">
                                <label>
                                    <span class="screen-reader-text">Buscar por:</span>
                                    <input type="search" name="filter[title]" class="search-field" placeholder="Buscar...">
                                </label>
                                <button type="submit"><i class="bx bx-search-alt"></i></button>
                            </form>
                        </section>

                        <!-- Filtro por Categorías -->
                        <section class="widget widget_categories">
                            <h3 class="widget-title">Categorías</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('eventos', ['filter[categories.id]' => $category->id]) }}">
                                            {{ $category->name }} <span
                                                class="post-count">({{ $category->events_count }})</span>
                                        </a>
                                    </li>
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
@endsection
