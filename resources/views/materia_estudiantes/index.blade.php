@extends('adminlte::page')

@section('title', 'Materias de Estudiantes')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE MATERIAS DE ESTUDIANTES</strong>
                            <a class="btn" href="{{ route('materia_estudiantes.index') }}">
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
                                    <h5 class="modal-title" id="formCreateLabel">Registrar nueva inscripción</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('materia_estudiantes.create')
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
                            <th>FECHA</th>
                            <th>ESTUDIANTE</th>
                            <th>GRUPO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materiasEstudiantes as $materiaEstudiante)
                        <tr>
                            <td>{{ $materiaEstudiante->fecha }}</td>
                            <td>{{ $materiaEstudiante->estudiante->nombre }}</td>
                            <td>{{ $materiaEstudiante->grupoMateria->sigla }}-{{ $materiaEstudiante->grupoMateria->descripcion }}</td>
                            <td>
                                <a href="{{ route('materia_estudiantes.show', $materiaEstudiante->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="editMateriaEstudiante('{{ $materiaEstudiante->id}}')" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('materia_estudiantes.destroy',$materiaEstudiante->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este inscipcion?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@include('materia_estudiantes.edit')
@stop

@section('footer')
<div class="container">
    <footer class="footer">
        <p class="text-center">Número de visitas: {{ $visitas }}</p>
    </footer>
</div>
@stop

@section('js')
<script>
    function editMateriaEstudiante(id) {
        fetch(`/materia_estudiantes/${id}/edit`)
            .then(response => response.json())
            .then(materia_estudiante => {
                // Cargar datos en el modal
                document.getElementById('editId').value = materia_estudiante.id;
                document.getElementById('editFecha').value = materia_estudiante.fecha;
                document.getElementById('editEstudianteCI').value = materia_estudiante.estudiante_ci;
                document.getElementById('editGrupoSigla').value = materia_estudiante.grupos_materias_sigla;

                document.getElementById('editMateriaEstudianteForm').action = `/materia_estudiantes/${id}`;

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