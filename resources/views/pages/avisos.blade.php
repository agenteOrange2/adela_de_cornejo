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

        <!-- Start Events Area -->
        <section class="events-area pt-100 pb-70">
            <div class="container">
                @foreach ($avisos as $aviso)                                    
                <div class="single-events-box mb-30">
                    <div class="events-box">
                        <div class="events-image">
                            <a href="{{ route('avisos.show', $aviso) }}">
                                <img src="{{ $aviso->image }}" alt="imagen {{$aviso->title}}">
                            </a>
                        </div>

                        <div class="events-content">
                            <div class="content">
                                <h3><a href="{{ route('avisos.show', $aviso) }}">{{$aviso->title}}</a></h3>
                                <p>{{$aviso->excerpt}}</p>                                
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
            </div>
        </section>
        <!-- End Events Area -->
@endsection
