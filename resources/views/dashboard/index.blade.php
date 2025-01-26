@extends('plantilla.plantilla')

@section('content')
<div class="container-fluid" style="margin-left: 260px; border: 1px solid grey; background-color:white; padding:40px; border-radius:10px">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3">Dashboard</h1>
        </div>
    </div>


    <div class="container"style="margin-bottom: 5%; ">
        <div class="row">
            <!-- Total Productos -->
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <strong>Total Productos</strong>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $totalProductos }}</h1>
                        <span class="label label-info">Total acumulado</span>
                    </div>
                </div>
            </div>

            <!-- Total Ventas -->
            <div class="col-md-3">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">
                        <strong>Total Ventas</strong>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $totalVentas }}</h1>
                        <span class="label label-success">Ventas realizadas</span>
                    </div>
                </div>
            </div>

            <!-- Total Clientes -->
            <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading text-center">
                        <strong>Total Clientes</strong>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $totalClientes }}</h1>
                        <span class="label label-warning">Clientes registrados</span>
                    </div>
                </div>
            </div>

            <!-- Total Proveedores -->
            <div class="col-md-3">
                <div class="panel panel-danger">
                    <div class="panel-heading text-center">
                        <strong>Total Proveedores</strong>
                    </div>
                    <div class="panel-body text-center">
                        <h1>{{ $totalProveedores }}</h1>
                        <span class="label label-danger">Proveedores registrados</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de estadísticas -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3" style="margin-right: 15%; margin-left: 40px;">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Proveedores</h5>
                </div>
                <div class="card-body">
                    <canvas id="valoresprod_prov" ></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Productos</h5>
                </div>
                <div class="card-body">
                    <canvas id="productosChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row"style="margin-bottom: 5%;">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ventas por Mes</h5>
                    <div>
                        <button id="anteriorAnio" class="btn btn-primary btn-sm">Año Anterior</button>
                        <span id="anioActual" class="mx-3">Año: {{ $anio }}</span>
                        <button id="siguienteAnio" class="btn btn-secondary btn-sm">Año Siguiente</button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="ventasPorMes" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorias = @json($categorias);
        const valores = @json($valores);
        const prod_prov = @json($prod_prov);
        const valoresprod_prov = @json($valoresprod_prov);
        const meses = @json($meses);
        const valoresVentas = @json($valoresVentas);

        const ctxProd_Prov = document.getElementById('valoresprod_prov').getContext('2d');
        new Chart(ctxProd_Prov, {
            type: 'doughnut',
            data: {
                labels: prod_prov,
                datasets: [{
                    label: 'Cantidad de productos',
                    data: valoresprod_prov,
                    backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
            legend: {
                position: 'right', // Cambia la posición de la leyenda al lado izquierdo
            },
            title: {
                display: true,
                text: 'Proveedores'
            }
        }
            }
        });

        const ctxProductos = document.getElementById('productosChart').getContext('2d');
        new Chart(ctxProductos, {
            type: 'bar',
            data: {
                labels: categorias,
                datasets: [{
                    label: 'Cantidad de productos por categoría',
                    data: valores,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        const ctxVentas = document.getElementById('ventasPorMes').getContext('2d');
        new Chart(ctxVentas, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Ventas por Mes',
                    data: valoresVentas,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection