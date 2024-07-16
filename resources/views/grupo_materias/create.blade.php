<form action="{{ route('grupo_materias.store') }}" method="post">
    @csrf

    <div class="form-group">
        <label for="sigla">Sigla:</label>
        <input name="sigla" class="form-control" type="text" rows="3" required>{{ old('sigla') }}</input>
        @error('sigla')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
        @error('descripcion')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="MateriaSigla">Materia</label>
        <select id="grupo_materia_id" name="grupo_materia_id" class="form-control" required>
            @foreach($carreraMaterias as $carreraMateria)
            <option value="{{ $carreraMateria->id }}">{{ $carreraMateria->materia_sigla }}- {{ $carreraMateria->materia->descripcion }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="docente_ci">Docente</label>
        <select id="docente_ci" name="docente_ci" class="form-control" required>
            @foreach($docentes as $docente)
            <option value="{{ $docente->ci }}">{{ $docente->nombre }}</option>
            @endforeach
        </select>
    </div>


    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('grupo_materias.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</button>
    </div>
</form>