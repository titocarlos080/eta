@extends('adminlte::page')

@section('title', 'Detalles del Administrativo')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalles del Administrativo</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ci">CI:</label>
                            <p>{{ $administrativo->ci }}</p>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <p>{{ $administrativo->nombre }}</p>
                        </div>
                        <div class="form-group">
                            <label for="apellido_pat">Apellido Paterno:</label>
                            <p>{{ $administrativo->apellido_pat }}</p>
                        </div>
                        <div class="form-group">
                            <label for="apellido_mat">Apellido Materno:</label>
                            <p>{{ $administrativo->apellido_mat }}</p>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <p>{{ $administrativo->telefono }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <p>{{ $administrativo->email }}</p>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <p>{{ $administrativo->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <p>{{ \Carbon\Carbon::parse($administrativo->fecha_nacimiento)->format('d/m/Y') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario Asociado:</label>
                            <p>{{ $administrativo->usuario->name ?? 'No asociado' }}</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('administrativos.index') }}" class="btn btn-primary">Volver a la lista</a>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
