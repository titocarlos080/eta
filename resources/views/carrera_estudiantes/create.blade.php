<form action="{{ route('carrera_estudiantes.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="fecha_inscripcion">Fecha de Inscripción</label>
        <input type="date" name="fecha_inscripcion" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="estudiante_ci">Estudiante</label>
        <select name="estudiante_ci" class="form-control" required>
            @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante->ci }}">{{ $estudiante->ci }} - {{ $estudiante->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="carrera_sigla">Carrera</label>
        <select name="carrera_sigla" class="form-control" required>
            @foreach($carreras as $carrera)
                <option value="{{ $carrera->sigla }}">{{ $carrera->sigla }} - {{ $carrera->descripcion }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
