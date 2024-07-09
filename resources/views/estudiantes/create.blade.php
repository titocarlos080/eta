 @extends('adminlte::page')

@section('title', 'Crear Estudiante')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1>Crear Estudiante</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('estudiantes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="ci">CI:</label>
                        <input type="text" name="ci" id="ci" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="apellido_pat">Apellido Paterno:</label>
                        <input type="text" name="apellido_pat" id="apellido_pat" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="apellido_mat">Apellido Materno:</label>
                        <input type="text" name="apellido_mat" id="apellido_mat" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo" class="form-control" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="usuario_id">Usuario:</label>
                        <select name="usuario_id" id="usuario_id" class="form-control" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/theme.js') }}"></script>
@endpush
