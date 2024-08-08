<x-admin-layout title="Dashboard" :breadcrumb="[    
    [
        'name' => 'Dashboard',
        'url' => null
    ],
]">

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded shadow-lg px-6 py-4">
        <div class="flex items-center">
        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition flex-shrink-0">
            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        </button>

        <div class="ml-4">
            <h2 class="text-lg font-semibold">
               <span class="text-blue-700">Bienvenido:</span> {{Auth::user()->name}}
            </h2>

            <form action="{{route('logout')}}" method="POST">
                @csrf
                
                <button class="text-red-600 font-bold text-sm hover:text-blue-500">Cerrar Sesion</button>
            </form>
        </div>
    </div>
    </div>
    <div class="bg-white rounded shadow-lg p-6 flex items-center justify-center gap-6">
        <button class="flex text-sm border-2 border-transparent rounded focus:outline-none focus:border-gray-300 transition flex-shrink-0">
            <img class="h-14 w-[100px] rounded object-cover" src="{{asset('favicon.ico')}}" alt="{{ Auth::user()->name }}" />
        </button>
        <h2 class="text-xl font-semibold uppercase">
            <span class="text-red-500">Adela</span>
            <span class="text-yellow-400">De</span>
            <span class="text-blue-700">Cornejo</span>
        </h2>
    </div>    
</div>

<div class="max-w-full mx-auto pt-5">

    <div class="relative w-full h-[600px]  bg-gray-800 rounded-lg overflow-hidden mt-6">
        <img src="{{asset('build/img/banner/banner-oferta-academica.webp')}}" alt="Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center">
            <h2 class="text-3xl font-bold text-white mb-4">Bienvenido {{ Auth::user()->name }}</h2>
            <p class="text-lg text-white">Nuestro compromiso es brindarte la mejor educación</p>            
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <i class="fas fa-exclamation-circle w-14 text-2xl"></i>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">{{ $totalAvisos }}</h2>
                    <p class="text-sm text-gray-500">Total Avisos</p>
                    <a href="{{route('admin.avisos.index')}}" class="text-sm hover:text-blue-500">Ver todos los avisos</a>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="w-14 h-14 bg-yellow-100 text-blue-700 rounded-full flex items-center justify-center mr-4">
                    <i class="far fa-calendar-check text-2xl"></i>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalEventos }}</p>
                    <p class="text-sm text-gray-500">Total Eventos</p>
                    <a href="{{route('admin.eventos.index')}}" class="text-sm hover:text-blue-500">Ver todos los eventos</a>
                </div>
            </div>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="w-14 h-14 bg-red-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                    <i class="far fa-user text-2xl "></i>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalUsuarios }}</p>
                    <p class="text-sm text-gray-500">Total Usuarios</p>
                    <a href="{{route('admin.users.index')}}" class="text-sm hover:text-blue-500">Ver todos los usuarios</a>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <div class="w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-4">
                    <i class="far fa-file-pdf text-2xl "></i>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalCalendariosEscolares }}</p>
                    <p class="text-sm text-gray-500">Todos los calendarios escolares</p>
                    <a href="{{ route('admin.calendarios.index') }}" class="text-sm hover:text-blue-500">Ver todos los calendarios</a>
                </div>
            </div>
        </div>
    </div>




    <!-- Reutilizar 

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Lead By Countries</h2>
            <div class="mb-4">
                <img src="world-map.png" alt="World Map" class="w-full">
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-gray-600">
                    <span>United States of America</span>
                    <span>37.61%</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Brazil</span>
                    <span>16.79%</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>India</span>
                    <span>12.42%</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>China</span>
                    <span>9.85%</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Algeria</span>
                    <span>7.68%</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Indonesia</span>
                    <span>5.11%</span>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Email Sent</h2>
            <div class="flex justify-center items-center">
                <div class="w-48 h-48">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <path class="circle-bg" d="M18 2.0845a15.9155 15.9155 0 1 1 0 31.831a15.9155 15.9155 0 1 1 0-31.831" fill="none" stroke="#e6e6e6" stroke-width="4"></path>
                        <path class="circle" d="M18 2.0845a15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke="#4c51bf" stroke-width="4" stroke-dasharray="73, 100" stroke-linecap="round"></path>
                    </svg>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="text-2xl font-semibold text-gray-800">73%</p>
                <p class="text-gray-600">Opened</p>
                <p class="text-sm text-gray-500">Performance</p>
                <p class="text-lg font-semibold text-gray-800">Average</p>
            </div>
        </div>
    </div>
    
    <div class="flex justify-end">
        <button class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg">View All Leads</button>
    </div>
    -->
</div>

</x-admin-layout>