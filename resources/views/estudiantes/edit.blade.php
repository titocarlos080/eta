@extends('adminlte::page')

@section('title', 'Editar Estudiante')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Editar Estudiante</strong></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('estudiantes.update', $estudiante->ci) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ci">CI</label>
                                <input type="text" id="ci" name="ci" class="form-control" value="{{ $estudiante->ci }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $estudiante->nombre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_pat">Apellido Paterno</label>
                                <input type="text" id="apellido_pat" name="apellido_pat" class="form-control" value="{{ $estudiante->apellido_pat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $estudiante->email }}">
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_mat">Apellido Materno</label>
                                <input type="text" id="apellido_mat" name="apellido_mat" class="form-control" value="{{ $estudiante->apellido_mat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="form-control" value="{{ $estudiante->telefono }}">
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" name="sexo" class="form-control">
                                    <option value="" {{ is_null($estudiante->sexo) ? 'selected' : '' }}>Seleccione</option>
                                    <option value="M" {{ $estudiante->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ $estudiante->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ $estudiante->fecha_nacimiento }}">
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-secondary" href="{{ route('estudiantes.index') }}">
                        Volver <i class="fas fa-sync fa-md fa-fw"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</section>
@stop
