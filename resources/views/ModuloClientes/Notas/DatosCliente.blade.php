<div class="row mt-1 ">
    
    <h5 class="text-center mt-2"><strong>Datos Cliente </strong></h5>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-1">
            <label for="RFC">RFC</label>
            <input type="text" name="RFC" id="RFC" readonly class="form-control" value="{{$Cliente->RFC}}">
        </div>
    
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-1">
            <label for="Contacto">Contacto</label>
            <input type="text" name="Contacto" id="Contacto" readonly class="form-control" value="{{$Cliente->NombreCompleto}}">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
            <label for="Direccion">Direccion</label>
            <input type="text" name="Direccion" id="Direccion" readonly class="form-control" value="{{$Cliente->Calle}}, #{{$Cliente->NoExterior}}, {{$Cliente->Colonia}} {{$Cliente->Municipio}}">
        </div>

        @foreach($Cliente->telefonos as $index => $telefono)
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile-vibration" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <rect x="4" y="4" width="10" height="16" rx="1" />
                        <line x1="8" y1="5" x2="10" y2="5" />
                        <line x1="9" y1="17" x2="9" y2="17.01" />
                        <path d="M20 6l-2 3l2 3l-2 3l2 3" />
                    </svg>

                    <label for="tel{{ $index + 1 }}">Teléfono {{ $index + 1 }}</label>
                    <input type="text" class="form-control" value="{{ $telefono->NumeroTelefonico }}" readonly id="tel{{ $index + 1 }}" name="tel{{ $index + 1 }}">
                </div>
            @endforeach
    </div>
    

    
</div>

