<x-admin-layout title="Usuarios" :breadcrumb="[
    ['name' => 'Inicio', 'url' => route('admin.dashboard')],
    ['name' => 'Usuarios'],
]">

    <x-slot name="action">
        <div class="flex space-x-2" x-data="{ open: false }">
            <a href="{{ route('admin.users.export') }}"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Exportar Usuarios
            </a>

            <a href="{{ route('admin.users.import') }}"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Importar Usuarios
            </a>

            <!-- Botón que abre el modal -->
            <button @click="open = true"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Crear Usuario
            </button>

            <!-- Modal -->
            <div x-show="open" x-cloak @click.away="open = false" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-[1000]">
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Seleccionar Tipo de Usuario</h2>
                    <div class="flex flex-col space-y-4">
                        <button @click="window.location.href='{{ route('admin.users.createstudent') }}'"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <i class="fa-solid fa-user-graduate"></i>
                            Crear Estudiante
                        </button>
                        <button @click="window.location.href='{{ route('admin.users.createpersonal') }}'"
                            class="text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <i class="fa-solid fa-user-gear"></i>
                            Crear Personal Administrativo
                        </button>
                    </div>
                    <button @click="open = false" class="mt-4 text-gray-500 hover:text-gray-700">Cancelar</button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Usuarios</h1>
    </div>

    <livewire:user-table />

</x-admin-layout>
