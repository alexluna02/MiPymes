@extends('plantilla.plantilla')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ route('venta.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                <select name="cliente_id" class="form-control" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" name="total" class="form-control" id="total" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="metodo_pago_id">Método de Pago</label>
                                <select name="metodo_pago_id" class="form-control" required>
                                    <option value="">Seleccione un método de pago</option>
                                    @foreach($metodosPago as $metodo)
                                        <option value="{{ $metodo->id }}">{{ $metodo->metodo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <input type="text" name="estado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_entrega">Fecha de Entrega</label>
                                <input type="date" name="fecha_entrega" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_entrega">Dirección de Entrega</label>
                                <textarea name="direccion_entrega" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios" class="form-control"></textarea>
                            </div>

                            <!-- Sección dinámica para detalles de venta -->
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
                                        <!-- Filas dinámicas se añadirán aquí -->
                                    </tbody>
                                </table>
                                <button type="button" id="agregar-producto" class="btn btn-primary">Agregar Producto</button>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Guardar Venta</button>
                                <a href="{{ route('venta.index') }}" class="btn btn-info btn-block">Atrás</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Script para manejar la sección dinámica -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let contador = 0;

            // Evento para agregar una nueva fila
            $('#agregar-producto').click(function () {
                contador++;
                const nuevaFila = `
                    <tr id="fila-${contador}">
                        <td>
                            <select name="detalles[${contador}][producto_id]" class="form-control" required>
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="detalles[${contador}][cantidad]" class="form-control cantidad" required>
                        </td>
                        <td>
                            <input type="number" name="detalles[${contador}][precio_unitario]" class="form-control precio-unitario" readonly>
                        </td>
                        <td>
                            <input type="number" name="detalles[${contador}][descuento]" class="form-control descuento">
                        </td>
                        <td>
                            <input type="number" name="detalles[${contador}][subtotal]" class="form-control subtotal" readonly>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-danger eliminar-fila" data-id="${contador}">Eliminar</button>
                        </td>
                    </tr>
                `;
                $('#detalles-venta tbody').append(nuevaFila);
            });

            // Evento para eliminar una fila
            $(document).on('click', '.eliminar-fila', function () {
                const filaId = $(this).data('id');
                $(`#fila-${filaId}`).remove();
                actualizarTotal();
            });

            // Evento para actualizar subtotal y total al cambiar cantidad o producto
            $(document).on('change', '.cantidad,.descuento, select[name^="detalles"]', function () {
                const fila = $(this).closest('tr');
                const precio = parseFloat(fila.find('select option:selected').data('precio')) || 0;
                const cantidad = parseInt(fila.find('.cantidad').val()) || 0;
                const descuento = parseInt(fila.find('.descuento').val()) || 0;
                const subtotal = precio * cantidad*(1-descuento/100);
                fila.find('.precio-unitario').val(precio.toFixed(2));
                fila.find('.subtotal').val(subtotal.toFixed(2));
                actualizarTotal();
            });

            // Función para actualizar el total general
            function actualizarTotal() {
                let total = 0;
                $('.subtotal').each(function () {
                    total += parseFloat($(this).val()) || 0;
                });
                $('#total').val(total.toFixed(2));
            }
        });
    </script>
@endsection
