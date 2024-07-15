<form action="{{ isset($administrativo) ? route('administrativos.update', $administrativo->ci) : route('administrativos.store') }}" method="post">
    @csrf
    @if(isset($administrativo))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="ci">C.I.:</label>
                <input type="text" name="ci" class="form-control" value="{{ old('ci', $administrativo->ci ?? '') }}" {{ isset($administrativo) ? 'readonly' : 'required' }}>
                @error('ci')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $administrativo->nombre ?? '') }}" required>
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="apellido_pat">Apellido Paterno:</label>
                <input type="text" name="apellido_pat" class="form-control" value="{{ old('apellido_pat', $administrativo->apellido_pat ?? '') }}" required>
                @error('apellido_pat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="apellido_mat">Apellido Materno:</label>
                <input type="text" name="apellido_mat" class="form-control" value="{{ old('apellido_mat', $administrativo->apellido_mat ?? '') }}">
                @error('apellido_mat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $administrativo->telefono ?? '') }}">
                @error('telefono')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $administrativo->email ?? '') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="sexo">Sexo:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="M" {{ old('sexo', $administrativo->sexo ?? 'M') == 'M' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoMasculino">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="sexoFemenino" value="F" {{ old('sexo', $administrativo->sexo ?? 'M') == 'F' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoFemenino">Femenino</label>
                </div>
                @error('sexo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $administrativo->fecha_nacimiento ?? '') }}">
                @error('fecha_nacimiento')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="usuario_id">ID de Usuario:</label>
        <input type="text" name="usuario_id" class="form-control" value="{{ old('usuario_id', $administrativo->usuario_id ?? '') }}">
        @error('usuario_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('administrativos.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</button>
    </div>
</form>
