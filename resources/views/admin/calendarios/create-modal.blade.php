<div x-data="modalHandler()">
    <!-- Botón para abrir el modal de creación -->
    <button @click="openCreateModal()"
        class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button">
        Agregar Calendario
        <i class="fa-regular fa-file-pdf"></i>
    </button>

    <!-- Modal de Creación -->
    <div x-show="openCreate" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
        <div @click.away="closeCreateModal()" class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
            <!-- Modal header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                    Agregar nuevo Calendario
                </h3>
                <button @click="closeCreateModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('admin.calendarios.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- Drag and Drop para el archivo PDF -->
                <div x-data="{ isDragging: false }" @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false" @drop.prevent="isDragging = false; handleFileDrop($event)">
                    <label for="pdf" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Subir
                        Calendario</label>
                    <div class="relative flex items-center justify-center w-full p-4 border-2 border-dashed rounded-lg"
                        :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">
                        <input x-ref="fileInputCreate" type="file" name="pdf" id="pdf"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="handleFileInput($event)">

                        <p class="text-gray-500">Arrastra el archivo aquí o haz clic para seleccionar</p>
                    </div>
                </div>

                <!-- Preview del archivo PDF -->
                <div x-show="fileName" class="mt-4 p-4 bg-gray-100 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                            <p class="text-xs text-gray-500" x-text="fileSize"></p>
                        </div>
                        <button type="button" @click="removeFile()" class="text-red-600 hover:text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Seleccionar Mes -->
                <div>
                    <label for="month"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Mes</label>
                    <select name="month" id="month" x-model="month"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        @foreach ($months as $num => $name)
                            <option value="{{ $num }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Seleccionar Plantel -->
                <div>
                    <label for="plantel_ids"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plantel</label>
                    <select name="plantel_ids[]" id="plantel_ids" x-model="planteles" multiple
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        @foreach ($planteles as $plantel)
                            <option value="{{ $plantel->id }}">{{ $plantel->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón para guardar -->
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Guardar PDF
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        console.log('Formulario enviado');
        // Aquí podrías hacer otras pruebas o enviar el formulario manualmente
        event.target.submit(); // Luego enviar el formulario si todo está bien
    });
</script>