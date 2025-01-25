@extends('plantilla.plantilla')

@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            <!-- Mostrar errores de validación -->
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

            <!-- Mostrar mensaje de éxito -->
            @if(Session::has('success'))
            <div class="alert alert-info">
                {{Session::get('success')}}
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
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre del producto" value="{{ old('nombre', $producto->nombre) }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <textarea name="descripcion" class="form-control input-sm" placeholder="Descripción del producto">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <label for="proveedor_id">Proveedor</label>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <select name="proveedor_id" class="form-control" required>
                                            <option value="">Seleccione un proveedor</option>
                                            @foreach($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}" {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="btn-group">
                                        <a href="{{ route('proveedor.create') }}?redirect_to={{ url()->current() }}" class="btn btn-primary">Crear nueva proveedor</a>

                                    </div>
                                </div>
                            </div>

                            <label for="categoria_id">Categoría</label>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <select name="categoria_id" class="form-control" required>
                                            <option value="">Seleccione una categoría</option>
                                            @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="btn-group">
                                        <a href="{{ route('categoria.create') }}?redirect_to={{ url()->current() }}" class="btn btn-primary">Crear nueva categoría</a>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="precio" id="precio" class="form-control input-sm" placeholder="Precio del producto" value="{{ old('precio', $producto->precio) }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cantidad_stock" id="cantidad_stock" class="form-control input-sm" placeholder="Cantidad en stock" value="{{ old('cantidad_stock', $producto->cantidad_stock) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="marca" id="marca" class="form-control input-sm" placeholder="Marca" value="{{ old('marca', $producto->marca) }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="modelo" id="modelo" class="form-control input-sm" placeholder="Modelo" value="{{ old('modelo', $producto->modelo) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="año_fabricacion" id="año_fabricacion" class="form-control input-sm" placeholder="Año de fabricación" value="{{ old('año_fabricacion', $producto->año_fabricacion) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
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
</div>
@endsection
