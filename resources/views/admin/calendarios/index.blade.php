{{-- resources/views/admin/calendarios/index.blade.php --}}
<x-admin-layout title="Calendario Escolar" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Calendario Escolar',
    ],
]">

<x-slot name="action">        
    <a href="{{ route('admin.calendarios.create') }}"
        class="flex select-none items-center gap-3 rounded-lg bg-school-blue py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-school-blue/10 transition-all hover:shadow-lg hover:shadow-school-blue/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button">
        <i class="fa-regular fa-file-pdf"></i>
        Agregar PDF
    </a>
</x-slot>

<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex items-center justify-between gap-8 mb-8">
            <div>
                <h3 class="text-2xl antialiased font-extrabold leading-snug tracking-normal text-school-blue flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Calendario Escolar
                </h3>
            </div>
            <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
            </div>
        </div>
        <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
            <div class="block w-full overflow-hidden md:w-max">
                <nav>
                    <ul role="tablist" class="relative flex flex-row p-1 rounded-lg bg-school-yellow bg-opacity-60">
                        <li role="tab" class="relative flex items-center justify-center w-full h-full px-2 py-1">
                            <a href="{{ route('admin.calendarios.index', ['level' => 'all']) }}"
                                class="text-inherit no-underline {{ request('level') == 'all' ? 'bg-school-red text-white' : '' }} rounded-lg px-3 py-1">
                                Todo
                            </a>
                        </li>
                        <li role="tab" class="relative flex items-center justify-center w-full h-full px-2 py-1">
                            <a href="{{ route('admin.calendarios.index', ['level' => 'preescolar']) }}"
                                class="text-inherit no-underline {{ request('level') == 'preescolar' ? 'bg-school-red text-white' : '' }} rounded-lg px-3 py-1">
                                Preescolar
                            </a>
                        </li>
                        <li role="tab" class="relative flex items-center justify-center w-full h-full px-2 py-1">
                            <a href="{{ route('admin.calendarios.index', ['level' => 'primaria']) }}"
                                class="text-inherit no-underline {{ request('level') == 'primaria' ? 'bg-school-red text-white' : '' }} rounded-lg px-3 py-1">
                                Primaria
                            </a>
                        </li>
                        <li role="tab" class="relative flex items-center justify-center w-full h-full px-2 py-1">
                            <a href="{{ route('admin.calendarios.index', ['level' => 'secundaria']) }}"
                                class="text-inherit no-underline {{ request('level') == 'secundaria' ? 'bg-school-red text-white' : '' }} rounded-lg px-3 py-1">
                                Secundaria
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="w-full md:w-72">
                <div class="relative h-10 w-full min-w-[200px]">
                    <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                            </path>
                        </svg>
                    </div>
                    <form action="{{ route('admin.calendarios.index') }}" method="GET">
                        <input type="text" name="search" placeholder="Buscar"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-school-blue focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-school-blue peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-school-blue peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-school-blue peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Buscar
                        </label>
                        <input type="hidden" name="level" value="{{ request('level', 'all') }}">
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- PDFs Table -->
    <div class="p-6 px-0 overflow-scroll">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-4 border-y border-blue-gray-100 bg-school-yellow">Nombre</th>
                    <th class="p-4 border-y border-blue-gray-100 bg-school-yellow">Última modificación</th>
                    <th class="p-4 border-y border-blue-gray-100 bg-school-yellow">Plantel</th>
                    <th class="p-4 border-y border-blue-gray-100 bg-school-yellow">Tipo de archivo</th>
                    <th class="p-4 border-y border-blue-gray-100 bg-school-yellow">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pdfs as $pdf)
                    <tr>
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="flex items-center gap-3">
                                <div class="flex flex-col">
                                    <a href="{{ route('admin.calendarios.edit', $pdf) }}"
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-800 opacity-90">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        {{ $pdf->name }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $pdf->updated_at->format('d/m/Y') }}
                            </p>
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            @foreach ($pdf->planteles as $plantel)
                                <span>{{ $plantel->name }}</span>
                            @endforeach
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <div class="w-max">
                                <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20">
                                    <span class="">PDF</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.calendarios.edit', $pdf->id) }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
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
                        <td colspan="5">
                            <div class="p-4 border-b border-blue-gray-50 text-center">No hay Pdfs Subidos</div>
                        </td>
                    </tr> 
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="items-center justify-between p-4 border-t border-blue-gray-50">
        <div class="mt-5">
            {{ $pdfs->links() }}
        </div>
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
        </script>
    @endpush
</x-admin-layout>
