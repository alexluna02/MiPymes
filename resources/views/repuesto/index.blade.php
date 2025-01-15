@extends('plantilla.plantilla')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <h3>Lista de Repuestos</h3>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('repuesto.create') }}" class="btn btn-info">Añadir Repuesto</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Cantidad en Stock</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año de Fabricación</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @if ($repuestos->count())
                                        @foreach ($repuestos as $repuesto)
                                            <tr>
                                                <td>{{ $repuesto->nombre }}</td>
                                                <td>{{ $repuesto->descripcion }}</td>
                                                <td>${{ $repuesto->precio }}</td>
                                                <td>{{ $repuesto->cantidad_stock }}</td>
                                                <td>{{ $repuesto->categoria }}</td>
                                                <td>{{ $repuesto->marca }}</td>
                                                <td>{{ $repuesto->modelo }}</td>
                                                <td>{{ $repuesto->año_fabricacion }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-xs"
                                                        href="{{ route('repuesto.edit', $repuesto->id) }}">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('repuesto.destroy', $repuesto->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger btn-xs" type="submit">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11">No hay registros</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $repuestos->links() }}
                </div>
            </div>
        </section>
    @endsection
