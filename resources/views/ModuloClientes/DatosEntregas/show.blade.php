
{{--  DATOS DE ENTERGAS  --}}

@foreach ($Datos as $dato)
    <div class="row mt-5 border border-4 rounded" id='ContenedordatoFiscales'>
        <h4 class="text-center mt-3"><strong>Datos de entrega</strong></h4>

        <form action="{{ route('DatosEntregas.update',  $dato->IdEntrega) }}" method="POST" enctype="multipart/form-data" id="formudatoEntrega" autocomplete="off">
            @csrf
            @method('put')

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border-black">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="NombreCompletoEntrega">Nombre Completo </label>
                        <input type="text" class="form-control "  value="{{ $dato->NombreCompleto }}" id="NombreCompletoEntrega" name="NombreCompletoEntrega" >
                        <div class="text-center" id="ErrorFacNombre"></div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="CalleEntrega">Calle </label>
                        <input type="text" class="form-control " id="CalleEntrega"   value="{{ $dato->Calle }}" name="CalleEntrega" >
                        <div class="text-center" id="ErrorFacCalle"></div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="NoExteriorEntrega">No. Exterior  </label>
                        <input type="text" class="form-control " id="NoExteriorEntrega"  value="{{ $dato->NoExterior }}" name="NoExteriorEntrega" >

                        <div class="text-center" id="ErrorFacNoExterior"></div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="NoInteriorEntrega">No. Interior </label>
                        <input type="text" class="form-control " id="NoInteriorEntrega"  value="{{ $dato->NoInterior }}" name="NoInteriorEntrega" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="ColoniaEntrega">Colonia </label>
                        <input type="text" class="form-control " id="ColoniaEntrega"  value="{{ $dato->Colonia }}" name="ColoniaEntrega" >
                        
                        <div class="text-center" id="ErrorFacColonia"></div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="MunicipioEntrega">Municipio </label>
                        <input type="text" class="form-control " id="MunicipioEntrega"  value="{{ $dato->Municipio }}" name="MunicipioEntrega" >
                        <div class="text-center" id="ErrorFacMunicipio"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label for="EstadoEntrega">Estado </label>
                        <input type="text" class="form-control " id="EstadoEntrega"  value="{{ $dato->Estado }}" name="EstadoEntrega" >
                        <div class="text-center" id="ErrorFacEstado"></div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label for="PaisEntrega">País </label>

                        <select class="form-control" id="PaisEntrega"  name="PaisEntrega">
                            <option value=""  disabled>  --Seleccione un país--  </option>
                            
                            @foreach ($Paises as $pais)
                                @if ($dato->ClavePais === $pais->ClavePais)
                                    <option selected value="{{ $pais->ClavePais }}"> {{$pais->Pais}}</option>
                                @else
                                    <option  value="{{ $pais->ClavePais }}"> {{$pais->Pais}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label for="CPEntrega">CP </label>
                        <input type="text" class="form-control "  id="CPEntrega" value="{{ $dato->CP }}" name="CPEntrega" >

                        <div class="text-center" id="ErrorFacCP"></div>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="Referencias">Referencias entrega </label>
                    <textarea class="form-control "  id="Referencias" name="Referencias"  > {{ $dato->Referencias }}</textarea>
                </div>

            </div>


            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                
                <a href="" id='BotonEnviardato2' class="">
                    <div class="text-center mt-1 mb-1 mx-4 flex-fill">
                    <button class="boton2 mx-auto btn-block" type="submit">Actualizar</button>
                    </div>
                </a>
            </div>
        </form>
    </div>
@endforeach


<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/ModuloClientes/ShowDatosEntregas.js')}}"> </script>