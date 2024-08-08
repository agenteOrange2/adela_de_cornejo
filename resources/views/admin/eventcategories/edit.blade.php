<x-admin-layout>
    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Actualizar Categoría</h1>
        <a href="{{ route('admin.categories-eventos.index') }}"
            class="text-white bg-school-red hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-red dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">Volver</a>
    </div>

    <form class="w-full mx-auto" action="{{ route('admin.categories-eventos.update', $categories_evento) }}"
        method="POST">
        @csrf
        @method('PUT')


        <x-validation-errors class="my-4" />

        <x-input class="w-full my-5" name="name" value="{{ $categories_evento->name }}"
            placeholder="Escriba el nombre de la categoría">

        </x-input>

        <div class="flex justify-end">
            <x-danger-button onclick="deleteCategory()">
                Eliminar
                <i class="fa-regular fa-trash-can ml-2"></i>
            </x-danger-button>

            <button type="submit"
                class="text-white bg-school-blue hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-blue dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Actualizar Categoría
                <i class="fa-regular fa-pen-to-square ml-2"></i>
            </button>
        </div>

    </form>

    <form action="{{ route('admin.categories-eventos.destroy', $categories_evento) }}" method="POST" id="formDelete">

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
