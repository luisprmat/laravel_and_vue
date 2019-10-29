<!doctype html>
<html lang="es">
    <head>
        <title>Módulo notas - Vue</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{ url('css/all.min.css') }}">

        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ url('css/style.css') }}">
    </head>
    <body>
        <div id="app" class="container col-md-8">
            @yield('content')
        </div>

        @yield('scripts')
    </body>
</html>
