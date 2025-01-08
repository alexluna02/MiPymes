@extends('plantilla.plantilla')
@section('content')

<section class="content">

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left">
                    <h3>Lista de Parametros</h3>
                </div>
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('parametro.create') }}" class="btn btn-info">Añadir Parametro</a>
                    </div>
                </div>
                <div class="table-container">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th>Descripcion</th>
                            <th>Tipo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </thead>
                        <tbody>
                            @if($parametros->count())
                            @foreach($parametros as $parametro)
                            <tr>
                                <td>{{$parametro->nombre}}</td>
                                <td>{{$parametro->valor}}</td>
                                <td>{{$parametro->descripcion}}</td>
                                <td>{{$parametro->tipo}}</td>
                                <td><a class="btn btn-primary btn-xs" href="{{ route('parametro.edit', $parametro->id) }}"><span class="glyphicon glyphicon-pencil"></span>Editar</a></td>
                                <td>
                                    <form action="{{ route('parametro.destroy', $parametro->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">

                                        <button class="btn btn-danger btn-xs" value="Eliminar" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
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
            {{ $parametros->links() }}
        </div>
    </div>
</section>

@endsection