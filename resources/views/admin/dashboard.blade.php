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




    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-4">
        <div>
            <div class="box pull-up">
                <div class="box-body">
                    <div class="flex justify-between items-center">
                        <div class="bs-5 ps-10 border-primary">
                            <p class="text-fade mb-10">Customers</p>	
                            <h2 class="my-0 fw-700 text-3xl">4,562</h2>					
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-users bg-primary-light me-0 fs-24 rounded-3"></i>
                        </div>
                    </div>
                    <p class="text-success mb-0 mt-10"><i class="fa-solid fa-arrow-up"></i> +8.5% since last week</p>
                </div>
            </div>
        </div>
        <div>
            <div class="box pull-up">
                <div class="box-body">
                    <div class="flex justify-between items-center">
                        <div class="bs-5 ps-10 border-info">
                            <p class="text-fade mb-10">Revenue</p>	
                            <h2 class="my-0 fw-700 text-3xl">$5,125</h2>					
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-hand-holding-dollar bg-info-light me-0 fs-24 rounded-3"></i>
                        </div>
                    </div>
                    <p class="text-danger mb-0 mt-10"><i class="fa-solid fa-arrow-down"></i> -0.10% since last week</p>
                </div>
            </div>
        </div>
        <div>
            <div class="box pull-up">
                <div class="box-body">
                    <div class="flex justify-between items-center">
                        <div class="bs-5 ps-10 border-warning">
                            <p class="text-fade mb-10">Invoices</p>	
                            <h2 class="my-0 fw-700 text-3xl">2,145</h2>					
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-file-invoice bg-warning-light me-0 fs-24 rounded-3"></i>
                        </div>
                    </div>
                    <p class="text-success mb-0 mt-10"><i class="fa-solid fa-arrow-up"></i> +10.5% since last week</p>
                </div>
            </div>
        </div>
        <div>
            <div class="box pull-up">
                <div class="box-body">
                    <div class="flex justify-between items-center">
                        <div class="bs-5 ps-10 border-danger">
                            <p class="text-fade mb-10">Profit</p>	
                            <h2 class="my-0 fw-700 text-3xl">70%</h2>					
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-sack-dollar bg-danger-light me-0 fs-24 rounded-3"></i>
                        </div>
                    </div>
                    <p class="text-danger mb-0 mt-10"><i class="fa-solid fa-arrow-down"></i> -0.5% since last week</p>
                </div>
            </div>
        </div>
    </div>
</div>

</x-admin-layout>