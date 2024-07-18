@extends('adminlte::page')

@section('title', 'Docentes')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><strong>LISTA DE DOCENTES</strong></h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('docentes.create') }}" class="btn btn-primary">Nuevo</a>
                    </div>
                    <form class="d-flex w-50 float-right"  role="search">
                        <input name="search" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" value="{{$search}}">
                        <button class="btn btn-success" type="submit">Buscar</button>
                      </form>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light">
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Email</th>
                            <th>Kardex</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($docentes as $docente)
                        <tr>
                            <td>{{ $docente->ci }}</td>
                            <td>{{ $docente->nombre }}</td>
                            <td>{{ $docente->apellido_pat }}</td>
                            <td>{{ $docente->email }}</td>
                            <td>{{ $docente->kardex }}</td>
                            <td>
                                <!-- Botón Ver -->
                                <a href="{{ route('docentes.show', $docente->ci) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Botón Editar -->
                                <a href="{{ route('docentes.edit', $docente->ci) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('docentes.destroy', $docente->ci) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este docente?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@stop
@section('footer')
    <div class="container">
        <footer class="footer">
            <p class="text-center">Número de visitas: {{ $visitas }}</p>
        </footer>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush