@extends('adminlte::page')

@section('title', 'Grupo-Materia')

@section('content')  
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE GRUPOS</strong>
                            <a class="btn" href="{{ route('grupo_materias.index') }}">
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
                                    <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo grupo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('grupo_materias.create')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="d-flex w-50 "  role="search">
                    <input name="search" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" value="{{$search}}">
                    <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light ">
                        <tr>
                            <th>SIGLA</th>
                            <th>DESCRIPCIÓN</th>
                            <th>MATERIA</th>
                            <th>CARRERA</th>
                            <th>DOCENTE</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupoMaterias as $gm)
                        <tr>
                            <td>{{ $gm->sigla }}</td>
                            <td>{{ $gm->descripcion }}</td>
                            <td>{{ $gm->materia_sigla }}</td>
                            <td>{{ $gm->carrera_sigla }}</td>
                            <td>{{ $gm->docente->nombre }}</td>
                            <td>
                                <a href="{{ route('grupo_materias.show', $gm->sigla) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="editGrupoMateria('{{ $gm->sigla }}')" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('grupo_materias.destroy', $gm->sigla) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este grupo?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@include('grupo_materias.edit')
@stop
@section('footer')
    <div class="container">
        <footer class="footer">
            <p class="text-center">Número de visitas: {{ $visitas }}</p>
        </footer>
    </div>
@stop
<script>
    function editGrupoMateria(sigla) {

        fetch(`/grupo_materias/${sigla}/edit`)
            .then(response => response.json())
            .then(grupoMateria => {
                document.getElementById('editSigla').value = grupoMateria.sigla;
                document.getElementById('editDescripcion').value = grupoMateria.descripcion;
                document.getElementById('editMateriaSigla').value = grupoMateria.materia_sigla;
                document.getElementById('editCarreraSigla').value = grupoMateria.carrera_sigla;
                document.getElementById('editDocenteCi').value = grupoMateria.docente_ci;

                // Correct the form action
                document.getElementById('editGrupoMateriaForm').action = `/grupo_materias/${sigla}`;

                $('#formEditModal').modal('show');
            }).catch(error => console.error('Error:', error));

    }
</script>




@section('js')
<script>
    function confirmarEliminacion(sigla) {
        if (confirm('¿Estás seguro de que deseas eliminar esta grupo?')) {
            window.location.href = '{{ url("grupo_materias") }}/' + sigla;
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