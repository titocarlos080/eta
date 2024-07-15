<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">  
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre:</label>
                        <input type="text" name="name" id="editNombre" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email:</label>
                        <input type="email" name="email" id="editEmail" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Contraseña:</label>
                        <input type="password" name="password" id="editPassword" class="form-control">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editRol_id" class="form-label">Rol:</label>
                        <select name="rol_id" id="editRol_id" class="form-select" required>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('rol_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function editUser(id) {
        fetch(`/usuarios/${id}/edit`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('editNombre').value = user.name;
                document.getElementById('editEmail').value = user.email;
                //No es una buena práctica enviar y mostrar la contraseña de los usuarios.
                // document.getElementById('editPassword').value = user.password; 
                document.getElementById('editRol_id').value = user.rol_id;

                // Correct the form action
                document.getElementById('editUserForm').action = `/usuarios/${id}`;

                $('#formEditModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }
</script>

