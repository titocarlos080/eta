@extends('adminlte::page')

@section('title', 'Registrar Oferta')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Registrar Nueva Oferta</strong></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ofertas.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gestion_codigo">Gestión</label>
                                <select id="gestion_codigo" name="gestion_codigo" class="form-control" required>
                                    @foreach($gestiones as $gestion)
                                        <option value="{{ $gestion->codigo }}">{{ $gestion->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="carrera_sigla">Carrera</label>
                                <select id="carrera_sigla" name="carrera_sigla" class="form-control" required>
                                    @foreach($carreras as $carrera)
                                        <option value="{{ $carrera->sigla }}">{{ $carrera->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="materia_sigla">Materia</label>
                                <select id="materia_sigla" name="materia_sigla" class="form-control" required>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia->sigla }}">{{ $materia->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="grupo_sigla">Grupo</label>
                                <select id="grupo_sigla" name="grupo_sigla" class="form-control" required>
                                    @foreach($grupos as $grupo)
                                        <option value="{{ $grupo->sigla }}">{{ $grupo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="docente_ci">Docente</label>
                                <select id="docente_ci" name="docente_ci" class="form-control" required>
                                    @foreach($docentes as $docente)
                                        <option value="{{ $docente->ci }}">{{ $docente->nombre }} {{ $docente->apellido_pat }} {{ $docente->apellido_mat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <a class="btn" href="{{ route('ofertas.index') }}"> Regresar
                        <i class="fas fa-sync fa-md fa-fw"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
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
