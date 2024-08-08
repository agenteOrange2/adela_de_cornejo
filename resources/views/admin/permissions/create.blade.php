<x-admin-layout>

    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Nuevo Permiso</h1>

        <a href="{{ route('admin.permissions.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </div>

    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf

        <x-validation-errors class="my-4" />

        <div class="mb-4">
            <x-label class="mb-4">
                Nombre del Permiso
            </x-label>
            <x-input class="w-full" name="name" value="{{ old('name') }}" placeholder="Ingresa el nombre del rol">
            </x-input>
        </div>
        
        <div class="flex justify-end">
            <x-button>
                Crear Permiso
            </x-button>
        </div>
    </form>

</x-admin-layout>
