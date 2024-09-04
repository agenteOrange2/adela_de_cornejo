@extends('layouts.principal')

@section('title', 'Mi Cuenta - Calendarios')

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
            
            <!-- Contenido específico de los calendarios -->
            <h3>Calendarios</h3>
            @if ($calendarios->isEmpty())
                <p>No hay calendarios disponibles.</p>
            @else
                <ul>
                    @foreach ($calendarios as $calendario)
                        <li><a href="{{ asset('storage/' . $calendario->file_path) }}"
                                target="_blank">{{ $calendario->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
        </div>
    @endsection
