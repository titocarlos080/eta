@extends('adminlte::page')

@section('title', 'Carreras de la Gestión')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Carreras de la Gestión {{ $gestion->descripcion }}</strong></h3>
            </div>
            <div class="card-body p-0">
                @if ($carreras->isEmpty())
                    <div class="alert alert-info m-3">
                        No hay carreras disponibles para esta gestión.
                    </div>
                @else
                    <div class="row">
                        @foreach($carreras as $carrera)
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $carrera->descripcion }}</h5>
                                    <a href="{{ route('ofertas.showMaterias', $carrera->sigla) }}" class="btn btn-primary w-100">Ver Materias</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
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
