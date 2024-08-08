<x-admin-layout>
    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Nueva Categoría</h1>

        <a href="{{ route('admin.categories-eventos.index') }}"
            class="text-white bg-school-red hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-red dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">Volver</a>
    </div>

    <form class="w-full mx-auto" action="{{ route('admin.categories-eventos.store') }}" method="POST">
        @csrf


        <x-validation-errors class="my-4" />

        <x-input class="w-full my-5" name="name" placeholder="Escriba el nombre de la categoría">

        </x-input>

        <div class="flex justify-end">
            <button type="submit"
                class="text-white bg-school-red hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-red dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">
                Crear Categoría
                <i class="fa-solid fa-plus ml-2"></i>
            </button>
        </div>

    </form>
</x-admin-layout>
