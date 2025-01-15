@extends('plantilla.plantilla')

@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Productos</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('producto.create') }}" class="btn btn-info">Añadir Producto</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Proveedor</th>
                <th>Cantidad en Stock</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año de Fabricación</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </thead>
              <tbody>
                @if($productos->count())  
                  @foreach($productos as $producto)  
                    <tr>
                      <td>{{$producto->nombre}}</td>
                      <td> <textarea name="descripcion" class="form-control input-sm" placeholder="Descripción del producto"readonly="true">{{$producto->descripcion}}</textarea></td>
                      <td>${{$producto->precio}}</td>
                      <td>{{ $producto->proveedor->nombre }}</td>
                      <td>{{$producto->cantidad_stock}}</td>
                      <td>{{$producto->categoria->nombre}}</td>
                      <td>{{$producto->marca}}</td>
                      <td>{{$producto->modelo}}</td>
                      <td>{{$producto->año_fabricacion}}</td>
                      <td>
                        <a class="btn btn-primary btn-xs" href="{{ route('producto.edit', $producto->id) }}">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                      </td>
                      <td>
                        <form action="{{ route('producto.destroy', $producto->id)}}" method="post">
                          {{csrf_field()}}
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
        {{ $productos->links() }}
      </div>
    </div>
  </section>
@endsection
