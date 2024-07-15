@extends('adminlte::page')

@section('title', 'materias')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE MATERIAS</strong>
                            <a class="btn" href="{{ route('materias.index') }}">
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
                                    <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('materias.create')
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
                            <th>SIGLA</th>
                            <th>DESCRIPCION</th>
                            <th>OBSERVACION</th>
                            <th>CREDITOS</th>
                            <th>ESTADO</th>

                        </tr>
                    </thead>


                    <tbody>
                        @foreach($materias as $materia)
                        <tr>
                            <td>{{ $materia->sigla }}</td>
                            <td>{{ $materia->descripcion }}</td>
                            <td>{{ $materia->observacion }}</td>
                            <td>{{ $materia->creditos }}</td>
                            <td>{{ $materia->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <!-- Formulario de eliminación directamente en la tabla -->
                                <button type="button" class="btn btn-warning btn-sm" onclick="editMateria('{{ $materia->sigla }}')">Editar</button>
                                <form action="{{ route('materias.destroy', $materia->sigla) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este Materia?')">Eliminar</button>
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
@include('materias.edit')
@stop

@section('footer')
    <div class="container">
        <footer class="footer">
            <p class="text-center">Número de visitas: {{ $visitas }}</p>
        </footer>
    </div>
@stop
<script>

  
    function editMateria(sigla) {
        fetch(`/materias/${sigla}/edit`)
            .then(response => response.json())
            .then(materia => {
                  
                document.getElementById('editSigla').value = materia.sigla;
                document.getElementById('editDescripcion').value = materia.descripcion;
                document.getElementById('editObservacion').value = materia.observacion;
                document.getElementById('editCreditos').value = materia.creditos;
                document.getElementById('editEstadoActivo').checked = materia.estado;
                document.getElementById('editEstadoInactivo').checked = !materia.estado;

                // Correct the form action
                document.getElementById('editMateriaForm').action = `/materias/${sigla}`;

                $('#formEditModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@section('js')
<script>
    function confirmarEliminacion(materiaSigla) {
        if (confirm('¿Estás seguro de que deseas eliminar este materia?')) {
            // Si el usuario hace clic en "Aceptar", redirige al controlador para eliminar el nivel
            window.location.href = '{{ url("materias") }}/' + materiaSigla;
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