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
                    
                    <div class="container mt-4">
                        <div class="row">
                            <!-- Contenedor de Filtros -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Sort
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="sortDropdown">
                                            <a class="dropdown-item" href="{{ route('eventos', ['sort' => 'popular']) }}">Most Popular</a>
                                            <a class="dropdown-item" href="{{ route('eventos', ['sort' => 'rating']) }}">Best Rating</a>
                                            <a class="dropdown-item" href="{{ route('eventos', ['sort' => 'newest']) }}">Newest</a>
                                        </div>
                                    </div>
                                    <button id="clear-all-filters" class="btn btn-link text-secondary">Clear all</button>
                                </div>
                    
                                <!-- Filtros -->
                                <div class="contenedor_filtros p-3 border rounded">
                                    <form id="filters-form" method="GET" action="{{ route('eventos') }}">
                                        <div class="row">
                                            <!-- Filtro por Fecha -->
                                            <div class="col-md-3 mb-3">
                                                <label for="dateRange">Fecha de Publicación</label>
                                                <input type="date" id="dateRangeStart" name="filter[start_date]" class="form-control" placeholder="Inicio">
                                                <input type="date" id="dateRangeEnd" name="filter[end_date]" class="form-control mt-2" placeholder="Fin">
                                            </div>
                                            
                                            <!-- Filtro por Plantel -->
                                            <div class="col-md-3 mb-3">
                                                <label for="plantelFilter">Plantel</label>
                                                <select id="plantelFilter" name="filter[plantel_id]" class="form-control">
                                                    <option value="">Seleccionar Plantel</option>
                                                    @foreach ($planteles as $plantel)
                                                        <option value="{{ $plantel->id }}">{{ $plantel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                    
                                            <!-- Filtro por Categoría -->
                                            <div class="col-md-3 mb-3">
                                                <label for="categoryFilter">Categoría</label>
                                                <select id="categoryFilter" name="filter[categories.id]" class="form-control">
                                                    <option value="">Seleccionar Categoría</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                    
                                            <!-- Filtro por Título -->
                                            <div class="col-md-3 mb-3">
                                                <label for="titleFilter">Título</label>
                                                <input type="text" id="titleFilter" name="filter[title]" class="form-control" placeholder="Buscar por título">
                                            </div>
                                        </div>
                    
                                        <!-- Botón Aplicar Filtros -->
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Sección para mostrar filtros aplicados -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="box-quitar-filtros">
                                    @if (request('filter'))
                                        <div id="applied-filters" class="mb-3">
                                            <strong>Filtros aplicados:</strong>
                                            <ul class="list-inline">
                                                @if (request('filter.categories.id'))
                                                    <li class="list-inline-item">
                                                        Categoría:
                                                        {{ $categories->firstWhere('id', request('filter.categories.id'))->name }}
                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar filtro</a>
                                                    </li>
                                                @endif
                                                @if (request('filter.title'))
                                                    <li class="list-inline-item">
                                                        Título: "{{ request('filter.title') }}"
                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar filtro</a>
                                                    </li>
                                                @endif
                                                @if (request('filter.plantel_id'))
                                                    <li class="list-inline-item">
                                                        Plantel:
                                                        {{ $planteles->firstWhere('id', request('filter.plantel_id'))->name }}
                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar filtro</a>
                                                    </li>
                                                @endif
                                                @if (request('filter.start_date') && request('filter.end_date'))
                                                    <li class="list-inline-item">
                                                        Fecha: {{ request('filter.start_date') }} - {{ request('filter.end_date') }}
                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar filtro</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Botón para quitar todos los filtros -->
                                        <div class="mb-3">
                                            <a href="{{ route('eventos') }}" class="btn btn-secondary">Quitar todos los filtros</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    

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
