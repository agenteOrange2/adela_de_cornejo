<x-admin-layout>

    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Editar Rol</h1>

        <a href="{{ route('admin.roles.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </div>

    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <x-validation-errors class="my-4" />

        <div class="mb-4">
            <x-label class="mb-4">
                Nombre del Rol
            </x-label>
            <x-input class="w-full" name="name" value="{{ old('name', $role->name) }}"
                placeholder="Ingresa el nombre del rol">
            </x-input>
        </div>

        <div class="mb-4">

            <h3 class="mb-4 font-semibold text-gray-900">Permisos</h3>
            <ul
                class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @foreach ($permissions as $permission)                                    
                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input  type="checkbox" 
                                name="permissions[]"
                                value="{{$permission->id}}"
                                @if(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()) )) checked @endif                                "
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="vue-checkbox"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$permission->name}}</label>
                    </div>
                </li>
                @endforeach
            </ul>

        </div>
        <div class="flex justify-end">
            <x-danger-button onclick="deleteRol()">
                Eliminar
            </x-danger-button>
            <x-button>
                Actualizar Rol
            </x-button>
        </div>
    </form>

    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" id="formDelete">

        @csrf
        @method('DELETE')
    </form>
    @push('js')
        <script>
            function deleteRol() {
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
