@extends('layouts.principal')

@section('title', 'Mi Cuenta - Calendarios')

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

            <!-- Contenido específico de los calendarios -->

            <div class="content_account">
                <h3>Calendarios Disponibles</h3>

                @if ($calendarios->isEmpty())
                    <div class="message">
                        <p>No hay calendarios disponibles en este momento.</p>
                    </div>
                @else
                    <ul class="account_calendar_list">
                        @foreach ($calendarios as $calendario)
                            <li>
                                <i class='bx bxs-file-pdf' ></i>
                                <a href="{{ asset('storage/' . $calendario->file_path) }}" target="_blank">
                                    {{ $calendario->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
@endsection
