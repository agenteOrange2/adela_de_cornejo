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
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="box-filter-l">
                                        <button id="filterToggle" class="btn btn-primary">Filtrar</button>
                                    </div>
                                    <div class="box-filter-r">
                                        <!-- Sección para mostrar filtros aplicados -->
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="box-quitar-filtros">
                                                    @if (request('filter'))
                                                        <div id="applied-filters" class="mb-3">
                                                            <strong>Filtros aplicados:</strong>
                                                            <ul class="list-inline">
                                                                @if (request('filter.eventCategories.id'))
                                                                    <li class="list-inline-item">
                                                                        Categoría ID: {{ request('filter.eventCategories.id') }}
                                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                                    </li>
                                                                @endif
                                                                @if (request('filter.title'))
                                                                    <li class="list-inline-item">
                                                                        Título: "{{ request('filter.title') }}"
                                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                                    </li>
                                                                @endif
                                                                @if (request('filter.planteles.id'))
                                                                    <li class="list-inline-item">
                                                                        Plantel ID: {{ request('filter.planteles.id') }}
                                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                                    </li>
                                                                @endif
                                                                @if (request('filter.date_between.0') && request('filter.date_between.1'))
                                                                    <li class="list-inline-item">
                                                                        Fecha: {{ request('filter.date_between.0') }} - {{ request('filter.date_between.1') }}
                                                                        <a href="{{ route('eventos') }}" class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="mb-3">
                                                            <a href="{{ route('eventos') }}" class="btn btn-secondary">Quitar todos los filtros</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filtros -->
                                <div id="filter-container" class="contenedor_filtros p-3 border rounded"
                                    style="display: none; opacity: 0; transition: opacity 0.5s ease;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>Filtros</h5>
                                        <button id="close-filters" class="btn btn-link text-secondary">&times;</button>
                                    </div>
                                    <form id="filters-form" method="GET" action="{{ route('eventos') }}">
                                        <div class="row">
                                            <!-- Filtro por Fecha de Publicación -->
                                            <div class="col-md-4 mb-3">
                                                <label for="dateRange">Fecha de Publicación</label>
                                                <input type="date" id="dateRangeStart" name="filter[date_between][]"
                                                    class="form-control" placeholder="Inicio"
                                                    value="{{ request('filter.date_between.0') }}">
                                                <input type="date" id="dateRangeEnd" name="filter[date_between][]"
                                                    class="form-control mt-2" placeholder="Fin"
                                                    value="{{ request('filter.date_between.1') }}">
                                            </div>

                                            <!-- Filtro por Plantel -->
                                            <div class="col-md-4 mb-3">
                                                <label for="plantelFilter">Plantel</label>
                                                <select id="plantelFilter" name="filter[planteles.id]" class="form-control">
                                                    <option value="">Seleccionar Plantel</option>
                                                    @foreach ($planteles as $plantel)
                                                        <option value="{{ $plantel->id }}">{{ $plantel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Filtro por Categoría -->
                                            <div class="col-md-4 mb-3">
                                                <label for="categoryFilter">Categoría</label>
                                                <select id="categoryFilter" name="filter[eventCategories.id]"
                                                    class="form-control">
                                                    <option value="">Seleccionar Categoría</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Filtro por Título -->
                                            <div class="col-md-12 mb-3">
                                                <label for="titleFilter">Título</label>
                                                <input type="text" id="titleFilter" name="filter[title]"
                                                    class="form-control" placeholder="Buscar por título"
                                                    value="{{ request('filter.title') }}">
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

                            <!-- Mensaje de advertencia -->
                            <div id="filter-warning" class="alert alert-danger mt-3" style="display: none;">
                                Por favor, elija al menos un filtro antes de aplicar.
                            </div>
                        </div>
                    </div>

                    <!-- Lista de eventos -->
                    <div id="eventos-list" class="row">
                        @if ($eventos->count())
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
                                            <a href="{{ route('eventos.show', $evento) }}"
                                                class="read-more-btn">Continuar
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
                        @else
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p>No se encontraron eventos para los filtros aplicados.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        <!-- Formulario de búsqueda -->
                        <section class="widget widget_search">
                            <form class="search-form" action="{{ route('eventos') }}" method="GET">
                                <label>
                                    <span class="screen-reader-text">Buscar por:</span>
                                    <input type="search" name="filter[title]" class="search-field"
                                        placeholder="Buscar..." value="{{ request('filter.title') }}">
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
                                        <a href="{{ route('eventos', ['filter[eventCategories.id]' => $category->id]) }}">
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

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Mostrar/Ocultar filtros al hacer clic en el botón "Filtrar"
                const filterToggle = document.getElementById('filterToggle');
                const filterContainer = document.getElementById('filter-container');
                const closeFilters = document.getElementById('close-filters');
                const filterForm = document.getElementById('filters-form');
                const filterWarning = document.getElementById('filter-warning');
                const clearAllFilters = document.getElementById('clear-all-filters');

                filterToggle.addEventListener('click', function() {
                    filterContainer.style.display = 'block';
                    setTimeout(function() {
                        filterContainer.style.opacity = '1';
                    }, 10);
                });

                // Ocultar filtros al hacer clic en el botón "Cerrar"
                closeFilters.addEventListener('click', function() {
                    filterContainer.style.opacity = '0';
                    setTimeout(function() {
                        filterContainer.style.display = 'none';
                    }, 500);
                });

                // Validación para verificar que al menos un filtro esté seleccionado
                filterForm.addEventListener('submit', function(event) {
                    const dateRangeStart = document.getElementById('dateRangeStart').value;
                    const dateRangeEnd = document.getElementById('dateRangeEnd').value;
                    const plantelFilter = document.getElementById('plantelFilter').value;
                    const categoryFilter = document.getElementById('categoryFilter').value;
                    const titleFilter = document.getElementById('titleFilter').value;

                    if (!dateRangeStart && !dateRangeEnd && !plantelFilter && !categoryFilter && !titleFilter) {
                        event.preventDefault(); // Detener el envío del formulario
                        filterWarning.style.display = 'block'; // Mostrar advertencia
                    } else {
                        filterWarning.style.display = 'none'; // Ocultar advertencia
                    }
                });

                // Limpiar todos los filtros
                clearAllFilters.addEventListener('click', function() {
                    document.getElementById('dateRangeStart').value = '';
                    document.getElementById('dateRangeEnd').value = '';
                    document.getElementById('plantelFilter').value = '';
                    document.getElementById('categoryFilter').value = '';
                    document.getElementById('titleFilter').value = '';
                    filterForm.submit();
                });
            });
        </script>
    @endpush

@endsection
