<div class="flex space-x-2">
    <!-- Ver -->    
    <a href="{{ route('eventos.show', $evento->slug) }}" class="text-blue-600 hover:text-blue-800" target="_blank">
        <i class="fa-solid fa-eye"></i>
    </a> 
    <!-- Editar -->
    <a href="{{ route('admin.eventos.edit', $evento) }}" class="text-blue-600 hover:text-blue-800">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

</div>