@extends('adminlte::page')

@section('title', 'Administrativos')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><strong>LISTA DE ADMINISTRATIVOS</strong></h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('administrativos.create') }}" class="btn btn-primary">Nuevo</a>
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
                            <th>Sexo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($administrativos as $administrativo)
                        <tr>
                            <td>{{ $administrativo->ci }}</td>
                            <td>{{ $administrativo->nombre }}</td>
                            <td>{{ $administrativo->apellido_pat }}</td>
                            <td>{{ $administrativo->email }}</td>
                            <td>{{ $administrativo->sexo }}</td>
                            <td>
                                <!-- Botón Ver -->
                                <a href="{{ route('administrativos.show', $administrativo->ci) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Botón Editar -->
                                <a href="{{ route('administrativos.edit', $administrativo->ci) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('administrativos.destroy', $administrativo->ci) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este administrativo?')" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
@endsection
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