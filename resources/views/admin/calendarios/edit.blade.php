<x-admin-layout title="Editar Archivo" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Menu Escolar',
        'url' => route('admin.menu-cafeteria.index'),
    ],
    [
        'name' => 'Editar Archivo',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.calendarios.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </x-slot>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css" rel="stylesheet">
    @endpush

    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Editar PDF</h1>       
    </div>

    <!-- Formulario de actualización con método PUT -->
    <form action="{{ route('admin.calendarios.update', ['calendario' => $pdf->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <!-- Vista previa del archivo PDF actual -->
        <div class="mb-4">
            <label for="current-file">Archivo Actual:</label>
            <div id="current-file">
                <iframe src="{{ asset('storage/' . $pdf->file_path) }}" style="width:100%;height:500px;"></iframe>
            </div>
        </div>

        <!-- Dropzone Container para actualizar el archivo -->
        <div class="mb-4">
            <div class="dropzone" id="file-upload"></div>
            <input type="hidden" name="file_path" value="{{ $pdf->file_path }}">
        </div>

        <!-- Campos existentes con valores predefinidos para edición -->
        <div class="flex flex-wrap -mx-3 my-4">
            <!-- Selector de Nivel Educativo con el valor actual seleccionado -->
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="education_level_id" class="block mb-2 text-sm font-medium text-gray-900">Nivel
                    Educativo:</label>
                <select name="education_level_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    @foreach ($educationLevels as $level)
                        <option value="{{ $level->id }}" @if ($level->id == $pdf->educationLevels->first()->id) selected @endif>
                            {{ $level->name }}</option>
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
                        <select name="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($months as $key => $month)
                                <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>{{ $month }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>

            <!-- Selector de Planteles con los valores actuales seleccionados -->
            <div class="w-full md:w-1/2 px-3">
                <h3 class="mb-2 font-semibold text-gray-900">Planteles</h3>
                <ul
                    class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($planteles as $plantel)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="plantel-checkbox-{{ $plantel->id }}" type="checkbox"
                                    value="{{ $plantel->id }}" name="plantel_ids[]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                    @if ($pdf->planteles->contains($plantel)) checked @endif>
                                <label for="plantel-checkbox-{{ $plantel->id }}"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $plantel->name }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Botón de envío -->
        <div class="flex justify-end">
            <button type="submit" id="submit-button"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar PDF
            </button>
        </div>
    </form>

    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>

        <script>
            Dropzone.autoDiscover = false; // Evitar auto-inicialización

            document.addEventListener('DOMContentLoaded', function() {
                var myDropzone = new Dropzone('#file-upload', {
                    url: "{{ route('admin.calendarios.update', $pdf) }}",
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
                                document.getElementById("edit-form")
                            .submit(); // Envía el formulario si no hay nuevos archivos
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


            /*                
            Dropzone.autoDiscover = false;

            var myDropzone = new Dropzone('#file-upload', {
                url: "{{ route('admin.calendarios.update', $pdf->id) }}",
                autoProcessQueue: false,
                uploadMultiple: false,
                paramName: "file_path", // El nombre del campo que contiene el archivo
                maxFiles: 1,
                maxFilesize: 2, // MB
                acceptedFiles: 'application/pdf',
                addRemoveLinks: true,
                init: function() {
                    var submitButton = document.getElementById("submit-button");
                    var form = document.getElementById("edit-form"); // Asegúrate de que este ID es correcto
                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        if (this.getQueuedFiles().length > 0) {
                            this.processQueue();
                        } else {
                            // Se procesa el formulario de manera normal si no hay archivos para subir.
                            form.submit();
                        }
                    }.bind(this)); // Enlaza correctamente el contexto

                    this.on("sending", function(file, xhr, formData) {
                        var token = document.querySelector('input[name="_token"]').value;
                        formData.append("_token", token); // Asegúrate de enviar el token CSRF
                    });

                    this.on("complete", function(file) {
                        if (this.getQueuedFiles().length === 0 && this.getUploadingFiles().length === 0) {
                            window.location.href = "{{ route('admin.calendarios.index') }}";
                        }
                    });
                }
            });*/
        </script>
    @endpush
</x-admin-layout>
