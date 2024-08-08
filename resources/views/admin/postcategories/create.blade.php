<x-admin-layout>
    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Nueva Categoría</h1>

        <a href="{{ route('admin.categories-avisos.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </div>
    
    <form class="w-full mx-auto" action="{{route('admin.categories-avisos.store')}}" method="POST">        
        @csrf        
                

        <x-validation-errors class="my-4"/>        

        <x-input class="w-full my-5" name="name" placeholder="Escriba el nombre de la categoría">

        </x-input>

        <div class="flex justify-end">
            <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Crear Categoría</button>
        </div>

    </form>
</x-admin-layout>