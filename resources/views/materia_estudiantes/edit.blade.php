<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            </div>
            <div class="modal-body">
                <form id="editMateriaEstudianteForm" method="POST" >
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId"  >
                    
                    <div class="form-group">
                        <label for="editFecha">Fecha</label>
                        <input type="date" name="fecha" id="editFecha" class="form-control"   required>
                    </div>
                    
                    <div class="form-group">
                        <label for="editEstudianteCI">Estudiante</label>
                        <select name="estudiante_ci" id="editEstudianteCI" class="form-control" required>
                            @foreach($estudiantes as $estudiante)
                                <option value="{{ $estudiante->ci }}" >
                                    {{ $estudiante->ci }} - {{ $estudiante->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="editGrupoSigla">Grupo</label>
                        <select name="grupo_sigla" id="editGrupoSigla" class="form-control" required>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->sigla }}"  >
                                    {{ $grupo->sigla }} - {{ $grupo->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
