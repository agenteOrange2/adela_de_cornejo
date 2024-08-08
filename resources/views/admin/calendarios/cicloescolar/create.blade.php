{{-- resources/views/admin/calendarios/cicloescolar/create.blade.php --}}
<x-admin-layout title="Nuevo Ciclo Escolar" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Ciclo Escolar',
        'url' => route('admin.ciclo-escolar.index'),
    ],
    [
        'name' => 'Nuevo Ciclo Escolar',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.ciclo-escolar.index') }}"
            class="text-white bg-red-500 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">Volver</a>
    </x-slot>
    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-school-red flex items-center">                        
            <i class="fa-regular fa-calendar-plus mr-2"></i>
            Nuevo Ciclo Escolar
        </h1>
    </div>

    <form class="w-full mx-auto" action="{{ route('admin.ciclo-escolar.store') }}" method="POST">
        @csrf
        <x-validation-errors class="my-4" />
    
        <!-- Campo para el nombre del ciclo escolar -->
        <div class="my-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nombre del Ciclo Escolar:</label>
            <input type="text" name="name" id="name"
                class="bg-yellow-100 border border-blue-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-900 dark:border-blue-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="Ejemplo: 2024-2025" required>
        </div>
    
        <div class="flex flex-wrap -mx-3 my-4">
            <!-- Campo para el año de inicio del ciclo -->
            <div class="my-5 w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Fecha de Inicio:</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                    class="bg-yellow-100 border border-blue-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-900 dark:border-blue-600 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
    
            <!-- Campo para el año de fin del ciclo -->
            <div class="my-5 w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Fecha de Fin:</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                    class="bg-yellow-100 border border-blue-300 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-900 dark:border-blue-600 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
        </div>
    
        <div class="flex justify-end">
            <button type="submit"
                class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Crear
                Ciclo Escolar</button>
        </div>
    </form>
    
</x-admin-layout>
