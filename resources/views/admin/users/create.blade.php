<x-admin-layout title="Nuevo Usuario" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'url' => route('admin.users.index'),
    ],
    [
        'name' => 'Nuevo Usuario',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.users.index') }}"
            class="mt-4 sm:mt-0 px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg">Volver</a>
    </x-slot>

    <div class="max-w-full mx-auto bg-white shadow-md rounded-lg sm:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <div class="text-center sm:text-left">
                <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">Usuario</h1>
                <p class="text-gray-600">Ingrese los datos del nuevo usuario.</p>
            </div>

        </div>

        <form class="w-full mx-auto" action="{{ route('admin.users.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <x-validation-errors class="my-4" />
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Imagen de perfil</h2>
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="w-full sm:w-1/2 ">

                        <div class="mb-6 relative">
                            <figure
                                class="w-full max-w-[450px] h-[400px] sm:h-[600px] aspect-w-1 aspect-h-1 overflow-hidden rounded">
                                <img class="w-full h-full object-cover"
                                    src="https://i.postimg.cc/prsHzgwn/adeladecornejo-predeterminado.webp"
                                    alt="Imagen destacada" id="imgPreview">
                                {{-- <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image"/> --}}
                            </figure>
                            <div class="absolute top-8 right-8">
                                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                                    <i class="fa-solid fa-camera mr-2"></i>
                                    Actualizar imagen
                                    <input type="file" accept="image/*" name="image" class="hidden"
                                        onchange="previewImage(event, '#imgPreview')">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-center sm:text-left">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Información Personal</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                            <div class="w-full">
                                <label class="block text-gray-600 text-sm mb-2">Nombre Completo</label>
                                <input type="text" name="name"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('name') }}" placeholder="Ingrese el nombre completo del usuario">
                            </div>
                            <div class="w-full">
                                <label class="block text-gray-600 text-sm mb-2">Email</label>
                                <input type="email" name="email"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('email') }}" placeholder="Ingrese el correo electrónico">
                            </div>
                            <div class="w-full">
                                <label class="block text-gray-600 text-sm mb-2">Numero de teléfono</label>
                                <input type="text" name="phone"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ old('phone') }}" placeholder="Ingrese el número de teléfono">
                            </div>

                            <div class="w-full">
                                <label class="block text-gray-600 text-sm mb-2">Password</label>
                                <input type="password" name="password"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Ingrese una contraseña temporal" autocomplete="new-password" />
                            </div>

                            <div class="w-full">
                                <label class="block text-gray-600 text-sm mb-2">Confirmar Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Ingrese una contraseña temporal" autocomplete="new-password" />
                            </div>

                            <div class="w-full">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900">Plantel</label>
                                <select name="plantel_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Seleccione un plantel</option>
                                    @foreach ($plantels as $plantel)
                                        <option value="{{ $plantel->id }}"
                                            {{ old('plantel_id') == $plantel->id ? 'selected' : '' }}>
                                            {{ $plantel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Nivel
                                    Educativo</label>
                                <select name="education_level_id" id="education-level-select"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Seleccione un nivel educativo</option>
                                    @foreach ($educationLevels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('education_level_id') == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full" id="grade-container" style="display:none;">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900">Grado</label>
                                <select name="grade_id" id="grade-select"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Seleccione un grado</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            data-level="{{ $grade->education_level_id }}">
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full" id="group-container" style="display:none;">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900">Grupo</label>
                                <select name="group_id" id="group-select"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>Seleccione un grupo</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">

                                <h3 class="mb-4 font-semibold text-gray-900">Permisos</h3>
                                <ul
                                    class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach ($roles as $role)
                                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                            <div class="flex items-center ps-3">
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                    {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                                                <label for="vue-checkbox"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $role->name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-4">
                    <button class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg">Guardar</button>
                </div>
            </div>

        </form>
    </div>

    @push('js')
        <script>
            /*Imagen Preview*/
            function previewImage(event, querySelector) {
                const input = event.target;
                const imgPreview = document.querySelector(querySelector);

                if (!input.files.length) return;

                const file = input.files[0];
                const objectURL = URL.createObjectURL(file);
                imgPreview.src = objectURL;
            }

            /* Mostrar y ocultar campos dependiendo de la selección */
            document.addEventListener('DOMContentLoaded', function() {
                const educationLevelSelect = document.getElementById('education-level-select');
                const gradeSelect = document.getElementById('grade-select');
                const gradeContainer = document.getElementById('grade-container');
                const groupContainer = document.getElementById('group-container');

                educationLevelSelect.addEventListener('change', function() {
                    const selectedLevelId = this.value;

                    // Filtrar grados por nivel educativo
                    Array.from(gradeSelect.options).forEach(option => {
                        option.style.display = option.getAttribute('data-level') === selectedLevelId ?
                            'block' : 'none';
                    });

                    // Reiniciar la selección del grado y ocultar el campo de grupo
                    gradeSelect.value = '';
                    gradeContainer.style.display = 'block';
                    groupContainer.style.display = 'none';
                });

                gradeSelect.addEventListener('change', function() {
                    if (this.value) {
                        groupContainer.style.display = 'block';
                    } else {
                        groupContainer.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush

</x-admin-layout>
