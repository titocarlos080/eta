@extends('adminlte::page')

@section('title', 'Detalles de la Inscripción')

@section('content_header')
    <h1>Detalles de la Inscripción</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>Inscripción {{ $inscripcion->estudiante_ci }} - {{ $inscripcion->carrera_sigla }}</strong>
                    <a class="btn" href="{{ route('carrera_estudiantes.index') }}">
                        <i class="fas fa-sync fa-md fa-fw"></i>
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Fecha de Inscripción:</dt>
                    <dd class="col-sm-8">{{ $inscripcion->fecha_inscripcion }}</dd>
                    <dt class="col-sm-4">CI del Estudiante:</dt>
                    <dd class="col-sm-8">{{ $inscripcion->estudiante->ci }}  - {{ $inscripcion->estudiante->nombre }} </dd>
                    <dt class="col-sm-4">Sigla de la Carrera:</dt>
                    <dd class="col-sm-8">{{ $inscripcion->carrera_sigla }}</dd>
                </dl>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('carrera_estudiantes.index') }}" class="btn btn-secondary">Volver  </a>
            </div>
        </div>
    </div>
</section>
@stop
