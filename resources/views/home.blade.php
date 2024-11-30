@extends('layout')
@section('title')
Home
@endsection
@section('content')
<h1>Home</h1>
<h1>Examen Grupal</h1>
<h2>Nombre: Michael Serrano</h2>
<!--Bienvenido {{ $nombre ?? "Invitado" }}-->
Bienvenido {{ $nombre ?? "Michael Serrano" }}
@endsection