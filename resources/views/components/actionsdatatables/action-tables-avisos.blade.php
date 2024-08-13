<div class="flex space-x-2">
    <!-- Ver -->    
    <a href="{{ route('avisos.show', $aviso->slug) }}" class="text-blue-600 hover:text-blue-800" target="_blank">
        <i class="fa-solid fa-eye"></i>
    </a>
    <!-- Editar -->
    <a href="{{ route('admin.avisos.edit', $aviso) }}" class="text-blue-600 hover:text-blue-800">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

</div>


