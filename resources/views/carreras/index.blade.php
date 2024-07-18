@extends('adminlte::page')

@section('title', 'Carreras')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-xs-4 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE CARRERAS</strong>
                            <a class="btn" href="{{ route('carreras.index') }}">
                                <i class="fas fa-sync fa-md fa-fw"></i>
                            </a>
                        </h3>
                    </div>
                    
                    <div class="col-auto mt-2">
                        <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary" type="button">Nuevo</button>
                    </div>
                    
                    <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formCreateLabel">Registrar nueva carrera</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('carreras.create')
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
                    <thead class="table-light">
                        <tr>
                            <th>SIGLA</th>
                            <th>DESCRIPCIÓN</th>
                            <th>GESTIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carreras as $carrera)
                        <tr>
                            <td>{{ $carrera->sigla }}</td>
                            <td>{{ $carrera->descripcion }}</td>
                            <td>{{ $carrera->gestion->descripcion }}</td>
                            <td>
                                <a href="{{ route('carrera_materias.index') }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar materias">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('carreras.show', $carrera->sigla) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-warning btn-sm" onclick="editCarrera('{{ $carrera->sigla }}')" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('carreras.destroy',$carrera->sigla) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Carrera?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@include('carreras.edit')
@stop
@section('footer')
<div class="container">
    <footer class="footer">
        <p class="text-center">Número de visitas: {{ $visitas }}</p>
    </footer>
</div>
@stop
<script>
    function editCarrera(sigla) {
        fetch(`/carreras/${sigla}/edit`)
            .then(response => response.json())
            .then(carrera => {
                document.getElementById('editSigla').value = carrera.sigla;
                document.getElementById('editDescripcion').value = carrera.descripcion;
                const selectGestion = document.getElementById('editGestionCodigo');
                selectGestion.value = carrera.gestion_codigo;
                // Correct the form action
                document.getElementById('editCarreraForm').action = `/carreras/${sigla}`;

                $('#formEditModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }
</script>

@section('js')
<script>
    function confirmarEliminacion(carreraSigla) {
        if (confirm('¿Estás seguro de que deseas eliminar esta carrera?')) {
            // Si el usuario hace clic en "Aceptar", redirige al controlador para eliminar la carrera
            window.location.href = '{{ url("carreras") }}/' + carreraSigla;
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