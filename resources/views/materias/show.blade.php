@extends('adminlte::page')

@section('title', 'Detalles de la Carrera')

@section('content_header')
    <h1>Detalles de la Carrera</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>{{ $carrera->sigla }} - {{ $carrera->descripcion }}</strong>
                    <div class="card-tools"> 
                        <a href="{{ route('carrera_materias.index', $carrera->sigla) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> Agregar Materias
                        </a>
                        <a href="{{ route('carreras.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                    </div>
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Sigla:</dt>
                    <dd class="col-sm-8">{{ $carrera->sigla }}</dd>
                    <dt class="col-sm-4">Descripción:</dt>
                    <dd class="col-sm-8">{{ $carrera->descripcion }}</dd>
                    <dt class="col-sm-4">Gestión:</dt>
                    <dd class="col-sm-8">{{ $carrera->gestion->descripcion ?? 'N/A' }}</dd> 
                </dl>
            </div>
            
        </div>
    </div>
</section>

@stop
