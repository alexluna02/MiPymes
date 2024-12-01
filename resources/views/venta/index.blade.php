@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Listado de Ventas</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>{{ $venta->estado }}</td>
                <td>
                    <a href="{{ route('venta.edit', $venta->id) }}">Editar</a>
                    <form action="{{ route('venta.destroy', $venta->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection