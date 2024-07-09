<!-- resources/views/partials/carreras/form_edit.blade.php -->

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
                        <label for="editNombre">Nombre</label>
                        <input type="text" id="editNombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editDuracion">Duración</label>
                        <input type="text" id="editDuracion" name="duracion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editNiveles">Nivel</label>
                        <select id="editNiveles" name="niveles[]" class="form-control select2" style="width: 100%;">
                            <!-- Las opciones se llenarán dinámicamente mediante JavaScript -->
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
