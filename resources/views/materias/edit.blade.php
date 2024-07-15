<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMateriaForm" method="POST">
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editSigla">Sigla:</label>
                        <input type="text" id="editSigla" name="sigla" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editCreditos">Créditos:</label>
                        <input type="number" id="editCreditos" name="creditos" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <textarea id="editDescripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editObservacion">Observación:</label>
                        <textarea id="editObservacion" name="observacion" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editEstado">Estado:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="editEstadoActivo" value="1">
                            <label class="form-check-label" for="editEstadoActivo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="editEstadoInactivo" value="0">
                            <label class="form-check-label" for="editEstadoInactivo">Inactivo</label>
                        </div>
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
