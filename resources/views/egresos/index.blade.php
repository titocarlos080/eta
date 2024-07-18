@extends('adminlte::page')

@section('title', 'Egresos')

@section('content')
<section class="content">
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 my-auto">
                        <h3 class="card-title my-auto">
                            <strong>LISTA DE EGRESOS</strong>
                            <a class="btn" href="{{ route('egresos.index') }}">
                                <i class="fas fa-sync fa-md fa-fw"></i>
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{ route('egresos.create') }}" class="btn btn-primary" type="button">Nuevo</a>
                    </div>
                </div>
                <form class="d-flex w-50 "  role="search">
                    <input name="search" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" value="{{$search}}">
                    <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover table-head-fixed text-center">
                    <thead class="table-light">
                        <tr>
                            <th>CONCEPTO</th>
                            <th>MONTO</th>
                            <th>FECHA</th>
                            <th>GESTIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($egresos as $egreso)
                        <tr id="egreso-{{ $egreso->id }}" class="{{ $egreso->anulado ? 'table-secondary' : '' }}">
                            <td>{{ $egreso->concepto }}</td>
                            <td>{{ $egreso->monto }}</td>
                            <td>{{ $egreso->fecha }}</td>
                            <td>{{ $egreso->gestion->descripcion }}</td>
                            <td>
                                @if(!$egreso->anulado)
                                <form action="{{ route('egresos.anular', $egreso->id) }}" method="POST" class="d-inline anular-form" data-id="{{ $egreso->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Anular</button>
                                </form>
                                @else
                                <span class="badge badge-secondary">Anulado</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.anular-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                var id = this.dataset.id;
                var url = this.action;
                var token = this.querySelector('input[name="_token"]').value;

                if (confirm('¿Estás seguro de que deseas anular este egreso?')) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            _token: token
                        })
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            var row = document.getElementById('egreso-' + id);
                            row.classList.add('table-secondary');
                            var button = row.querySelector('button');
                            if (button) {
                                button.textContent = 'Anulado';
                                button.classList.remove('btn-danger');
                                button.classList.add('btn-secondary');
                                button.disabled = true;
                            }
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al intentar anular el egreso. Por favor, inténtelo de nuevo.');
                    });
                }
            });
        });
    });
</script>
@stop

@push('css')
<style>
.table-secondary {
    background-color: #f2f2f2;
    color: #6c757d;
}
</style>
@endpush
@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
