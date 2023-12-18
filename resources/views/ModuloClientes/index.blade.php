@extends('layaout.plantilla')

@section('titulo', 'Index')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/index.css') }}" type="text/css">
@endsection

@section('subtitulo', 'Modulo de clientes')

@section('contenido')


    <div class="fila container-fluid  mt-5">


        <a href="{{route('clientes.index')}}" class="botones">
            <i class='bx bxs-user'></i>
            <span>Clientes</span>
        </a>

        <a href="{{route('notas.index')}}" class="botones">
            <i class='bx bx-notepad'></i>
            <span>Seguimiento Notas</span>
        </a>

        <a href="{{route('cotizaciones.index')}}" class="botones">
            <i class='bx bx-notepad'></i>
            <span>Cotizaciones</span>
        </a>
    </div>

    <div class="fila container-fluid  mt-5">


        <a href="{{route('ventas.index')}}" class="botones">
            <i class='bx bx-store'></i>
            <span>Ventas</span>
        </a>

    </div>




@endsection
