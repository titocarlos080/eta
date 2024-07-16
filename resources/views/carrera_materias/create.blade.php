<form action="{{ route('carrera_materias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="carrera_sigla">Carrera</label>
            <select class="form-control @error('carrera_sigla') is-invalid @enderror" name="carrera_sigla" id="carrera_sigla" required>
                <option value="">Seleccione una carrera</option>
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->sigla }}" {{ old('carrera_sigla') == $carrera->sigla ? 'selected' : '' }}>{{ $carrera->sigla }} - {{ $carrera->descripcion }}</option>
                @endforeach
            </select>
            @error('carrera_sigla')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="materia_sigla">Materia</label>
            <select class="form-control @error('materia_sigla') is-invalid @enderror" name="materia_sigla" id="materia_sigla" required>
                <option value="">Seleccione una materia</option>
                @foreach($materias as $materia)
                    <option value="{{ $materia->sigla }}" {{ old('materia_sigla') == $materia->sigla ? 'selected' : '' }}>{{ $materia->sigla }} - {{ $materia->descripcion }}</option>
                @endforeach
            </select>
            @error('materia_sigla')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nivel">Nivel</label>
            <select class="form-control @error('nivel') is-invalid @enderror" name="nivel_id" id="nivel">
                <option value="">Seleccione un nivel</option>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id }}" {{ old('nivel') == $nivel->id ? 'selected' : '' }}>{{ $nivel->nombre }}</option>
                @endforeach
            </select>
            @error('nivel')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>