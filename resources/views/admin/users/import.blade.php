<x-admin-layout title="Importar Usuarios" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'url' => route('admin.users.index'),
    ],
    [
        'name' => 'Importar Usuarios',
    ],
]">

    <x-validation-errors class="my-4" />

    <div class="py-12">
        <div class="max-w-7xl max-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.users.importUsersStore') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded p-8 shadow space-y-4" x-data="fileUploadHandler()">
                @csrf
                <h1 class="text-2xl font-semibold mb-4">Importar Usuarios</h1>

                <!-- Drag and Drop para el archivo CSV -->
                <label for="file" class="block mb-2 text-sm font-medium text-gray-900">Subir archivo CSV</label>
                <div :class="{ 'border-blue-500 bg-blue-50': isDragging, 'border-gray-300': !isDragging }"
                    class="relative flex items-center justify-center w-full p-4 border-2 border-dashed rounded-lg"
                    @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false; handleFileDrop($event)">
                    <input x-ref="fileInputImport" type="file" name="file" id="file" accept=".csv, .xlsx"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="handleFileInput">
                    <p class="text-gray-500" x-show="!fileName">Arrastra el archivo aquí o haz clic para seleccionar</p>
                    <p class="text-gray-900" x-show="fileName" x-text="fileName"></p>
                    <p class="text-xs text-gray-500" x-show="fileName" x-text="fileSize"></p>
                </div>

                <!-- Preview del archivo -->
                <div x-show="fileName" class="mt-4 p-4 bg-gray-100 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                            <p class="text-xs text-gray-500" x-text="fileSize"></p>
                        </div>
                        <button type="button" @click="removeFile" class="text-red-600 hover:text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Botón para guardar -->
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Importar Usuarios
                </button>
            </form>
        </div>

        @if (session('duplicatedEmails'))
            <div x-data="{ open: false }">
                <div class="alert alert-warning">
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            <strong>Advertencia:</strong> Se encontraron Usuarios duplicados. Estos usuarios no
                            fueron actualizados ni creados.
                            <button @click="open = !open" class="text-blue-600 hover:underline ml-2">
                                Ver detalles
                            </button>
                        </div>
                    </div>

                    <!-- Colapso para mostrar los usuarios duplicados -->
                    <div x-show="open" x-cloak>
                        <ul class="bg-gray-50 p-4 rounded-lg">
                            @foreach (session('duplicatedEmails') as $user)
                                <li class="mb-2">
                                    <div class="flex items-center p-2 text-red-800 rounded-lg bg-red-50">
                                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div class="ms-3 text-sm font-medium">
                                            {{ $user['name'] }} {{ $user['last_name'] }} -
                                            {{ $user['email'] }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('js')
        <script>
            function fileUploadHandler() {
                return {
                    isDragging: false,
                    fileName: '',
                    fileSize: '',

                    handleFileInput(event) {
                        const file = event.target.files[0];
                        this.fileName = file.name;
                        this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
                    },

                    handleFileDrop(event) {
                        const file = event.dataTransfer.files[0];
                        this.fileName = file.name;
                        this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
                        this.$refs.fileInputImport.files = event.dataTransfer.files;
                    },

                    removeFile() {
                        this.fileName = '';
                        this.fileSize = '';
                        this.$refs.fileInputImport.value = '';
                    }
                }
            }
        </script>
    @endpush

</x-admin-layout>
