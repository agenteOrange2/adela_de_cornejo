<x-admin-layout title="Menu Escolar" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Menu Escolar',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.menu-cafeteria.create') }}"
        class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button">
        <i class="fa-regular fa-file-pdf"></i>
        Agregar PDF
    </a>     
    </x-slot>

    <livewire:menu-cafeteria-data-table />

    {{-- <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-school-blue flex items-center">              
            <i class="fa-solid fa-utensils mr-2"></i>
            Menú Escolar
        </h1>
                
        <!-- Selectores para filtros -->
        <div class="space-x-4 flex">
            <select onchange="location = this.value;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="{{ route('admin.menu-cafeteria.index') }}">Todos los Planteles</option>
                @foreach ($planteles as $plantel)
                    <option value="{{ route('admin.menu-cafeteria.index', ['plantel' => $plantel->id]) }}"
                        {{ $plantelId == $plantel->id ? 'selected' : '' }}>{{ $plantel->name }}</option>
                @endforeach
            </select>
            <select onchange="location = this.value;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <!-- Asígnale el valor correcto para filtrar por mes -->
                @foreach ($months as $num => $name)
                    <option value="{{ route('admin.menu-cafeteria.index', ['plantel' => $plantelId, 'month' => $num]) }}"
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
                    <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Tipo de archivo</th>
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
                                    <a href="{{ route('admin.menu-cafeteria.edit', $pdf->id) }}"
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-800 opacity-90">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        {{ $pdf->name }}
                                    </a>
                                </div>
                            </div>
                        </td>       
                        
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="w-max">
                                <div
                                    class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                    <span class="">PDF</span>
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
                                <a href="{{ route('admin.menu-cafeteria.edit', $pdf->id) }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
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
    </div> --}}

    

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
    </script>
@endpush
</x-admin-layout>
