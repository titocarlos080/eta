<form action="{{ route('gestiones.store') }}" method="post">
    @csrf

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
        @error('descripcion')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha_inicio">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha_fin">Fecha Fin:</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
                @error('fecha_fin')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('gestiones.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</button>
    </div>
</form>