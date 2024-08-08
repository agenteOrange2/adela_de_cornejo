<x-admin-layout title="Ciclo escolar" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],    
    [
        'name' => 'Ciclo Escolar',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.ciclo-escolar.create') }}"
        class="text-white bg-red-500 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">Nuevo
        Ciclo Escolar</a>
    </x-slot>

    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-school-blue flex items-center">              
            <i class="fa-solid fa-graduation-cap mr-2"></i>      
            Lista de Ciclo Escolar
        </h1>
    </div>

    <x-validation-errors class="my-4" />

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-blue-700 dark:bg-yellow-500 dark:text-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Inicio Periodo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fin Periodo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ciclos as $ciclo)
                    <tr class="odd:bg-yellow-100 odd:dark:bg-blue-900 even:bg-gray-50 even:dark:bg-blue-800 border-b dark:border-gray-500">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                            {{ $ciclo->id }}
                        </th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            {{ $ciclo->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            {{ \Carbon\Carbon::parse($ciclo->start_date)->isoFormat('dddd, D [de] MMMM [de] Y') }}
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            {{ \Carbon\Carbon::parse($ciclo->end_date)->isoFormat('dddd, D [de] MMMM [de] Y') }}
                        </td>
                        <td class="px-6 py-4 flex items-center space-x-3">
                            <a href="{{ route('admin.ciclo-escolar.edit', $ciclo) }}" class="font-medium text-blue-600 dark:text-blue-300 hover:underline">Editar</a>
                            <button onclick="deleteCiclo()" class="text-red-600 hover:text-red-800">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <form action="{{ route('admin.ciclo-escolar.destroy', $ciclo) }}" method="POST" id="formDelete">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b">
                        <td colspan="5" class="px-6 py-4 text-center bg-red-600 text-white">No hay Ciclos Escolares.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="items-center justify-between p-4 border-t border-blue-700 dark:border-gray-600">
            <div class="mt-5">
                {{ $ciclos->links() }}
            </div>
        </div>
    </div>
    
    <script>
        function deleteCiclo() {
            if (confirm('¿Estás seguro de eliminar este ciclo escolar?')) {
                document.getElementById('formDelete').submit();
            }
        }
    </script>
    


    @push('js')
        <script>
            function deleteCiclo() {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('formDelete');
                        form.submit(); // Envía el formulario de eliminación
                    }
                });
            }
        </script>
    @endpush


</x-admin-layout>
