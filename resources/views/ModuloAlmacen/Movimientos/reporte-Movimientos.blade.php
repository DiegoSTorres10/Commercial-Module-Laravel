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
        padding-left: 50px;
        margin-top: 40px;
    }

    .page-break {
        page-break-after: always;
    }

    .Color-Datos {
        color: #0000ff
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
</style>
</head>

<body>

    <main>
        <div class="container-fluid">
            <div class="image-with-text">
                <div class="Text-container ">
                    <h3 class="Color-Datos text-center"><strong> Diego ST Developer </strong></h3>
                    <h5 class="text-center">Almacen: <span class="Color-Datos">{{ $NombreAlmacen }} </span></h5>
                </div>


                <div class="InformacionContainer">
                    <h2 class="Informacion"><strong>Registro de movimiento</strong></h2>
                    <h5 class="Informacion">{{ $Historial->razones->tipos_movimientos->TipoMovimiento }} por
                        {{ $Historial->razones->Razon }}</h5>
                    <h5 class="Informacion">Folio del movimiento: <span class="Color-Datos">#
                            {{ $Historial->FolioMovimiento }}</span></h5>
                    <h5 class="Informacion">Fecha del movimiento: <span class="Color-Datos">
                            {{ $Historial->FechaMovimiento }}</span></h5>
                </div>



            </div>

            <table class="table table-striped">
                <thead class="fondoTabla">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Unidad</th>
                        <th class="text-center">Clave</th>
                        <th class="text-center">Productos</th>
                        <th class="text-center">Costo Unitario</th>
                        <th class="text-center">Costo Total</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($resultados as $index => $producto)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ number_format($producto->Cantidad, 0, ',', ',')  }}</td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $producto->UnidadMedida }}</td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                {{ $producto->ClaveProducto }}</td>
                            <td class="text-center" style="max-width: 200px; word-wrap: break-word;">
                                {{ $producto->Nombre }}</td>
                            <!-- Asegúrate de ajustar este campo según la estructura real de tus datos -->
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                ${{ number_format($producto->Precio, 2, ',', ',')  }}</td>
                            <td class="text-center" style="max-width: 100px; word-wrap: break-word;">
                                ${{ number_format($producto->Cantidad * $producto->Precio, 2, ',', ',')   }}</td>
                            @php
                                $total += $producto->Cantidad * $producto->Precio;
                            @endphp
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="text-center  fondoTabla font-weight-bold">Total Final</td>

                        <td class="text-center fondoTabla font-weight-bold">
                            ${{ number_format($total, 2, ',', ',')  }}
                        </td>
                    </tr>
                </tfoot>
            </table>
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
