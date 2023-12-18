@extends('layaout.plantilla')

@section('titulo', 'Catálogo productos')

@section('estilos')
    <link rel="stylesheet" href="{{asset('css/botones.css')}}">
@endsection

@section('subtitulo', 'Ver producto ')

@section('contenido')

    <div class="container mt-3">

        <h4 class="mt-4"><strong>Información del producto</strong></h4>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                    <path d="M15 9h.01" />
                </svg>

                <label for="ClaveProducto">Clave </label>
                <input type="text" class="form-control mt-1 px-3" id='ClaveProducto' name='ClaveProducto' readonly value="{{$Producto->ClaveProducto}}">
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 21l18 0" />
                    <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                    <path d="M5 21l0 -10.15" />
                    <path d="M19 21l0 -10.15" />
                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                </svg>

                <label for="Nombre">Nombre  </label>
                <input type="text" class="form-control mt-1 px-3" id='Nombre' name='Nombre' readonly value="{{$Producto->Nombre}}">
            </div>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-baseline-density-large" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 4h16" />
                    <path d="M4 20h16" />
                </svg>

                <label for="IdTipo">Tipo  </label>
                <input type="text" class="form-control mt-1 px-3" id='IdTipo' name='IdTipo' readonly value="{{$Producto->tipoSerProductos->Tipo}}">
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <label for="Clasificador">Clasificador </label>
                <input type="text" class="form-control mt-1 px-3" id='Clasificador' name='Clasificador' readonly value="{{$Producto->Clasificador}}">
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <label for="UnidadMedida">Unidad de Medida  </label>
                <input type="text" class="form-control mt-1 px-3" id='UnidadMedida' name='UnidadMedida' readonly value="{{$Producto->UnidadMedida}}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-vocabulary" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                    <path d="M12 5v16" />
                    <path d="M7 7h1" />
                    <path d="M7 11h1" />
                    <path d="M16 7h1" />
                    <path d="M16 11h1" />
                    <path d="M16 15h1" />
                </svg>

                <label for="Descipcion">Descipcion </label>
                <textarea name="Descipcion" class="form-control px-3" id="Descipcion" cols="" readonly rows="2"> {{$Producto->Descripcion}} </textarea>
            </div>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-premium-rights" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M13.867 9.75c-.246 -.48 -.708 -.769 -1.2 -.75h-1.334c-.736 0 -1.333 .67 -1.333 1.5c0 .827 .597 1.499 1.333 1.499h1.334c.736 0 1.333 .671 1.333 1.5c0 .828 -.597 1.499 -1.333 1.499h-1.334c-.492 .019 -.954 -.27 -1.2 -.75" />
                    <path d="M12 7v2" />
                    <path d="M12 15v2" />
                </svg>

                <label for="Precio">Precio  </label>
                <input type="text" class="form-control mt-1 px-3" id='Precio' name='Precio' readonly value="$ {{$Producto->Precio}}">
            </div>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 17v-14" />
                    <path d="M15 6l-3 -3l-3 3" />
                    <path d="M12 17a2 2 0 1 0 0 4a2 2 0 0 0 0 -4" />
                </svg>

                <label for="Aumento">Aumento  </label>
                <input type="text" class="form-control mt-1 px-3" id='Aumento' name='Aumento' readonly value="%{{$Producto->listasPrecios->Porcentaje}}">
            </div>
        </div>


        @foreach($Producto->proveedores as $proveedor)
            @if ($proveedor->pivot->ProveedorSeleccionado == true)
                <div class="border border-3 border-primary mt-4 mb-2">
                    <h4 class="mt-2 px-2"><strong>Información del proveedor seleccionado </strong></h4>
                    <div class="row mt-2 px-2 pb-4">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
            
                            <label for="Fecha">Fecha Cotizacion </label>
                            <input type="date" name="Fecha" id="Fecha" readonly class="form-control mt-1 px-3" value="{{$proveedor->pivot->FechaCotizacion}}">
                        </div>
            
            
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            
                            <label for="Proveedor">Proveedor  </label>
                            <input type="text" class="form-control mt-1 px-3" id='Proveedor' name='Proveedor' readonly value="{{$proveedor->NombreComercial}}">
                        </div>
            
            
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-premium-rights" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M13.867 9.75c-.246 -.48 -.708 -.769 -1.2 -.75h-1.334c-.736 0 -1.333 .67 -1.333 1.5c0 .827 .597 1.499 1.333 1.499h1.334c.736 0 1.333 .671 1.333 1.5c0 .828 -.597 1.499 -1.333 1.499h-1.334c-.492 .019 -.954 -.27 -1.2 -.75" />
                                <path d="M12 7v2" />
                                <path d="M12 15v2" />
                            </svg>
                            <label for="CosPro">Costo Proveedor  </label>
                            <input type="text" class="form-control mt-1 px-3" id='CosPro' name='CosPro' readonly value="$ {{$proveedor->pivot->CostoProveedor}} {{$proveedor->pivot->IdTipoMoneda}}">
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        @foreach($Producto->proveedores as $proveedor)
            @if  ($proveedor->pivot->ProveedorSeleccionado != true)
            <div class="mt-4 mb-2">
                <h4 class="mt-2 px-2"><strong>Información del proveedor  </strong></h4>
                <div class="row mt-2 px-2 pb-4">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M16 3l0 4" />
                            <path d="M8 3l0 4" />
                            <path d="M4 11l16 0" />
                            <path d="M8 15h2v2h-2z" />
                        </svg>
        
                        <label for="Fecha">Fecha Cotizacion </label>
                        <input type="date" name="Fecha" id="Fecha" readonly class="form-control mt-1 px-3" value="{{$proveedor->pivot->FechaCotizacion}}">
                    </div>
        
        
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        
                        <label for="Proveedor">Proveedor  </label>
                        <input type="text" class="form-control mt-1 px-3" id='Proveedor' name='Proveedor' readonly value="{{$proveedor->NombreComercial}}">
                    </div>
        
        
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-premium-rights" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M13.867 9.75c-.246 -.48 -.708 -.769 -1.2 -.75h-1.334c-.736 0 -1.333 .67 -1.333 1.5c0 .827 .597 1.499 1.333 1.499h1.334c.736 0 1.333 .671 1.333 1.5c0 .828 -.597 1.499 -1.333 1.499h-1.334c-.492 .019 -.954 -.27 -1.2 -.75" />
                            <path d="M12 7v2" />
                            <path d="M12 15v2" />
                        </svg>
                        <label for="CosPro">Costo Proveedor  </label>
                        <input type="text" class="form-control mt-1 px-3" id='CosPro' name='CosPro' readonly value="$ {{$proveedor->pivot->CostoProveedor}} {{$proveedor->pivot->IdTipoMoneda}}">
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        


        <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
            <a href="{{route('productos.index')}}">
                <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                </div>
            </a>
        </div>

    </div>

@endsection

