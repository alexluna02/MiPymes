@extends('plantilla.plantillalogin')
@section('content')
    <div class="login-container">
        <div class="login-header">
            <h3>Registro de Usuario</h3>
        </div>
        <div class="table-container">
            <form method="POST" action="{{ route('validar-registro') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                <a href="/login" class="btn btn-danger btn-primary btn-block">Regresar</a>
            </form>
        </div>
    </div>
@endsection
