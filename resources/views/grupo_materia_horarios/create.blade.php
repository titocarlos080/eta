<form action="{{ route('grupo_materia_horarios.store') }}" method="post">
    @csrf

    <div class="form-group">
        <label for="grupo_sigla">Grupo:</label>
        <select id="grupo_sigla" name="grupo_sigla" class="form-control" required>
            @foreach($grupos as $grupo)
            <option value="{{ $grupo->sigla }}">{{ $grupo->sigla }} - {{ $grupo->descripcion }}</option>
            @endforeach
        </select>
        @error('grupo_sigla')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="horario_id">Horario:</label>
        <select id="horario_id" name="horario_id" class="form-control" required>
            @foreach($horarios as $horario)
            <option value="{{ $horario->id }}">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</option>
            @endforeach
        </select>
        @error('horario_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="dia_id">Día:</label>
        <select id="dia_id" name="dia_id" class="form-control" required>
            @foreach($dias as $dia)
            <option value="{{ $dia->id }}">{{ $dia->nombre }}</option>
            @endforeach
        </select>
        @error('dia_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('grupo_materia_horarios.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</button>
    </div>
</form>
