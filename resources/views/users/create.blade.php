<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" required>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="rol_id" class="form-label">Rol:</label>
        <select name="rol_id" id="rol_id" class="form-select form-control" required>
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

    <hr>
    <div class="d-flex justify-content-end">
        <a href="{{ route('usuarios.index') }}" class="btn btn-danger mr-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
