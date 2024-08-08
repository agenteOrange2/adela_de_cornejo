<x-admin-layout title="Edición de Plantel {{ $plantel->name }}" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Edicion de plantel',
    ],
]">

    <form method="POST" action="{{ route('admin.planteles.update', $plantel->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">Plantel Adela de Cornejo</h2>

                        <div class="my-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Plantel</label>
                            <input type="text" name="name" value="{{ $plantel->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingresar un plantel" required />
                        </div>
                        <div class="my-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Dirección</label>
                            <input type="text" name="address" value="{{ $plantel->address }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingresar una dirección " required />
                        </div>
                        <div class="my-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Teléfono</label>
                            <input type="text" name="phone" value="{{ $plantel->phone }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingresar un teléfono ejemplo: 55555555" required />
                        </div>
                        <div class="my-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Correo Electrónico</label>
                            <input type="text" name="email" value="{{ $plantel->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingresar un correo ejemplo: adela@adeladecornejo.com" required />
                        </div>
                        <div class="my-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Mensaje</label>
                            <textarea name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Escribe una breve descripción...">{{ $plantel->description }}</textarea>
                        </div>

                          {{-- Sección para los videos --}}
                          <div class="mb-4">
                            <label for="videos" class="block mb-2 text-sm font-medium text-gray-900">Videos</label>
                            <div id="video-links-container">
                                {{-- Los enlaces de video existentes deben ser agregados aquí --}}
                                @foreach ($plantel->videos as $video)
                                    <div class="video-input-group mb-2">
                                        <input type="url" name="video_urls[]" value="{{ $video->url }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Ingrese URL del video">
                                        <button type="button" class="remove-video-btn text-red-500">Eliminar</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-video-btn"
                                class="mt-2 text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Agregar
                                Enlace</button>
                        </div>


                        <div class="my-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Menú de la Cafetería</label>
                            <select name="pdf_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Seleccionar PDF del menú</option>
                                @foreach ($pdfs as $pdf)
                                    <option value="{{ $pdf->id }}" @if($plantel->menu_pdf_id == $pdf->id) selected @endif>{{ $pdf->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex">
                            <button type="submit" class="flex ml-auto text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded">Actualizar</button>
                        </div>
                    </div>

                    <div class="mb-6 relative lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded">
                        <figure>
                            <img class="w-full lg:h-auto object-cover object-center rounded" src="{{ Storage::url($plantel->image_path) }}" alt="{{ $plantel->name }}" id="imgPreview">                            
                        </figure>
                        <div class="absolute top-8 right-8">
                            <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                                <i class="fa-solid fa-camera mr-2"></i>
                                Actualizar imagen
                                <input type="file" accept="image/*" name="image" class="hidden" onchange="previewImage(event, '#imgPreview')">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    @push('js')
        <script>
            /* Imagen Preview */
            function previewImage(event, querySelector) {
                const input = event.target;
                const $imgPreview = document.querySelector(querySelector);
                if (!input.files.length) return;
                const file = input.files[0];
                const objectURL = URL.createObjectURL(file);
                $imgPreview.src = objectURL;
            }

            /* Videos */
            const videoLinksContainer = document.getElementById('video-links-container');
            const addVideoBtn = document.getElementById('add-video-btn');

            addVideoBtn.addEventListener('click', function() {
                const inputHTML = `
                <div class="video-input-group mb-2">
                    <input type="url" name="video_urls[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Ingrese URL del video">
                    <button type="button" class="remove-video-btn text-red-500">Eliminar</button>
                </div>`;
                videoLinksContainer.insertAdjacentHTML('beforeend', inputHTML);
            });

            videoLinksContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-video-btn')) {
                    event.target.parentElement.remove();
                }
            });
        </script>
    @endpush
</x-admin-layout>
