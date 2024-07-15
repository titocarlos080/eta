 <!-- Editar una carrera existente -->
<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCarreraForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editSigla">SIGLA</label>
                        <input type="text" id="editSigla" name="sigla" class="form-control" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="editDescripcion">DESCRIPCIÓN</label>
                        <input type="text" id="editDescripcion" name="descripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editGestionCodigo">GESTIÓN</label>
                        <select id="editGestionCodigo" name="gestion_codigo" class="form-control" required>
                            @foreach($gestiones as $gestion)
                                <option value="{{ $gestion->codigo }}">{{ $gestion->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
