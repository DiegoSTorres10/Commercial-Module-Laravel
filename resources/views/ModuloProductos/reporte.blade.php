<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet"> --}}
    <style>
        .container1 {
            text-align: center;
        }

        .image-with-text img {
            display: inline-block;
            vertical-align: middle;
            max-height: 100px;
            width: auto;
        }

        .image-with-text h1 {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
            /* Ajusta este valor según sea necesario */
        }

        .page-break {
            page-break-after: always;
        }
    </style>
    </head>

    <body>
        <div class="container1">
            <div class="image-with-text">
                <img src="{{ public_path('/images/LogoProfesional.png') }}" alt="" class="img-fluid"
                    style="max-height: 100px;">
                <h1><strong>Reporte de los productos</strong></h1>
            </div>
        </div>

        <main>
            <div class="container-fluid mt-4">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" style="vertical-align: middle;"> Clave</th>
                            <th class="text-center" style="vertical-align: middle;">Nombre del Producto</th>
                            <th class="text-center" style="vertical-align: middle;">Clasificación</th>
                            <th class="text-center" style="vertical-align: middle;">Unidad Medida</th>
                            <th class="text-center" style="vertical-align: middle;">Precio Unitario</th>
                            <th class="text-center" style="vertical-align: middle;">Distribuidores</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($Productos as $producto)
                            <tr>
                                <td class="text-center"style="max-width: 100px; word-wrap: break-word;"> {{ $producto->ClaveProducto }}</td>
                                <td class="text-center" style="max-width: 50px; word-wrap: break-word;">{{ $producto->Nombre }}</td>
                                <td class="text-center" style="max-width: 50px; word-wrap: break-word;">{{ $producto->Clasificador }}</td>
                                <td class="text-center" style="max-width: 100px; word-wrap: break-word;">{{ $producto->UnidadMedida }}</td>
                                <td class="text-center" style="max-width: 80px; word-wrap: break-word;">
                                    ${{ number_format($producto->Precio, 0, ',', ',')  }}
                                    @foreach ($producto->proveedores as $proveedor)
                                        @if ($proveedor->pivot->ProveedorSeleccionado == true)
                                            {{ $proveedor->pivot->IdTipoMoneda }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-center" style="vertical-align: middle;"> Nombre del
                                                    Proveedor</th>
                                                <th class="text-center" style="vertical-align: middle;"> Precio del
                                                    Proveedor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($producto->proveedores as $proveedor)
                                                @if ($proveedor->pivot->ProveedorSeleccionado == true)
                                                    <tr class="table-success">
                                                        <td>{{ $proveedor->NombreComercial }}</td>
                                                        <td>${{  number_format($proveedor->pivot->CostoProveedor, 0, ',', ',')  }}
                                                            {{ $proveedor->pivot->IdTipoMoneda }} </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $proveedor->NombreComercial }}</td>
                                                        <td>${{ $proveedor->pivot->CostoProveedor }}
                                                            {{ $proveedor->pivot->IdTipoMoneda }} </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @foreach ($producto->proveedores as $proveedor)
                                                @if ($proveedor->pivot->ProveedorSeleccionado == true)
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </main>

    </body>

</html>
