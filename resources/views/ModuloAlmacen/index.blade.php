@extends('layaout.plantilla')

@section('titulo', 'Modulo Almacén')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/index.css') }}" type="text/css">
@endsection

@section('subtitulo', 'Modulo de almacén')

@section('contenido')


    <div class="fila container-fluid  mt-5">


        <a href="{{route('almacenes.index')}}" class="botones">
            <i class='bx bx-vector'></i>
            <span>Almacenes</span>
        </a>

        <a href="{{route('movimientos.index')}}" class="botones">
            <i class='bx bx-notepad'></i>
            <span>Movimientos</span>
        </a>

        <a href="{{route('inventario.consulta')}}" class="botones">
            <i class='bx bx-notepad'></i>
            <span>Consulta Inventario</span>
        </a>
    </div>


    

    


@endsection
