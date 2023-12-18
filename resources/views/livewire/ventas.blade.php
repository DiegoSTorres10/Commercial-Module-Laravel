<div class="px-3">

    <div class=" text-center">
        <input type="text" id="Busqueda" wire:model="search"
            placeholder="Buscar por Cliente, fecha  o Almacen" class=" input-custom mb-3" autocomplete="off">
    </div>
    <div class="container-fluid mt-2 mb-2 ">
        <span>Mostrar</span>

        <select wire:model="cant">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>

        <span> entradas </span>

    </div>


    @if ($Ventas->count())

        <div class="table-responsive">
            <table class="table table-striped table-hover  ">
                <thead>
                    <tr>
                        <th class="cursor-pointer text-center" style="width: 250px;" wire:click="order('IdCaja')">
                            Almacen

                            @if ($sort == 'IdCaja')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif


                        </th>
                        <th class="cursor-pointer text-center" style="width: 250px;" wire:click="order('IdCliente')">
                            Cliente
                            @if ($sort == 'IdCliente')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right  mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="cursor-pointer text-center" wire:click="order('FechaHora')">
                            Fecha Venta
                            @if ($sort == 'FechaHora')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                       
                        <th class="cursor-pointer text-center" wire:click="order('TotalPagar')">
                            Monto Pagar
                            @if ($sort == 'TotalPagar')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>

                       
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Ventas as $vent)
                        <tr class="table-active ">
                            <td class="text-center"> {{ $vent->CajaVentas->Almacenes->NombreAlmacen }}</td>
                            <td class="text-center"> {{ $vent->IdCliente == null ? 'Sin cliente' : $vent->Clientes->NombreCompleto }}</td>
                            <td class="text-center"> {{ $vent->FechaHora }}</td>
                            
                            <td class="text-center">${{ number_format($vent->TotalPagar, 2, ',', ',') }} </td>

                           

                            <td class="text-center">
                                <div style="display: inline-block;">
                                    <a class="badge rounded mb-2 bg-info" href="{{route('ventas.pdfVentas', $vent->IdVenta)}}" target="_blank">
                                        <i class="far fa-file-pdf fa-2x"></i>
                                    </a>
                                </div>
                                
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>


        </div>
    @else
        <div class="text-center ">
            <span class="shadow px-5 py-1" style="max-width: 400px">No existe ningún registro coincidente </span>
        </div>
    @endif


    @if ($Ventas->links())
        <div class="d-flex justify-content-center mt-4 pb-5">
            {{ $Ventas->links() }}
        </div>
    @endif

</div>
