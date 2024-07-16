<form id="createMateriaEstudianteForm" method="POST" action="{{ route('materia_estudiantes.store') }}">
    @csrf
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="estudiante_ci">Estudiante</label>
        <select name="estudiante_ci" id="estudiante_ci" class="form-control" required>
            @foreach($estudiantes as $estudiante)
                <option value="{{ $estudiante->ci }}">{{ $estudiante->ci }} - {{ $estudiante->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="grupo_sigla">Grupo</label>
        <select name="grupo_sigla" id="grupo_sigla" class="form-control" required>
            @foreach($grupos as $grupo)
                <option value="{{ $grupo->sigla }}">{{ $grupo->sigla }} - {{ $grupo->descripcion }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>
