@extends('adminlte::page')

@section('title', 'Inscripciones')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE INSCRIPCIONES</strong>
                            <a class="btn" href="{{ route('carrera_estudiantes.index') }}">
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
                                    <h5 class="modal-title" id="formCreateLabel">Registrar nueva inscripción</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('carrera_estudiantes.create')
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
                            <th>FECHA DE INSCRIPCIÓN</th>
                            <th> ESTUDIANTE</th>
                            <th>SIGLA DE LA CARRERA</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carreraEstudiantes as $carreraEstudiante)
                        <tr>
                            <td>{{ $carreraEstudiante->fecha_inscripcion }}</td>
                            <td>{{ $carreraEstudiante->estudiante_ci }}-{{ $carreraEstudiante->estudiante->nombre }}</td>
                            <td>{{ $carreraEstudiante->carrera_sigla }}- {{ $carreraEstudiante->carrera->descripcion }}</td>
                            <td>
                                <a href="{{ route('carrera_estudiantes.show', $carreraEstudiante->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="editInscripcion('{{ $carreraEstudiante->id }}')" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('carrera_estudiantes.destroy', $carreraEstudiante->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta inscripción?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@include('carrera_estudiantes.edit')
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
    function editInscripcion(id) {
        fetch(`/carrera_estudiantes/${id}/edit`)
            .then(response => response.json())
            .then(inscripcion => {
                document.getElementById('editId').value = inscripcion.id;
                document.getElementById('editFechaInscripcion').value = inscripcion.fecha_inscripcion;
                document.getElementById('editEstudianteCI').value = inscripcion.estudiante_ci;
                document.getElementById('editCarreraSigla').value = inscripcion.carrera_sigla;
                // Correct the form action
                document.getElementById('editInscripcionForm').action = `/carrera_estudiantes/${id}`;

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
