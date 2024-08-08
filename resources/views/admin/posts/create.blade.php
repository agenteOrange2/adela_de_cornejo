<x-admin-layout title="Nuevo Aviso" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Avisos',
        'url' => route('admin.avisos.index'),
    ],
    [
        'name' => 'Nuevo Aviso',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.avisos.index') }}"
        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </x-slot>
    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Nuevo Aviso</h1>        
    </div>

    <form action="{{ route('admin.avisos.store') }}" method="POST" enctype="multipart/form-data" x-data="data()"
        x-init="$watch('title', value => { string_to_slug(value) })">

        @csrf

        <x-validation-errors class="my-4" />

        <div class="mb-6 relative">

            <figure>
                <img class="aspect-[16/9] object-cover object-center w-full"
                    src="{{ isset($property) ? $property->mainImage() : 'https://i.postimg.cc/GhF1rT75/predeterminado-adeladecornejo.webp' }}"
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

        <div class="flex flex-wrap -mx-2">
            <div class="mb-4 px-2 w-full md:w-1/2">
                <x-label for="title" class="mb-2">
                    Título de la aviso
                </x-label>
                <x-input value="{{ old('title') }}" x-model="title" class="w-full" name="title"
                    placeholder="Ingrese el nombre del aviso">
                </x-input>
            </div>

            <!-- Añade tu segundo campo aquí, asegúrate de cambiar el 'name', 'id', y otros atributos relevantes -->
            <div class="mb-4 px-2 w-full md:w-1/2">
                <x-label for="another-field" class="mb-2">
                    Slug
                </x-label>
                <x-input value="{{ old('slug') }}" x-model="slug" class="w-full" name="slug"
                    placeholder="Ingrese el Slug del aviso">
                </x-input>
            </div>

        </div>

        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="me-2">
                    <a href="#" id="description-tab"
                        class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg  group active border-blue-600 text-blue-600"
                        aria-current="page">
                        <i class="fa-solid fa-list mr-2" aria-hidden="true"></i> Descripción
                    </a>
                </li>
                <li class="me-2">
                    <a href="#" id="pdf-upload-tab"
                        class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <i class="fa-solid fa-file-pdf mr-2" aria-hidden="true"></i> PDF
                    </a>
                </li>
            </ul>

        </div>

        <div id="description-content" class="tab-content  my-5">
            <!-- Aquí pones el contenido de descripción que ya tienes -->
            <div class="mb-5">
                <x-label for="excerpt" class="mb-2">
                    Descripcion corta
                </x-label>
                <textarea name="excerpt" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Escriba un extracto del post">{{ old('excerpt') }}</textarea>
            </div>

            <div class="my-10 ckeditor" data-upload-url="{{ route('images.upload') }}">
                <x-label for="body" class="mb-2">
                    Descripcion
                </x-label>
                <textarea class="editor" value="{{ old('body') }}" name="body" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Escriba el Contenido"></textarea>
            </div>

            <div class="mb-4">
                <h3 class="mb-4 font-semibold text-gray-900 ">Categorías</h3>
                <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach($categories as $category)
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="category-{{ $category->id }}" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="category-{{ $category->id }}" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
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
  

        <div id="pdf-upload-content" class="tab-content my-5 hidden">
            <!-- Botón para abrir el modal de subida de archivos -->

            <label for="file-input"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300 cursor-pointer">
                Subir Archivo PDF
            </label>
            <input type="file" id="file-input" name="pdf_files[]" accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden "
                multiple onchange="handleFiles(this.files)" />

            <!-- Contenedor para mostrar los archivos seleccionados -->
            <ul id="gallery" class="flex flex-wrap mt-4">
                <!-- Los items se añadirán aquí dinámicamente -->
            </ul>

        </div>

        <div class="flex justify-end my-10">
            <label class="inline-flex items-center mb-5 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 ">Publicar</span>
            </label>
        </div>


        <template id="file-template">
            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                <article tabindex="0"
                    class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline relative bg-gray-100 cursor-pointer shadow-sm">
                    <section
                        class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                        <h1 class="flex-1 group-hover:text-blue-800"></h1>
                        <div class="flex justify-between items-center">
                            <p class="p-1 size text-xs text-gray-700"></p>
                            <button class="delete focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                                <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                </svg>
                            </button>
                        </div>
                    </section>
                </article>
            </li>
        </template>

        <div class="flex justify-end">
            <x-button id="submit-button">
                Crear aviso
            </x-button>
        </div>
    </form>

    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            /*Imagen Preview*/
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

            function data() {
                return {
                    title: '',
                    slug: '',
                    string_to_slug(str) {
                        str = str.replace(/^\s+|\s+$/g, '');
                        str = str.toLowerCase();
                        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                        var to = "aaaaeeeeiiiioooouuuunc------";
                        for (var i = 0, l = from.length; i < l; i++) {
                            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                        }
                        str = str.replace(/[^a-z0-9 -]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                        this.slug = str;
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {

                //TABS
                let descriptionTab = document.getElementById('description-tab');
                let pdfUploadTab = document.getElementById('pdf-upload-tab');
                let descriptionContent = document.getElementById('description-content');
                let pdfUploadContent = document.getElementById('pdf-upload-content');

                function setActiveTab(activeTab, inactiveTab) {
                    activeTab.classList.add('border-blue-600', 'text-blue-600', 'active');
                    activeTab.classList.remove('border-transparent', 'text-gray-600');
                    inactiveTab.classList.remove('border-blue-600', 'text-blue-600', 'active');
                    inactiveTab.classList.add('border-transparent', 'text-gray-600');
                }

                descriptionTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    descriptionContent.style.display = 'block';
                    pdfUploadContent.style.display = 'none';
                    setActiveTab(descriptionTab, pdfUploadTab);
                });

                pdfUploadTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    descriptionContent.style.display = 'none';
                    pdfUploadContent.style.display = 'block';
                    setActiveTab(pdfUploadTab, descriptionTab);
                });

                const editors = {};

                // Inicializar CKEditor
                document.querySelectorAll('.editor').forEach((editorElement, index) => {
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
                            editor
                                .updateSourceElement(); // Sincroniza el textarea con el contenido de CKEditor
                        });
                    }).catch(error => {
                        console.error(error);
                    });
                });

            });

            document.getElementById('file-input').addEventListener('change', function(e) {
                handleFiles(this.files);
            });

            // Variable para almacenar los archivos seleccionados
            let FILES = {};

            function handleFiles(files) {
                const gallery = document.getElementById('gallery');
                const template = document.getElementById('file-template').content;
                let newFilesAdded = false;

                Array.from(files).forEach(file => {
                    if (!FILES[file.name]) {
                        FILES[file.name] = file;
                        const clone = template.cloneNode(true);
                        clone.querySelector('h1').textContent = file.name;
                        clone.querySelector('.size').textContent = formatBytes(file.size);
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
                }
            }
            function formatBytes(bytes, decimals = 2) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
            }
        </script>
    @endpush
</x-admin-layout>
