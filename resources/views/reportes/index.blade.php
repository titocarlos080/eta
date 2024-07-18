@extends('adminlte::page')

@section('title', 'Generar Reportes')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Generar Reportes</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Reporte de Estudiantes por Carrera</h5>
                        <form action="{{ route('reporte.estudiantes_por_carrera') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="carrera">Selecciona una Carrera:</label>
                                <select name="carrera" id="carrera" class="form-control">
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->sigla }}">{{ $carrera->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar PDF</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5>Reporte de Materias por Estudiante</h5>
                        <form action="{{ route('reporte.materias_por_estudiante') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="estudiante">Selecciona un Estudiante:</label>
                                <select name="estudiante" id="estudiante" class="form-control">
                                    @foreach ($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->ci }}">{{ $estudiante->nombre }} {{ $estudiante->apellido_pat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar PDF</button>
                        </form>
                    </div>
                </div>
            </div>  <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Ingresos por Carrera</h5>
                        <form action="{{ route('reporte.ingresos_por_carrera') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="carrera">Selecciona una Carrera:</label>
                                <select name="carrera" id="carrera" class="form-control">
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->sigla }}">{{ $carrera->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar PDF</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5>Ingresos por Materia</h5>
                        <form action="{{ route('reporte.ingresos_por_materia') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="estudiante">Selecciona un Estudiante:</label>
                                <select name="estudiante" id="estudiante" class="form-control">
                                    @foreach ($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->ci }}">{{ $estudiante->nombre }} {{ $estudiante->apellido_pat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
