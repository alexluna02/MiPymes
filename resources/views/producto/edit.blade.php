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
                            <input name="_method" type="hidden" value="PATCH">
                            
                            <!-- Nombre y Descripción -->
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{ $producto->nombre }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <textarea name="descripcion" class="form-control input-sm" placeholder="Descripción del producto">{{ $producto->descripcion }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Precio y Cantidad en Stock -->
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="precio" id="precio" class="form-control input-sm" value="{{ $producto->precio }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cantidad_stock" id="cantidad_stock" class="form-control input-sm" value="{{ $producto->cantidad_stock }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Tipo de Producto, Categoría, Marca y Modelo -->
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="tipo_producto" id="tipo_producto" class="form-control input-sm" value="{{ $producto->tipo_producto }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="categoria" id="categoria" class="form-control input-sm" value="{{ $producto->categoria }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="marca" id="marca" class="form-control input-sm" value="{{ $producto->marca }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="modelo" id="modelo" class="form-control input-sm" value="{{ $producto->modelo }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Año de Fabricación -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="año_fabricacion" id="año_fabricacion" class="form-control input-sm" value="{{ $producto->año_fabricacion }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
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
@endsection
