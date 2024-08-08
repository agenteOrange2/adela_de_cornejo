@extends('layouts.principal')

@section('title', 'Campus Iv Siglos')

@section('content')

    <div class="page-title-area  jarallax" data-background="/build/img/banner/banner-admisiones.webp"
        data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="campus-iv-siglos">Campus IV Siglos</a></li>
                </ul>
                <h2>Campus IV Siglos</h2>

            </div>
        </div>
    </div>

    <!-- Start Experience Area -->
    <section class="experience-area ptb-100 bg-f5faf8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="experience-content animated">
                        <span class="sub-title">Adela de Cornejo</span>
                        <h2>{{ $plantel->name }}</h2>
                        <div class="title-line_wrapper">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <p class="text-justify pt-3">{{ $plantel->description }}</p>
                        <p><span>Dirección: </span>{{ $plantel->address }}</p>
                        <p><span>Teléfono: </span>{{ $plantel->phone }}</p>
                        <p><span>Correo electrónico: </span>{{ $plantel->email }}</p>
                    </div>
                </div>

                <div class="col-lg col-md-12 pt-5 pt-md-0">
                    <a href="{{ Storage::url($plantel->image_path) }}" data-toggle="lightbox" data-gallery="hidden-images"
                        class="col-6 col-sm-6 pb-3">
                        <img src="{{ Storage::url($plantel->image_path) }}" class="img-fluid" alt="{{ $plantel->name }}">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Experience Area -->
@endsection
