<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Gestión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editGestionForm" method="POST">
                @csrf
                @method('PUT') 
            
                <div class="modal-body">
                 <input type="text" name="" hidden id="editCodigo">
                    <div class="form-group">
                        <label for="editDescripcion">Descripción:</label>
                        <textarea id="editDescripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editFechaInicio">Fecha Inicio:</label>
                        <input type="date" id="editFechaInicio" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editFechaFin">Fecha Fin:</label>
                        <input type="date" id="editFechaFin" name="fecha_fin" class="form-control" required>
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
