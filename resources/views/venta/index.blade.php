@extends('plantilla.plantilla')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Listado de Ventas</h1>
    <div class="pull-right mb-3">
        <div class="btn-group">
            <a href="{{ route('venta.create') }}" class="btn btn-info">Registrar Venta</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Fecha de Venta</th>
                <th>Total</th>
                <th>Fecha de Entrega</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($ventas->count())
                @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->fecha_entrega }}</td>
                    <td>{{ $venta->estado }}</td>
                    <td>
                        <a href="{{ route('venta.edit', $venta->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('venta.destroy', $venta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        <button class="btn btn-sm btn-primary detalles-btn" data-id="{{ $venta->id }}">Ver Detalles</button>
                    </td>
                </tr>
                <tr id="detalles-venta-{{ $venta->id }}" class="detalles-venta" style="display: none;">
                    <td colspan="6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($venta->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                    <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
            @else
            <tr>
                <td colspan="6">No hay registros.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Script para manejar el panel de detalles -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.detalles-btn').on('click', function() {
            const id = $(this).data('id');
            $(`#detalles-venta-${id}`).toggle();
        });
    });
</script>
@endsection
