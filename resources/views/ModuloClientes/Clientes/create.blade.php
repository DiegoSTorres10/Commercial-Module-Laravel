@extends('layaout.plantilla')

@section('titulo', 'Catalago Clientes')

@section('estilos')
    <link rel="stylesheet" href="{{asset('css/botones.css')}}">


@endsection

@section('subtitulo', 'Ver cliente ')

@section('contenido')

    <div class="container mt-3">
        <form action="{{route('clientes.store')}}" method="POST" enctype="multipart/form-data" id="formulario" autocomplete="off">
            @csrf

            <div class="row">

                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-12 mb-2">
                    
                    <label for="Clave">Clave</label>
                    <input type="text" class="form-control" id="Clave" name="Clave" value="{{$ultimoCliente}}" readonly>
                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                    <label for="fecha">Fecha de Alta</label>
                    <input type="text" class="form-control" id="FechaAlta" name="FechaAlta" readonly>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                        <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    </svg>
                    <label for="RFC">RFC </label>
                    <input type="text" class="form-control" id="RFC" value="{{ old('RFC') }}" name="RFC" >
                    <input type="checkbox" name="Extranjero" id="Extranjero"> ¿Es extranjero?
                    @error('RFC')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                        <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                        <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    </svg>
                    <label for="CURP">CURP</label>
                    <input type="text" class="form-control" id="CURP" value="{{ old('CURP') }}" name="CURP" >
                    @error('CURP')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="7" r="4" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <label for="NombreCompleto">Nombre Completo *</label>
                    <input type="text" class="form-control " id="NombreCompleto" value="{{ old('NombreCompleto') }}" name="NombreCompleto">
                    @error('NombreCompleto')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-question" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                        <path d="M19 22v.01" />
                        <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                    </svg>
                    <label for="TipoCliente">Tipo Cliente * </label>
                    <select class="form-control" id="TipoCliente" name="TipoCliente">
                        <option value="" selected disabled>  --Seleccione un tipo de cliente--  </option>
                        @foreach ($TipoClientes as $TC)
                            <option value="{{ $TC->ClaveTipo }}"> {{ $TC->Descripcion }} </option>
                        @endforeach
                    </select>
                    @error('TipoCliente')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 mb-2">
                    
                    <label for="Calle">Calle </label>
                    <input type="text" class="form-control" id="Calle" value="{{ old('Calle') }}" name="Calle" >
                    @error('Calle')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    <label for="NoExterior">No. Exterior *</label>
                    <input type="text" class="form-control" id="NoExterior" value="{{ old('NoExterior') }}" name="NoExterior" >
                    @error('NoExterior')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-12 mb-2">
                    
                    <label for="NoInterior">No. Interior</label>
                    <input type="text" class="form-control" id="NoInterior"  value="{{ old('NoInterior') }}" name="NoInterior" >
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="Colonia">Colonia </label>
                    <input type="text" class="form-control " id="Colonia"  value="{{ old('Colonia') }}" name="Colonia">
                    @error('Colonia')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    
                    <label for="Municipio">Municipio </label>
                    <input type="text" class="form-control " id="Municipio"  value="{{ old('Municipio') }}" name="Municipio">
                    @error('Municipio')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">

                    <label for="Estado">Estado </label>
                    <input type="text" class="form-control" id="Estado" value="{{ old('Estado') }}" name="Estado" >
                    @error('Estado')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    
                    <label for="Pais">País </label>
                    <select class="form-control" id="Pais" name="Pais">
                        <option value="" selected disabled>  --Seleccione un país--  </option>
                        @foreach ($Paises as $pais)
                            <option value="{{ $pais->ClavePais }}"> {{$pais->Pais}} [{{$pais->ClavePais}}]</option>
                        @endforeach
                    </select>
                    @error('Pais')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    
                    <label for="CP">Código Postal </label>
                    <input type="text" class="form-control" id="CP" value="{{ old('CP') }}" name="CP" >
                    @error('CP')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-2">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile-vibration" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <rect x="4" y="4" width="10" height="16" rx="1" />
                        <line x1="8" y1="5" x2="10" y2="5" />
                        <line x1="9" y1="17" x2="9" y2="17.01" />
                        <path d="M20 6l-2 3l2 3l-2 3l2 3" />
                    </svg>
                    <label for="tel1">Teléfono 1 *</label>
                    <input type="text" class="form-control " id="tel1" value="{{ old('tel1') }}" name="tel1" >
                    @error('tel1')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile-vibration" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <rect x="4" y="4" width="10" height="16" rx="1" />
                        <line x1="8" y1="5" x2="10" y2="5" />
                        <line x1="9" y1="17" x2="9" y2="17.01" />
                        <path d="M20 6l-2 3l2 3l-2 3l2 3" />
                    </svg>
                    <label for="tel2">Teléfono 2</label>
                    <input type="text" class="form-control " value="{{ old('tel2') }}" id="tel2" name="tel2">
                    @error('tel2')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <polyline points="3 7 12 13 21 7" />
                    </svg>
                    <label for="Email">Email </label>
                    <input type="email" class="form-control " id="Email" value="{{ old('Email') }}" name="Email">
                    @error('Email')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror
                </div>
                <div id="msgCorreo"></div>

            </div>

            

            {{--  DATOS DE FACTURACION  --}}
            <div class="row mt-5 border border-4 rounded d-none" id='ContenedorDatosFiscales'>
                <h4 class="text-center mt-3"><strong>Datos de facturación</strong></h4>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mt-3">
                    <h5 class="mx-3"> <strong>¿Desea copiar los datos del cliente para la facturación?</strong></h5>
                    <div class="container mt-0 mb-3">
                        
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="radioOptions" id="radioSi" value="si">
                            <label class="form-check-label" for="radioSi">
                                Si
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 border-black">
                    
                    <label for="NombreCompletoFacturacion">Nombre Completo </label>
                    <input type="text" class="form-control " value="{{ old('NombreCompletoFacturacion') }}" id="NombreCompletoFacturacion" name="NombreCompletoFacturacion" >
                    @error('NombreCompletoFacturacion')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="CalleFacturacion">Calle </label>
                            <input type="text" class="form-control " id="CalleFacturacion"  value="{{ old('CalleFacturacion') }}" name="CalleFacturacion" >
                        </div>
                        @error('CalleFacturacion')
                            <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                <strong>{{ $message }}</strong>
                                
                            </span>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="NoExteriorFacturacion">No. Exterior  </label>
                            <input type="text" class="form-control " id="NoExteriorFacturacion" value="{{ old('NoExteriorFacturacion') }}" name="NoExteriorFacturacion" >

                            @error('NoExteriorFacturacion')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="NoInteriorFacturacion">No. Interior </label>
                            <input type="text" class="form-control " id="NoInteriorFacturacion" value="{{ old('NoInteriorFacturacion') }}" name="NoInteriorFacturacion" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="ColoniaFactura">Colonia </label>
                            <input type="text" class="form-control " id="ColoniaFactura" value="{{ old('ColoniaFactura') }}" name="ColoniaFactura" >
                            
                            @error('ColoniaFactura')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="MunicipioFactura">Municipio </label>
                            <input type="text" class="form-control " id="MunicipioFactura" value="{{ old('MunicipioFactura') }}" name="MunicipioFactura" >
                            @error('MunicipioFactura')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="EstadoFactura">Estado </label>
                            <input type="text" class="form-control " id="EstadoFactura" value="{{ old('EstadoFactura') }}" name="EstadoFactura" >
                            @error('EstadoFactura')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="PaisFactura">País </label>

                            <select class="form-control" id="PaisFactura" name="PaisFactura">
                                <option value="" selected disabled>  --Seleccione un país--  </option>
                                @foreach ($Paises as $pais)
                                    <option value="{{ $pais->ClavePais }}"> {{$pais->Pais}}</option>
                                @endforeach
                            </select>

                            @error('PaisFactura')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="CPFactura">CP </label>
                            <input type="text" class="form-control " id="CPFactura" value="{{ old('CPFactura') }}" name="CPFactura" >

                            @error('CPFactura')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                    </div>

                </div>

            </div>


            {{-- DATOS DE ENTREGA --}}
            <div class="row mt-5 border border-4 rounded mb-4 d-none" id='ContenedorDatosEntregas'>
                <h4 class="text-center mt-3"><strong>Datos de entrega</strong></h4>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mt-3">
                    <h5 class="mx-3"> <strong>¿Desea copiar los datos del cliente para la entrega?</strong></h5>
                    <div class="container mt-0 mb-3">
                        
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="radioOptionsEntrega" id="radioSiEntrega" value="si">
                            <label class="form-check-label" for="radioSiEntrega">
                                Si
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 border-black">
                    <label for="NombreCompletoEntrega">Nombre Completo </label>
                    <input type="text" class="form-control " id="NombreCompletoEntrega"  value="{{ old('NombreCompletoEntrega') }}" name="NombreCompletoEntrega" >

                    @error('NombreCompletoEntrega')
                        <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                            <strong>{{ $message }}</strong>
                            
                        </span>
                    @enderror

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="CalleEntrega">Calle </label>
                            <input type="text" class="form-control " id="CalleEntrega" value="{{ old('CalleEntrega') }}" name="CalleEntrega" >
                        </div>

                        @error('CalleEntrega')
                            <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                <strong>{{ $message }}</strong>
                                
                            </span>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="NoExteriorEntrega">No. Exterior  </label>
                            <input type="text" class="form-control " id="NoExteriorEntrega" value="{{ old('NoExteriorEntrega') }}" name="NoExteriorEntrega" >

                            @error('NoExteriorEntrega')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="NoInteriorEntrega">No. Interior </label>
                            <input type="text" class="form-control " id="NoInteriorEntrega" value="{{ old('NoInteriorEntrega') }}" name="NoInteriorEntrega" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="ColoniaEntrega">Colonia </label>
                            <input type="text" class="form-control " id="ColoniaEntrega" value="{{ old('ColoniaEntrega') }}" name="ColoniaEntrega" >

                            @error('ColoniaEntrega')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="MunicipioEntrega">Municipio </label>
                            <input type="text" class="form-control " id="MunicipioEntrega" value="{{ old('MunicipioEntrega') }}" name="MunicipioEntrega" >

                            @error('MunicipioEntrega')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="EstadoEntrega">Estado </label>
                            <input type="text" class="form-control " id="EstadoEntrega" value="{{ old('EstadoEntrega') }}" name="EstadoEntrega" >
                            
                            @error('EstadoEntrega')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="PaisEntrega">País </label>

                            <select class="form-control" id="PaisEntrega" name="PaisEntrega">
                                <option value="" selected disabled>  --Seleccione un país--  </option>
                                @foreach ($Paises as $pais)
                                    <option value="{{ $pais->ClavePais }}"> {{$pais->Pais}}</option>
                                @endforeach
                            </select>

                            @error('PaisEntrega')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="CPEntrega">CP </label>
                            <input type="text" class="form-control " id="CPEntrega" value="{{ old('CPEntrega') }}" name="CPEntrega" >
                            @error('CPEntrega')
                                <span class="invalid-feedback" role="alert" style=" text-align: center; display: flex; justify-content: center; align-items: center;">
                                    <strong>{{ $message }}</strong>
                                    
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="Referencias">Referencias entrega </label>
                        <textarea type="" class="form-control " id="Referencias" name="Referencias"  > {{ old('Referencias') }}</textarea>
                    </div>
                </div>

            </div>


            <div class="container-fluid d-flex flex-wrap justify-content-center align-items-center mt-3 pb-5">
                <a href="{{route('clientes.index')}}">
                    <div class="text-center mx-4 mb-1 mt-1 flex-fill">
                    <button class="boton3 mx-auto btn-block" type="button">Regresar</button>
                    </div>
                </a>

                <div class="text-center mx-4 mb-1 mt-1 flex-fill" id='BDatosFis'>
                    <button class="boton2 mx-auto btn-block" id="BDatosFiscales" type="button">Datos Facturación</button>
                </div>
                
                <div class="text-center mx-4 mb-1 mt-1 flex-fill" id='BDatosEnt'>
                    <button class="boton2 mx-auto btn-block" id="BDatosEntregas" type="button">Datos Entrega</button>
                </div>
                
                <a href="">
                    <div class="text-center mt-1  mb-1 mx-4 flex-fill">
                    <button class="boton2 mx-auto btn-block" type="submit">Guardar</button>
                    </div>
                </a>
            </div>

        </form>
    </div>


    <!-- Modal para que esten llenos los campos -->
    <div class="modal fade modal-custom" id="ErrorEnviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Error al enviar los datos</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{asset('images/error.png')}}" alt="Error" class="img-fluid mx-auto d-block mb-3" style="max-width: 150px;">
                    <p>No se pudo enviar los datos <br>
                        Verifica que hallas llenado los las datos de facturación/entrega/cliente</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de error -->
    <div class="modal fade modal-custom" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-bold font-weight-bold" id="exampleModalLabel"><strong>Error al copiar los datos</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{asset('images/error.png')}}" alt="Error" class="img-fluid mx-auto d-block mb-3" style="max-width: 150px;">
                    <p>No se pudo copiar los datos del cliente <br>
                        Verifica que todos los campos del cliente esten llenados</p>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/ModuloClientes/AltaCliente.js') }}"></script>
@endsection
