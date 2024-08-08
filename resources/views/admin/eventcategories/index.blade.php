<x-admin-layout>
    <div class="flex justify-between heading py-5">
        <h1 class="text-2xl font-extrabold text-school-blue flex items-center">
            <i class="fa-solid fa-list mr-2"></i>
            Lista de Categorias
        </h1>

        <a href="{{ route('admin.categories-eventos.create') }}"
            class="text-white bg-school-red hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-school-red dark:hover:bg-blue-700 dark:focus:ring-blue-700 dark:border-blue-700">
            Crear Categoría
        </a>
    </div>

    <x-validation-errors class="my-4" />


    <livewire:categorie-eventos-data-table />

    {{-- <div class="mb-4">
        <form method="GET" action="{{ route('admin.categories-eventos.index') }}"
            class="flex items-center max-w-lg mx-auto" id="searchForm">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <input type="text" name="filter[name]" id="searchInput"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese su búsqueda" value="{{ request('filter.name') }}" />
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-red-700 rounded-lg border  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>Buscar
            </button>
            <button type="button" id="resetButton"
                class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-gray-700 rounded-lg border  hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Restablecer
            </button>
        </form>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="categoryTable">
            <thead class="text-xs text-white uppercase bg-school-red dark:bg-school-red">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="odd:bg-white odd:dark:bg-gray-100 even:bg-gray-50 even:dark:bg-gray-100 border-b dark:border-red-500">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
                            {{ $category->id }}
                        </th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-700">
                            {{ $category->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.categories-eventos.edit', $category) }}"
                                class="font-medium text-school-blue dark:text-blue-500 hover:underline">Editar</a>
                            <button onclick="deleteCategory()" class="text-red-600 dark:text-red-400 hover:underline ml-2">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <form action="{{ route('admin.categories-eventos.destroy', $category) }}" method="POST" id="formDelete" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b">
                        <td colspan="5" class="px-6 py-4 text-center bg-gray-700 text-white">No hay categorías registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $categories->links() }}
    </div>
 --}}

    @push('js')
        {{-- <script>
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(this.delay);
                this.delay = setTimeout(function() {
                    fetchCategories();
                }.bind(this), 300);
            });

            document.getElementById('resetButton').addEventListener('click', function() {
                document.getElementById('searchInput').value = '';
                fetchCategories();
            });

            function fetchCategories() {
                const query = document.getElementById('searchInput').value;
                const url = new URL('{{ route('admin.categories-eventos.index') }}');
                url.searchParams.append('filter[name]', query);

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newTable = doc.getElementById('categoryTable').innerHTML;
                        document.getElementById('categoryTable').innerHTML = newTable;

                        const newPagination = doc.getElementById('paginationLinks').innerHTML;
                        document.getElementById('paginationLinks').innerHTML = newPagination;
                    })
                    .catch(error => console.error('Error fetching categories:', error));
            }

            function deleteCategory() {
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
                        const form = document.getElementById('formDelete');
                        form.submit(); // Envía el formulario de eliminación
                    }
                });
            }
        </script> --}}

        <script>
            Livewire.on('error', function(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: message,
                })
            });
        </script>
    @endpush
</x-admin-layout>
