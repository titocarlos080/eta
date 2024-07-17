<div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditLabel">Editar Grupo, Horario y Día</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editGrupoMateriaHorarioForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    
                    <div class="form-group">
                        <label for="editGrupoSigla">Grupo:</label>
                        <select id="editGrupoSigla" name="grupo_sigla" class="form-control" required>
                            @foreach($grupos as $grupo)
                            <option value="{{ $grupo->sigla }}">{{ $grupo->sigla }} - {{ $grupo->descripcion }}</option>
                            @endforeach
                        </select>
                        @error('grupo_sigla')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="editHorarioId">Horario:</label>
                        <select id="editHorarioId" name="horario_id" class="form-control" required>
                            @foreach($horarios as $horario)
                            <option value="{{ $horario->id }}">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</option>
                            @endforeach
                        </select>
                        @error('horario_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="editDiaId">Día:</label>
                        <select id="editDiaId" name="dia_id" class="form-control" required>
                            @foreach($dias as $dia)
                            <option value="{{ $dia->id }}">{{ $dia->nombre }}</option>
                            @endforeach
                        </select>
                        @error('dia_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
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
