<!-- Para extender desde la base -->
@extends('layouts.base')

<!-- Definimos la sección-->
@section('styles')
<link rel="stylesheet" href="{{ asset('css/login/css/login.css') }}">

@endsection 

@section('title', 'Crear cuenta')
@section('content')


<form method="POST" class="form" action="{{ route('register') }}" novalidate>
    <!-- Como esto es un formulario, debemos definir un token de verificación --> 
    @csrf
    <h2>Crear cuenta</h2>
    <div class="content-login">
        <div class="input-content">
            <!-- old quiere decir que si ocurre un error, evita que el campo ingresado desaparezca --> 
            <input type="text" name="full_name" placeholder="Nombre completo"
                value="{{ old('full_name') }}" 
                autofocus>
            <!-- Esto es para definir los mensajes de error --> 

            @error('full_name')
            <span class="alert-red">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="text" name="email" placeholder="Correo eléctronico"
                value="{{ old('email')}}" 
                autofocus>

            @error('email')
            <span class="alert-red">
                <span>{{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password" placeholder="Contraseña">

            @error('password')
            <span class="text-danger">
                <span>* {{ $message }}</span>
            </span>
            @enderror

        </div>

        <div class="input-content">
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña">
        </div>
    </div>

    <input type="submit" value="Registrarse" class="button">
    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="link">Iniciar sesión</a></p>
</form>

@endsection

<!-- Las rutas están defininidas por Laravel después de haber ejecutado el método de autenticación. 
Las rutas se encuentran en vendor/laravel/ui/scr/AuthRouteMethods.php --> 