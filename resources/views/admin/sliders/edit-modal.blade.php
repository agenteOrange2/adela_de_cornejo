<!-- Modal de Edición de Slider -->
<div x-show="openEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
    <div @click.away="closeEditModal()" class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <!-- Modal header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Editar Slider</h3>
            <button @click="closeEditModal()"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Validación de Errores -->
        <x-validation-errors class="my-4" />

        <!-- Formulario de Edición -->        
        <form :action="'/admin/sliders/' + form.id" method="POST" enctype="multipart/form-data">
      
            @csrf
            @method('PUT')

            <!-- Tabs -->
            <div class="mb-4">
                <ul class="flex border-b">
                    <li class="mr-1">
                        <button type="button" @click="activeTab = 'desktop'"
                            :class="{'active': activeTab === 'desktop'}"
                            class="tab-btn bg-white inline-block py-2 px-4 text-blue-500 hover:text-white font-semibold transition">
                            Escritorio
                        </button>
                    </li>
                    <li class="mr-1">
                        <button type="button" @click="activeTab = 'tablet'"
                            :class="{'active': activeTab === 'tablet'}"
                            class="tab-btn bg-white inline-block py-2 px-4 text-blue-500 hover:text-white font-semibold transition">
                            Tableta
                        </button>
                    </li>
                    <li class="mr-1">
                        <button type="button" @click="activeTab = 'mobile'"
                            :class="{'active': activeTab === 'mobile'}"
                            class="tab-btn bg-white inline-block py-2 px-4 text-blue-500 hover:text-white font-semibold transition">
                            Celular
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Contenido de las Tabs -->
            <div x-show="activeTab === 'desktop'" x-transition>
                <div x-data="{ isDragging: false }" @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false; handleImageUpload($event, 'desktop')">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Imagen Desktop</label>
                    <div class="relative flex items-center justify-center w-full p-4 border-2 border-dashed rounded-lg"
                        :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="handleImageUpload($event, 'desktop')">
                        <p x-show="!form.images.desktop" class="text-gray-500">Arrastra la imagen aquí o haz clic para seleccionar</p>
                        <img x-show="form.images.desktop" :src="form.images.desktop" class="w-full h-auto">
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'tablet'" x-transition>
                <div x-data="{ isDragging: false }" @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false; handleImageUpload($event, 'tablet')">
                    <label for="image_tablet" class="block mb-2 text-sm font-medium text-gray-900">Imagen Tablet</label>
                    <div class="relative flex items-center justify-center w-full p-4 border-2 border-dashed rounded-lg"
                        :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">
                        <input type="file" name="image_tablet" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="handleImageUpload($event, 'tablet')">
                        <p x-show="!form.images.tablet" class="text-gray-500">Arrastra la imagen aquí o haz clic para seleccionar</p>
                        <img x-show="form.images.tablet" :src="form.images.tablet" class="w-full h-auto">
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'mobile'" x-transition>
                <div x-data="{ isDragging: false }" @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false; handleImageUpload($event, 'mobile')">
                    <label for="image_mobile" class="block mb-2 text-sm font-medium text-gray-900">Imagen Mobile</label>
                    <div class="relative flex items-center justify-center w-full p-4 border-2 border-dashed rounded-lg"
                        :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">
                        <input type="file" name="image_mobile" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="handleImageUpload($event, 'mobile')">
                        <p x-show="!form.images.mobile" class="text-gray-500">Arrastra la imagen aquí o haz clic para seleccionar</p>
                        <img x-show="form.images.mobile" :src="form.images.mobile" class="w-full h-auto">
                    </div>
                </div>
            </div>

            <!-- Título -->
            <div class="mt-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Título del Slider</label>
                <input type="text" name="title" x-model="form.title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ingrese el título">
            </div>

            <!-- Enlace -->
            <div class="mt-4">
                <label for="link" class="block mb-2 text-sm font-medium text-gray-900">Enlace</label>
                <input type="text" name="link" x-model="form.link"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ingrese el enlace">
            </div>

            <!-- Publicado -->
            <div class="mt-4 flex items-center">
                <label class="inline-flex items-center mb-5 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $slider->is_published) == 1)
                        class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 ">Publicar</span>
                </label>
            </div>

            <!-- Botón para guardar -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>



