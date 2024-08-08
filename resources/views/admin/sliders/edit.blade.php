<x-admin-layout title="Edición Slider" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Sliders',
        'url' => route('admin.sliders.index'),
    ],
    [
        'name' => 'Edición de Slider',
    ],
]">

    @push('css')
        <style>
            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
            }

            .tab-btn.active {
                background-color: #f91d25;
                color: white;
                border-bottom: 2px solid #f91d25;
            }

            .tab-btn {
                border-bottom: 2px solid transparent;
            }

            .transition {
                transition: all 0.3s ease-in-out;
            }

            .tab-content.active {
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .tab-btn:hover {
                background-color: #0a78bf;
                color: white;
            }

            .file-label:hover {
                background-color: #fbcc07;
                color: black;
            }

            .form-input {
                background-color: #f3f4f6;
                border: 2px solid #e5e7eb;
                transition: border-color 0.3s;
            }

            .form-input:focus {
                border-color: #0a78bf;
            }

            .form-label {
                color: #4b5563;
            }

            .icon-wrapper {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 10px;
            }
        </style>
    @endpush

    <x-slot name="action">
        <a href="{{ route('admin.sliders.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Volver</a>
    </x-slot>
    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-gray-800">Edición Slider "{{ $slider->title }}"</h1>
    </div>
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-validation-errors class="my-4" />

        <div class="flex flex-col md:flex-row">
            <!-- Tabs and Images Section -->
            <div class="w-full md:w-1/2 mb-6 md:mb-0">
                <!-- Tabs for Images -->
                <div class="mb-6">
                    <ul class="flex border-b">
                        <li class="mr-1">
                            <a class="tab-btn bg-white inline-block py-2 px-4 text-blue-500 hover:text-white font-semibold transition active"
                                href="javascript:void(0)" onclick="openTab(event, 'desktop')">Escritorio</a>
                        </li>
                        <li class="mr-1">
                            <a class="tab-btn bg-white inline-block py-2 px-4 text-blue-500 hover:text-white font-semibold transition"
                                href="javascript:void(0)" onclick="openTab(event, 'tablet')">Tableta</a>
                        </li>
                        <li class="mr-1">
                            <a class="tab-btn bg-white inline-block py-2 px-4 text-blue-500 hover:text-white font-semibold transition"
                                href="javascript:void(0)" onclick="openTab(event, 'mobile')">Celular</a>
                        </li>
                    </ul>
                </div>

                <!-- Desktop Image -->
                <div id="desktop" class="tab-content active transition">
                    <div class="relative">
                        <figure>
                            <img class="object-cover object-center w-full h-[400px] md:aspect-[16/9]"
                                src="{{ $slider->getDesktopImage() ? asset('storage/' . $slider->getDesktopImage()->path) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg' }}"
                                alt="Imagen destacada" id="imgPreviewDesktop">
                        </figure>
                        <div class="mt-4 absolute top-8 right-8">
                            <label
                                class="file-label bg-white px-4 py-2 rounded-lg cursor-pointer transition flex items-center">
                                <i class="fa-solid fa-camera mr-2"></i>
                                <span>Actualizar imagen</span>
                                <input type="file" accept="image/*" name="image" class="hidden"
                                    onchange="previewImage(event, '#imgPreviewDesktop')">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Tablet Image -->
                <div id="tablet" class="tab-content transition">
                    <div class="relative">
                        <figure>
                            <img class="object-cover object-center w-full h-[400px] md:aspect-[16/9]"
                                src="{{ $slider->getTabletImage() ? asset('storage/' . $slider->getTabletImage()->path) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg' }}"
                                alt="Imagen para Tableta" id="imgPreviewTablet">
                        </figure>
                        <div class="mt-4 absolute top-8 right-8">
                            <label
                                class="file-label bg-white px-4 py-2 rounded-lg cursor-pointer transition flex items-center">
                                <i class="fa-solid fa-camera mr-2"></i>
                                <span>Actualizar imagen</span>
                                <input type="file" accept="image/*" name="image_tablet" class="hidden"
                                    onchange="previewImage(event, '#imgPreviewTablet')">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Mobile Image -->
                <div id="mobile" class="tab-content transition">
                    <div class="relative">
                        <figure>
                            <img class="object-cover object-center w-full h-[400px] md:aspect-[16/9]"
                                src="{{ $slider->getMobileImage() ? asset('storage/' . $slider->getMobileImage()->path) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg' }}"
                                alt="Imagen para Celular" id="imgPreviewMobile">
                        </figure>
                        <div class="mt-4 absolute top-8 right-8">
                            <label
                                class="file-label bg-white px-4 py-2 rounded-lg cursor-pointer transition flex items-center">
                                <i class="fa-solid fa-camera mr-2"></i>
                                <span>Actualizar imagen</span>
                                <input type="file" accept="image/*" name="image_mobile" class="hidden"
                                    onchange="previewImage(event, '#imgPreviewMobile')">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Fields Section -->
            <div class="w-full flex items-center md:w-1/2 md:pl-6">
                <div class="flex flex-wrap -mx-2">
                    <div class="mb-4 px-2 w-full">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-heading text-gray-500"></i>
                            <label for="title" class="form-label">Título del Slider</label>
                        </div>
                        <input value="{{ old('title', $slider->title) }}" class="form-input w-full" name="title"
                            placeholder="Ingrese el nombre del slider"></input>
                    </div>

                    <div class="mb-5 px-2 w-full">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-paragraph text-gray-500"></i>
                            <label for="paragraph" class="form-label">Descripcion corta</label>
                        </div>
                        <textarea name="paragraph" rows="4"
                            class="form-input block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Escriba un extracto del slider">{{ old('paragraph', $slider->paragraph) }}</textarea>
                    </div>

                    <div class="mb-4 px-2 w-full">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-link text-gray-500"></i>
                            <label for="link" class="form-label">Link</label>
                        </div>
                        <input name="link" value="{{ old('link', $slider->link) }}"
                            class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Ingrese el link"></input>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5 w-full">
            <div class="flex justify-end my-10">
                <input type="hidden" value="0" name="is_published">
                <label class="inline-flex items-center mb-5 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $slider->is_published) == 1)
                        class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 ">Publicar</span>
                </label>
            </div>
            <div class="flex justify-end">
                <button class="bg-red-600 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Actualizar Slider
                </button>
            </div>
        </div>
    </form>


    @push('js')
        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tabbtns;
                tabcontent = document.getElementsByClassName("tab-content");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].classList.remove("active");
                }
                tabbtns = document.getElementsByClassName("tab-btn");
                for (i = 0; i < tabbtns.length; i++) {
                    tabbtns[i].classList.remove("active");
                }
                document.getElementById(tabName).classList.add("active");
                evt.currentTarget.classList.add("active");
            }

            function previewImage(event, selector) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.querySelector(selector);
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    @endpush
</x-admin-layout>
