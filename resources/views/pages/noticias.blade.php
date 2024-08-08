@extends('layouts.principal')


@section('title', 'Noticias')

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg3 jarallax" data-background="{{ asset('build/img/banner/banner-contacto.webp') }}"
        data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="{{ route('index') }}">Inicio</a></li>
                    <li><a href="{{ route('noticias') }}">Noticias</a></li>
                </ul>
                <h2>Noticias Adela de Cornejo</h2>                
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Blog Area -->
    <section class="blog-area ptb-100">
        <div class="container">

            {{-- <div class="courses-topbar">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-4">
                            <div class="topbar-result-count">
                                <p>Showing 1 – 6 of 54</p>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8">
                            <div class="topbar-ordering-and-search">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-5 offset-lg-4 offset-md-1">
                                        <form action="{{route('noticias')}}">
                                            <div class="topbar-ordering">                                            
                                                <select>                                                
                                                    <option>Sort by popularity</option>
                                                    <option>Sort by latest</option>
                                                    <option>Default sorting</option>
                                                    <option>Sort by rating</option>
                                                    <option>Sort by new</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-lg-5 col-md-6">
                                        <div class="topbar-search">
                                            <form>
                                                <label><i class="bx bx-search"></i></label>
                                                <input type="text" class="input-search" placeholder="Buscar...">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">

                        @foreach ($noticias as $noticia)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-post mb-30">
                                    <div class="post-image">
                                        <a href="{{ route('noticias.show', $noticia) }} " class="d-block">
                                            <div class="image-wrapper">
                                                <img src="{{ $noticia->image }}" alt="{{ $noticia->title }}">
                                            </div>
                                        </a>


                                        <div class="tag">
                                            @foreach ($noticia->tags as $tag)
                                                <a
                                                    href="{{ route('noticias') . '?tag=' . $tag->name }}">{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="post-content">
                                        <ul class="post-meta">
                                            <li class="post-author">


                                                Autor : <a href="#" class="d-inline-block">{{ $noticia->user->name }}
                                                </a>

                                            </li>
                                            <li>{{ $noticia->published_at->format('d M Y') }}</li>
                                        </ul>
                                        <h3><a href="{{ route('noticias.show', $noticia) }}"
                                                class="d-inline-block">{{ $noticia->title }}</a></h3>
                                        <a href="{{ route('noticias.show', $noticia) }}" class="read-more-btn">Continuar
                                            Leyendo ... <i class='bx bx-right-arrow-alt'></i></a>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination-container">
                            {{ $noticias->links() }}
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        {{-- <section class="widget widget_search">
          
                            </section> --}}

                        <section class="widget widget_categories">
                            <h3 class="widget-title">Categorias</h3>
                            <form action="{{ route('noticias') }}">

                                {{-- <div class="col-xs-6 col-sm-12 col-md-6 mt-2 pb-3">
                                    <div class="form-group">
                                        <strong>Ordenar :</strong>
                                        <select name="order">                                            
                                            <option value="new">Más Nuevos</option>
                                            <option value="old" @selected(request('order') == 'old')>Más Antiguos</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="filter-categories">
                                    {{-- <div class="filter-box">
                                        <ul class="categories py-3">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <label class="label-checkbox">
                                                        <input type="checkbox" name="category[]"
                                                            value="{{ $category->id }}"
                                                            {{ is_array(request('category')) && in_array($category->id, request('category')) ? 'checked' : '' }}>
                                                        <span
                                                            class="post-count">{{ $category->name }}({{ $category->noticias_count }})</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <button type="submit" href="#" class="default-btn"><i
                                                class='bx bx-paper-plane icon-arrow before'></i><span class="label">Aplicar
                                                Filtrar</span><i class="bx bx-paper-plane icon-arrow after"></i></button>
                                    </div> --}}

                                    <ul>

                                        {{-- <li><a href="#">Categoryname <span class="post-count">(03)</span></a></li>  --}}
        
                                        @foreach ($categories as $category)
                                            <li>
                                                {{-- <a href="{{route('noticias') . '?noticia=' . $category->name }}">{{ $category->name }} <span
                                                        class="post-count">({{ $category->noticias_count }})</span></a> --}}
        
                                                        <a href="{{ route('noticias', ['category' => $category->name]) }}">{{ $category->name }} <span class="post-count">({{ $category->noticias_count }})</span></a>
        
                                            </li>
                                        @endforeach
        
        
                                </div>                                
                            </form>
                        </section>
                        <section class="widget widget_contact">
                            <div class="text">
                                <div class="icon">
                                    <i class='bx bx-phone-call'></i>
                                </div>
                                <span>Emergency</span>
                                <a href="#">+0987-9876-8753</a>
                            </div>
                        </section>
                    </aside>
                </div>
                {{-- Sidebar --}}
            </div>
        </div>
    </section>
    <!-- End Blog Area -->
@endsection
