<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editGrupoMateriaForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <input type="text" name="" hidden id="editSigla">
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <textarea id="editDescripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editMateriaSigla">Materia</label>
                        <select id="editMateriaSigla" name="carrera_materia_id" class="form-control" required>
                            @foreach($carreraMaterias as $carreraMateria)
                            <option value="{{ $carreraMateria->id }}">{{ $carreraMateria->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDocenteCi">Docente</label>
                        <select id="editDocenteCi" name="docente_ci" class="form-control" required>
                            @foreach($docentes as $docente)
                            <option value="{{ $docente->ci }}">{{ $docente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>