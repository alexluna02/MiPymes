@extends('plantilla.plantilla')

@section('content')
@if ($errors->any())
<div class="col-md-8 col-md-offset-2">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
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
                            <input type="text" name="cod_factura" class="form-control" value="{{ $venta->cod_factura }}" required>
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
                                        <th>Descuento%</th>
                                        <th>IVA %</th>
                                        <th>Subtotal</th>

                                        <th>Total_Linea</th>
                                        <!--<th>Acciones</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($venta->detalles as $detalle)
                                    <tr>
                                        <td>
                                            <select name="detalles[{{ $loop->index }}][producto_id]" class="form-control" style="display: none;">
                                                
                                                @foreach($productos as $producto)
                                                <option value="{{ $producto->id }}" {{ $detalle->producto_id == $producto->id ? 'selected' : '' }}>
                                                    {{ $producto->nombre }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @foreach($productos as $producto)
    @if($detalle->producto_id == $producto->id)
        <!--<input type="number" name="detalles[{{ $loop->index }}][producto_id]" class="form-control" value="{{ $producto->id }}" hidden>
-->
        <input type="text"  class="form-control" value="{{ $producto->nombre }}" readonly>
    @endif
@endforeach

                                        </td>

                                        <input type="number" name="detalles[{{ $loop->index }}][id]" class="form-control id" value="{{ $detalle->id }}" hidden>

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
                                            <input type="number" name="detalles[{{ $loop->index }}][iva]" class="form-control iva" value="{{ $detalle->impuesto }}" readonly>

                                        </td>
                                        <td>
                                            <input type="number" name="detalles[{{ $loop->index }}][subtotal]" class="form-control subtotal" value="{{ $detalle->subtotal }}" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="detalles[{{ $loop->index }}][total_linea]" class="form-control total_linea" value="{{ $detalle->total_linea }}" readonly>
                                        </td>
                                        <!--<td>
                                            <button type="button" class="btn btn-danger eliminar-fila">Eliminar</button>
                                        </td>-->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--<button type="button" id="agregar-producto" class="btn btn-primary">Agregar Producto</button>
--></div>

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

<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
    // Actualizar subtotales y totales al cambiar cantidad o descuento
    function actualizarTotales() {
        let totalVenta = 0;

        document.querySelectorAll("#detalles-venta tbody tr").forEach(function(fila) {
            const cantidad = parseFloat(fila.querySelector(".cantidad").value) || 0;
            const precioUnitario = parseFloat(fila.querySelector(".precio-unitario").value) || 0;
            const descuento = parseFloat(fila.querySelector(".descuento").value) || 0;
            const iva = parseFloat(fila.querySelector(".iva").value) || 0;

            // Calcular subtotal
            const subtotal = cantidad * precioUnitario - descuento;
            fila.querySelector(".subtotal").value = subtotal.toFixed(2);

            // Calcular total línea con IVA
            const totalLinea = subtotal + (subtotal * iva / 100);
            fila.querySelector(".total_linea").value = totalLinea.toFixed(2);

            // Sumar al total de la venta
            totalVenta += totalLinea;
        });

        // Actualizar total de la venta
        document.getElementById("total").value = totalVenta.toFixed(2);
    }

    // Evento: Actualizar totales al cambiar cantidad o descuento
    document.querySelectorAll("#detalles-venta").forEach(function(tabla) {
        tabla.addEventListener("input", function(event) {
            if (event.target.classList.contains("cantidad") || event.target.classList.contains("descuento")) {
                actualizarTotales();
            }
        });
    });

    // Ocultar fila al presionar "Eliminar"
    document.querySelectorAll(".eliminar-fila").forEach(function(boton) {
        boton.addEventListener("click", function() {
            const fila = this.closest("tr");
            fila.style.display = "none";
            fila.querySelector(".cantidad").value = 0; // Marcar cantidad como 0 para excluir del cálculo
            actualizarTotales();
        });
    });

    // Agregar funcionalidad al botón "Agregar Producto"
    document.getElementById("agregar-producto").addEventListener("click", function() {
        const tabla = document.querySelector("#detalles-venta tbody");
        const nuevaFila = document.createElement("tr");

        nuevaFila.innerHTML = `
            <td>
                <select name="detalles[new][producto_id]" class="form-control" required>
                    <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">
                                {{ $producto->nombre }}
                    </option>
                         @endforeach
                </select>
            </td>
            <td><input type="number" name="detalles[new][cantidad]" class="form-control cantidad" value="0" required></td>
            <td><input type="number" name="detalles[new][precio_unitario]" class="form-control precio-unitario" value="0" readonly></td>
            <td><input type="number" name="detalles[new][descuento]" class="form-control descuento" value="0"></td>
            <td><input type="number" name="detalles[new][iva]" class="form-control iva" value="0" readonly></td>
            <td><input type="number" name="detalles[new][subtotal]" class="form-control subtotal" value="0" readonly></td>
            <td><input type="number" name="detalles[new][total_linea]" class="form-control total_linea" value="0" readonly></td>
            <td><button type="button" class="btn btn-danger eliminar-fila">Eliminar</button></td>
        `;

        tabla.appendChild(nuevaFila);

        // Agregar eventos a la nueva fila
        nuevaFila.querySelector(".eliminar-fila").addEventListener("click", function() {
            nuevaFila.style.display = "none";
            nuevaFila.querySelector(".cantidad").value = 0;
            actualizarTotales();
        });

        nuevaFila.querySelectorAll(".cantidad, .descuento").forEach(function(input) {
            input.addEventListener("input", actualizarTotales);
        });
    });
});

</script>
@endsection