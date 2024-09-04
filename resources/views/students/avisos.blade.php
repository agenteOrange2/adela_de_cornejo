@extends('layouts.principal')

@section('title', 'Mi Cuenta - Avisos')

@section('content')

    <section class="my-account-area ptb-100">
        <div class="container">
            @include('students.partials.information-user')

            <!-- Navegación con botones o tabs -->
            <div class="myAccount-navigation">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/calendarios') ? 'active' : '' }}"
                            href="{{ route('student.calendarios') }}">Calendarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/menu-cafeteria') ? 'active' : '' }}"
                            href="{{ route('student.menu') }}">Menú de Cafetería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/avisos') ? 'active' : '' }}"
                            href="{{ route('student.avisos') }}">Avisos</a>
                    </li>
                </ul>
            </div>

            <!-- Contenido específico de los avisos -->
            <h3>Avisos</h3>
            @if ($avisos->isEmpty())
                <p>No hay avisos disponibles.</p>
            @else
                <ul>
                    @foreach ($avisos as $aviso)
                        <li><a href="{{ route('avisos.show', $aviso) }}">{{ $aviso->title }}</a></li>
                    @endforeach
                </ul>
            @endif

        </div>
    </section>

@endsection
