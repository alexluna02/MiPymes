@extends('plantilla.plantilla')
@section('content')
<section class="content">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left">
                    <h3>Lista de Parámetros</h3>
                </div>
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('parametro.create') }}" class="btn btn-info">Añadir Parámetro</a>
                    </div>
                </div>
                <div class="table-container">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </thead>
                        <tbody>
                            @if($parametros->count())
                                @foreach($parametros as $parametro)
                                <tr>
                                    <td>{{ $parametro->nombre }}</td>
                                    <td>{{ $parametro->valor }}</td>
                                    <td>{{ $parametro->descripcion }}</td>
                                    <td>{{ $parametro->tipo }}</td>
                                    <td>
                                        @if($parametro->estado)
                                            <button 
                                                class="btn btn-success btn-xs toggle-estado" 
                                                data-id="{{ $parametro->id }}" 
                                                data-tipo="{{ $parametro->tipo }}"
                                                data-estado="0">
                                                Activo
                                            </button>
                                        @else
                                            <button 
                                                class="btn btn-danger btn-xs toggle-estado" 
                                                data-id="{{ $parametro->id }}" 
                                                data-tipo="{{ $parametro->tipo }}"
                                                data-estado="1">
                                                Inactivo
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ route('parametro.edit', $parametro->id) }}">
                                            <span class="glyphicon glyphicon-pencil"></span> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('parametro.destroy', $parametro->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger btn-xs" type="submit">
                                                <span class="glyphicon glyphicon-trash"></span> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No hay registros !!</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.toggle-estado');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const tipo = this.dataset.tipo;
                const estado = this.dataset.estado;

                fetch(`/parametro/cambiar-estado/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ tipo, estado })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recargar la página para reflejar los cambios
                    } else {
                        alert('Error al cambiar el estado');
                    }
                })
                .catch(err => console.error(err));
            });
        });
    });
</script>
@endsection
