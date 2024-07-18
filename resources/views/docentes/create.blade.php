@extends('adminlte::page')

@section('title', 'Registrar Docente')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Registrar Nuevo Docente</strong></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('docentes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ci">CI</label>
                                <input type="text" id="ci" name="ci" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_pat">Apellido Paterno</label>
                                <input type="text" id="apellido_pat" name="apellido_pat" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido_mat">Apellido Materno</label>
                                <input type="text" id="apellido_mat" name="apellido_mat" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kardex">Kardex</label>
                                <input type="text" id="kardex" name="kardex" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="curriculum">Currículum</label>
                                <input type="text" id="curriculum" name="curriculum" class="form-control">
                            </div>
                            
                        </div>
                    </div>

                    <a class="btn" href="{{ route('docentes.index') }}"> Regresar
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
