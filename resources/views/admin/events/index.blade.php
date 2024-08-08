<x-admin-layout title="Eventos" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Eventos',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.eventos.create') }}"
            class="text-white bg-school-red hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-red dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">Crear
            Evento
            <i class="fa-regular fa-calendar-check ml-2"></i>
        </a>        
    </x-slot>

    <div class="flex justify-between heading py-5">        
        <h1 class="text-2xl font-extrabold text-gray-800">
            <i class="fa-regular fa-calendar-check mr-2"></i>
            Lista de Eventos
        </h1>
    </div>

    <x-validation-errors class="my-4" />

    <livewire:eventos-data-table  />

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

    {{-- <ul class="space-y-8">
        @forelse ($eventos as $evento)
            <div class="dark:bg-gray-100 dark:text-gray-900">
                <div class="container grid grid-cols-12 mx-auto dark:bg-gray-50">

                    <div class="bg-no-repeat bg-cover  col-span-full lg:col-span-4 ">
                        <img class="rounded-lg" src="{{ $evento->image }}" alt="{{ $evento->title }}">
                    </div>
                    <div class="flex flex-col p-6 col-span-full row-span-full lg:col-span-8 lg:p-10">
                        <div class="flex justify-start mb-5">
                            <span @class([
                                'bg-blue-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-white' =>
                                    $evento->is_published,
                                'bg-red-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-white' => !$evento->is_published,
                            ])>{{ $evento->is_published ? 'Publicado' : 'Borrador' }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-semibold">{{ $evento->title }}</h1>
                        <p class="flex-1 pt-2">{{ $evento->excerpt }}</p>

                        </a>
                        <div class="flex items-center justify-between pt-5">
                            <div class="flex space-x-2">
                                <img src="{{ $evento->user->profile_photo_url }}" alt="{{ $evento->user->name }}" class="w-8 h-8 rounded-full">
                                <span class="self-center text-sm">{{ $evento->user->name }}</span>
                            </div>

                            <a href="{{ route('admin.eventos.edit', $evento) }}"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Editar
                                Evento</a>
                        </div>
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-200 border-0 ">
            </div>
        @empty

        <div class="border-b ">
            <h2 class="px-6 py-4 text-center  bg-school-blue text-white rounded-lg">No hay eventos registrados<i class="fa-regular fa-calendar-check ml-2"></i></h2>
        </div>
        @endforelse
    </ul>

    <div class="mt-5">
        {{$eventos->links()}}
    </div> --}}
</x-admin-layout>