@extends('layaout.plantilla')

@section('titulo', 'Catálogo de productos')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">


    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>
    
@endsection

@section('subtitulo', 'Catálogo de productos')

@section('contenido')

    <div class="container-fluid">

        @if(session()->has('update_Producto'))
            <div class="alert alert-primary">
                {!! session()->get('update_Producto') !!}
            </div>
        @elseif (session()->has('create_nota'))
            <div class="alert alert-success">
                {!! session()->get('create_nota') !!}
            </div>
        @elseif (session()->has('delete_Producto'))
            <div class="alert alert-secondary">
                {{ session('delete_Producto') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif

        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <a href="{{ route('productos.create') }}" class="botones">
                    <i class='bx bx-comment-add'></i>
                    <span>Nuevo producto/servicio</span>
                </a>
                <a href="{{ route('productos.reporte') }}" target="_blank" class="botones pt-3">
                    <i class='bx bxs-report'></i>
                    <span>Reporte</span>
                </a>
            </div>
        </div>
        

        @livewire('productos-servicio-table')

        
    </div>

    
    

@endsection

@section('js')
    @livewireScripts
@endsection
