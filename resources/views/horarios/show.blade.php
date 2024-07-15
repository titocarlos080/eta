@extends('adminlte::page')

@section('title', 'Detalle de Horario')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>DETALLE DEL HORARIO</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Inicio</label>
                            <input type="time" id="hora_inicio" class="form-control" value="{{ $horario->hora_inicio }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hora_fin">Hora de Fin</label>
                            <input type="time" id="hora_fin" class="form-control" value="{{ $horario->hora_fin }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
