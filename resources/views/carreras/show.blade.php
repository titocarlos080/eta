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
                    <a class="btn" href="{{ route('carreras.index') }}">
                        <i class="fas fa-sync fa-md fa-fw"></i>
                    </a>
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
            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Volver a la Lista</a>
            </div>
        </div>
    </div>
</section>

@stop
