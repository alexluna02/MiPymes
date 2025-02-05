@extends('plantilla.plantilla')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-6 col-md-offset-3">
            
            @if(Session::has('success'))
            <div class="alert alert-info">
                {{Session::get('success')}}
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nuevo Cliente</h3>
                </div>
                <div class="panel-body">
                    <div class="table-container">
                        <form method="POST" action="{{ route('cliente.store') }}"  role="form">
                            {{ csrf_field() }}
                            <div class="row">
                               <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="cedula" id="cedula" class="form-control input-sm" placeholder="Cedula" value="{{ old('cedula') }}">
                                        @error('cedula')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre del cliente" value="{{ old('nombre') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-13 col-sm-13 col-md-13">
                                    <div class="form-group">
                                        <input type="text" name="direccion" id="direccion" class="form-control input-sm" placeholder="Direccion del Cliente" value="{{ old('direccion') }}">
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="telefono" id="telefono" class="form-control input-sm" placeholder="Telefono del cliente" value="{{ old('telefono') }}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Email del cliente" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('cliente.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
