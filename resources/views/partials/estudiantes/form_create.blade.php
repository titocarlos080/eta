<form action="{{ route('estudiantes.store') }}" method="post" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="nombre">NOMBRE</label>
                <input type="text" name="nombre" class="form-control my-colorpicker1" value="{{ old('nombre') }}"
                    required>

                @error('nombre')
                <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="apellidos">APELLIDOS</label>
                <input type="text" name="apellidos" class="form-control my-colorpicker1" value="{{ old('apellidos') }}"
                    required>

                @error('apellidos')
                <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="carnet">CARNET DE IDENTIDAD</label>
                <input name="carnet" class="form-control my-colorpicker1" type="number" value="{{ old('carnet') }}"
                    step="1" min="0" value="0" required>

                @error('carnet')
                <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="carrera">SELECCIONAR CARRERA Y NIVEL</label>
                <select name="carrera_nivel" class="form-control select2" style="width: 100%;">
                    @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}_{{ optional($carrera->niveles->first())->id }}">
                        {{ $carrera->nombre }} - {{ optional($carrera->niveles->first())->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('estudiantes.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</a>
    </div>

</form>

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
