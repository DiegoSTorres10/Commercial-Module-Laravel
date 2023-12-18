<div class="px-3">

    <div class=" text-center">
        <input type="text" id="Busqueda" wire:model="search"
            placeholder="Buscar por Cliente, fecha cotización o Almacen" class=" input-custom mb-3" autocomplete="off">
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


    @if ($Cotizaciones->count())

        <div class="table-responsive">
            <table class="table table-striped table-hover  ">
                <thead>
                    <tr>
                        <th class="cursor-pointer text-center" style="width: 250px;" wire:click="order('IdAlmacen')">
                            Almacenes

                            @if ($sort == 'IdAlmacen')
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
                        <th class="cursor-pointer text-center" wire:click="order('FechaCotizacion')">
                            Fecha Cotización
                            @if ($sort == 'FechaCotizacion')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right  mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="cursor-pointer text-center" wire:click="order('FechaVencimiento')">
                            Vigencia
                            @if ($sort == 'FechaVencimiento')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1 "></i>
                            @endif
                        </th>
                        <th class="cursor-pointer text-center" wire:click="order('FechaEstimadaEntrega')">
                            Fecha Entrega
                            @if ($sort == 'FechaEstimadaEntrega')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down float-right mt-1"></i>
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

                        <th class="cursor-pointer text-center" wire:click="order('Estatus')">
                            Estatus
                            @if ($sort == 'Estatus')
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
                    @foreach ($Cotizaciones as $coti)
                        <tr class="table-active ">
                            <td class="text-center"> {{ $coti->Almacenes->NombreAlmacen }}</td>
                            <td class="text-center"> {{ $coti->Clientes->NombreCompleto }}</td>
                            <td class="text-center"> {{ $coti->FechaCotizacion }}</td>
                            <td class="text-center"> {{ $coti->FechaVencimiento }} </td>
                            <td class="text-center">
                                {{ $coti->FechaEstimadaEntrega }}
                            </td>
                            <td class="text-center">${{ number_format($coti->TotalPagar, 2, ',', ',') }} </td>

                            <td class="text-center">
                                @if ($coti->Estatus == 0)
                                    <span class="text-danger border-danger p-1">Inactiva</span>
                                @else
                                    <span class="text-success  border-success p-1">Activa</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div style="display: inline-block;">
                                    <a class="badge rounded mb-2 bg-info" href="{{route('cotizaciones.pdfCotizacion', $coti->IdCotizacion)}}" target="_blank">
                                        <i class="far fa-file-pdf fa-2x"></i>
                                    </a>
                                </div>
                                <div style="display: inline-block;">
                                    <form action="{{route('cotizaciones.destroy', $coti->IdCotizacion)}}" method="POST" id="form_delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="badge rounded bg-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota??')">
                                            <i class="fas fa-trash fa-2x"></i>
                                        </button>
                                    </form>
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


    @if ($Cotizaciones->links())
        <div class="d-flex justify-content-center mt-4 pb-5">
            {{ $Cotizaciones->links() }}
        </div>
    @endif

</div>
