@extends('layaout.plantilla')

@section('titulo', 'Catálogo productos')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ModuloClientes/Botones.css') }}" type="text/css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@endsection

@section('subtitulo', 'Actualizar producto ')

@section('contenido')



    <div class="container mt-3">

        @if (session()->has('update_Proveedor'))
            <div class="alert alert-primary">
                {!! session()->get('update_Proveedor') !!}
            </div>
        @elseif (session()->has('delete_Proveedor'))
            <div class="alert alert-secondary">
                {{ session('delete_Proveedor') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-secondary">
                {{ session('error') }}
            </div>
        @endif


        <h4 class="mt-4"><strong>Información del producto</strong></h4>

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                    <path d="M15 9h.01" />
                </svg>

                <label for="ClaveProducto">Clave </label>
                <input type="text" class="form-control mt-1 px-3" readonly id='ClaveProducto' name='ClaveProducto'
                    readonly value="{{ $Producto->ClaveProducto }}">
                @error('ClaveProducto')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 21l18 0" />
                    <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                    <path d="M5 21l0 -10.15" />
                    <path d="M19 21l0 -10.15" />
                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                </svg>

                <label for="Nombre">Nombre*</label>
                <input type="text" class="form-control mt-1 px-3" id='Nombre' readonly name='Nombre'
                    value="{{ $Producto->Nombre }}">
                @error('Nombre')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-baseline-density-large"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4h16" />
                    <path d="M4 20h16" />
                </svg>

                <label for="IdTipo">Tipo </label>
                <input type="text" class="form-control mt-1 px-3" id='IdTipo' name='IdTipo' readonly
                    value="{{ $Producto->tipoSerProductos->Tipo }}">
                @error('IdTipo')
                    <span class="invalid-feedback" role="alert"
                        style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="d-sm-flex justify-content-between">
                <button class="botones" id="AgregarDistribuidor">
                    <i class='bx bx-comment-add'></i>
                    <span>Nuevo distribuidor</span>
                </button>
                <a href="{{ route('productos.edit', $Producto) }}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                        <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>
            </div>
        </div>


        {{-- ==============Modal para el error de seleccion de alguna lista  --}}
        <div class="modal fade modal-custom " id="FormularioModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                <div class="modal-content pt-1 pb-5 bg-black" style="background-color: #FDF4F5;">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Nuevo
                                distribuidor</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <form action="" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                    <label for="FechaCotizacion">Fecha Cotización</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="FechaCotizacion"
                                            value="{{ old('FechaCotizacion') }}" name="FechaCotizacion" />
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                            data-toggle="datepicker">
                                            <i class="bi bi-calendar"></i>
                                        </button>
                                    </div>
                                    @error('FechaCotizacion')
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>

                                        </span>
                                    @enderror
                                    <div id="ErrorFecha"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                    <label for="IdProveedor">Proveedor* </label>
                                    <select name="IdProveedor" class="form-control text-center" id="IdProveedor">
                                        <option value="" selected disabled> --Seleccione el proveedor-- </option>
                                        @foreach ($Proveedores as $pro)
                                            @if ($pro->IdProveedor == old('IdProveedor'))
                                                <option value="{{ $pro->IdProveedor }}" selected>
                                                    {{ $pro->NombreComercial }}</option>
                                            @else
                                                <option value="{{ $pro->IdProveedor }}">{{ $pro->NombreComercial }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('IdProveedor')
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="ErrorProveedor"></div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                                    <label for="CostoProveedor">Costo Proveedor* </label>
                                    <input type="text" class="form-control" id="CostoProveedor" name="CostoProveedor"
                                        value="{{ old('ClaveProducto') }}">

                                    @error('CostoProveedor')
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="ErrorCosto"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                                    <label for="IdTipoMoneda" class="mx-4">Tipo Moneda* </label>
                                    <select name="IdTipoMoneda" class="form-control text-center" id="IdTipoMoneda">
                                        <option value="" selected disabled> --Seleccione el tipo de moneda--
                                        </option>
                                        @foreach ($TiposMoneda as $tm)
                                            @if ($tm->IdTipoMoneda == old('IdTipoMoneda'))
                                                <option value="{{ $tm->IdTipoMoneda }}" selected>{{ $tm->TipoMoneda }} --
                                                    [{{ $tm->IdTipoMoneda }}]</option>
                                            @else
                                                <option value="{{ $tm->IdTipoMoneda }}">{{ $tm->TipoMoneda }} --
                                                    [{{ $tm->IdTipoMoneda }}]
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('IdTipoMoneda')
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="ErrorMoneda"></div>
                                </div>
                            </div>

                            <div class="row text-center mt-4">
                                <div class="col-12">
                                    <label for="Seleccionado">Seleccionar distribuidor</label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-center">
                                    <input type="radio" name="Seleccionado" id="siSeleccionado" value="1"
                                        class="mx-2"> Si
                                    <input type="radio" name="Seleccionado" id="noSeleccionado" value="0"
                                        class="mx-2"> No
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12" id="ErrorRadio"></div>
                            </div>


                            <a href="">
                                <div class="text-center mt-3 mx-4 flex-fill">
                                    <button class="boton2 mx-auto btn-block " type="button"
                                        id="EnviarFomulario">Agregar</button>
                                </div>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>





        @foreach ($Producto->proveedores as $proveedor)
            @if ($proveedor->pivot->ProveedorSeleccionado == true)
                <div class="border border-3 border-primary mt-3 mb-3">
                    <div class="mx-4 mb-3">
                        <h4 class="mt-2 px-2"><strong>Información del proveedor seleccionado </strong></h4>
                        <form action="{{ route('productosProveedores.updateProductoProveedor', $Producto) }}"
                            method="POST" autocomplete="off" id="formulario-proveedor-{{ $proveedor->IdProveedor }}">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                    <label for="FechaCotizacion">Fecha Cotización</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control fecha-cotizacion"
                                            id="FechaCotizacionRegister" value="{{ $proveedor->pivot->FechaCotizacion }}"
                                            name="FechaCotizacionRegister_{{ $proveedor->IdProveedor }}" />
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                            data-toggle="datepicker1">
                                            <i class="bi bi-calendar"></i>
                                        </button>
                                    </div>
                                    @error('FechaCotizacionRegister_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="FechaCotizacionRegister"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                    <label for="ProveedorRegister">Proveedor </label>
                                    <input type="text" id="IdProveedorRegister" name="IdProveedorRegister"
                                        value="{{ $proveedor->IdProveedor }}" hidden>
                                    <input type="text" class="form-control mt-1 px-3" id='ProveedorRegister'
                                        name='ProveedorRegister_{{ $proveedor->IdProveedor }}' readonly
                                        value="{{ $proveedor->NombreComercial }}">
                                    @error('ProveedorRegister_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="ProveedorRegister"></div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                                    <label for="CostoProveedorRegister">Costo Proveedor* </label>
                                    <input type="text" class="form-control costo-proveedor"
                                        id="CostoProveedorRegister"
                                        name="CostoProveedorRegister_{{ $proveedor->IdProveedor }}"
                                        value="${{ $proveedor->pivot->CostoProveedor }}">
                                    <input type="text" class="form-control costo-proveedor-bueno" hidden
                                        id="CostoProveedor" name="CostoProveedor_{{ $proveedor->IdProveedor }}"
                                        value="">

                                    @error('CostoProveedor_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="CostoProveedorBueno"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                                    <label for="IdTipoMonedaRegister" class="mx-4">Tipo Moneda* </label>
                                    <select name="IdTipoMoneda_{{ $proveedor->IdProveedor }}"
                                        class="form-control text-center" id="IdTipoMonedaRegister">
                                        <option value="" selected disabled> --Seleccione el tipo de moneda--
                                        </option>
                                        @foreach ($TiposMoneda as $tm)
                                            @if ($tm->IdTipoMoneda == $proveedor->pivot->IdTipoMoneda)
                                                <option value="{{ $tm->IdTipoMoneda }}" selected>{{ $tm->TipoMoneda }} --
                                                    [{{ $tm->IdTipoMoneda }}]</option>
                                            @else
                                                <option value="{{ $tm->IdTipoMoneda }}">{{ $tm->TipoMoneda }} --
                                                    [{{ $tm->IdTipoMoneda }}]
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('IdTipoMonedaRegister_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="IdTipoMonedaRegister"></div>
                                </div>
                            </div>

                            <div class="row text-center mt-4">
                                <div class="col-12">
                                    <label for="SeleccionadoRegister">Seleccionar distribuidor</label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-center">
                                    <input type="radio" name="SeleccionadoRegister" id="siSeleccionado" value="1"
                                        class="mx-2"> Si
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12" id="ErrorRadio"></div>
                            </div>


                            <a href="">
                                <div class="text-center mt-3 mx-4 flex-fill">
                                    <button class="boton2 mx-auto btn-block " type="submit"
                                        id="EnviarFomulario">Actualizar</button>
                                </div>
                            </a>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach


        @foreach ($Producto->proveedores as $proveedor)
            @if ($proveedor->pivot->ProveedorSeleccionado != true)
                <div class="mt-3 mb-2 border border-3 border-secondary ">
                    <div class="mx-4 mb-3">
                        <div class="container-fluid mt-4">
                            <div class="d-sm-flex justify-content-between">
                                <h4 class="mt-2 px-2"><strong>Información del proveedor </strong></h4>
                                <div class="text-end mx-4 mb-1 mt-1 flex-fill">
                                    <form
                                        action="{{ route('productosProveedores.destroyProductoProveedor', [$Producto, $proveedor->IdProveedor]) }}"
                                        method="POST" id="form_delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="badge rounded bg-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este distribuidor?')">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash-filled" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z"
                                                    stroke-width="0" fill="currentColor" />
                                                <path
                                                    d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"
                                                    stroke-width="0" fill="currentColor" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('productosProveedores.updateProductoProveedor', $Producto) }}"
                            method="POST" autocomplete="off" id="formulario-proveedor-{{ $proveedor->IdProveedor }}">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                    <label for="FechaCotizacion">Fecha Cotización</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control fecha-cotizacion"
                                            id="FechaCotizacionRegister" value="{{ $proveedor->pivot->FechaCotizacion }}"
                                            name="FechaCotizacionRegister_{{ $proveedor->IdProveedor }}" />
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                            data-toggle="datepicker1">
                                            <i class="bi bi-calendar"></i>
                                        </button>
                                    </div>
                                    @error('FechaCotizacionRegister_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="FechaCotizacionRegister"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                    <label for="ProveedorRegister">Proveedor </label>
                                    <input type="text" id="IdProveedorRegister" name="IdProveedorRegister"
                                        value="{{ $proveedor->IdProveedor }}" hidden>
                                    <input type="text" class="form-control mt-1 px-3" id='ProveedorRegister'
                                        name='ProveedorRegister_{{ $proveedor->IdProveedor }}' readonly
                                        value="{{ $proveedor->NombreComercial }}">
                                    @error('ProveedorRegister_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="ProveedorRegister"></div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                                    <label for="CostoProveedorRegister">Costo Proveedor* </label>
                                    <input type="text" class="form-control costo-proveedor"
                                        id="CostoProveedorRegister"
                                        name="CostoProveedorRegister_{{ $proveedor->IdProveedor }}"
                                        value="${{ $proveedor->pivot->CostoProveedor }}">
                                    <input type="text" class="form-control costo-proveedor-bueno" hidden
                                        id="CostoProveedorBueno" name="CostoProveedor_{{ $proveedor->IdProveedor }}"
                                        value="">

                                    @error('CostoProveedor_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="CostoProveedor"></div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                                    <label for="IdTipoMonedaRegister" class="mx-4">Tipo Moneda* </label>
                                    <select name="IdTipoMoneda_{{ $proveedor->IdProveedor }}"
                                        class="form-control text-center" id="IdTipoMonedaRegister">
                                        <option value="" selected disabled> --Seleccione el tipo de moneda--
                                        </option>
                                        @foreach ($TiposMoneda as $tm)
                                            @if ($tm->IdTipoMoneda == $proveedor->pivot->IdTipoMoneda)
                                                <option value="{{ $tm->IdTipoMoneda }}" selected>{{ $tm->TipoMoneda }} --
                                                    [{{ $tm->IdTipoMoneda }}]</option>
                                            @else
                                                <option value="{{ $tm->IdTipoMoneda }}">{{ $tm->TipoMoneda }} --
                                                    [{{ $tm->IdTipoMoneda }}]
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('IdTipoMonedaRegister_' . $proveedor->IdProveedor)
                                        <span class="invalid-feedback" role="alert"
                                            style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="IdTipoMonedaRegister"></div>
                                </div>
                            </div>

                            <div class="row text-center mt-4">
                                <div class="col-12">
                                    <label for="SeleccionadoRegister">Seleccionar distribuidor</label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-center">
                                    <input type="radio" name="SeleccionadoRegister" id="siSeleccionado" value="1"
                                        class="mx-2"> Si
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12" id="ErrorRadio"></div>
                            </div>


                            <a href="">
                                <div class="text-center mt-3 mx-4 flex-fill">
                                    <button class="boton2 mx-auto btn-block " type="submit"
                                        id="EnviarFomulario">Actualizar</button>
                                </div>
                            </a>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach



        {{-- ================MOdal para  algun error ========== --}}
        <div class="modal fade modal-custom" id="Error" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Error al
                                procesar la solicitud</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('images/error.png') }}" alt="Error" class="img-fluid mx-auto d-block mb-3"
                            style="max-width: 150px;">
                        <p>Se ha presentado un error, intentelo más tarde </p>
                    </div>
                </div>
            </div>
        </div>


        <div id="NuevoDistribuidor" data-url="{{ route('productosProveedores.store') }}"></div>
        <div id="Finalizado" data-url="{{ route('productosProveedores.EditProveedor', $Producto) }}"></div>

        {{-- ================MOdal para exito del proceso del guardar ========== --}}
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
                        <p>Se ha guardado con éxito el nuevo distribuido </p>
                    </div>
                </div>
            </div>
        </div>








        <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
            <a href="{{ route('productos.edit', $Producto) }}">
                <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                    <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                </div>
            </a>
        </div>

    </div>

@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/ModuloProductos/ModProd.js') }}"></script>

@endsection
