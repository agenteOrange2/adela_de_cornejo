@extends('layouts.principal')

@section('title', 'Editar Mi Cuenta')

@section('content')

<div class="page-title-area  jarallax" data-background="{{asset('/build/img/banner/banner_white_adela.jpg')}}"
    data-jarallax='{"speed": 0.3}'>
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li><a class="text-primary" href="{{ route('index') }}">Home</a></li>
                <li class="text-danger">Editar Mi Cuenta</li>
            </ul>
            <h2 class="text-danger">Editar Mi Cuenta</h2>
        </div>
    </div>
</div>

<section class="my-account-area ptb-100">
    <div class="container">
        <form action="{{ route('student.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="profile-image">
                        <img src="{{ $user->profile_photo_url }}" alt="image">
                        <input type="file" name="profile_photo" class="form-control mt-2">
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <div class="profile-content">
                        <h3>Información Personal</h3>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
