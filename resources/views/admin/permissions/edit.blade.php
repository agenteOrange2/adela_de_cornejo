<x-admin-layout>

    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Editar Rol</h1>

        <a href="{{ route('admin.permissions.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </div>

    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')
        <x-validation-errors class="my-4" />

        <div class="mb-4">
            <x-label class="mb-4">
                Nombre del permiso
            </x-label>
            <x-input class="w-full" name="name" value="{{ old('name', $permission->name) }}"
                placeholder="Ingresa el nombre del permiso">
            </x-input>
        </div>

        <div class="flex justify-end">

            <x-danger-button onclick="deletePermission()">
                Eliminar
            </x-danger-button>
            <x-button>
                Actualizar Permiso
            </x-button>
        </div>
    </form>

    <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" id="formDelete">

        @csrf
        @method('DELETE')


    </form>

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
