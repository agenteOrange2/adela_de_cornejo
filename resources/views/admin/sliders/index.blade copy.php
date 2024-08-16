<x-admin-layout title="Sliders" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Sliders',
    ],
]">

    <x-slot name="action">        
            <button @click="openCreateModal()"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Crear Nuevo Slider
        </button>
    </x-slot>

    <!-- Modal de Creación/Edición -->
    @include('admin.sliders.create-modal') <!-- Aquí cargamos el modal que se verá más adelante -->

    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Lista de Sliders</h1>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha de Creación
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $slider)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">

                            @if ($slider->images->first())
                                <img class="w-10 h-10 rounded-full"
                                    src="{{ asset('storage/' . $slider->images->first()->path) }}" alt="{{ $slider->title }}">
                            @else
                                <img class="w-10 h-10 rounded-full" src="/images/default.png" alt="Default image">
                            @endif
                            <div class="ps-3">
                                <div class="text-base font-semibold">{{ $slider->title }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $slider->updated_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="h-2.5 w-2.5 rounded-full {{ $slider->is_published ? 'bg-green-500' : 'bg-red-500' }} me-2">
                                </div>
                                {{ $slider->is_published ? 'Publicado' : 'Borrador' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center px-6 py-4">
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Editar</a>
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST"
                                    id="delete-slider-form-{{ $slider->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteSlider({{ $slider->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr class="border-b">
                        <td colspan="5" class="px-6 py-4 text-center  bg-gray-700 text-white">No hay sliders
                            registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('js')
        <script>
            function deleteSlider(sliderId) {
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
                        const form = document.getElementById('delete-slider-form-' + sliderId);
                        if (form) {
                            form.submit(); // Envía el formulario de eliminación específico
                        }
                    }
                });
            }

            function modalHandler() {
                return {
                    openCreate: false,
                    openEdit: false,
                    form: {
                        id: null,
                        title: '',
                        link: '',
                        is_published: false,
                        images: {
                            desktop: null,
                            tablet: null,
                            mobile: null,
                        }
                    },
                    openCreateModal() {
                        this.resetForm();
                        this.openCreate = true;
                    },
                    openEditModal(sliderData) {
                        this.form = { ...sliderData };
                        this.openEdit = true;
                    },
                    closeModal() {
                        this.openCreate = false;
                        this.openEdit = false;
                    },
                    resetForm() {
                        this.form = {
                            id: null,
                            title: '',
                            link: '',
                            is_published: false,
                            images: {
                                desktop: null,
                                tablet: null,
                                mobile: null,
                            }
                        };
                    },
                    handleImageUpload(event, type) {
                        const file = event.target.files[0];
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.form.images[type] = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                };
            }
        </script>
    @endpush
</x-admin-layout>
