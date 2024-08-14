<x-admin-layout title="Ciclo Escolar" :breadcrumb="[['name' => 'Inicio', 'url' => route('admin.dashboard')], ['name' => 'Ciclo Escolar']]">

    <div x-data="modalHandler()">
        <!-- Incluir el modal de creación -->
        @include('admin.cicloescolar.create-modal')

        <!-- Incluir el modal de edición -->
        @include('admin.cicloescolar.edit-modal')

        <!-- Filtros (si es necesario agregar alguno) -->
        <div class="flex justify-between heading py-5">
            <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
                <i class="fa-solid fa-calendar-alt mr-2"></i>
                Lista de Ciclo Escolar
            </h1>
        </div>

        <!-- Tabla de Ciclos Escolares -->
        <div class="p-6 overflow-scroll">
            <table class="w-full min-w-max text-left table-auto">
                <thead>
                    <tr>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Nombre del Ciclo</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Fecha de Inicio</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Fecha de Fin</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Actual</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schoolCycles as $ciclo)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">{{ $ciclo->name }}</td>
                            <td class="p-4 border-b border-blue-gray-50">{{ $ciclo->formatted_start_date }}</td>
                            <td class="p-4 border-b border-blue-gray-50">{{ $ciclo->formatted_end_date }}</td>
                            <td class="p-4 border-b border-blue-gray-50">
                                @if ($ciclo->is_current)
                                    <span class="text-green-600">Sí</span>
                                @else
                                    <span class="text-red-600">No</span>
                                @endif
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex gap-2">
                                    <button
                                        @click="openEditModal({
                                        id: {{ $ciclo->id }},
                                        name: '{{ $ciclo->name }}',
                                        start_date: '{{ $ciclo->start_date->format('Y-m-d') }}',
                                        end_date: '{{ $ciclo->end_date->format('Y-m-d') }}',
                                        is_current: {{ $ciclo->is_current ? 'true' : 'false' }},
                                    })"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.ciclo-escolar.destroy', $ciclo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay ciclos escolares registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('js')
        <script>
            function modalHandler() {
                return {
                    openCreate: false,
                    openEdit: false,
                    ciclo: {
                        id: null,
                        name: '',
                        start_date: '',
                        end_date: '',
                        is_current: false,
                    },

                    openCreateModal() {
                        this.resetCiclo();
                        this.openCreate = true;
                    },
                    closeCreateModal() {
                        this.openCreate = false;
                    },

                    openEditModal(cicloData) {
                        this.ciclo = {
                            ...cicloData
                        };
                        this.openEdit = true;
                    },
                    closeEditModal() {
                        this.openEdit = false;
                    },

                    resetCiclo() {
                        this.ciclo = {
                            id: null,
                            name: '',
                            start_date: '',
                            end_date: '',
                            is_current: false,
                        };
                    },
                };
            }
        </script>
    @endpush

</x-admin-layout>
