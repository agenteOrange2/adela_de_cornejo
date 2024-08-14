{{-- resources/views/admin/calendarios/index.blade.php --}}
<x-admin-layout title="Calendario Escolar" :breadcrumb="[['name' => 'Inicio', 'url' => route('admin.dashboard')], ['name' => 'Calendario Escolar']]">
    <div x-data="modalHandler()">
        @include('admin.calendarios.create-modal')
        @include('admin.calendarios.edit-modal')

        <!-- Filtros -->
        <div class="flex justify-between heading py-5">
            <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
                <i class="fa-solid fa-calendar-alt mr-2"></i>
                Lista de Calendarios
            </h1>
        </div>

        <div class="space-x-4 flex">
            <!-- Filtro por Nivel Educativo -->
            <select onchange="location = this.value;"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">

                <option value="">Seleccionar Nivel Educativo</option>

                @foreach ($educationLevels as $level)
                    <option
                        value="{{ route('admin.calendarios.index', ['education_level_id' => $level->id, 'plantel_id' => $plantelId, 'month' => $month]) }}"
                        {{ $levelId == $level->id ? 'selected' : '' }}>
                        {{ $level->name }}
                    </option>
                @endforeach

            </select>

            <!-- Filtro por Plantel -->
            <select onchange="location = this.value;"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                <option value="">Seleccionar Plantel</option>
                @foreach ($planteles as $plantel)
                    <option
                        value="{{ route('admin.calendarios.index', ['education_level_id' => $levelId, 'plantel_id' => $plantel->id, 'month' => $month]) }}"
                        {{ $plantelId == $plantel->id ? 'selected' : '' }}>
                        {{ $plantel->name }}
                    </option>
                @endforeach
            </select>

            <!-- Filtro por Mes -->
            <select onchange="location = this.value;"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                <option value="">Seleccionar Mes</option>
                @foreach ($months as $num => $name)
                    <option
                        value="{{ route('admin.calendarios.index', ['education_level_id' => $levelId, 'plantel_id' => $plantelId, 'month' => $num]) }}"
                        {{ $month == $num ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tabla de PDFs -->
        <div class="p-6 overflow-scroll">
            <table class="w-full min-w-max text-left table-auto">
                <thead>
                    <tr>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Nombre</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Nivel Educativo</th>
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
                                @foreach ($pdf->educationLevels as $level)
                                    <span>{{ $level->name }}</span>
                                @endforeach
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                @foreach ($pdf->planteles as $plantel)
                                    <span>{{ $plantel->name }}</span>
                                @endforeach
                            </td>

                            <td class="p-4 border-b border-blue-gray-50">
                                @foreach ($pdf->planteles as $plantel)
                                    <span>{{ $months[$plantel->pivot->month] ?? 'Mes desconocido' }}</span>
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
                                    @click="openEditModal({
                                        id: {{ $pdf->id }},
                                        name: '{{ $pdf->name }}',
                                        education_level_id: {{ $levelId }},
                                        plantel_id: {{ $plantelId }},
                                        month: {{ optional($pdf->pivot)->month ?? 'null' }} // Usar optional() para evitar errores
                                    })"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                    <button onclick="deletePdf({{ $pdf->id }})">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>

                                    <form id="formDelete-{{ $pdf->id }}" method="POST"
                                        action="{{ route('admin.calendarios.destroy', $pdf->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay calendarios subidos.</td>
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


            document.addEventListener('alpine:init', () => {
        Alpine.data('modalHandler', () => ({
            openCreate: false,
            openEdit: false,
            pdfId: null,
            fileName: '',
            fileSize: '',
            educationLevel: '',
            month: '',
            planteles: [],
            file: null,

            handleFileInput(event) {
                const file = event.target.files[0];
                this.file = file;
                this.fileName = file.name;
                this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
                console.log('Archivo seleccionado:', this.fileName, this.fileSize);
            },
            
            openCreateModal() {
                this.openCreate = true;
                console.log('Modal de creación abierto');
            },
            
            closeCreateModal() {
                this.openCreate = false;
            },

            handleFileDrop(event) {
                const file = event.dataTransfer.files[0];
                this.file = file;
                this.fileName = file.name;
                this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
                console.log('Archivo arrastrado:', this.fileName, this.fileSize);
                this.$refs.fileInputEdit.files = event.dataTransfer.files;
            },

            submitForm(event) {
                console.log('Formulario está siendo enviado');
                console.log('Nombre del archivo:', this.fileName);
                console.log('Tamaño del archivo:', this.fileSize);
                console.log('Nivel educativo seleccionado:', this.educationLevel);
                console.log('Mes seleccionado:', this.month);
                console.log('Planteles seleccionados:', this.planteles);

                event.target.submit();
            },

            openEditModal(pdfData) {
                this.pdfId = pdfData.id;
                this.fileName = pdfData.name;
                this.educationLevel = pdfData.education_level_id || '';
                this.plantel = pdfData.plantel_id || '';
                this.month = pdfData.month || '';
                this.file = null;
                this.openEdit = true;
                console.log('Modal de edición abierto con datos:', pdfData);
            },
            
            closeEditModal() {
                this.openEdit = false;
            }
        }));
    });
        </script>
    @endpush
</x-admin-layout>
