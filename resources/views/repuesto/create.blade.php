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
                @if (Session::has('success'))
                    <div class="alert alert-info">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nuevo Repuesto</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <form method="POST" action="{{ route('repuesto.store') }}" role="form">
                                {{ csrf_field() }}

                                <!-- Crear -->
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nombre" id="nombre"
                                                class="form-control input-sm" placeholder="Nombre del repuesto"
                                                value="{{ old('nombre') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <textarea name="descripcion" class="form-control input-sm" placeholder="Descripción del repuesto">{{ old('descripcion') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="precio" id="precio"
                                                class="form-control input-sm" placeholder="Precio del repuesto"
                                                value="{{ old('precio') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="cantidad_stock" id="cantidad_stock"
                                                class="form-control input-sm" placeholder="Cantidad en stock"
                                                value="{{ old('cantidad_stock') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="categoria_id" id="categoria_id"
                                                class="form-control input-sm" placeholder="Categoría"
                                                value="{{ old('categoria_id') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="marca" id="marca"
                                                class="form-control input-sm" placeholder="Marca"
                                                value="{{ old('marca') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="modelo" id="modelo"
                                                class="form-control input-sm" placeholder="Modelo"
                                                value="{{ old('modelo') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="año_fabricacion" id="año_fabricacion"
                                                class="form-control input-sm" placeholder="Año de fabricación"
                                                value="{{ old('año_fabricacion') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit" value="Guardar" class="btn btn-success btn-block">
                                        <a href="{{ route('repuesto.index') }}" class="btn btn-info btn-block">Atrás</a>
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
