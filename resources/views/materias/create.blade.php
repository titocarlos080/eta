<form action="{{ route('materias.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="sigla">Sigla:</label>
                <input type="text" name="sigla" class="form-control" value="{{ old('sigla') }}" required>
                @error('sigla')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="creditos">Créditos:</label>
                <input type="number" name="creditos" class="form-control" value="{{ old('creditos') }}" required>
                @error('creditos')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
        @error('descripcion')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="observacion">Observación:</label>
        <textarea name="observacion" class="form-control" rows="3">{{ old('observacion') }}</textarea>
        @error('observacion')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="estado">Estado:</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="estado" id="estadoActivo" value="1" {{ old('estado', 1) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="estadoActivo">Activo</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="estado" id="estadoInactivo" value="0" {{ old('estado') === "0" ? 'checked' : '' }}>
            <label class="form-check-label" for="estadoInactivo">Inactivo</label>
        </div>
        @error('estado')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    

    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('materias.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</button>
    </div>
</form>
