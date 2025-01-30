@extends('plantilla.plantilla')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-info">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar Producto</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <form method="POST" action="{{ route('producto.update', $producto->id) }}" role="form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre del Producto</label>
                                            <input type="text" name="nombre" class="form-control"
                                                value="{{ old('nombre', $producto->nombre) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Proveedor -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select name="proveedor_id" class="form-control" required>
                                                <option value="">Seleccione un proveedor</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}" 
                                                        {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                                                        {{ $proveedor->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <a href="{{ route('proveedor.create') }}" class="btn btn-primary">Crear nuevo Proveedor</a>
                                    </div>
                                </div>

                                <!-- Categoría -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Categoría</label>
                                            <select name="categoria_id" class="form-control" required>
                                                <option value="">Seleccione una categoría</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" 
                                                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <a href="{{ route('categoria.create') }}" class="btn btn-primary">Crear nueva categoría</a>

                                    </div>
                                </div>

                                <!-- Precio y Stock -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="text" name="precio" class="form-control"
                                                value="{{ old('precio', $producto->precio) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cantidad en Stock</label>
                                            <input type="text" name="cantidad_stock" class="form-control"
                                                value="{{ old('cantidad_stock', $producto->cantidad_stock) }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Marca y Modelo -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" name="marca" class="form-control"
                                                value="{{ old('marca', $producto->marca) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Año de Fabricacion</label>
                                            <input type="text" name="año_fabricacion" class="form-control"
                                                value="{{ old('año_fabricacion', $producto->año_fabricacion) }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Repuestos -->
                                <label>Repuestos</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#repuestosModal">
                                            Añadir Repuestos
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <ul class="list-group">
                                            @foreach ($producto->repuestos as $repuesto)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $repuesto->nombre }}
                                                    <button type="button" class="btn btn-danger btn-sm removeRepuestoBtn" data-repuesto-id="{{ $repuesto->id }}">
                                                        Eliminar
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="submit" value="Actualizar" class="btn btn-success btn-block">
                                        <a href="{{ route('producto.index') }}" class="btn btn-info btn-block">Atrás</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal para seleccionar repuestos -->
        <div class="modal fade" id="repuestosModal" tabindex="-1" aria-labelledby="repuestosModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar Repuestos</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($repuestos as $repuesto)
                            <div class="form-check">
                                <input class="form-check-input repuesto-checkbox" type="checkbox" value="{{ $repuesto->id }}">
                                <label>{{ $repuesto->nombre }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="guardarRepuestosBtn">Guardar Selección</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('guardarRepuestosBtn').addEventListener('click', function() {
                let selectedRepuestos = [];
                document.querySelectorAll('.repuesto-checkbox:checked').forEach(checkbox => {
                    selectedRepuestos.push(checkbox.value);
                });

                fetch('/add-repuestos', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ producto_id: {{ $producto->id }}, repuestos: selectedRepuestos })
                }).then(response => response.json())
                .then(data => location.reload());
            });




            document.querySelectorAll('.removeRepuestoBtn').forEach(button => {
            button.addEventListener('click', function() {
            const repuestoId = this.dataset.repuestoId;

            if (confirm('¿Estás seguro de que deseas eliminar este repuesto?')) {
            fetch(`/remove-repuesto`, {
            method: 'DELETE',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
            producto_id: {{ $producto->id }},
            repuesto_id: repuestoId
            })
            })
            .then(response => response.json())
            .then(data => {
            if (data.success) {
            alert('Repuesto eliminado correctamente');
            location.reload();
            } else {
            alert('Hubo un error al eliminar el repuesto');
            }
            })
            .catch(error => console.error('Error:', error));
            }
            });
            });

        </script>
    </div>
@endsection
