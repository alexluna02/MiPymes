@extends('plantilla.plantilla')

@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ route('venta.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                <select name="cliente_id" class="form-control" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" name="total" class="form-control" required step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="metodo_pago_id">Método de Pago</label>
                                <select name="metodo_pago_id" class="form-control" required>
                                    <option value="">Seleccione un método de pago</option>
                                    @foreach($metodosPago as $metodo)
                                        <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <input type="text" name="estado" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_entrega">Fecha de Entrega</label>
                                <input type="date" name="fecha_entrega" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion_entrega">Dirección de Entrega</label>
                                <textarea name="direccion_entrega" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Guardar Venta</button>
                                <a href="{{ route('venta.index') }}" class="btn btn-info btn-block">Atrás</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection