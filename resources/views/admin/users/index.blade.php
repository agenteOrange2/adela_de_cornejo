<x-admin-layout title="Usuarios" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

    <x-slot name="action">
        <div class="flex space-x-2">
            <a href="{{ route('admin.users.export') }}"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Exportar Usuarios
            </a>

            <a href="{{ route('admin.users.import') }}"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Importar Usuarios
            </a>
            <!-- Incluir el modal -->
            {{-- @include('admin.users.import') --}}

            <a href="{{ route('admin.users.create') }}"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                Crear Usuario
            </a>
        </div>
    </x-slot>

    <div class="heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Usuarios</h1>

    </div>
    <livewire:user-table />




    @push('js')
    <script>
        // function modalHandler() {
        //     return {
        //         openImport: false,
        //         fileName: '',
        //         fileSize: '',
    
        //         openImportModal() {
        //             this.openImport = true;
        //         },
        //         closeImportModal() {
        //             this.openImport = false;
        //             this.removeFile();
        //         },
    
        //         handleFileInput(event) {
        //             const file = event.target.files[0];
        //             this.fileName = file.name;
        //             this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
        //         },
    
        //         handleFileDrop(event) {
        //             const file = event.dataTransfer.files[0];
        //             this.$refs.fileInputImport.files = event.dataTransfer.files;
        //             this.fileName = file.name;
        //             this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
        //         },
    
        //         removeFile() {
        //             if (this.$refs.fileInputImport) {
        //                 this.$refs.fileInputImport.value = '';
        //             }
        //             this.fileName = '';
        //             this.fileSize = '';
        //         }
        //     };
        // }
    </script>
            
    @endpush
</x-admin-layout>
