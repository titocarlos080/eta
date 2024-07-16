@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Estadísticas de Estudiantes por Materia</h1>
        
        <div class="form-group">
            <label for="chartType">Tipo de Gráfica:</label>
            <select id="chartType" class="form-control" style="width: 200px;">
                <option value="bar">Barra</option>
                <option value="line">Lineal</option>
            </select>
        </div>

        <div class="chart-container" style="position: relative; height:60vh; width:100vw">
            <canvas id="estudiantesPorMateriaChart"></canvas>
        </div>
    </div>

    <!-- Incluir el script de Chart.js desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('estudiantesPorMateriaChart').getContext('2d');
            var data = @json($data);

            var labels = data.map(function(item) {
                return item.materia;
            });

            var counts = data.map(function(item) {
                return item.total_estudiantes;
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
                            label: 'Estudiantes por Materia',
                            data: counts,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
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

@push('scripts')
    <script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush
