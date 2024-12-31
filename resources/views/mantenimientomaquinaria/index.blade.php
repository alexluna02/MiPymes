@extends('plantilla.plantilla')
@section('content')
<div class="row">
<div class="btn-group">
    <a href="/home" class="btn btn-danger btn-xs">Regresar</a>
  </div>
  <section class="content">
    
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Mantenimiento</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('mantenimientomaquinaria.create') }}" class="btn btn-info" >Añadir Registro de Mantenimiento</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>producto id</th>
               <th>venta id</th>
               <th>fecha</th>
               <th>tipo</th>
               <th>descripcion</th>
               <th>costo</th>
               <th>estado</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($mantenimientomaquinarias->count())  
              @foreach($mantenimientomaquinarias as $mantenimientomaquinaria)  
              <tr>
                <td>{{$mantenimientomaquinaria->producto_id}}</td>
                <td>{{$mantenimientomaquinaria->venta_id}}</td>
                <td>{{$mantenimientomaquinaria->fecha_mantenimiento}}</td>
                <td>{{$mantenimientomaquinaria->tipo_mantenimiento}}</td>
                <td>{{$mantenimientomaquinaria->descripcion}}</td>
                <td>{{$mantenimientomaquinaria->costo}}</td>
                <td>{{$mantenimientomaquinaria->estado_post_mantenimiento}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('mantenimientomaquinaria.edit', $mantenimientomaquinaria->id) }}" ><span class="glyphicon glyphicon-pencil"></span>Editar</a></td>
                <td>
                  <form action="{{ route('mantenimientomaquinaria.destroy', $mantenimientomaquinaria->id)}}" method="post">
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
      {{ $mantenimientomaquinarias->links() }}
    </div>
  </div>
</section>

@endsection