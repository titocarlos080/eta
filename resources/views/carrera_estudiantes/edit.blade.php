<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editInscripcionForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" id="editId"  hidden ="">
                    <div class="form-group">
                        <label for="editFechaInscripcion">Fecha de Inscripción</label>
                        <input type="date" name="fecha_inscripcion" id="editFechaInscripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editEstudianteCI"> Estudiante</label>
                        <select name="estudiante_ci" id="editEstudianteCI" class="form-control" required>
                            @foreach($estudiantes as $estudiante)
                                <option value="{{ $estudiante->ci }}">{{ $estudiante->ci }} - {{ $estudiante->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editCarreraSigla"> Carrera</label>
                        <select name="carrera_sigla" id="editCarreraSigla" class="form-control" required>
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->sigla }}">{{ $carrera->sigla }} - {{ $carrera->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush