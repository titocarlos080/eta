@extends('adminlte::page')

@section('title', 'Horarios de Grupo Materia')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE HORARIOS DE GRUPO MATERIA</strong>
                            <a class="btn" href="{{ route('grupo_materia_horarios.index') }}">
                                <i class="fas fa-sync fa-md fa-fw"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="col-xs">
                        <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary" type="button">Nuevo</button>
                    </div>

                    <!-- Modal para crear nuevo -->
                    <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formCreateLabel">Registrar nuevo horario de grupo materia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('grupo_materia_horarios.create')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light ">
                        <tr>
                            <th>GRUPO</th>
                            <th>HORARIO</th>
                            <th>DIA</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupoHorarios as $grupoMateriaHorario)
                        <tr>
                            <td>{{ $grupoMateriaHorario->grupoMateria->sigla }} - {{ $grupoMateriaHorario->grupoMateria->descripcion }}</td>
                            <td>{{ $grupoMateriaHorario->horario->descripcion }}</td>
                            <td>{{ $grupoMateriaHorario->dia->nombre }}</td>
                            <td>
                                <a href="{{ route('grupo_materia_horarios.show', $grupoMateriaHorario->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="editGrupoMateriaHorario('{{ $grupoMateriaHorario->id }}')" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('grupo_materia_horarios.destroy', $grupoMateriaHorario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este horario de grupo materia?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div> 
    </div>
</section>

<!-- Modal para editar -->
@include('grupo_materia_horarios.edit')
@stop

@section('js')
<script>
    function editGrupoMateriaHorario(id) {
        fetch(`/grupo_materia_horarios/${id}/edit`)
            .then(response => response.json())
            .then(grupo_materia_horario => {
                // Cargar datos en el modal
                document.getElementById('editId').value = grupo_materia_horario.id;
                document.getElementById('editGrupoSigla').value = grupo_materia_horario.grupo_sigla;
                document.getElementById('editHorarioId').value = grupo_materia_horario.horario_id;
                document.getElementById('editDiaId').value = grupo_materia_horario.dia_id;

                document.getElementById('editGrupoMateriaHorarioForm').action = `/grupo_materia_horarios/${id}`;

                // Mostrar el modal
                $('#formEditModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@stop

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
