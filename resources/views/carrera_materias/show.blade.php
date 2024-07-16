@extends('adminlte::page')

@section('title', 'Detalle de Carrera Materia')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>DETALLE DE CARRERA MATERIA</strong>
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nivel:</strong> {{ $carreraMateria->nivel->nombre }}</p>
                        <p><strong>Materia:</strong> {{ $carreraMateria->materia->sigla }} - {{ $carreraMateria->materia->descripcion }}</p>
                        <p><strong>Carrera:</strong> {{ $carreraMateria->carrera->sigla }} -{{ $carreraMateria->carrera->descripcion }} </p>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{ route('carrera_materias.index') }}" > VOLVER
                             </a>

    </div>
</section>
@stop
