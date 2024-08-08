<x-admin-layout title="Plantel" :breadcrumb="[
    [
        'name' => 'Inicio',
        'url' => route('admin.dashboard'),
    ],
    [
        'name' => 'Plantel',
    ],
]">
 <section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">Plantel Adela de Cornejo</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ $plantel->name }}</h1>
        <div class="flex mb-4">
          <a class="flex-grow text-red-600 border-b-2 border-red-700 py-2 text-lg px-1">Descripción</a>                
        </div>
        <p class="leading-relaxed mb-4"><span>Dirección: </span>{{ $plantel->address }}</p>
        <p class="leading-relaxed mb-4"><span>Teléfono: </span>{{ $plantel->phone }}</p>
        <p class="leading-relaxed mb-4"><span>Correo electrónico: </span>{{ $plantel->email }}</p>
        <p class="leading-relaxed mb-4">{{ $plantel->description }}</p>
        <div class="info">
          @if ($plantel->menu_pdf_id)
            <p class="leading-relaxed mb-4"><span>Menú de la Cafetería: </span>
              <a href="{{ Storage::url($plantel->menuPdf->file_path) }}" target="_blank">{{ $plantel->menuPdf->name }}</a>
            </p>
          @endif
        </div>

        <div class="flex">                
          <a href="{{ route('admin.planteles.edit', $plantel->id) }}" class="flex ml-auto text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-800 rounded">Editar</a>                
        </div>
      </div>            
      <img class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{ Storage::url($plantel->image_path) }}" alt="{{ $plantel->name }}">            
    </div>
  </div>
</section>    
</x-admin-layout>
