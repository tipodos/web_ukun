<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <header>
        <nav>
            <h1>logo</h1>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Productos</a></li>
                <li><a href="">Nosotros</a></li>
                <li><a href="">Contactos</a></li>
                <li><a href=""><img src="{{ asset('css/carrito.png') }}" alt="" width="25px"></a></li>
            </ul>
        </nav>
    </header>
   @yield('contenido')
</body>
</html>