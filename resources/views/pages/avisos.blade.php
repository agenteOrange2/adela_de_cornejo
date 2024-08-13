@extends('layouts.principal')


@section('title', 'Avisos')

@section('content')
    <div class="page-title-area item-bg3 jarallax" data-background="{{ asset('build/img/banner/banner-contacto.webp') }}"
        data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('index') }}">Inicio</a></li>
                    <li><a href="{{ route('avisos') }}">Avisos</a></li>
                </ul>
                <h2>Avisos Adela de Cornejo</h2>
            </div>
        </div>
    </div>


    <!-- Filtros y Filtros Aplicados -->
    <div class="container mt-4 mb-4 px-0">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="box-filter-l">
                        <button id="filterToggle" class="btn btn-filtering d-flex align-items-center">
                            Filtrar
                            <i class='bx bx-filter-alt ms-2'></i>
                        </button>
                    </div>
                    <div class="box-filter-r">
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="box-quitar-filtros">
                                    @if (request('filter'))
                                        <div class="mb-3">
                                            <a href="{{ route('avisos') }}"
                                                class="btn btn-filtering d-flex align-items-center">
                                                Quitar todos los filtros
                                                <i class='bx bx-window-close ms-2'></i>
                                            </a>
                                        </div>
                                        <div id="applied-filters" class="mb-3">
                                            <strong>Filtros aplicados:</strong>
                                            <ul class="list-inline">
                                                @if (request('filter.categories.id'))
                                                    <li class="list-inline-item">
                                                        Categoría ID: {{ request('filter.categories.id') }}
                                                        <a href="{{ route('avisos') }}"
                                                            class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                    </li>
                                                @endif
                                                @if (request('filter.title'))
                                                    <li class="list-inline-item">
                                                        Título: "{{ request('filter.title') }}"
                                                        <a href="{{ route('avisos') }}"
                                                            class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                    </li>
                                                @endif
                                                @if (request('filter.planteles.id'))
                                                    <li class="list-inline-item">
                                                        Plantel ID: {{ request('filter.planteles.id') }}
                                                        <a href="{{ route('avisos') }}"
                                                            class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                    </li>
                                                @endif
                                                @if (request('filter.date_between.0') && request('filter.date_between.1'))
                                                    <li class="list-inline-item">
                                                        Fecha: {{ request('filter.date_between.0') }} -
                                                        {{ request('filter.date_between.1') }}
                                                        <a href="{{ route('avisos') }}"
                                                            class="btn btn-danger btn-sm ml-2">Quitar</a>
                                                    </li>
                                                @endif
                                            </ul>
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
                    <button id="close-filters" class="btn btn-filtering d-flex align-items-center  btn-link">
                        Cerrar<i class='bx bxs-message-alt-x ms-2'></i>
                    </button>
                </div>
                <form id="filters-form" method="GET" action="{{ route('avisos') }}">
                    <div class="row">
                        <!-- Filtro por Fecha de Publicación -->
                        <div class="col-md-4 mb-3">
                            <label for="dateRange">Fecha de Publicación</label>
                            <div class="form-group">
                                <input type="date" id="dateRangeStart" name="filter[date_between][]"
                                    class="form-control" placeholder="Inicio"
                                    value="{{ request('filter.date_between.0') }}">
                            </div>
                            <div class="form-group">
                                <input type="date" id="dateRangeEnd" name="filter[date_between][]"
                                    class="form-control mt-2" placeholder="Fin"
                                    value="{{ request('filter.date_between.1') }}">
                            </div>
                        </div>
            
                        <!-- Filtro por Plantel -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="plantelFilter">Plantel</label>
                                <div class="select-box">
                                    <select id="plantelFilter" name="filter[planteles.id]" class="form-control">
                                        <option value="">Seleccionar Plantel</option>
                                        @foreach ($planteles as $plantel)
                                            <option value="{{ $plantel->id }}">{{ $plantel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
            
                        <!-- Filtro por Categoría -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="categoryFilter">Categoría</label>
                                <select id="categoryFilter" name="filter[categories.id]" class="form-control">
                                    <option value="">Seleccionar Categoría</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
            
                        <!-- Filtro por Título -->
                        <div class="col-md-12 mb-3">
                            <label for="titleFilter">Título</label>
                            <input type="text" id="titleFilter" name="filter[title]" class="form-control"
                                placeholder="Buscar por título" value="{{ request('filter.title') }}">
                        </div>
            
                        <!-- Filtro por Ordenamiento -->
                        <div class="col-md-12 mb-3">
                            <label for="sortDirection">Ordenar por:</label>
                            <div class="form-group">
                                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'desc') == 'asc' ? 'desc' : 'asc' }}">
                            </div>
                        </div>
                    </div>
            
                    <!-- Botón Aplicar Filtros -->
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-filtering d-flex align-items-center">
                                Aplicar Filtros <i class='bx bx-search-alt ms-2'></i>
                            </button>
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

    <!-- Start Events Area -->
    <section class="events-area pt-100 pb-70">
        <div class="container">
            <!-- Filtros de Ordenación -->
            @foreach ($avisos as $aviso)
                <div class="single-events-box mb-30">
                    <div class="events-box">
                        <div class="events-image">
                            <a href="{{ route('avisos.show', $aviso) }}">
                                <img src="{{ $aviso->image }}" alt="imagen {{ $aviso->title }}">
                            </a>
                        </div>

                        <div class="events-content">
                            <div class="content">
                                <h3><a href="{{ route('avisos.show', $aviso) }}">{{ $aviso->title }}</a></h3>
                                <p>{{ $aviso->excerpt }}</p>
                                <a href="{{ route('avisos.show', $aviso) }}" class="join-now-btn">Continuar Leyendo</a>
                            </div>
                        </div>

                        <div class="events-date">
                            <div class="date">
                                <div class="d-table">
                                    <div class="d-table-cell">
                                        <span>{{ $aviso->created_at->isoFormat('D') }}</span>
                                        <h3>{{ $aviso->created_at->isoFormat('MMM') }}</h3>
                                        <p>{{ $aviso->created_at->isoFormat('Y') }}</p>
                                        <i class='bx bx-calendar'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pagination-area text-center">
                    {{-- {{ $avisos->links('vendor.pagination.bootstrap-5-frontend') }} --}}
                </div>
            </div>
        </div>
    </section>
    <!-- End Events Area -->


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
