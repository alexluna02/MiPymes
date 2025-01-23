@extends('plantilla.plantilla')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ route('venta.update', $venta->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="cod_factura">Codigo de la Factura</label>
                                <input type="text" name="cod_factura" class="form-control" value="{{ $venta->cod_factura }}"required>
                            </div>
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                <select name="cliente_id" class="form-control" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" name="total" class="form-control" id="total" value="{{ $venta->total }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="metodo_pago_id">Método de Pago</label>
                                <select name="metodo_pago_id" class="form-control" required>
                                    <option value="">Seleccione un método de pago</option>
                                    @foreach($metodosPago as $metodo)
                                        <option value="{{ $metodo->id }}" {{ $venta->metodo_pago_id == $metodo->id ? 'selected' : '' }}>
                                            {{ $metodo->metodo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <input type="text" name="estado" class="form-control" value="{{ $venta->estado }}" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_entrega">Fecha de Entrega</label>
                                <input type="date" name="fecha_entrega" class="form-control" value="{{ $venta->fecha_entrega }}" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_entrega">Dirección de Entrega</label>
                                <textarea name="direccion_entrega" class="form-control" required>{{ $venta->direccion_entrega }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios" class="form-control">{{ $venta->comentarios }}</textarea>
                            </div>

                            <!-- Sección para detalles de venta -->
                            <div class="form-group">
                                <h4>Detalles de Venta</h4>
                                <table class="table table-bordered" id="detalles-venta">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Descuento</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($venta->detalles as $detalle)
                                            <tr>
                                                <td>
                                                    <select name="detalles[{{ $loop->index }}][producto_id]" class="form-control" required>
                                                        <option value="">Seleccione un producto</option>
                                                        @foreach($productos as $producto)
                                                            <option value="{{ $producto->id }}" {{ $detalle->producto_id == $producto->id ? 'selected' : '' }}>
                                                                {{ $producto->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="detalles[{{ $loop->index }}][cantidad]" class="form-control cantidad" value="{{ $detalle->cantidad }}" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="detalles[{{ $loop->index }}][precio_unitario]" class="form-control precio-unitario" value="{{ $detalle->precio_unitario }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="detalles[{{ $loop->index }}][descuento]" class="form-control descuento" value="{{ $detalle->descuento }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="detalles[{{ $loop->index }}][subtotal]" class="form-control subtotal" value="{{ $detalle->subtotal }}" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger eliminar-fila">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="button" id="agregar-producto" class="btn btn-primary">Agregar Producto</button>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Actualizar Venta</button>
                                <a href="{{ route('venta.index') }}" class="btn btn-info btn-block">Atrás</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
