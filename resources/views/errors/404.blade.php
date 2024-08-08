@extends('layouts.principal')


@section('title', 'Error 404')

@section('content')
    <!-- Start Error 404 Area -->
    <div class="error-404-area">
        <div class="container">
            <div class="notfound">
                <div class="notfound-bg">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <h1 class="titulo-error"><span class="palabra-u">U</span> <span class="palabra-p">p</span>s!</h1>
                <h3>Error 404 : Página no encontrada</h3>
                <p>Es posible que la página que está buscando haya sido eliminada debido a un cambio de nombre o no esté
                    disponible temporalmente.</p>
                <a href="/" class="default-btn"><i class='bx bx-home-circle icon-arrow before'></i><span
                        class="label">Regresar al Inicio</span><i class="bx bx-home-circle icon-arrow after"></i></a>
            </div>
        </div>
    </div>
    <!-- End Error 404 Area -->
@endsection
