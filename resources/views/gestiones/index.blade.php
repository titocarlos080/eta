@extends('adminlte::page')

@section('title', 'Gestiones')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE GESTIONES</strong>
                            <a class="btn" href="{{ route('gestiones.index') }}">
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
                                    <h5 class="modal-title" id="fomrCreateLabel">Registrar nueva gestión</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('gestiones.create')
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
                            <th>DESCRIPCIÓN</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gestiones as $gestion)
                        <tr>
                            <td>{{ $gestion->descripcion }}</td>
                            <td>{{ $gestion->fecha_inicio }}</td>
                            <td>{{ $gestion->fecha_fin }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" onclick="editGestion('{{ $gestion->codigo }}')">Editar</button>
                                <form action="{{ route('gestiones.destroy', $gestion->codigo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta gestión?')">Eliminar</button>
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
@include('gestiones.edit')
@stop

<script>
    function editGestion(codigo) {

        fetch(`/gestiones/${codigo}/edit`)
            .then(response => response.json())
            .then(gestion => {
                 document.getElementById('editCodigo').value = gestion.codigo;
                document.getElementById('editDescripcion').value = gestion.descripcion;
                document.getElementById('editFechaInicio').value = gestion.fecha_inicio;
                document.getElementById('editFechaFin').value = gestion.fecha_fin;

                // Correct the form action
                document.getElementById('editGestionForm').action = `/gestiones/${codigo}`;

                $('#formEditModal').modal('show');
            }).catch(error => console.error('Error:', error));

    }
</script>




@section('js')
<script>
    function confirmarEliminacion(gestionCodigo) {
        if (confirm('¿Estás seguro de que deseas eliminar esta gestión?')) {
            window.location.href = '{{ url("gestiones") }}/' + gestionCodigo;
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