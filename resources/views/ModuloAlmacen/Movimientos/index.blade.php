@extends('layaout.plantilla')

@section('titulo', 'Movimientos')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">


@endsection

@section('subtitulo', 'Movimientos')

@section('contenido')

    <div class="container-fluid">

        @if (session()->has('update_almacen'))
            <div class="alert alert-primary">
                {!! session()->get('update_almacen') !!}
            </div>
        @elseif (session()->has('delete_almacen'))
            <div class="alert alert-secondary">
                {{ session('delete_almacen') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('url_pdf'))
            {{-- Script JavaScript para abrir automáticamente el modal --}}
            <script>
                // Espera 1 segundo (ajusta según sea necesario)
                setTimeout(function() {
                    // Abre automáticamente el modal
                    $('#autoOpenModal').modal('show');
                }, 1000); // 1000 milisegundos = 1 segundo

                // Función para abrir el enlace al PDF
                function verReporte() {
                    // Cambiar la URL según tu lógica
                    var urlPdf = "{{ session('url_pdf') }}";

                    // Abrir la nueva pestaña
                    window.open(urlPdf, "_blank");

                    // Cerrar el modal
                    $('#autoOpenModal').modal('hide');
                }
            </script>

            {{-- Elimina la variable de sesión después de usarla --}}
            {{ session()->forget('url_pdf') }}
        @endif


        <div class="modal fade" id="autoOpenModal" tabindex="-1" aria-labelledby="autoOpenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="autoOpenModalLabel">Confirmar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="fs-5">¿Desea ver el reporte creado del movimiento registrado con anterioridad?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="verReporte()">Sí</button>
                    </div>
                </div>
            </div>
        </div>



        <h5 class="mt-4 px-5"><strong>Datos generales </strong></h5>
        <form action="{{ route('movimientos.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data"
            id="formulario" class="mx-5">
            @csrf
            <div class="row mt-3">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <label for="Folio">Folio </label>
                    <input type="text" class="form-control costo-proveedor" readonly id="Folio" name="Folio"
                        value="{{ $Folio }}">
                    @error('Folio')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                    <label for="Almacen">Almacén </label>
                    <select name="Almacen" id="Almacen" class="form-control text-center">
                        <option value="" disabled selected> --Seleccione el almacen--</option>
                        @foreach ($Almacenes as $almacen)
                            @if ($almacen->IdAlmacen == old('Almacen'))
                                <option value="{{ $almacen->IdAlmacen }}" selected> {{ $almacen->NombreAlmacen }} </option>
                            @else
                                <option value="{{ $almacen->IdAlmacen }}"> {{ $almacen->NombreAlmacen }} </option>
                            @endif
                        @endforeach
                    </select>
                    @error('Almacen')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-xl- col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="FechaMovimiento">Fecha Movimiento </label>
                    <input type="text" class="form-control costo-proveedor" id="FechaMovimiento" name="FechaMovimiento"
                        readonly>
                    @error('FechaMovimiento')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div id="consulta-razones" data-url="{{ route('movimientos.consulta_razones') }}"></div>
            <div class="row mt-3">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">

                    <label for="Tipo">Tipo *</label>
                    <select name="Tipo" id="Tipo" class="form-control text-center">
                        <option value="" disabled selected> --Seleccione el tipo movimiento--</option>
                        @foreach ($TipoMovimiento as $tipo)
                            @if ($tipo->IdTipo == old('Tipo'))
                                <option value="{{ $tipo->IdTipo }}" selected> {{ $tipo->TipoMovimiento }} </option>
                            @else
                                <option value="{{ $tipo->IdTipo }}"> {{ $tipo->TipoMovimiento }} </option>
                            @endif
                        @endforeach
                    </select>
                    @error('Tipo')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                    <label for="Razon">Razón * </label>
                    <select name="Razon" id="Razon" class="form-control text-center">
                        <option value="" disabled selected> --Seleccione la razón--</option>

                    </select>
                    @error('Razon')
                        <span class="invalid-feedback" role="alert"
                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


            </div>

            <div id='EntradaDiv' class="d-none">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <button id="agregar-producto" class="botones mt-4">
                            <i class='bx bx-comment-add'></i>
                            <span>Nuevo producto</span>
                        </button>
                        <button id="Enviar-Entrada" class="botones mt-4">
                            <i class='bx bx-comment-add'></i>
                            <span>Enviar</span>
                        </button>
                    </div>
                </div>
                <div id="ObtenerProductos" data-url="{{ route('movimientos.obtenerProductos') }}"></div>
                <div id="ObtenerDetallesProductos" data-url="{{ route('movimientos.ObtenerDetallesProductos') }}"></div>



                <div class="table-responsive mt-4 mx-4" style="max-height: 150px; overflow-y: auto;">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center" style="width: 250px">Clave</th>
                                <th class="text-center">Unidad</th>
                                <th class="text-center" style="width: 150px">Cantidad</th>
                                <th class="text-center">Costo </th>
                                <th class="text-center">Acciones </th>

                            </tr>
                        </thead>
                        <tbody id="tabla-productos">


                        </tbody>

                    </table>
                </div>
            </div>

            <div id="SalidaDiv" class="d-none">

                <div id="obtenerProductosAlmacen" data-url="{{ route('movimientos.obtenerProductosAlmacen') }}"></div>
                <div id="ObtenerDetallesProductosAlmacen"
                    data-url="{{ route('movimientos.ObtenerDetallesProductosAlmacen') }}"></div>


                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <button id="Eliminar-Producto" class="botones mt-4">
                            <i class='bx bx-comment-add'></i>
                            <span>Nuevo producto</span>
                        </button>
                        <button id="Enviar-Salida" class="botones mt-4">
                            <i class='bx bx-comment-add'></i>
                            <span>Enviar</span>
                        </button>
                    </div>
                </div>

                <div class="table-responsive mt-4 mx-4 " style="max-height: 150px; overflow-y: auto;">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center" style="width: 250px">Clave</th>
                                <th class="text-center">Unidad</th>
                                <th class="text-center">Existencias</th>
                                <th class="text-center" style="width: 150px">Cantidad</th>
                                <th class="text-center">Costo </th>
                                <th class="text-center">Acciones </th>

                            </tr>
                        </thead>
                        <tbody id="tabla-productos_eliminar">


                        </tbody>

                    </table>
                </div>
            </div>






        </form>
    </div>


    <div class="modal fade modal-custom" id="Error" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Se ha
                            producido un error</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/error.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                        style="max-width: 150px;">
                    <p> </p>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')
    <script src="{{ asset('js/ModuloAlmacen/movimientos.js') }}"></script>
@endsection
