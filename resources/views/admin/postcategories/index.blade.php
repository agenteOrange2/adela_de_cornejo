<x-admin-layout>
    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Categorias</h1>

        <a href="{{ route('admin.categories-avisos.create') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Crear
            Categoría</a>
    </div>

    <x-validation-errors class="my-4" />

    <livewire:categorie-avisos-data-table />


    {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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

                @forelse ($categories as $category)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">


                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $category->name }}
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('admin.categories-avisos.edit', $category) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <button onclick="deleteCategory()">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>


                            <form action="{{ route('admin.categories-avisos.destroy', $category) }}" method="POST"
                                id="formDelete">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b">
                        <td colspan="5" class="px-6 py-4 text-center  bg-gray-700 text-white">No hay categorías
                            registradas.</td>
                    </tr>
                @endforelse
        </table>
    </div>

    <div class="mt-5">
        {{ $categories->links() }}
    </div>
        --}}
    @push('js')
        {{-- <script>
            function deleteCategory() {
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
        </script> --}}
        <script>
                    Livewire.on('error', function(message){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
        })
    });
        </script>
    @endpush 


</x-admin-layout>
