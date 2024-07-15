@extends('adminlte::page')

@section('title', 'Editar Docente')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Editar Docente</strong></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('docentes.update', $docente->ci) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ci">CI</label>
                                <input type="text" id="ci" name="ci" class="form-control" value="{{ $docente->ci }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $docente->nombre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_pat">Apellido Paterno</label>
                                <input type="text" id="apellido_pat" name="apellido_pat" class="form-control" value="{{ $docente->apellido_pat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_mat">Apellido Materno</label>
                                <input type="text" id="apellido_mat" name="apellido_mat" class="form-control" value="{{ $docente->apellido_mat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $docente->email }}" required>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kardex">Kardex</label>
                                <input type="text" id="kardex" name="kardex" class="form-control" value="{{ $docente->kardex }}">
                            </div>
                            <div class="form-group">
                                <label for="curriculum">Currículum</label>
                                <input type="text" id="curriculum" name="curriculum" class="form-control" value="{{ $docente->curriculum }}">
                            </div>
                             
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</section>
@stop
