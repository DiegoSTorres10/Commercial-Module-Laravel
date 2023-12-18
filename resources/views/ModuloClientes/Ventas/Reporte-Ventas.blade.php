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
                    <h3 class="Color-Datos text-center"><strong> Diego ST Developer </strong></h3>
                    <h5 class="text-center">Almacen: <span
                            class="Color-Datos">{{ $Venta->CajaVentas->Almacenes->NombreAlmacen }} </span></h5>
                    <h5 class="text-center"> Elaborador: <span class="Color-Datos">
                            {{ $Venta->NombreElaborador }}
                        </span>
                    </h5>

                </div>


                <div class="InformacionContainer">
                    <h3 class=""><strong>Venta</strong></h3>
                    @if ($Venta->IdCliente != null)
                        <h5 class=""> Cliente: <span class="Color-Datos">
                                {{ $Venta->Clientes->NombreCompleto }}
                            </span>
                        </h5>
                    @endif
                    <h5 class="">Folio de la venta : <span class="Color-Datos"> #
                            {{ $Venta->IdVenta }}
                        </span>
                    </h5>
                    <h5 class="">Fecha de la venta: <span class="Color-Datos">
                            {{ $Venta->FechaHora }}
                        </span>

                    </h5>


                    @if ($Venta->Descuento != 0)
                        <h5 class="">Descuento del: <span class="Color-Datos"> {{ $Venta->Descuento }}%
                            </span>
                        </h5>
                    @endif





                    </h5>


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
                    @foreach ($Venta->productos_venta as $index => $ProductoVenta)
                        <tr>
                            <th class="text-center">{{ $index + 1 }}</th>
                            <th class="text-center" style="width: 250px">{{ $ProductoVenta->Nombre }}</th>
                            <th class="text-center">{{ $ProductoVenta->UnidadMedida }}</th>
                            <th class="text-center">{{ $ProductoVenta->pivot->CantidadProductos }}</th>
                            <th class="text-center" style="width: 150px">
                                ${{ number_format($ProductoVenta->Precio, 2, ',', ',') }}</th>
                            <th class="text-center" style="width: 150px">$
                                {{ number_format($ProductoVenta->Precio * $ProductoVenta->pivot->CantidadProductos, 2, ',', ',') }}
                            </th>
                        </tr>
                        @php
                            $total += $ProductoVenta->Precio * $ProductoVenta->pivot->CantidadProductos;
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
                                    ${{ number_format($total * 0.16, 2, ',', ',') }}
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center"><strong>Total </strong></th>
                                <th class="text-center">
                                    ${{ number_format($total * 1.16, 2, ',', ',') }}
                                </th>
                            </tr>

                            @if ($Venta->Descuento != 0)
                                <tr>
                                    <th class="text-center">Total con Descuento</th>
                                    <th class="text-center">
                                        ${{ number_format($Venta->TotalPagar, 2, ',', ',') }}
                                    </th>
                                </tr>
                            @endif



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px; border-top: 1px solid #ccc; position: relative;">
            <span
                style="position: absolute; left: 50%; transform: translateX(-50%); background-color: #fff; padding: 0 10px;">********</span>
        </div>


        <div class="container-fluid" style="max-width: 250px; margin-left: auto; margin-right: 0;">
            <h4 class="text-center mt-3">Formas de Pago</h4>
            @foreach ($Venta->PagosDeVenta as $MetPago)
                <h5 class="">Metodo de pago: <span class="Color-Datos">
                        {{ $MetPago->TipoPagos->TipoPago }}
                    </span>
                    <h5 class="">Monto: <span class="Color-Datos">
                            $ {{ number_format($MetPago->Monto, 2, ',', ',') }}
                        </span>
            @endforeach
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
