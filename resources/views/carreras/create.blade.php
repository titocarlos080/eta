 <!-- Crear una nueva carrera -->
<form action="{{ route('carreras.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="sigla">SIGLA</label>
                <input type="text" name="sigla" class="form-control" value="{{ old('sigla') }}" required>

                @error('sigla')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="descripcion">DESCRIPCIÓN</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" required>

                @error('descripcion')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gestion_codigo">GESTIÓN</label>
                <select name="gestion_codigo" class="form-control" required>
                    <option value="">Selecciona una gestión</option>
                    @foreach($gestiones as $gestion)
                        <option value="{{ $gestion->codigo }}" {{ old('gestion_codigo') == $gestion->codigo ? 'selected' : '' }}>
                            {{ $gestion->descripcion }}
                        </option>
                    @endforeach
                </select>

                @error('gestion_codigo')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
