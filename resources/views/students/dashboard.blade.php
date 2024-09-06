@extends('layouts.principal')

@section('title', 'Mi Cuenta')

@section('content')


@include('students.partials.information-user-header')

<section class="my-account-area ptb-100">
    <div class="container">

        <!-- Información del usuario -->
        @include('students.partials.information-user')

        <!-- Navegación con botones o tabs -->
        <div class="myAccount-navigation">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mi-cuenta/calendarios') ? 'active' : '' }}" href="{{ route('student.calendarios') }}"><i class='bx bxs-calendar'></i>Calendarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mi-cuenta/menu-cafeteria') ? 'active' : '' }}" href="{{ route('student.menu') }}"><i class='bx bx-food-menu' ></i>Menú de Cafetería</a>
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
