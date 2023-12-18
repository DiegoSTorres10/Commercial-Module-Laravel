<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Reporte</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

{{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet"> --}}
<style>
    .image-with-text .Text-container {
        width: 250px;
        display: inline-block;
        padding-left: 10px;
        vertical-align: middle;
    }

    .image-with-text .InformacionContainer {
        display: inline-block;
        text-align: right;
        width: 400px;
        padding-left: 50px;
        margin-top: 40px;
    }

    .page-break {
        page-break-after: always;
    }

    .Color-Datos {
        color: #0000ff;
        word-wrap: break-word;

    }

    .fondoTabla {
        background-color: #ddd;

    }

    .table th,
    .table td {
        border: 3px solid white;
        padding: 2px;

    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }


    .table-striped tbody tr:nth-child(odd) {
        background-color: #e6f7ff;
    }


    .tableTotal th,
    .tableTotal td {
        border: 1px solid black;
        padding: 2px;

    }

    .table-total tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-total tbody tr:nth-child(odd) {
        background-color: #e6f7ff;
    }
</style>
</head>

<body>



    <main>
        <div class="container-fluid">
            <div class="image-with-text">
                <div class="Text-container ">
                    <h3 class="Color-Datos text-center"><strong> Diego ST Developer</strong></h3>
                    <h5 class="text-center">Almacen: <span
                            class="Color-Datos">{{ $Cotizacion->Almacenes->NombreAlmacen }} </span></h5>
                    <h5 class="text-center"> Elaborador: <span class="Color-Datos">
                            {{ $Cotizacion->NombreElaborador }}
                        </span>
                    </h5>

                </div>


                <div class="InformacionContainer">
                    <h3 class=""><strong>Cotización</strong></h3>
                    <h5 class=""> Cliente: <span class="Color-Datos">
                            {{ $Cotizacion->Clientes->NombreCompleto }}
                        </span>
                    </h5>
                    <h5 class="">Folio de la cotización : <span class="Color-Datos"> #
                            {{ $Cotizacion->IdCotizacion }}
                        </span>
                    </h5>
                    <h5 class="">Fecha de Cotización: <span class="Color-Datos">
                            {{ $Cotizacion->FechaCotizacion }}
                        </span>

                    </h5>

                    <h5 class="">Fecha vigencia: <span class="Color-Datos"> {{ $Cotizacion->FechaVencimiento }}
                        </span>

                    </h5>

                    @if($Cotizacion->Descuento !=0)
                        <h5 class="">Descuento del: <span class="Color-Datos"> {{ $Cotizacion->Descuento }}%
                            </span>
                        </h5>
                    @endif


                </div>



            </div>

            <table class="table table-striped">
                <thead class="fondoTabla">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center" style="width: 250px">Producto</th>
                        <th class="text-center">Unidad</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center" style="width: 150px">Precio Unitario</th>
                        <th class="text-center" style="width: 150px">SubTotal</th>

                    </tr>
                </thead>

                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($Cotizacion->productos_cotizaciones as $index => $ProductosCotizacion)
                        <tr>
                            <th class="text-center">{{ $index + 1 }}</th>
                            <th class="text-center" style="width: 250px">{{ $ProductosCotizacion->Nombre }}</th>
                            <th class="text-center">{{ $ProductosCotizacion->UnidadMedida }}</th>
                            <th class="text-center">{{ $ProductosCotizacion->pivot->CantidadProductos }}</th>
                            <th class="text-center" style="width: 150px">
                                ${{ number_format($ProductosCotizacion->Precio, 2, ',', ',') }}</th>
                            <th class="text-center" style="width: 150px">$
                                {{ number_format($ProductosCotizacion->Precio * $ProductosCotizacion->pivot->CantidadProductos, 2, ',', ',') }}
                            </th>
                        </tr>
                        @php
                            $total += $ProductosCotizacion->Precio * $ProductosCotizacion->pivot->CantidadProductos;
                        @endphp
                    @endforeach

                </tbody>
            </table>

            <div class=" text-center">
                <div class="table-responsive" style="max-width: 250px; margin-left: auto; margin-right: 0;">
                    <table class="table tableTotal table-total ">
                        <tbody>
                            <tr>
                                <th class="text-center">SubTotal</th>
                                <th class="text-center">
                                    ${{ number_format($total, 2, ',', ',') }}
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">IVA (16%)</th>
                                <th class="text-center">
                                    ${{ number_format($total*.16, 2, ',', ',') }}
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center"><strong>Total </strong></th>
                                <th class="text-center">
                                    ${{ number_format($Cotizacion->TotalPagarSinDescuento, 2, ',', ',') }}
                                </th>
                            </tr>
                            @if($Cotizacion->Descuento !=0)
                                <tr>
                                    <th class="text-center">Total con Descuento</th>
                                    <th class="text-center">
                                        ${{ number_format($Cotizacion->TotalPagar, 2, ',', ',') }}
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </main>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 765, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
	</script>

</body>

</html>
