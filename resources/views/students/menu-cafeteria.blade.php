@extends('layouts.principal')

@section('title', 'Mi Cuenta - Menú de Cafetería')

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

            <!-- Contenido específico del menú de cafetería -->
            <h3>Menú de Cafetería</h3>
            @if ($menuCafeteria->isEmpty())
                <p>No hay menús de cafetería disponibles.</p>
            @else
                <ul>
                    @foreach ($menuCafeteria as $menu)
                        <li><a href="{{ asset('storage/' . $menu->file_path) }}" target="_blank">{{ $menu->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>

@endsection
