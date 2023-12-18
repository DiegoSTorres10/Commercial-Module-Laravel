
{{--  DATOS DE FACTURACION  --}}
<div class="row mt-5 border border-4 rounded" id='ContenedorDatosFiscales'>
    <h4 class="text-center mt-3"><strong>Datos de facturación</strong></h4>

    <form action="{{route('DatosFacturacion.update', $Datos)}}" method="POST" enctype="multipart/form-data" id="formuDatosFactura" autocomplete="off">
        @csrf
        @method('put')

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-black">

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="NombreCompletoFacturacion">Nombre Completo </label>
                    <input type="text" class="form-control " readonly value="{{ $Datos->NombreCompleto }}" id="NombreCompletoFacturacion" name="NombreCompletoFacturacion" >
                    <div class="text-center" id="ErrorFacNombre"></div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="CalleFacturacion">Calle </label>
                    <input type="text" class="form-control " id="CalleFacturacion"  readonly value="{{ $Datos->Calle }}" name="CalleFacturacion" >
                    <div class="text-center" id="ErrorFacCalle"></div>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="NoExteriorFacturacion">No. Exterior  </label>
                    <input type="text" class="form-control " id="NoExteriorFacturacion" readonly value="{{ $Datos->NoExterior }}" name="NoExteriorFacturacion" >

                    <div class="text-center" id="ErrorFacNoExterior"></div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="NoInteriorFacturacion">No. Interior </label>
                    <input type="text" class="form-control " id="NoInteriorFacturacion" readonly value="{{ $Datos->NoInterior }}" name="NoInteriorFacturacion" >
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="ColoniaFactura">Colonia </label>
                    <input type="text" class="form-control " id="ColoniaFactura" readonly value="{{ $Datos->Colonia }}" name="ColoniaFactura" >
                    
                    <div class="text-center" id="ErrorFacColonia"></div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="MunicipioFactura">Municipio </label>
                    <input type="text" class="form-control " id="MunicipioFactura" readonly value="{{ $Datos->Municipio }}" name="MunicipioFactura" >
                    <div class="text-center" id="ErrorFacMunicipio"></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="EstadoFactura">Estado </label>
                    <input type="text" class="form-control " id="EstadoFactura" readonly value="{{ $Datos->Estado }}" name="EstadoFactura" >
                    <div class="text-center" id="ErrorFacEstado"></div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="PaisFactura">País </label>

                    <select class="form-control" id="PaisFactura" readonly name="PaisFactura">
                        <option value=""  disabled>  --Seleccione un país--  </option>
                        
                        @foreach ($Paises as $pais)
                            @if ($Datos->ClavePais === $pais->ClavePais)
                                <option selected value="{{ $pais->ClavePais }}"> {{$pais->Pais}}</option>
                            @else
                                <option  value="{{ $pais->ClavePais }}"> {{$pais->Pais}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <label for="CPFactura">CP </label>
                    <input type="text" class="form-control " readonly id="CPFactura" value="{{ $Datos->CP }}" name="CPFactura" >

                    <div class="text-center" id="ErrorFacCP"></div>
                </div>

            </div>

        </div>

        <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">

            <div class="text-center mx-4 mb-1 mt-1 flex-fill" id='BModificar1'>
                <button class="boton2 mx-auto btn-block" id="BModificar1" type="button">Modificar Datos</button>
            </div>
            
            <a href="" id='BotonEnviarDatos' class="d-none">
                <div class="text-center mt-1 mb-1 mx-4 flex-fill">
                <button class="boton2 mx-auto btn-block" type="submit">Actualizar</button>
                </div>
            </a>
        </div>
    </form>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/ModuloClientes/ShowDatosFactura.js')}}"> </script>