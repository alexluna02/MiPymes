@extends('plantilla.plantilla')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-info">
                {{Session::get('success')}}
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Actualizar Registro</h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <form method="POST" action="{{ route('mantenimientomaquinaria.update',$mantenimientomaquinaria->id) }}" role="form">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="producto_id" id="producto_id" value="{{$mantenimientomaquinaria->producto_id}}" class="form-control input-sm" placeholder="producto id ">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="venta_id" id="venta_id" value="{{$mantenimientomaquinaria->venta_id}}" class="form-control input-sm" placeholder="id venta">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="date" name="fecha_mantenimiento" class="form-control input-sm" value="{{$mantenimientomaquinaria->fecha_mantenimiento}}" placeholder="fecha mantenimiento">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="tipo_mantenimiento" id="tipo_mantenimiento" value="{{$mantenimientomaquinaria->tipo_mantenimiento}}" class="form-control input-sm" placeholder="tipo mantenimiento">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <textarea name="descripcion" class="form-control input-sm"  placeholder="Descripcion...">{{$mantenimientomaquinaria->descripcion}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="costo" class="form-control input-sm" value="{{$mantenimientomaquinaria->costo}}" placeholder="costo">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="estado_post_mantenimiento" id="estado_post_mantenimiento" value="{{$mantenimientomaquinaria->estado_post_mantenimiento}}" class="form-control input-sm" placeholder="Estado">
                                    </div>
                                </div>


                            </div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="submit" value="Actualizar" class="btn btn-success btn-block">
                            <a href="{{ route('mantenimientomaquinaria.index') }}" class="btn btn-info btn-block">Atrás</a>
                        </div>

                    </div>
                    </form>
                </div>
            </div>

        </div>
</div>
</section>
@endsection