<x-admin-layout title="Menu Escolar" :breadcrumb="[['name' => 'Inicio', 'url' => route('admin.dashboard')], ['name' => 'Menu Escolar']]">

    <div x-data="{
        openCreate: false,
        openEdit: false,
        pdfIdEdit: null,
        fileNameEdit: '',
        fileSizeEdit: '',
        schoolCycleEdit: '',
        monthEdit: '',
        plantelesEdit: [],
        fileEdit: null,
        handleFileInputEdit(event) {
            const file = event.target.files[0];
            this.fileEdit = file;
            this.fileNameEdit = file.name;
            this.fileSizeEdit = (file.size / 1024).toFixed(2) + ' KB';
        },
        handleFileDropEdit(event) {
            const file = event.dataTransfer.files[0];
            this.fileEdit = file;
            this.fileNameEdit = file.name;
            this.fileSizeEdit = (file.size / 1024).toFixed(2) + ' KB';
            this.$refs.fileInputEdit.files = event.dataTransfer.files;
        },
        removeFileEdit() {
            this.fileEdit = null;
            this.fileNameEdit = '';
            this.fileSizeEdit = '';
            this.$refs.fileInputEdit.value = null;
        },
        openModalEdit(pdfData) {
            this.pdfIdEdit = pdfData.id;
            this.fileNameEdit = pdfData.name;
            this.fileSizeEdit = '';
            this.schoolCycleEdit = pdfData.school_cycle_id || '';
            this.monthEdit = pdfData.month || '';
            this.plantelesEdit = pdfData.planteles || [];
            this.fileEdit = null;
            this.openEdit = true;
        }
    }">

        <!-- Incluir el modal de creación -->
        @include('admin.services.cafeteriamenu.create-modal')

        <!-- Incluir el modal de edición -->
        @include('admin.services.cafeteriamenu.edit-modal')

        <!-- Filtros -->
        <div class="flex justify-between heading py-5">
            <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
                <i class="fa-solid fa-utensils mr-2"></i>
                Menú Escolar
            </h1>

            <div class="space-x-4 flex">
                <select onchange="location = this.value;"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="{{ route('admin.menu-cafeteria.index') }}">Todos los Planteles</option>
                    @foreach ($planteles as $plantel)
                        <option value="{{ route('admin.menu-cafeteria.index', ['plantel' => $plantel->id]) }}"
                            {{ $plantelId == $plantel->id ? 'selected' : '' }}>{{ $plantel->name }}</option>
                    @endforeach
                </select>
                <select onchange="location = this.value;"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($months as $num => $name)
                        <option
                            value="{{ route('admin.menu-cafeteria.index', ['plantel' => $plantelId, 'month' => $num]) }}"
                            {{ $month == $num ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Tabla de PDFs -->
        <div class="p-6 overflow-scroll">
            <table class="w-full min-w-max text-left table-auto">
                <thead>
                    <tr>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Nombre</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Plantel</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Mes asignado</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Última modificación</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pdfs as $pdf)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <span
                                            class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-800 opacity-90">
                                            <i class="fa-solid fa-file-pdf"></i>
                                            {{ $pdf->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                @foreach ($pdf->plantelesForMenu as $plantel)
                                    <span>{{ $plantel->name }}</span>
                                @endforeach
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                @foreach ($pdf->plantelesForMenu as $pivot)
                                    <span>{{ $months[$pivot->pivot->month] ?? 'Mes desconocido' }}</span>
                                @endforeach
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $pdf->updated_at->format('d/m/Y') }}
                                </p>
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex gap-2">

                                    <button
                                    onclick="openModalEdit({
                                        id: {{ $pdf->id }},
                                        name: '{{ $pdf->name }}',
                                        school_cycle_id: {{ $pdf->school_cycle_id ?? 'null' }},
                                        month: {{ $pdf->month ?? 'null' }},
                                        planteles: [{{ $pdf->plantelesForMenu->pluck('id')->implode(',') }}]
                                    })"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                
                                
                                    <button onclick="deletePdf({{ $pdf->id }})">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>

                                    <form id="formDelete-{{ $pdf->id }}" method="POST"
                                        action="{{ route('admin.menu-cafeteria.destroy', $pdf->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay PDFs subidos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    @push('js')
        <script>
            function deletePdf(pdfId) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('formDelete-' + pdfId);
                        if (form) {
                            form.submit();
                        } else {
                            console.error("No se encontró el formulario para PDF ID:", pdfId);
                        }
                    }
                });
            }

            function openModalEdit(pdfData) {
        console.log('Edit button clicked with data:', pdfData);

        // Encuentra el elemento que contiene el modal de edición
        const modalElement = document.querySelector('[x-data][x-show="openEdit"]');

        if (!modalElement) {
            console.error('No se pudo encontrar el modal de edición.');
            return;
        }

        // Accede a Alpine.js desde el componente específico
        const alpineScope = Alpine.$data(modalElement);

        if (!alpineScope) {
            console.error('No se pudo acceder a los datos de Alpine.js.');
            return;
        }

        alpineScope.pdfIdEdit = pdfData.id;
        alpineScope.fileNameEdit = pdfData.name;
        alpineScope.schoolCycleEdit = pdfData.school_cycle_id || '';
        alpineScope.monthEdit = pdfData.month || '';
        alpineScope.plantelesEdit = pdfData.planteles || [];
        alpineScope.fileEdit = null; // Resetea el input de archivo al abrir el modal
        alpineScope.openEdit = true;

        console.log('Modal state updated:', {
            openEdit: alpineScope.openEdit,
            pdfIdEdit: alpineScope.pdfIdEdit,
            fileNameEdit: alpineScope.fileNameEdit,
            schoolCycleEdit: alpineScope.schoolCycleEdit,
            monthEdit: alpineScope.monthEdit,
            plantelesEdit: alpineScope.plantelesEdit,
            fileEdit: alpineScope.fileEdit,
        });  // Log para verificar el estado del modal
    }
        </script>
    @endpush
</x-admin-layout>
