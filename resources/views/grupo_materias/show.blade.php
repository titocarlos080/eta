@extends('adminlte::page')

@section('title', 'Detalles del Grupo Materia')

@section('content_header')
    <h1>Detalles del Grupo Materia</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>{{ $grupoMateria->sigla }} - {{ $grupoMateria->descripcion }}</strong>
                    <a class="btn" href="{{ route('grupo_materias.index') }}">
                        <i class="fas fa-sync fa-md fa-fw"></i>
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Sigla:</dt>
                    <dd class="col-sm-8">{{ $grupoMateria->sigla }}</dd>
                    
                    <dt class="col-sm-4">Descripción:</dt>
                    <dd class="col-sm-8">{{ $grupoMateria->descripcion }}</dd>
                    
                    <dt class="col-sm-4">Materia:</dt>
                    <dd class="col-sm-8">{{ $grupoMateria->materia->sigla }} - {{ $grupoMateria->materia->descripcion }}</dd>
                    
                    <dt class="col-sm-4">Carrera:</dt>
                    <dd class="col-sm-8">{{ $grupoMateria->carrera->sigla }} - {{ $grupoMateria->carrera->descripcion }}</dd>
                    
                    <dt class="col-sm-4">Docente:</dt>
                    <dd class="col-sm-8">{{ $grupoMateria->docente->ci }} - {{ $grupoMateria->docente->nombre }}</dd>
                </dl>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('grupo_materias.index') }}" class="btn btn-secondary">Volver a la Lista</a>
            </div>
        </div>
    </div>
</section>
@stop
