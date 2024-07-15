@extends('adminlte::page')

@section('title', 'Horarios')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE HORARIOS</strong>
                            <a class="btn" href="{{ route('horarios.index') }}">
                                <i class="fas fa-sync fa-md fa-fw"></i>
                            </a>
                        </h3>
                    </div>

                    <div class="col-xs">
                        <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary" type="button">Nuevo</button>
                    </div>
                    <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formCreateLabel">Registrar nuevo horario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('horarios.create')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Hora de Inicio</th>
                            <th>Hora de Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                        <tr>
                            <td>{{ $horario->id }}</td>
                            <td>{{ $horario->hora_inicio }}</td>
                            <td>{{ $horario->hora_fin }}</td>
                            <td>
                                <a href="{{ route('horarios.show', $horario->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="editHorario('{{ $horario->id }}')" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('horarios.destroy', $horario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este horario?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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

<!-- Incluir el formulario de edición -->
@include('horarios.edit')
@stop

@section('js')
<script>
    function editHorario(id) {
        fetch(`/horarios/${id}/edit`)
            .then(response => response.json())
            .then(horario => {
                document.getElementById('editHoraInicio').value = horario.hora_inicio;
                document.getElementById('editHoraFin').value = horario.hora_fin;

                // Correct the form action
                document.getElementById('editHorarioForm').action = `/horarios/${id}`;

                $('#formEditModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    function confirmarEliminacion(horarioId) {
        if (confirm('¿Estás seguro de que deseas eliminar este horario?')) {
            window.location.href = '{{ url("horarios") }}/' + horarioId;
        }
    }
</script>
@stop

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
