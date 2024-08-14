<div x-data="{ open: false, ciclo: {} }">
    <!-- Modal de edición -->
    <div x-show="open" @click.away="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800">Editar Ciclo Escolar</h2>
                <button @click="open = false" class="text-gray-400 hover:text-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form :action="'/admin/ciclo-escolar/' + ciclo.id" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Ciclo</label>
                    <input type="text" name="name" id="name" x-model="ciclo.name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" x-model="ciclo.start_date" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
                    <input type="date" name="end_date" id="end_date" x-model="ciclo.end_date" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    function openEditModal(ciclo) {
        // Abre el modal y carga los datos del ciclo
        document.querySelector('[x-data="{ open: false, ciclo: {} }"]').__x.$data.ciclo = ciclo;
        document.querySelector('[x-data="{ open: false, ciclo: {} }"]').__x.$data.open = true;
    }
</script>
@endpush
