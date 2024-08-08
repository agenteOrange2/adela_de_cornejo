<x-admin-layout title="Nuevo Evento" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Eventos',
        'url' => route('admin.eventos.index'),
    ],
    [
        'name' => 'Nuevo Evento',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.eventos.index') }}"
            class="text-white bg-school-blue hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-blue dark:hover:bg-blue-700 dark:focus:ring-blue-700">Volver</a>
    </x-slot>

    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
            <i class="fas fa-calendar-plus mr-2"></i>
            Nuevo Evento
        </h1>
    </div>

    <form action="{{ route('admin.eventos.store') }}" method="POST" enctype="multipart/form-data" x-data="data()"
        x-init="$watch('title', value => { string_to_slug(value) })">
        @csrf
        <x-validation-errors class="my-4" />

        <!-- Profile Header -->
        <div class="my-2">
            <div class="max-w-full mx-auto bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <figure>
                        <img src="https://via.placeholder.com/1500x500" alt="Banner" class="w-full h-48 object-cover"
                            id="imgPreviewBanner">
                    </figure>
                    <div class="absolute top-8 right-8">
                        <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                            <i class="fa-solid fa-camera mr-2"></i>
                            Actualizar imagen
                            <input type="file" accept="image/*" name="banner" class="hidden"
                                onchange="previewImage(event, '#imgPreviewBanner')">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-10">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                    <div class="mb-6 relative shadow">
                        <figure>
                            <img class="aspect-[16/9] object-cover object-center w-full"
                                src="{{ isset($property) ? $property->mainImage() : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg' }}"
                                alt="Imagen destacada" id="imgPreview">
                        </figure>
                        <div class="absolute top-8 right-8">
                            <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                                <i class="fa-solid fa-camera mr-2"></i>
                                Actualizar imagen
                                <input type="file" accept="image/*" name="image" class="hidden"
                                    onchange="previewImage(event, '#imgPreview')">
                            </label>
                        </div>
                    </div>

                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <ul
                            class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                            <li class="me-2">
                                <a href="#" id="description-tab"
                                    class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg  group active border-blue-600 text-blue-600"
                                    aria-current="page">
                                    <i class="fa-solid fa-list mr-2" aria-hidden="true"></i>
                                    Descripción
                                </a>
                            </li>
                            <li class="me-2">
                                <a href="#" id="gallery-upload-tab"
                                    class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                    <i class="fa-solid fa-file-pdf mr-2" aria-hidden="true"></i>
                                    Galería
                                </a>
                            </li>
                            <li class="me-2">
                                <a href="#" id="video-upload-tab"
                                    class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                    <i class="fa-solid fa-video mr-2" aria-hidden="true"></i>
                                    Videos
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="description-content" class="tab-content my-5">
                        <div class="flex flex-wrap -mx-2">
                            <div class="mb-4 px-2 w-full md:w-1/2">
                                <label for="title" class="mb-2">
                                    Título del Evento
                                </label>
                                <input value="{{ old('title') }}" name="title" x-model="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese el nombre del Evento">
                                </input>
                            </div>
                            <div class="mb-4 px-2 w-full md:w-1/2">
                                <label for="slug" class="mb-2">
                                    Slug
                                </label>
                                <input value="{{ old('slug') }}" name="slug" x-model="slug"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese el Slug del Evento">
                                </input>
                            </div>
                        </div>
                        <div class="mb-5">
                            <x-label for="excerpt" class="mb-2">
                                Descripcion corta
                            </x-label>
                            <textarea name="excerpt" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Escriba un extracto del post">{{ old('excerpt') }}</textarea>
                        </div>
                        <div class="my-10 ckeditor" data-upload-url="{{ route('images.upload') }}">
                            <x-label for="description" class="mb-2">
                                Descripcion
                            </x-label>
                            <textarea class="editor" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Escriba el Contenido">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div id="gallery-upload-content" class="tab-content my-5 hidden">
                        <header id="drop-area"
                            class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                            <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                <span>Arrastra y suelta tus</span>&nbsp;<span>archivos aquí o</span>
                            </p>
                            <input id="file-input" type="file" name="gallery_files[]" multiple class="hidden"
                                accept=".jpg,.jpeg,.png,.webp,.gif" />
                            <button id="upload-button"
                                class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                Subir un archivo
                            </button>
                        </header>

                        <ul id="gallery" class="flex flex-wrap mt-4">
                        </ul>
                        <button id="add-more-button"
                            class="mt-2 rounded-sm px-3 py-1 bg-school-blue text-white hover:bg-blue-700 focus:shadow-outline focus:outline-none hidden">
                            Añadir más archivos
                        </button>
                    </div>

                    <div id="video-upload-content" class="tab-content my-5 hidden">
                        <div class="mb-4 px-2 w-full">
                            <label for="videos"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Videos</label>
                            <div id="video-links-container">
                            </div>
                            <button type="button" id="add-video-btn"
                                class="mt-2 text-white bg-school-blue hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                Agregar Enlace
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="my-5">
                        <h3 class="mb-4 font-semibold text-gray-900 ">Categorías</h3>
                        <div class="p-3">
                            <label for="input-group-search-categories" class="sr-only">Buscar</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="input-group-search-categories"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Buscar">
                            </div>
                        </div>
                        <ul id="categories-list"
                            class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-900 dark:text-gray-200">
                            @foreach ($categories as $category)
                                <li class="category-item">
                                    <div
                                        class="flex items-center p-2 rounded hover:bg-gray-700 dark:hover:bg-gray-300">
                                        <input id="checkbox-{{ $category->id }}" type="checkbox"
                                            name="event_category_ids[]" value="{{ $category->id }}"
                                            class="w-4 h-4 text-school-blue bg-gray-100 border-gray-300 rounded focus:ring-school-blue dark:focus:ring-school-blue dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            {{ in_array($category->id, old('event_category_ids', [])) ? 'checked' : '' }}>
                                        <label for="checkbox-{{ $category->id }}"
                                            class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-700">{{ $category->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-4 px-2 w-full">
                        <label for="date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Fecha del
                            Evento</label>
                        <input type="date" name="date" value="{{ old('date') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Seleccione la fecha del evento">
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <label for="start_time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Hora de
                            Inicio</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="time" name="start_time" value="{{ old('start_time') }}"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <label for="end_time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Hora de Fin</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="time" name="end_time" value="{{ old('end_time') }}"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <x-label for="location" class="mb-2">Ubicación del Evento</x-label>
                        <input type="text" name="location" value="{{ old('location') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Ingrese la ubicación del evento" />
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <x-label for="maps" class="mb-2">Mapa</x-label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa-regular fa-map text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <input type="text" name="maps" value="{{ old('maps') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ingrese la URL del mapa" />
                        </div>
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <x-label for="type" class="mb-2">Tipo de Evento</x-label>
                        <select name="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Seleccione un tipo</option>
                            <option value="academico">Académico</option>
                            <option value="cultural">Cultural</option>
                            <option value="deportivo">Deportivo</option>
                            <option value="social">Social</option>
                        </select>
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <x-label for="status" class="mb-2">Estado del Evento</x-label>
                        <select name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="planeado">Planeado</option>
                            <option value="en_curso">En Curso</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="mb-4 px-2 w-full">
                        <x-label for="organizer" class="mb-2">Organizador del Evento</x-label>
                        <x-input name="organizer" value="{{ old('organizer') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Ingrese el nombre del organizador">
                        </x-input>
                    </div>
                    <div class="mb-4">
                        <x-label for="planteles" class="mb-2">Planteles</x-label>
                        <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($planteles as $plantel)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center px-3">
                                        <input id="plantel-{{ $plantel->id }}" type="checkbox" name="plantel_ids[]" value="{{ $plantel->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="plantel-{{ $plantel->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $plantel->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <template id="image-template">
                <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                    <article tabindex="0"
                        class="group hasImage w-full h-full rounded-md focus:outline-none dark:focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                        <img alt="upload preview"
                            class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
                        <section
                            class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                            <h1 class="flex-1"></h1>
                            <div class="flex">
                                <span class="p-1">
                                    <i>
                                        <svg class="fill-current w-4 h-4 ml-auto pt-"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                        </svg>
                                    </i>
                                </span>
                                <p class="p-1 size text-xs"></p>
                                <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path class="pointer-events-none"
                                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                    </svg>
                                </button>
                            </div>
                        </section>
                    </article>
                </li>
            </template>

            <div class="my-5">
                <div class="flex justify-end my-10">
                    <label class="inline-flex items-center mb-5 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900">Publicar</span>
                    </label>
                </div>
                <div class="flex justify-end">
                    <x-button>
                        Crear Evento
                    </x-button>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            /* Imagen Preview */
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
            /*Imagen Preview*/

            /* Slug Generation */
            function data() {
                return {
                    title: '',
                    slug: '',
                    string_to_slug(str) {
                        str = str.replace(/^\s+|\s+$/g, '').toLowerCase();
                        const from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                        const to = "aaaaeeeeiiiioooouuuunc------";
                        for (let i = 0, l = from.length; i < l; i++) {
                            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                        }
                        str = str.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                        this.slug = str;
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // TABS
                const tabs = {
                    description: {
                        tab: document.getElementById('description-tab'),
                        content: document.getElementById('description-content')
                    },
                    gallery: {
                        tab: document.getElementById('gallery-upload-tab'),
                        content: document.getElementById('gallery-upload-content')
                    },
                    video: {
                        tab: document.getElementById('video-upload-tab'),
                        content: document.getElementById('video-upload-content')
                    }
                };

                function setActiveTab(activeKey) {
                    for (const key in tabs) {
                        const {
                            tab,
                            content
                        } = tabs[key];
                        if (key === activeKey) {
                            tab.classList.add('border-blue-600', 'text-blue-600', 'active');
                            tab.classList.remove('border-transparent', 'text-gray-600');
                            content.style.display = 'block';
                        } else {
                            tab.classList.remove('border-blue-600', 'text-blue-600', 'active');
                            tab.classList.add('border-transparent', 'text-gray-600');
                            content.style.display = 'none';
                        }
                    }
                }

                for (const key in tabs) {
                    const {
                        tab
                    } = tabs[key];
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        setActiveTab(key);
                    });
                }

                // CKEditor
                const editors = {};
                document.querySelectorAll('.editor').forEach((editorElement) => {
                    ClassicEditor.create(editorElement, {
                        simpleUpload: {
                            uploadUrl: "{{ route('images.upload') }}",
                            withCredentials: true,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        }
                    }).then(editor => {
                        editors[editorElement.name] = editor;
                        editor.model.document.on('change:data', () => {
                            editor.updateSourceElement();
                        });
                    }).catch(error => {
                        console.error(error);
                    });
                });

                // Buscador
                function setupSearch(inputId, listId, itemClass) {
                    const input = document.getElementById(inputId);
                    const items = document.querySelectorAll(`#${listId} .${itemClass}`);
                    input.addEventListener('keyup', function() {
                        const searchTerm = this.value.toLowerCase();
                        items.forEach(item => {
                            const itemText = item.textContent.toLowerCase();
                            item.style.display = itemText.includes(searchTerm) ? '' : 'none';
                        });
                    });
                }
                setupSearch('input-group-search-categories', 'categories-list', 'category-item');


                // Handle image files
                document.getElementById('file-input').addEventListener('change', function(e) {
                    handleFiles(this.files);
                });

                const dropArea = document.getElementById('drop-area');
                const galleryUploadContent = document.getElementById('gallery-upload-content');
                const addMoreButton = document.getElementById('add-more-button');
                const uploadButton = document.getElementById('upload-button');
                let FILES = {};

                // Drag & Drop functionality
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                dropArea.addEventListener('dragover', highlight, false);
                dropArea.addEventListener('dragenter', highlight, false);
                dropArea.addEventListener('dragleave', unhighlight, false);
                dropArea.addEventListener('drop', unhighlight, false);

                function highlight(e) {
                    dropArea.classList.add('bg-gray-200');
                }

                function unhighlight(e) {
                    dropArea.classList.remove('bg-gray-200');
                }

                dropArea.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    handleFiles(files);
                }

                function handleFiles(files) {
                    const fileInput = document.getElementById('file-input');
                    const gallery = document.getElementById('gallery');
                    const template = document.getElementById('image-template').content;
                    let newFilesAdded = false;

                    Array.from(files).forEach(file => {
                        if (!FILES[file.name] && file.size <= 400 * 1024) { // 400 KB limit
                            FILES[file.name] = file;

                            // Añadir el archivo al campo de entrada
                            const dataTransfer = new DataTransfer();
                            Array.from(fileInput.files).forEach(file => dataTransfer.items.add(file));
                            dataTransfer.items.add(file);
                            fileInput.files = dataTransfer.files;

                            const clone = template.cloneNode(true);
                            clone.querySelector('h1').textContent = file.name;
                            clone.querySelector('.size').textContent = formatBytes(file.size);
                            const imgPreview = clone.querySelector('.img-preview');
                            imgPreview.src = URL.createObjectURL(file);
                            clone.querySelector('.delete').addEventListener('click', function() {
                                delete FILES[file.name];
                                this.closest('li').remove();
                            });
                            gallery.appendChild(clone);
                            newFilesAdded = true;
                        }
                    });

                    if (newFilesAdded) {
                        console.log('Nuevos archivos agregados:', FILES);
                        dropArea.style.display = 'none';
                        addMoreButton.classList.remove('hidden');
                    }
                }

                uploadButton.addEventListener('click', function(e) {
                    e.preventDefault(); // Evita que el formulario se envíe
                    document.getElementById('file-input').click();
                });

                addMoreButton.addEventListener('click', function(e) {
                    e.preventDefault(); // Evita que el formulario se envíe
                    document.getElementById('file-input').click();
                });

                function formatBytes(bytes, decimals = 2) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const dm = decimals < 0 ? 0 : decimals;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
                }

                // Video Links
                const videoLinksContainer = document.getElementById('video-links-container');
                const addVideoBtn = document.getElementById('add-video-btn');

                function addVideoInput(value = '') {
                    const index = videoLinksContainer.children.length;
                    const inputHTML = `
                        <div class="video-input-group mb-2">
                            <input type="url" name="video_urls[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ingrese URL del video" value="${value}">
                            <button type="button" class="remove-video-btn text-red-500">Eliminar</button>
                        </div>`;
                    videoLinksContainer.insertAdjacentHTML('beforeend', inputHTML);
                }

                addVideoBtn.addEventListener('click', function() {
                    addVideoInput();
                });

                videoLinksContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-video-btn')) {
                        event.target.parentElement.remove();
                    }
                });

                @if (old('video_urls'))
                    @foreach (old('video_urls') as $video_url)
                        addVideoInput('{{ $video_url }}');
                    @endforeach
                @endif
            });
        </script>
    @endpush
</x-admin-layout>
