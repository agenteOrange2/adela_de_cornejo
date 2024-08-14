<x-admin-layout title="Avisos" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Avisos',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.avisos.create') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Crear
            Aviso</a>
    </x-slot>
    <div class="flex justify-between heading py-5">

        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Avisos</h1>

    </div>

    <x-validation-errors class="my-4" />

    <div class="mb-4">               
        <livewire:avisos-data-table  />
    </div>

    {{-- <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-5 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @forelse ($avisos as $aviso)
                    <div class="py-8 flex align-middle flex-wrap md:flex-nowrap">
                        <div class="md:w-1/8 mr-5 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <!-- Ajuste del contenedor de la imagen -->
                            <div class="w-full h-48 bg-gray-200 overflow-hidden">
                                <img src="{{ $aviso->image }}" alt="{{ $aviso->title }}"
                                    class="w-full h-full object-cover object-center">
                            </div>

                        </div>
                        <div class="md:flex-grow">
                            <div class="flex justify-start mb-5">
                                <span @class([
                                    'bg-blue-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-white' =>
                                        $aviso->is_published,
                                    'bg-red-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-white' => !$aviso->is_published,
                                ])>{{ $aviso->is_published ? 'Publicado' : 'Borrador' }}
                                </span>
                            </div>
                            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $aviso->title }}</h2>
                            <p class="leading-relaxed">{{ $aviso->excerpt }}</p>
                            <div class="mt-5">
                                <a href="{{ route('admin.avisos.edit', $aviso) }}"
                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Editar
                                    aviso</a>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="border-b">
                        <h2 class="px-6 py-4 text-center  bg-gray-700 text-white">No hay Avisos Registrados</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div class="mt-5">
        {{ $avisos->links() }}
    </div> --}}

@push('js')
    <script>
        Livewire.on('error', function(message){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
        })
    });
    </script>
@endpush
</x-admin-layout>
