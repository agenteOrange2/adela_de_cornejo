@extends('layouts.principal')

@section('title', 'Mi Cuenta')

@section('content')

<div class="page-title-area item-bg1 jarallax" data-jarallax="{&quot;speed&quot;: 0.3}">
    <div class="container">
        <div class="page-title-content">
            <ul>
                <li><a href="{{ route('index') }}">Inicio</a></li>
                <li>Mi Cuenta</li>
            </ul>
            <h2>Mi Cuenta</h2>
        </div>
    </div>
</div>

<section class="my-account-area ptb-100">
    <div class="container">

        <!-- Información del usuario -->
        @include('students.partials.information-user')

        <!-- Navegación con botones o tabs -->
        <div class="myAccount-navigation">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mi-cuenta/calendarios') ? 'active' : '' }}" href="{{ route('student.calendarios') }}">Calendarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mi-cuenta/menu-cafeteria') ? 'active' : '' }}" href="{{ route('student.menu') }}">Menú de Cafetería</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mi-cuenta/avisos') ? 'active' : '' }}" href="{{ route('student.avisos') }}">Avisos</a>
                </li>
            </ul>
        </div>

        <!-- Contenido dinámico que cambia según la URL -->
        <div class="tab-content mt-4">
            @yield('tab-content') <!-- Aquí se insertará el contenido dinámico -->
        </div>

    </div>
</section>

@endsection
