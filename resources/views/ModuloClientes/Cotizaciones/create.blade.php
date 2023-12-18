@extends('layaout.plantilla')

@section('titulo', 'Nueva Cotización')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Tabla_base.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

@endsection

@section('subtitulo', 'Nueva Cotización')

@section('contenido')

    <div class="container-fluid">


        <h5 class="mt-4 px-5"><strong>Datos generales </strong></h5>
        <p class="text-danger px-5">*Las cotizaciones son vigentes por 5 días* </p>
        <form action="#" autocomplete="off" method="POST" enctype="multipart/form-data" id="formulario" class="mx-5">
            @csrf
            <div class="row mt-3">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                    <label for="Folio">Folio </label>
                    <input type="text" class="form-control costo-proveedor" readonly id="Folio" name="Folio"
                        value="{{ $Folio }}">

                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <label for="IdAlmacen">Almacén </label>
                    <select name="IdAlmacen" id="IdAlmacen" class="form-control text-center">
                        <option value="" disabled selected> --Seleccione el almacen--</option>
                        @foreach ($Almacenes as $almacen)
                            <option value="{{ $almacen->IdAlmacen }}"> {{ $almacen->NombreAlmacen }} </option>
                        @endforeach
                    </select>
                    <div id="ErrorAlmacen"></div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <label for="FechaCotizacion">Fecha Movimiento </label>
                    <input type="text" class="form-control costo-proveedor" id="FechaCotizacion" name="FechaCotizacion"
                        readonly>

                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <label for="NombreElaborador">Elaboro: </label>
                    <input type="text" class="form-control" id="NombreElaborador" value="{{ $user->name }}"
                        name="NombreElaborador" readonly>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="IdCliente">Cliente </label>
                    <select name="IdCliente" id="IdCliente" class="form-control text-center">
                        <option value="" disabled selected> --Seleccione el cliente--</option>
                        @foreach ($Clientes as $Cliente)
                            <option value="{{ $Cliente->IdCliente }}"> {{ $Cliente->NombreCompleto }} </option>
                        @endforeach
                    </select>
                    <div id="ErrorCliente"></div>
                </div>


                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <label for="Descuento">¿Algún descuento? </label>
                    <input type="text" class="form-control" id="Desc" value="0" name="Desc">
                    <input type="text" class="form-control" id="Descuento" value="0" hidden name="Descuento">
                    </select>
                    <div id="ErrorDescuento"></div>
                </div>

            </div>




            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <button id="Agregar-Producto" class="botones mt-4">
                        <i class='bx bx-comment-add'></i>
                        <span>Nuevo producto</span>
                    </button>
                    <button id="Enviar-Cotizacion" class="botones mt-4">
                        <i class='bx bxs-send'></i>
                        <span>Enviar</span>
                    </button>
                </div>
            </div>


            <div id="obtenerProductosAlmacen" data-url="{{ route('movimientos.obtenerProductosAlmacen') }}"></div>
            <div id="ObtenerDetallesProductosAlmacen"
                data-url="{{ route('movimientos.ObtenerDetallesProductosAlmacen') }}"></div>
<div id="PDFShow"
                data-url="{{ route('cotizaciones.pdfCotizacion') }}"></div>
            <div id="EnviarFormularioAjax" data-url="{{ route('cotizaciones.store') }}"></div>
            <div class="table-responsive mt-4 mx-4 mb-2" style="max-height: 250px; overflow-y: auto;">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center" style="width: 250px">Clave</th>
                            <th class="text-center">Unidad</th>
                            <th class="text-center">Existencias</th>
                            <th class="text-center" style="width: 150px">Cantidad</th>
                            <th class="text-center">Costo </th>
                            <th class="text-center" style="width: 150px">SubTotal</th>
                            <th class="text-center">Acciones </th>

                        </tr>
                    </thead>
                    <tbody id="tabla-productos-cotizar">


                    </tbody>



                </table>
            </div>

            <div class="container px-4 text-center mt-2">
                <div class="table-responsive " style="max-width: 250px; margin-left: auto; margin-right: 0;">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="text-center">SubTotal</th>
                                <th class="text-center"> <input type="text" id='SubtotalOficial' value="0"
                                        class="form-control text-center" readonly name="SubtotalOficial">
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">IVA (16%)</th>
                                <th class="text-center"><input type="text" id='IVATotal' value="0"
                                        class="form-control text-center" readonly name="IVATotal"></th>
                            </tr>
                            <tr>
                                <th class="text-center"><strong>Total </strong></th>
                                <th class="text-center"><input type="text" id='TotalCompra' value="0"
                                        class="form-control text-center" readonly name="TotalCompra"> </th>
                            </tr>
                            <tr>
                                <th class="text-center">Tola con Descuento</th>
                                <th class="text-center"><input type="text" id='DescuentoTotal' value="0"
                                        class="form-control text-center" readonly name="DescuentoTotal"></th>
                            </tr>
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

    <div class="modal fade modal-custom" id="Congratulations" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Éxito en
                            el proceso</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('images/exito.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                        style="max-width: 150px;">
                    <p>Se ha guardado con éxito la cotización </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="imprimirBtn">Imprimir Cotización</button>
                    <button type="button" class="btn btn-secondary" id="CerrarBTN" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
        <a href="{{ route('cotizaciones.index') }}">
            <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
            </div>
        </a>
    </div>


@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/ModuloClientes/Cotizacion.js') }}"></script>
@endsection
