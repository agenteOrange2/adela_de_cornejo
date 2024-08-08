<x-admin-layout title="Editar Pdf" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Menu Escolar',
        'url' => route('admin.menu-cafeteria.index'),
    ],
    [
        'name' => 'Editar Pdf',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.menu-cafeteria.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </x-slot>

    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css" rel="stylesheet">
    @endpush

    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Editar archivo</h1>        
    </div>

    <form action="{{ route('admin.menu-cafeteria.update', $pdf->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />

        <!-- Vista previa del archivo PDF actual -->
        <div class="mb-4">
            <label for="current-file">Archivo Actual:</label>
            <div id="current-file">
                <iframe src="{{ Storage::url($pdf->file_path) }}" style="width:100%; height:500px;"></iframe>
            </div>
        </div>

        <!-- Dropzone Container para actualizar el archivo (opcional) -->
        <div class="mb-4">
            <label for="file-upload" class="block mb-2 text-sm font-medium text-gray-900">Subir nuevo archivo PDF
                (opcional):</label>
            <div class="dropzone" id="file-upload"></div>
            <input type="hidden" name="file_path" value="{{ $pdf->file_path }}">
        </div>

        <div class="flex flex-wrap -mx-3 my-4">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        <label for="school_cycle_id" class="block mb-2 text-sm font-medium text-gray-900">Ciclo
                            Escolar:</label>
                        <select name="school_cycle_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @foreach ($schoolCycles as $cycle)
                                <option value="{{ $cycle->id }}"
                                    {{ $pdf->schoolCycle && $pdf->schoolCycle->id == $cycle->id ? 'selected' : '' }}>
                                    {{ $cycle->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900">Mes:</label>
                        <select name="month"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @foreach ($months as $index => $month)
                                <option value="{{ $index }}" {{ $selectedMonth == $index ? 'selected' : '' }}>
                                    {{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

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
                                    {{ in_array($plantel->id, $pdf->plantelesForMenu->pluck('id')->toArray()) ? 'checked' : '' }}>
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
            <x-button id="submit-button" class="mt-4">
                Actualizar Archivo
            </x-button>
        </div>
    </form>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
        {{-- 
        <script>
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone('#file-upload', {
                url: "{{ route('admin.menu-cafeteria.update', $pdf->id) }}",
                method: 'post',
                paramName: 'file_path', // El campo que se utiliza para enviar el archivo
                maxFiles: 1,
                maxFilesize: 2, // MB
                acceptedFiles: 'application/pdf',
                addRemoveLinks: true,
                init: function() {
                    var submitButton = document.getElementById("submit-button");
                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone
                    .processQueue(); // Procesar solo cuando se hace clic en el botón de enviar
                    });

                    this.on("sending", function(file, xhr, formData) {
                        // Agregar campos del formulario manualmente
                        formData.append("_token", '{{ csrf_token() }}');
                        formData.append("_method",
                        'PUT'); // Asegurarse de que Laravel trate la solicitud como PUT
                        formData.append("school_cycle_id", document.querySelector(
                            '[name="school_cycle_id"]').value);
                        formData.append("month", document.querySelector('[name="month"]').value);

                        // Agregar cada checkbox de planteles
                        document.querySelectorAll('[name="plantel_ids[]"]').forEach(function(checkbox) {
                            if (checkbox.checked) {
                                formData.append('plantel_ids[]', checkbox.value);
                            }
                        });
                    });

                    this.on("success", function(file, response) {
                        console.log("Success:", response);
                        window.location.href =
                        "{{ route('admin.menu-cafeteria.index') }}"; // Redirigir después del éxito
                    });

                    this.on("error", function(file, response) {
                        console.error("Error:", response);
                        // Muestra mensaje de error si hay falla en la validación
                        alert(response.message ||
                            'Error al procesar el formulario. Por favor revisa los datos.');
                    });
                }
            });
        </script>
 --}}

        <script>
            Dropzone.autoDiscover = false; // Desactivar la auto-configuración de Dropzone
            var myDropzone = new Dropzone('#file-upload', {
                url: "{{ route('admin.menu-cafeteria.update', $pdf->id) }}",
                autoProcessQueue: false, // Desactivar el procesamiento automático para controlarlo manualmente
                paramName: 'file_path', // El campo que se utiliza para enviar el archivo
                maxFiles: 1,
                maxFilesize: 2, // Tamaño máximo en megabytes
                acceptedFiles: 'application/pdf',
                addRemoveLinks: true,
                init: function() {
                    var submitButton = document.getElementById("submit-button");
                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if (myDropzone.files.length > 0) {
                            myDropzone
                        .processQueue(); // Procesa la cola de archivos cuando se hace clic en el botón
                        } else {
                            alert("Por favor, añade un archivo antes de enviar.");
                        }
                    });

                    this.on("sending", function(file, xhr, formData) {
                        formData.append("_token", '{{ csrf_token() }}');
                        formData.append("_method", 'PUT');
                        formData.append("school_cycle_id", document.querySelector(
                            '[name="school_cycle_id"]').value);
                        formData.append("month", document.querySelector('[name="month"]').value);
                        document.querySelectorAll('[name="plantel_ids[]"]').forEach(function(checkbox) {
                            if (checkbox.checked) {
                                formData.append('plantel_ids[]', checkbox.value);
                            }
                        });
                    });

                    this.on("success", function(file, response) {
                        console.log("Success:", response);
                        window.location.href = "{{ route('admin.menu-cafeteria.index') }}";
                    });

                    this.on("error", function(file, response) {
                        console.error("Error:", response);
                        alert("Error al procesar el formulario. Por favor revisa los datos.");
                    });
                }
            });
        </script>
    @endpush
</x-admin-layout>
