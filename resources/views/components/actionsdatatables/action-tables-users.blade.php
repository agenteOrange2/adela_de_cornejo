<div class="flex space-x-2">
    
    <!-- Editar -->
    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <!-- Eliminar -->
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" id="delete-user-form-{{ $user->id }}">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deleteUser(event, {{ $user->id }})" class="text-red-600 hover:text-red-800">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
</div>

@push('js')
<script>
    function deleteUser(event, userId) {
        event.preventDefault(); // Prevenir el envío automático del formulario

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
                const form = document.getElementById('delete-user-form-' + userId);
                if (form) {
                    form.submit(); // Envía el formulario de eliminación específico solo si el usuario confirma
                }
            }
        });
    }
</script>
@endpush
