<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/menu_lateral.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/cdn_Bootrap.min.css') }}" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    @yield('estilos')
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details mt-4 mb-2">
            <a href="{{ route('home') }}" class="mt-4 pt-5" style="text-decoration: none;">
                <img src="{{ asset('images/LogoProfesional.png') }}" class="mx-4" alt="Logo de Sistemas"
                    style="max-width: 30px;">
                <span class="logo_name" style="color: white; text-decoration: none;">DST-MC</span>
            </a>
        </div>
        <ul class="nav-links">


            @if (auth()->user()->modules->contains('IdModulo', 1))
                <li>
                    <div class="iocn-link">
                        <a href="{{ route('ModuloClientes.index') }}">
                            <i class='bx bx-user'></i>
                            <span class="link_name">M. Clientes</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
                        <li><a href="{{ route('notas.index') }}">Notas</a></li>
                        <li><a href="{{ route('cotizaciones.index') }}">Cotizaciones</a></li>
                        <li><a href="{{ route('ventas.index') }}">Venta</a></li>

                    </ul>
                </li>
            @endif


            @if (auth()->user()->modules->contains('IdModulo', 2))
                <li>
                    <div class="iocn-link">
                        <a href="{{route('ModuloAlmacen.index')}}">
                            <i class='bx bx-vector'></i>
                            <span class="link_name">M. Almacén</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a href="{{route('almacenes.index')}}">Almacenes</a></li>
                        <li><a href="{{route('movimientos.index')}}">Movimientos</a></li>
                        <li><a href="{{route('inventario.consulta')}}">Consulta Inventario</a></li>

                    </ul>
                </li>
            @endif

            @if (auth()->user()->modules->contains('IdModulo', 3))
                <li>
                    <a href="{{ route('proveedores.index') }}">
                        <i class='bx bx-pie-chart-alt-2'></i>
                        <span class="link_name">M. Proveedores </span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="{{ route('proveedores.index') }}">Proveedores</a></li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->modules->contains('IdModulo', 4))
                <li>
                    <a href="{{ route('productos.index') }}">
                        <i class='bx bx-package'></i>
                        <span class="link_name">M. Productos </span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="{{ route('productos.index') }}">Productos/Servicios </a></li>
                    </ul>
                </li>
            @endif


            <li>
                <a href="#" onclick="document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out exit'></i>
                    <span class="link_name">Cerrar Sesion</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>


                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="#" onclick="document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <li>

            </li>
        </ul>
    </div>


    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>
        <h1 class="titulo mb-2"> @yield('subtitulo') </h1>

        @yield('contenido')


    </section>





    <script src="{{ asset('js/menu_lateral.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    @yield('js')


    <footer>
        <p>&copy; 2023 For International System. Todos los derechos reservados. V. 1.0</p>
        </p>
    </footer>

</body>

</html>
