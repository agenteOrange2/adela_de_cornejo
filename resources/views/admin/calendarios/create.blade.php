<x-admin-layout title="Nuevo Archivo" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Menu Escolar',
        'url' => route('admin.menu-cafeteria.index'),
    ],
    [
        'name' => 'Nuevo Archivo',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.calendarios.index') }}"
            class="text-white bg-school-blue hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-blue dark:hover:bg-blue-700 dark:focus:ring-blue-700">Volver</a>
    </x-slot>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css" rel="stylesheet">
    @endpush

    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
            <i class="fas fa-upload mr-2"></i>
            Nuevo archivo
        </h1>        
    </div>

    <form action="{{ route('admin.calendarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-validation-errors class="mb-4" />

        <!-- Dropzone Container for File Upload -->
        <div class="mb-4">
            <div class="dropzone" id="file-upload"></div>
            <input type="hidden" name="file_path">
        </div>

        <div class="flex flex-wrap -mx-3 my-4">
            <!-- Education Level Selector -->
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="education_level_id" class="block mb-2 text-sm font-medium text-gray-900">Nivel
                    Educativo:</label>
                <select name="education_level_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    @foreach ($educationLevels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>

                <div class="flex flex-wrap my-5">
                    <!-- Selector de Ciclo Escolar -->
                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                        <label for="school_cycle_id" class="block mb-2 text-sm font-medium text-gray-900">Ciclo
                            Escolar:</label>
                        <select name="school_cycle_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @foreach ($schoolCycles as $cycle)
                                <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selector de Mes -->
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900">Mes:</label>
                        <select name="month"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @foreach ($months as $index => $month)
                                <option value="{{ $index + 1 }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Planteles Selector -->
            <div class="w-full md:w-1/2 px-3">
                <h3 class="mb-2 font-semibold text-gray-900">Planteles</h3>
                <ul
                    class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($planteles as $plantel)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="plantel-checkbox-{{ $plantel->id }}" type="checkbox"
                                    value="{{ $plantel->id }}" name="plantel_ids[]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="plantel-checkbox-{{ $plantel->id }}"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $plantel->name }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <x-button id="submit-button">
                Subir Archivo
            </x-button>
        </div>
    </form>


    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>


        <script>
            Dropzone.autoDiscover = false; // Evitar auto-inicialización

            document.addEventListener('DOMContentLoaded', function() {
                var myDropzone = new Dropzone('#file-upload', {
                    url: "{{ route('admin.calendarios.store') }}",
                    autoProcessQueue: false,
                    uploadMultiple: false,
                    paramName: "file_path", // El nombre del campo que contiene el archivo
                    maxFiles: 1,
                    maxFilesize: 2, // MB
                    acceptedFiles: 'application/pdf',
                    addRemoveLinks: true,
                    init: function() {
                        var submitButton = document.getElementById("submit-button");
                        var csrfToken = document.querySelector('input[name="_token"]')
                            .value; // Asegurar que el token CSRF está disponible
                        submitButton.addEventListener("click", function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            if (this.getQueuedFiles().length > 0) {
                                this.processQueue(); // Procesa la cola si hay archivos en cola
                            } else {
                                alert("Por favor, añade un archivo antes de enviar.");
                            }
                        }.bind(this));

                        this.on("sending", function(file, xhr, formData) {
                            // Añadir el token CSRF y otros campos del formulario
                            formData.append("_token", csrfToken);
                            var formElements = document.querySelectorAll('form input, form select');
                            formElements.forEach(function(input) {
                                if (input.name && input.type !== 'submit' && input.type !==
                                    'file') {
                                    if (input.type === 'checkbox') {
                                        if (input
                                            .checked
                                            ) { // Solo añadir si el checkbox está marcado
                                            formData.append(input.name, input.value);
                                        }
                                    } else {
                                        formData.append(input.name, input.value);
                                    }
                                }
                            });
                        });

                        this.on("success", function(file, response) {
                            console.log("Success:", response);
                            window.location.href =
                                "{{ route('admin.calendarios.index') }}"; // Redirigir después del éxito
                        });

                        this.on("error", function(file, response) {
                            console.error("Error:", response);
                        });
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
