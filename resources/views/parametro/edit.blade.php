@extends('plantilla.plantilla')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Editar Parámetro</h3></div>
            <div class="panel-body">
                <form action="{{ route('parametro.update', $parametro->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $parametro->nombre }}" required>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="number" name="valor" id="valor" class="form-control" step="0.01" value="{{ $parametro->valor }}" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control">{{ $parametro->descripcion }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $parametro->tipo }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="{{ route('parametro.index') }}" class="btn btn-info">Atrás</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection