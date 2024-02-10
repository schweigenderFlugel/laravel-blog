<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('img/icono.ico') }}">

    <!-- Estilos de bootstrap. Mix hace que sea fácil compilar y minimizar los archivos css y javascript de la aplicación
        Véase los archivos en resources/app.css resources/app.js --> 
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Estilos css generales. Asset porque son archivos independientes que se encuentran en la carpeta public. 
        No son archivos extensos como el archivo app.css o app.js -->
    <link href="{{ asset('css/base/css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/css/footer.css') }}" rel="stylesheet">

    <!-- Estilos cambiantes. Esto sirve para reservar un espacio determinado en la plantilla base para unos estilos -->
    @yield('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Para que el título también sea cambiante --> 
    <title>@yield('title')</title>
</head>

<body>

    <div class="content">
        <!-- Incluir menú -->
        @include('layouts.menu')

        <section class="section">
           @yield('content')
        </section>

        <!-- Incluir footer -->
        @include('layouts.footer')
    </div>

    @yield('scripts')
    <!-- Scripts de bootstrap -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>