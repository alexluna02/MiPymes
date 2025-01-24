@extends('plantilla.plantilla')

@section('content')
<div class="container">
    <h1>Dashboard de Productos</h1>
    <canvas id="productosChart" width="400" height="200"></canvas>
    <canvas id="ventasPorMes" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Datos de productos por categoría
        const categorias = @json($categorias);
        const valores = @json($valores);

        // Configuración del gráfico de productos
        const ctxProductos = document.getElementById('productosChart').getContext('2d');
        const productosChart = new Chart(ctxProductos, {
            type: 'bar', // Cambiar a 'pie', 'line', etc. según prefieras
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Cantidad de productos por categoría',
                    data: valores,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });

        // Datos de ventas por mes
        const meses = @json($meses);
        const valoresVentas = @json($valoresVentas);

        // Configuración del gráfico de ventas
        const ctxVentas = document.getElementById('ventasPorMes').getContext('2d');
        const ventasChart = new Chart(ctxVentas, {
            type: 'line', // Gráfico de líneas
            data: {
                labels: meses,
                datasets: [{
                    label: 'Ventas por Mes',
                    data: valoresVentas,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true // Asegura que el eje Y comience en cero
                    }
                }
            }
        });
    });
</script>
@endsection
