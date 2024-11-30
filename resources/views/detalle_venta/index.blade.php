@extends('plantilla.plantilla')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left">
                        <h3>Lista Detalles</h3>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ route('detalle_venta.create') }}" class="btn btn-info">Añadir Detalle</a>
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>ID Venta</th>
                                <th>ID Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Descuento</th>
                                <th>Impuesto</th>
                                <th>Total Linea</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                @if($detalles->count())
                                @foreach($detalles as $det)
                                <tr>
                                    <td>{{$det->venta_id}}</td>
                                    <td>{{$det->producto_id}}</td>
                                    <td>{{$det->cantidad}}</td>
                                    <td>{{$det->precio_unitario}}</td>
                                    <td>{{$det->subtotal}}</td>
                                    <td>{{$det->descuento}}%</td>
                                    <td>{{$det->impuesto}}%</td>
                                    <td>{{$det->total_linea}}</td>
                                    <td><a class="btn btn-primary btn-xs" href="{{ route('detalle_venta.edit', $det->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td>
                                        <form action="{{ route('detalle_venta.destroy', $det->id)}}" method="post">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">

                                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8">No hay registro !!</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
                {{ $detalles->links() }}
            </div>
        </div>
    </section>

    @endsection