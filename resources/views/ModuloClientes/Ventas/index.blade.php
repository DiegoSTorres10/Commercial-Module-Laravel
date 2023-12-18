@extends('layaout.plantilla')

@section('titulo', 'Ventas')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloAlmacen/Inventario.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">


    <link rel="stylesheet" href="{{ asset('css/LiveWire.css') }}" type="text/css">
    @livewireStyles
    <script src="https://kit.fontawesome.com/2e1b023ca0.js" crossorigin="anonymous"></script>


@endsection

@section('subtitulo', 'Ventas')

@section('contenido')

    <div class="container-fluid">

        @if (session()->has('update_nota'))
            <div class="alert alert-primary">
                {!! session()->get('update_nota') !!}
            </div>
        @elseif (session()->has('create_nota'))
            <div class="alert alert-success">
                {!! session()->get('create_nota') !!}
            </div>
        @elseif (session()->has('delete_nota'))
            <div class="alert alert-secondary">
                {{ session('delete_nota') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif

        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <a  class="botones boton-izquierda" data-bs-toggle="modal"
                    data-bs-target="#modalNuevaVenta">
                    <i class='bx bx-comment-add'></i>
                    <span>Nueva Venta</span>
                </a>

            </div>
        </div>

        @livewire('ventas')
        @livewireScripts


    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalNuevaVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Nueva Venta</strong></h5>
                    <button type="button" class="btn-close" id='CerrarIcono' data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Formulario" novalidate autocomplete="off" method="POST" action="{{route('ventas.create')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="Almacen" class="form-label">Almacen</label>

                            <select name="Almacen" id="Almacen" class="form-control text-center">
                                <option value="" selected disabled>--Almacen--</option>
                                @foreach ($Almacenes as $Almacen)
                                    <option value="{{ $Almacen->IdAlmacen }}">{{ $Almacen->NombreAlmacen }}</option>
                                @endforeach
                            </select>
                            <div id="ErrorAlmacen" class="text-center"></div>
                            @error('Almacen')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror 

                        </div>
                        <div class="mb-3">
                            <label for="Fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control text-center" readonly id="Fecha" name="Fecha">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <!-- Botones de enviar y cerrar -->
                   
                    <button type="button" id='CerrarBtn' class="btn boton3" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id='Enviar' class="btn boton2">Seleccionar</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')


    <script>
        $(document).ready(function() {


            var FechaAlta = $('#Fecha')
            var today = new Date();
            var year = today.getFullYear();
            var month = String(today.getMonth() + 1).padStart(2, '0');
            var day = String(today.getDate()).padStart(2, '0');

            FechaAlta.val(year + '-' + month + '-' + day);

            $('#CerrarBtn').on('click', () => {
                $('#Almacen').val('')
            })

            $('#CerrarIcono').on('click', () => {
                $('#Almacen').val('')
            })

            $('#Enviar').on('click',  (e) => {
                e.preventDefault();
                if ($('#Almacen').val() == null){

                    $('#ErrorAlmacen').text('No puedes dejar en blanco el almacén').css('color', 'red');
                    return
                }
                $('#ErrorAlmacen').text('')
                $('#Formulario').submit();

            })



        });
    </script>
@endsection
