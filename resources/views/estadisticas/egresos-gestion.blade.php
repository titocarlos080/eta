@extends('adminlte::page')

@section('title', 'Estadísticas de Egresos por Gestión')

@section('content')
    <div class="container">
        <h1>Estadísticas de Egresos por Gestión</h1>
        
        <div class="form-group">
            <label for="statisticType">Tipo de Estadística:</label>
            <select id="statisticType" class="form-control" style="width: 200px; display: inline-block;" onchange="location = this.value;">
                <option value="{{ url('/estadisticas/estudiantes') }}">Estudiantes por Carrera</option>
                <option value="{{ url('/estadisticas/estudiantes_materia') }}">Estudiantes por Materia</option>
                <option value="{{ url('/estadisticas/egresos_gestion') }}" selected>Egresos por Gestión</option>
            </select>

            <label for="chartType">Tipo de Gráfica:</label>
            <select id="chartType" class="form-control" style="width: 200px; display: inline-block;">
                <option value="bar">Barra</option>
                <option value="line">Lineal</option>
            </select>
        </div>

        <div class="chart-container" style="position: relative; height:60vh; width:100vw">
            <canvas id="chartCanvas"></canvas>
        </div>
    </div>

    <!-- Incluir el script de Chart.js desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('chartCanvas').getContext('2d');
            var data = @json($data);

            var labels = data.map(function(item) {
                return item.gestion;
            });

            var counts = data.map(function(item) {
                return item.total_egresos;
            });

            var chartType = document.getElementById('chartType').value;
            var chart;

            function createChart(type) {
                if (chart) {
                    chart.destroy();
                }
                chart = new Chart(ctx, {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Egresos por Gestión',
                            data: counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            createChart(chartType);

            document.getElementById('chartType').addEventListener('change', function() {
                chartType = this.value;
                createChart(chartType);
            });
        });
    </script>
@endsection
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
