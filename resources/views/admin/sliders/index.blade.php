<x-admin-layout title="Sliders" :breadcrumb="[['name' => 'Inicio', 'url' => route('admin.dashboard')], ['name' => 'Sliders']]">

    <!-- Contenedor principal -->
    <div x-data="modalHandler()">
        <!-- Botón para abrir el modal de creación -->
        <div class="flex justify-end my-4">
            <button @click="openCreateModal()"
                class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                Crear Nuevo Slider
            </button>
        </div>

        <!-- Tabla de Sliders -->
        <div class="p-6 overflow-scroll">
            <table class="w-full min-w-max text-left table-auto">
                <thead>
                    <tr>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Título</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Enlace</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Publicado</th>
                        <th class="p-4 bg-blue-gray-50 border-y border-blue-gray-100">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">{{ $slider->title }}</td>
                            <td class="p-4 border-b border-blue-gray-50">{{ $slider->link }}</td>
                            <td class="p-4 border-b border-blue-gray-50">{{ $slider->is_published ? 'Sí' : 'No' }}</td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex gap-2">
                                    <button
                                    @click="openEditModal({
                                        title: '{{ $slider->title }}',
                                        link: '{{ $slider->link }}',
                                        is_published: {{ $slider->is_published }},
                                        images: {
                                            desktop: '{{ $slider->getDesktopImage() ? asset('storage/' . $slider->getDesktopImage()->path) : '' }}',
                                            tablet: '{{ $slider->getTabletImage() ? asset('storage/' . $slider->getTabletImage()->path) : '' }}',
                                            mobile: '{{ $slider->getMobileImage() ? asset('storage/' . $slider->getMobileImage()->path) : '' }}',
                                        }
                                    })"
                                    class="text-blue-600 hover:text-blue-800"
                                >
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>


                                    <!-- Aquí puedes añadir el botón de eliminar -->
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay sliders creados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal de Creación -->
        @include('admin.sliders.create-modal')

        <!-- Modal de Edición -->
        {{-- @include('admin.sliders.edit-modal') --}}

    </div>

    @push('js')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('modalHandler', () => ({
                    openCreate: false,
                    openEdit: false,
                    activeTab: 'desktop',
                    form: {
                        title: '',
                        link: '',
                        is_published: false,
                        images: {
                            desktop: '',
                            tablet: '',
                            mobile: '',
                        },
                    },
                    openCreateModal() {
                        this.resetForm();
                        this.openCreate = true;
                    },
                    closeCreateModal() {
                        this.openCreate = false;
                    },
                    openEditModal(slider) {
                        this.resetForm();
                        this.form.title = slider.title;
                        this.form.link = slider.link;
                        this.form.is_published = slider.is_published;

                        // Asignar las rutas de las imágenes solo si existen
                        this.form.images.desktop = slider.images.desktop ? slider.images.desktop : '';
                        this.form.images.tablet = slider.images.tablet ? slider.images.tablet : '';
                        this.form.images.mobile = slider.images.mobile ? slider.images.mobile : '';

                        this.openEdit = true;
                    },
                    closeEditModal() {
                        this.openEdit = false;
                    },
                    resetForm() {
                        this.form = {
                            title: '',
                            link: '',
                            is_published: false,
                            images: {
                                desktop: '',
                                tablet: '',
                                mobile: '',
                            },
                        };
                    },
                    handleImageUpload(event, type) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.form.images[type] = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
                }));
            });
        </script>
    @endpush

</x-admin-layout>
