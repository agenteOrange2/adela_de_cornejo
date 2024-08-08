@extends('layouts.principal')

@section('title', 'Cafetería')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg2 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="page-title-content">
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li>Cafetería</li>
                </ul>
                <h2 class="text-uppercase">Cafetería</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Experience Area -->
    <section class="experience-area ptb-100 bg-f5faf8">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 px-sm-5 px-md-3 ptb-30">
                    <div class="ms-3 me-3 animated">
                        <h2>Cafetería</h2>
                        <div class="title-line_wrapper pb-3">
                            <div class="title-line"></div>
                            <div class="title-line-bg"></div>
                        </div>
                        <p>Contamos un menú adecuado y saludable, balanceado en diversos nutrientes cuidando la salud de
                            nuestros alumnos.
                        </p>
                        <div class="new-comers-content mb-50">
                            <h4>Beneficios de una alimentación correcta:</h4>
                            <ul class="new-comers-list">
                                <li>
                                    <i class='bx bx-receipt'></i>
                                    Promueve una alimentación sana y variada. ...
                                </li>
                                <li>
                                    <i class='bx bx-receipt'></i>
                                    Marca rutinas y horarios en la comida. ...
                                </li>
                                <li>
                                    <i class='bx bx-receipt'></i>
                                    Inculca hábitos de higiene y comportamiento. ...
                                </li>
                                <li>
                                    <i class='bx bx-receipt'></i>
                                    Refuerza la autonomía de los niños y niñas. ...
                                </li>
                                <li>
                                    <i class='bx bx-receipt'></i>
                                    Favorece la convivencia.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 pt-sm-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach($planteles as $plantel)
                            <li class="nav-item" role="presentation">
                                <button class="default-btn nav-link {{ $loop->first ? 'active' : '' }}" id="{{ Str::slug($plantel->name) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($plantel->name) }}" type="button" role="tab" aria-controls="{{ Str::slug($plantel->name) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $plantel->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($planteles as $plantel)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($plantel->name) }}" role="tabpanel" aria-labelledby="{{ Str::slug($plantel->name) }}-tab">
                                @if($plantel->menuPdf)
                                <iframe src="{{ Storage::url($plantel->menuPdf->file_path) }}#view=FitH" width="100%" height="500px"></iframe>
                                    <div class="pt-3">
                                        <a href="{{ Storage::url($plantel->menuPdf->file_path) }}" download class="default-btn">
                                            <i class='bx bx bxs-file-pdf icon-arrow before'></i>
                                            <span class="label">Descargar Menú {{ $plantel->name }}</span>
                                            <i class="bx bx bxs-file-pdf icon-arrow after"></i>
                                        </a>
                                    </div>
                                @else
                                    <p>No hay menú disponible para {{ $plantel->name }}.</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="health-coaching-shape3"><img src="/build/img/logo-adela-black.png" alt="image"></div>
    </section>
    <!-- End Experience Area -->

@endsection
