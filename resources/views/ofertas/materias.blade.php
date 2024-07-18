@extends('adminlte::page')

@section('title', 'Materias Ofertadas')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Materias Ofertadas</strong></h3>
            </div>
        </div>
        <div class="card-body ">
            <form class="d-flex w-50 " role="search">
                <input name="search" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" value="{{ $search ?? '' }}">
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
        </div>
        <div class="card">

            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed">
                    <thead class="table-light">
                        <tr>
                            <th>Materia</th>
                            <th>Grupo</th>
                            <th>Docente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materias as $materia)
                        <tr>
                            <td>{{ $materia->materia_descripcion }}</td>
                            <td>{{ $materia->grupo_descripcion }}</td>
                            <td>{{ $materia->docente_nombre }} {{ $materia->docente_apellido_pat }} {{ $materia->docente_apellido_mat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
