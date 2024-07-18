@extends('adminlte::page')

@section('title', 'Detalles del Estudiante')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Detalles del Estudiante</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CI:</label>
                            <p>{{ $estudiante->ci }}</p>
                        </div>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <p>{{ $estudiante->nombre }}</p>
                        </div>
                        <div class="form-group">
                            <label>Apellido Paterno:</label>
                            <p>{{ $estudiante->apellido_pat }}</p>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <p>{{ $estudiante->email }}</p>
                        </div>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido Materno:</label>
                            <p>{{ $estudiante->apellido_mat }}</p>
                        </div>
                        <div class="form-group">
                            <label>Teléfono:</label>
                            <p>{{ $estudiante->telefono }}</p>
                        </div>
                        <div class="form-group">
                            <label>Sexo:</label>
                            <p>{{ $estudiante->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
                        </div>
                        <div class="form-group">
                            <label>Fecha de Nacimiento:</label>
                            <p>{{ $estudiante->fecha_nacimiento }}</p>
                        </div>
                        <div class="form-group">
                            <label>Usuario:</label>
                            <p>{{ $estudiante->usuario ? $estudiante->usuario->name : 'No asignado' }}</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
</section>
@stop
@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush