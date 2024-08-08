<x-admin-layout title="Usuarios" :breadcrumb="[
    
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

<x-slot name="action">
    <a href="{{ route('admin.users.create') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Crear
            Usuario</a>
</x-slot>

    <div class="heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Usuarios</h1>
        
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div
            class="flex items-center justify-end flex-column p-5 flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rol
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Creacion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $user->name }} </div>
                                <div class="font-normal text-gray-500">{{ $user->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            @if ($user->roles->isNotEmpty())
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            @else
                                Sin asignar
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                {{ $user->formatted_created_at }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center px-6 py-4">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Editar</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    id="delete-user-form-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteUser({{ $user->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr class="border-b">
                        <td colspan="5" class="px-6 py-4 text-center  bg-gray-700 text-white">No hay roles
                            registrados.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $users->links() }}
    </div>


    @push('js')
        <script>
            function deleteUser(userId) {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('delete-user-form-' + userId);
                        if (form) {
                            form.submit(); // Envía el formulario de eliminación específico
                        }
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>
