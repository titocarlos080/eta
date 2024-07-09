<!-- resources/views/partials/estudiantes/form_edit.blade.php -->

<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editEstudianteForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNombre">Nombre</label>
                        <input type="text" id="editNombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editApellidos">Apellidos</label>
                        <input type="text" id="editApellidos" name="apellidos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editCarnet">Carnet</label>
                        <input type="text" id="editCarnet" name="carnet" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="editCarreraNivel">Carrera y Nivel</label>
                        <select id="editCarreraNivel" name="carrera_nivel" class="form-control" style="width: 100%;">
                            <!-- Opciones de carrera se agregarán dinámicamente -->
                        </select>
                    </div>

                    <!-- Otros campos necesarios -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
