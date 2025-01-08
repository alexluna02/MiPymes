@extends('plantilla.plantilla')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista de Pacientes</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('paciente.create') }}" class="btn btn-info">Añadir Paciente</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Código</th>
               <th>Nombre</th>
               <th>Dirección</th>
               <th>Fecha de Nacimiento</th>
               <th>Edad</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($pacientes->count())  
              @foreach($pacientes as $paciente)  
              <tr>
                <td>{{ $paciente->codigo_paciente }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->direccion }}</td>
                <td>{{ $paciente->fecha_nacimiento }}</td>
                <td>{{ $paciente->edad }}</td>
                <td><a class="btn btn-primary btn-xs" href="{{ route('paciente.edit', $paciente->codigo_paciente) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{ route('paciente.destroy', $paciente->codigo_paciente) }}" method="post">
                   {{ csrf_field() }}
                   <input name="_method" type="hidden" value="DELETE">
                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>
                 </td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="7">No hay registros disponibles</td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>
      </div>
      {{ $pacientes->links() }}
    </div>
  </div>
</section>

@endsection
