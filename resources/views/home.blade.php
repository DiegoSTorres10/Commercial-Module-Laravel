@extends('layaout.plantilla')

@section('titulo', 'ERP')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/index.css') }}" type="text/css">
@endsection

@section('subtitulo', 'Gestión Comercial DST')

@section('contenido')

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="fila container-fluid  mt-5">
        @php
            $count = 0;
        @endphp

        @if (auth()->user()->modules->contains('IdModulo', 1))

            @if ($count == 3)
    </div>
    <div class="fila container-fluid  mt-5">
        @endif
        <a href="{{ route('ModuloClientes.index') }}" class="botones">
            <i class='bx bxs-user'></i>
            <span>Modulo de Clientes</span>
        </a>
        @php
            $count++;
        @endphp
        @endif


        @if (auth()->user()->modules->contains('IdModulo', 2))
            @if ($count == 3)
    </div>
    <div class="fila container-fluid  mt-5">
        @endif
        <a href="{{ route('ModuloAlmacen.index') }}" class="botones ">
            <i class='bx bx-vector'></i>
            <span>Módulo de Almacen</span>
        </a>
        @php
            $count++;
        @endphp
        @endif


        @if (auth()->user()->modules->contains('IdModulo', 3))
            @if ($count == 3)
    </div>
    <div class="fila container-fluid  mt-5">
        @endif
        <a href="{{ route('proveedores.index') }}" class="botones">
            <i class='bx bx-store'></i>
            <span>Módulo de Proveedores</span>
        </a>
        @php
            $count++;
        @endphp
        @endif

        @if (auth()->user()->modules->contains('IdModulo', 4))
            @if ($count == 3)
    </div>
    <div class="fila container-fluid  mt-5">
        @endif
        <a href="{{ route('productos.index') }}" class="botones">
            <i class='bx bx-package'></i>
            <span>Módulo de Productos </span>
        </a>
        @php
            $count++;
        @endphp
        @endif
    </div>



@endsection
