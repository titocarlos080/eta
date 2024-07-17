@extends('adminlte::page')
@section('title', 'Registrar Egreso')

<head>
    <style>
        /* Estilo para el contenedor del selector de meses */
        .mes-selector {
            position: relative;
            display: inline-block;
        }

        /* Estilo para la lista de meses */
        .mes-lista {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            top: -150px;
            /* Ajusta la posición vertical según sea necesario */
            left: 0;
            /* Coloca la lista a un lado del campo de entrada */
            /* Cambios para mostrar en cuatro columnas y tres meses por columna */
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            max-width: 350px;
            /* Ancho máximo para mantener la apariencia cuadrada */
            gap: 5px;
            /* Espaciado entre los meses */
            padding: 10px;
            /* Relleno para mejorar la apariencia */
        }

        /* Estilo para las opciones de la lista de meses */
        .mes-lista label {
            display: block;
            padding: 5px;
            cursor: pointer;
            text-align: center;
            /* Centrar el texto en cada cuadro */
            font-size: 12px;
            /* Tamaño de fuente más pequeño */
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

@section('content')
<section class="content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="font-weight: bold;">Registrar Egreso</div>
                    <div class="card-body">
                        <form action="{{ route('egresos.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monto">Monto:</label>
                                        <input type="number" name="monto" id="monto" class="form-control" value="{{ old('monto') }}" required>

                                        @error('monto')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha:</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>

                                        @error('fecha')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="concepto">Concepto:</label>
                                <input type="text" class="form-control" id="concepto" name="concepto" value="{{ old('concepto') }}" required>

                                @error('concepto')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="gestion_codigo">Gestión:</label>
                                <select name="gestion_codigo" id="gestion_codigo" class="form-control" required>
                                    <option value="">Selecciona una gestión</option>
                                    @foreach($gestiones as $gestion)
                                        <option value="{{ $gestion->codigo }}" {{ old('gestion_codigo') == $gestion->codigo ? 'selected' : '' }}>
                                            {{ $gestion->descripcion }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('gestion_codigo')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary botonguardar" type="submit">Registrar Egreso</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section ('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

@stop

@section('footer')
    <div class="container">
        <footer class="footer">
            <p class="text-center">Número de visitas: {{ $visitas }}</p>
        </footer>
    </div>
@stop
@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
