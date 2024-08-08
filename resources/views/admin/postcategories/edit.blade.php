<x-admin-layout>
    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Actualizar Categoría</h1>
        <a href="{{ route('admin.categories-avisos.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Regresar</a>
    </div>
    
    <form class="w-full mx-auto" action="{{ route('admin.categories-avisos.update', $categories_aviso) }}" method="POST">
        @csrf
        @method('PUT')


        <x-validation-errors class="my-4" />

        <x-input class="w-full my-5" name="name" value="{{ $categories_aviso->name }}"
            placeholder="Escriba el nombre de la categoría">

        </x-input>

        <div class="flex justify-end">
            <x-danger-button onclick="deleteCategory()">
                Eliminar
            </x-danger-button>

            <button type="submit"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Actualizar
                Categoría</button>
        </div>

    </form>

    <form action="{{ route('admin.categories-avisos.destroy', $categories_aviso) }}" method="POST" id="formDelete">

        @csrf
        @method('DELETE')


    </form>

    @push('js')
        <script>
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
        </script>
    @endpush
</x-admin-layout>
