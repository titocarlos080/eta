<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Materia a Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCarreraMateriaForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editCarreraSigla">Carrera</label>
                        <select class="form-control" id="editCarreraSigla" name="carrera_sigla">
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->sigla }}">{{ $carrera->sigla }} - {{ $carrera->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editMateriaSigla">Materia</label>
                        <select class="form-control" id="editMateriaSigla" name="materia_sigla">
                            @foreach($materias as $materia)
                                <option value="{{ $materia->sigla }}">{{ $materia->sigla }} - {{ $materia->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editNivel">Nivel</label>
                        <select class="form-control" id="editNivelId" name="nivel">
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>