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
          <div class="pull-left"><h3>Lista de Proveedores</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('proveedor.create') }}" class="btn btn-info" >Añadir Proveedor</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Nombre</th>
               <th>Direccion</th>
               <th>Telefono</th>
               <th>Email</th>
               <th>Fecha_Registro</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($proveedores->count())  
              @foreach($proveedores as $proveedor)  
              <tr>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->direccion}}</td>
                <td>{{$proveedor->telefono}}</td>
                <td>{{$proveedor->email}}</td>
                <td>{{$proveedor->fecha_registro}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('proveedor.edit', $proveedor->id) }}" ><span class="glyphicon glyphicon-pencil"></span>Editar</a></td>
                <td>
                  <form action="{{ route('proveedor.destroy', $proveedor->id)}}" method="post">
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
      {{ $proveedores->links() }}
    </div>
  </div>
</section>

@endsection