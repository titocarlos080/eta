@extends('adminlte::page')

@section('title', 'Gestiones')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Ofertas</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($gestiones as $gestion)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <a href="{{ route('ofertas.showCarreras', $gestion->codigo) }}" class="btn btn-lg btn-info w-100">
                                        {{ $gestion->descripcion }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
