@props([
    'breadcrumb' => [],
    ])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Dashboard' }} - {{ config('app.name') }}</title>
    {{-- <title>{{ config('app.name', 'Primero tu Hogar') }}</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicon icon -->    
    <link rel="shortcut icon" href="{{ asset('build/img/logo-adela-de-cornejo.ico') }}" type="image/x-icon">

    <script src="https://kit.fontawesome.com/cc7eb48181.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    @livewireStyles

    @stack('css')
</head>

<body x-data="{ sidebarOpen: window.innerWidth >= 1024 }" class="font-sans antialiased sm:overflow-auto">

    @include('layouts.includes.admin.nav')

    @include('layouts.includes.admin.aside')

    <!-- Main Content -->
    <div class="transition-all duration-300 p-4 dark:bg-gray-900"
        :class="{'ml-0': !sidebarOpen || window.innerWidth < 1024, 'lg:ml-64': sidebarOpen && window.innerWidth >= 1024}">
        <div class="mt-14 -mb-10 flex flex-col md:flex-row justify-between items-center">
            <div class="w-full md:w-auto mb-4 md:mb-0">
                @include('layouts.includes.admin.breadcrumb')
            </div>
            @isset($action)
                <div class="w-full md:w-auto flex justify-end">
                    {{ $action }}
                </div>
            @endisset
        </div>

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 dark:bg-gray-900">
            {{ $slot }}
        </div>
    </div>

    <div x-show="sidebarOpen && window.innerWidth < 1024" x-on:click="sidebarOpen = false"
        class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30 lg:hidden"></div>
    
    @stack('modals')

    @livewireScripts

    @stack('js')
    {{-- <script src="https://flowbite.com/docs/flowbite.min.js?v=2.3.0a"></script> --}}
    @if (session('swal'))
        <script>
            Swal.fire(@json(session('swal')))
        </script>
    @endif
    <script src="{{ asset('build/assets/ckeditor/ckeditor.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuLinks = document.querySelectorAll('.menu-link');

            function toggleDropdown(submenuId) {
                const submenu = document.getElementById('submenu-' + submenuId);
                const link = document.getElementById('menu-link-' + submenuId);
                if (submenu.style.maxHeight) {
                    submenu.style.maxHeight = null;
                    link.classList.remove('bg-gray-700');
                } else {
                    document.querySelectorAll('.submenu').forEach(s => s.style.maxHeight = null);
                    document.querySelectorAll('.menu-link').forEach(l => l.classList.remove('bg-blue-700'));
                    submenu.style.maxHeight = submenu.scrollHeight + "px";
                    link.classList.add('bg-blue-700');
                }
            }

            menuLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const submenuId = this.getAttribute('data-submenu-id');
                    toggleDropdown(submenuId);
                });
            });
        });

    </script>


</body>

</html>
