<x-admin-layout>
    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Permisos</h1>

        <a href="{{ route('admin.permissions.create') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Crear nuevo permission</a>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($permissions as $permission)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">


                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $permission->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $permission->name }}
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <button onclick="deletePermission()">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>


                            <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST"
                                id="formDelete">

                                @csrf
                                @method('DELETE')


                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b">
                        <td colspan="5" class="px-6 py-4 text-center  bg-gray-700 text-white">No hay Permisos
                            registrados.</td>
                    </tr>
                @endforelse
        </table>
    </div>


    @push('js')
    <script>
        function deletePermission() {
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
                    const form = document.getElementById('formDelete');
                    form.submit(); // Envía el formulario de eliminación
                }
            });
        }
    </script>
@endpush
</x-admin-layout>