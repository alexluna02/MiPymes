@extends('plantilla.plantillalogin')
@section('content')
    <div class="login-container">
        <div class="login-header">
            <h3>Login de Usuario</h3>
        </div>
        <form method="POST" action="{{ route('iniciar-sesion') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a href="/registro" class="btn btn-danger btn-primary btn-block" >Registrar</a>
        </form>
    </div>
@endsection
