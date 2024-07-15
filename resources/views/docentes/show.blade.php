@extends('adminlte::page')

@section('title', 'Detalles del Docente')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Detalles del Docente</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CI:</label>
                            <p>{{ $docente->ci }}</p>
                        </div>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <p>{{ $docente->nombre }}</p>
                        </div>
                        <div class="form-group">
                            <label>Apellido Paterno:</label>
                            <p>{{ $docente->apellido_pat }}</p>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <p>{{ $docente->email }}</p>
                        </div>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido Materno:</label>
                            <p>{{ $docente->apellido_mat }}</p>
                        </div>
                        <div class="form-group">
                            <label>Kardex:</label>
                            <p>{{ $docente->kardex }}</p>
                        </div>
                        <div class="form-group">
                            <label>Currículum:</label>
                            <p>{{ $docente->curriculum }}</p>
                        </div>
                        <div class="form-group">
                            <label>Usuario:</label>
                            <p>{{ $docente->usuario ? $docente->usuario->name : 'No asignado' }}</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('docentes.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
</section>
@stop
