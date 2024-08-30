{{-- <div x-data="modalHandler()">
    <!-- Botón para abrir el modal de importación -->
    <button @click="openImportModal()"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
        type="button">
        Importar Usuarios
        <i class="fa-regular fa-file-import"></i>
    </button>

    <!-- Modal de Importación -->
    <div x-show="openImport" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
        <div @click.away="closeImportModal()" class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
            <!-- Modal header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Importar Usuarios</h3>
                <button @click="closeImportModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{  route('admin.users.import.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- Drag and Drop para el archivo CSV -->
                <div x-data="{ isDragging: false }" @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false" @drop.prevent="isDragging = false; handleFileDrop($event)">
                    <label for="file_path" class="block mb-2 text-sm font-medium text-gray-900">Subir archivo CSV</label>
                    <div class="relative flex items-center justify-center w-full p-4 border-2 border-dashed rounded-lg"
                        :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">
                        <input x-ref="fileInputImport" type="file" name="file_path" id="file_path"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="handleFileInput($event)">
                        <p class="text-gray-500">Arrastra el archivo aquí o haz clic para seleccionar</p>
                    </div>
                </div>

                <!-- Preview del archivo -->
                <div x-show="fileName" class="mt-4 p-4 bg-gray-100 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900" x-text="fileName"></p>
                            <p class="text-xs text-gray-500" x-text="fileSize"></p>
                        </div>
                        <button type="button" @click="removeFile()" class="text-red-600 hover:text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12" />
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
    </div>
</div> --}}


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
        <form action="{{route('admin.users.importUsersStore')}}" method="POST" enctype="multipart/form-data" class="bg-white rounded p-8 shadow">
            @csrf
            <div class="">
                <h1 class="text-2xl font-semibold mb-4">Por favor seleccione el archivo que quiere importar</h1>
                <input type="file" name="file" accept=".csv, .xlsx">                
            </div>

            <div class="flex justify-start space-x-4 mt-4">
                <button class="px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg">Guardar</button>
            </div>            
        </form>
    </div>

    @if(session('duplicatedEmails'))
    <div class="alert alert-warning">
        <strong>Advertencia:</strong> Se encontraron correos duplicados. Estos usuarios no fueron actualizados ni creados:
        <ul>
            @foreach(session('duplicatedEmails') as $user)
                <li>{{ $user['name'] }} {{ $user['last_name'] }} - {{ $user['email'] }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>


</x-admin-layout>