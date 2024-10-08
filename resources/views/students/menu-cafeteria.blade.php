@extends('layouts.principal')

@section('title', 'Mi Cuenta - Menú de Cafetería')

@section('content')

@include('students.partials.information-user-header')
    <section class="my-account-area ptb-100">
        <div class="container">
            @include('students.partials.information-user')

            <!-- Navegación con botones o tabs -->
            <div class="myAccount-navigation">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/calendarios') ? 'active' : '' }}"
                            href="{{ route('student.calendarios') }}"><i class='bx bxs-calendar'></i> Calendarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/menu-cafeteria') ? 'active' : '' }}"
                            href="{{ route('student.menu') }}"><i class='bx bx-food-menu'></i>Menú de Cafetería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/avisos') ? 'active' : '' }}"
                            href="{{ route('student.avisos') }}"><i class='bx bxs-alarm-exclamation'></i>Avisos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/calificaciones') ? 'active' : '' }}"
                            href="{{ route('student.calificaciones') }}"><i class='bx bxs-pen' ></i>Calificaciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mi-cuenta/datos-medicos') ? 'active' : '' }}"
                            href="{{ route('student.datos-medicos') }}"><i class='bx bx-plus-medical' ></i>Datos Médicos
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contenido específico del menú de cafetería -->
            <div class="content_account">
                @if ($menuCafeteria->isEmpty())
                    <div class="message">
                        <h3>Menú de Cafetería</h3>
                        <p>No hay menús de cafetería disponibles.</p>
                    </div>
                @else
                    <div class="content_succefull">
                        <ul class="account_calendar_list">
                            @foreach ($menuCafeteria as $menu)
                                <h3>Menú de Cafetería</h3>
                                <li>
                                    <i class='bx bxs-file-pdf' ></i>
                                    <a href="{{ asset('storage/' . $menu->file_path) }}"
                                        target="_blank">{{ $menu->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
    </section>

@endsection
