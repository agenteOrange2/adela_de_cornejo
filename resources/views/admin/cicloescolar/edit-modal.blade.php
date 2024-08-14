<div x-show="openEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
    <div @click.away="closeEditModal()" class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <!-- Modal header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Editar Ciclo Escolar</h3>
            <button @click="closeEditModal()" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal body -->
        <form :action="'/admin/ciclo-escolar/' + ciclo.id" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nombre del Ciclo -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre del Ciclo</label>
                <input type="text" name="name" id="name" x-model="ciclo.name" required class="w-full p-2.5 border rounded-lg" />
            </div>

            <!-- Fecha de Inicio -->
            <div>
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" x-model="ciclo.start_date" required class="w-full p-2.5 border rounded-lg" />
            </div>

            <!-- Fecha de Fin -->
            <div>
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date" x-model="ciclo.end_date" required class="w-full p-2.5 border rounded-lg" />
            </div>

            <!-- Es Actual -->
            <div class="mb-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_current" value="0"> <!-- Esto asegura que 0 se envíe si no está marcado -->
                    <input type="checkbox" name="is_current" x-model="ciclo.is_current" value="1" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ciclo Escolar Actual</span>
                </label>
            </div>

            <!-- Botón de Guardar -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
