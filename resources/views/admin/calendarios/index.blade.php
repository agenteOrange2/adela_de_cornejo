<x-admin-layout title="Calendario Escolar" :breadcrumb="[['name' => 'Inicio', 'url' => route('admin.dashboard')], ['name' => 'Calendario Escolar']]">

    <!-- Contenedor principal -->
    <div x-data="modalHandler()">
        <!-- Incluir el modal de creación -->
        @include('admin.calendarios.create-modal')

        <!-- Incluir el modal de edición -->
        @include('admin.calendarios.edit-modal')

        <!-- Filtros -->
        <div class="flex justify-between heading py-5">
            <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
                <i class="fa-solid fa-calendar-alt mr-2"></i>
                Lista de Calendarios
            </h1>

            <div class="space-x-4 flex">
                <!-- Filtro por Nivel Educativo -->
                <select onchange="location = this.value;"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                    <option value="">Seleccionar Nivel Educativo</option>
                    @foreach ($educationLevels as $level)
                        <option
                            value="{{ route('admin.calendarios.index', ['education_level_id' => $level->id, 'plantel_id' => $plantelId]) }}"
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
                            value="{{ route('admin.calendarios.index', ['education_level_id' => $levelId, 'plantel_id' => $plantel->id]) }}"
                            {{ $plantelId == $plantel->id ? 'selected' : '' }}>
                            {{ $plantel->name }}</option>
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
                                    <span>{{ $months[$plantel->pivot->start_month] ?? 'Mes desconocido' }}</span>
                                    <span>-</span>
                                    <span>{{ $months[$plantel->pivot->end_month] ?? 'Mes desconocido' }}</span>
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
                                        school_cycle_id: {{ $pdf->school_cycle_id ?? 'null' }},
                                        education_level_id: {{ $pdf->educationLevels->first()->id ?? 'null' }},
                                        start_month: {{ $pdf->educationLevels->first()->pivot->start_month ?? 'null' }},
                                        end_month: {{ $pdf->educationLevels->first()->pivot->end_month ?? 'null' }},
                                        plantel_ids: [{{ $pdf->planteles->pluck('id')->implode(',') }}]
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

            function modalHandler() {
                return {
                    openCreate: false,
                    openEdit: false,
                    pdfId: null,
                    fileName: '',
                    fileSize: '',
                    schoolCycle: '',
                    startMonth: '',
                    endMonth: '',
                    educationLevel: '',
                    planteles: [],
                    months: @json($months),
                    file: null,

                    handleFileInput(event) {
                        const file = event.target.files[0];
                        this.file = file;
                        this.fileName = file.name;
                        this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
                    },
                    handleFileDrop(event) {
                        const file = event.dataTransfer.files[0];
                        this.file = file;
                        this.fileName = file.name;
                        this.fileSize = (file.size / 1024).toFixed(2) + ' KB';
                        this.$refs.fileInputEdit.files = event.dataTransfer.files;
                    },
                    removeFile() {
                        this.file = null;
                        this.fileName = '';
                        this.fileSize = '';
                        this.$refs.fileInput.value = null;
                    },

                    openCreateModal() {
                        this.openCreate = true;
                    },
                    closeCreateModal() {
                        this.openCreate = false;
                    },

                    openEditModal(pdfData) {
                        console.log('PDF Data:', pdfData); // Esto te mostrará los valores que estás pasando
                        this.pdfId = pdfData.id;
                        this.fileName = pdfData.name;
                        this.schoolCycle = pdfData.school_cycle_id || '';
                        this.educationLevel = pdfData.education_level_id || '';
                        this.startMonth = pdfData.start_month || '';
                        this.endMonth = pdfData.end_month || '';
                        this.planteles = pdfData.plantel_ids || [];

                        this.openEdit = true;
                    },
                    closeEditModal() {
                        this.openEdit = false;
                    }
                };
            }
        </script>
    @endpush


</x-admin-layout>
