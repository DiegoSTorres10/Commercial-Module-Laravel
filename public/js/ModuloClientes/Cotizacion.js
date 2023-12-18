/**
 * Actualiza el valor del IVA total, el total sin descuento y el total con descuento.
 */
function ActualizarIVATotal() {
    const SubTotal = $('#SubtotalOficial').val();
    const IVA = $('#IVATotal');
    const DescuentoTotal = $('#DescuentoTotal');
    const TotalSinDescuento = $('#TotalCompra');

    const DescuentoInput = $('#Descuento').val();

    // Calcular el IVA
    let OperacionIva = SubTotal * 0.16;

    // Calcular el total sin descuento
    let OperacionTotalSinDescuento = parseFloat(SubTotal) + parseFloat(OperacionIva);

    // Calcular el total con descuento
    let OperacionTotalDescuento = OperacionTotalSinDescuento - (OperacionTotalSinDescuento * DescuentoInput / 100);

    // Actualizar los valores en los campos correspondientes
    IVA.val(OperacionIva.toFixed(2));
    TotalSinDescuento.val(OperacionTotalSinDescuento.toFixed(2));
    DescuentoTotal.val(OperacionTotalDescuento.toFixed(2));
}


/**
 * Actualiza el valor del subtotal y llama a la función para actualizar el IVA total y otros totales.
 */
function ActulizarSubTotal() {
    let totalSubtotales = 0;

    // Recorre todos los elementos con el nombre 'SubTotal[]'
    $('td[name="SubTotal[]"]').each(function () {
        var subtotalText = $(this).text().trim();
        var subtotalValue = parseFloat(subtotalText) || 0; // Parsea a número, si es posible

        totalSubtotales += subtotalValue;
    });

    // Actualiza el valor del subtotal en el elemento correspondiente
    $('#SubtotalOficial').val(totalSubtotales.toFixed(2));

    // Llama a la función para actualizar el IVA total y otros totales
    ActualizarIVATotal();
}


/**
 * Valida la cantidad ingresada en un campo de entrada, ajustándola si es necesario,
 * y actualiza el subtotal y otros totales.
 * @param {HTMLElement} input - El campo de entrada (input) que contiene la cantidad.
 */
function validarCantidadExistencia(input) {
    // Encuentra la fila actual utilizando la clase
    var currentRow = $(input).closest('.fila-producto');
    var inputElement = $(input).find('input[type="number"]');
    var SubtotalCell = currentRow.find('#SubTotal'); // Cambiado a SubtotalCell para mayor claridad
    var PrecioProd = parseFloat(currentRow.find('#Costo').text());
    var existencias = parseInt(currentRow.find('#Existencias').text());
    var quantity = parseInt(inputElement.val());

    let vacioCantidad = true;
    if (quantity < 1) {
        inputElement.val(1);
    } else if (quantity > existencias) {
        alert("No puedes colocar un número mayor a las existencias");
        inputElement.val(existencias);
    } else if (inputElement.val() == '') {
        vacioCantidad = false;
    }

    if (vacioCantidad) {
        var quantity = parseInt(inputElement.val());
        var subtotalValue = PrecioProd * quantity;
        SubtotalCell.text(subtotalValue.toFixed(2));
    } else {
        SubtotalCell.text(0);
    }

    ActulizarSubTotal();
}


$(document).ready(function () {



    /**
     * Maneja el evento de entrada en el campo de descuento, ajusta el formato y actualiza el descuento total.
     */
    jQuery("#Desc").on("input", function () {
        var inputVal = jQuery(this).val();
        var cleanedVal = inputVal.replace(/[^0-9.]+$/g, "");

        if (!/^\%/.test(cleanedVal)) {
            cleanedVal = "%" + cleanedVal;
        }

        jQuery(this).val(cleanedVal);

        let DescuentoParseado = parseFloat($('#Desc').val().replace(/[^\d.]/g, ""));
        if (DescuentoParseado > 100) {
            alert('No puedes colocar un porcentaje mayor a 100');
            $('#Desc').val('%100');
        } else {
            if (isNaN(DescuentoParseado))
                $('#Descuento').val(0);
            else
                $('#Descuento').val(DescuentoParseado);

            ActualizarIVATotal();
        }
    });





    /**
     * Establece la fecha actual en un campo de cotización.
     */
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var formattedFechaAlta = year + '-' + month + '-' + day;
    $('#FechaCotizacion').val(formattedFechaAlta);



    /**
     * Esta función maneja el evento de cambio en la selección del almacén con el id 'IdAlmacen'.
     * Se realiza una verificación de la selección del almacén y del cliente, y se ejecuta una solicitud AJAX para obtener productos según el almacén.
     * Luego, se agrega una nueva fila a la tabla de productos cotizados con los datos obtenidos de la respuesta AJAX.
     * Además, se restablecen algunos valores en los campos de Subtotal, IVA, Total de Compra y Descuento Total.
     */
    $('#IdAlmacen').on('change', function () {
        let key = 1;
        $('#tabla-productos-cotizar').empty();
        $('#SubtotalOficial').val(0);
        $('#IVATotal').val(0);
        $('#TotalCompra').val(0);
        $('#DescuentoTotal').val(0);
        let SelecionAlmacen = false;
        let Cliente = false;

        SelecionAlmacen = ($('#IdAlmacen').val() != null) ? true : false;
        Cliente = ($('#IdCliente').val() != null) ? true : false;

        if (SelecionAlmacen || Cliente)
            return;

        // Realizar solicitud AJAX para obtener productos según el almacén seleccionado
        $.ajax({
            url: $('#obtenerProductosAlmacen').data('url'),
            data: {
                Almacen: $('#IdAlmacen').val()
            },
            type: 'GET',

            success: function (data) {
                let options = '';
                data.forEach(producto => {
                    let productoExistente = ProductosSelecionado.find(item => item === producto.ClaveProducto); // Verifica si el producto ya está en ProductosSelecionado
                    if (!productoExistente)
                        options += `<option value="${producto.ClaveProducto}">${producto.Nombre} [${producto.ClaveProducto}]</option>`;
                });

                // Agregar una nueva fila a la tabla con los datos obtenidos
                $('#tabla-productos-cotizar').append(`
                <tr class="table-active fila-producto">
                    <td class="text-center">${key}</td>
                    <td class="text-center">
                        <select name="Clave[]" class="form-control text-center">
                            <option value="" disabled selected> --Seleccionar-- </option>
                            ${options}
                        </select>
                    </td>
                    <td class="text-center" id="Unidad"></td>
                    <td class="text-center" id="Existencias"></td>
                    <td class="text-center" name='Cantidad[]' id="Cantidad" min="1" oninput="validarCantidadExistencia(this)"></td>
                    <td class="text-center" name='Costo' id="Costo"></td>
                    <td class="text-center" name='SubTotal[]' id="SubTotal"></td>
                    <td class="text-center">
                        <button type="button" class="badge rounded bg-danger eliminar-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor"></path>
                                <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            `);

                key++;
            },
            error: function (error) {
                console.log(error);
            }
        });
    });



    let key = 1;
    let ProductosSeleccionados = [];


    /**
     * Esta función maneja el evento de cambio en la selección del producto en la tabla de productos a cotizar.
     * Se utiliza un array llamado ProductosSeleccionados para almacenar las opciones seleccionadas.
     * Se realiza una solicitud AJAX para obtener los detalles del producto seleccionado desde el servidor.
     * Luego, se actualizan dinámicamente las celdas de la fila actual con los datos obtenidos.
     */
    $('#tabla-productos-cotizar').on('change', 'select[name="Clave[]"]', function () {
        let selectedOption = $(this).val();
        let currentRow = $(this).closest('tr');
        ProductosSeleccionados.push(selectedOption);

        // Realizar una solicitud AJAX para obtener los detalles del producto seleccionado desde el servidor
        $.ajax({
            url: $('#ObtenerDetallesProductosAlmacen').data('url'),
            data: {
                ClaveProducto: selectedOption,
                IdAlmacen: $('#IdAlmacen').val()
            },
            type: 'GET',
            success: function (data) {
                // Actualizar dinámicamente las celdas de la fila actual con los datos obtenidos
                currentRow.find('#Unidad').text(data.UnidadMedida);
                currentRow.find('#Existencias').text(data.Existencias);
                currentRow.find('#Cantidad').html(`<input type="number" name="Cantidad[]" class="form-control text-center" oninput="validarCantidadExistencia(this)">`);
                currentRow.find('#Costo').text(data.Precio);
                currentRow.find('#SubTotal').html(`<input type="text" id="SubTotal" name="SubTotal[]" class="form-control text-center" readonly>`);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });



    /**
 * Maneja el evento de clic en el botón "Agregar Producto" en la interfaz de cotización.
 * Verifica la selección de almacén y cliente antes de agregar productos.
 * Si hay productos previamente agregados, verifica la cantidad y producto ingresados.
 * Realiza una solicitud AJAX para obtener los productos del almacén seleccionado.
 * Agrega una nueva fila a la tabla de productos con los datos obtenidos.
 */
    $('#Agregar-Producto').click(function (event) {
        event.preventDefault();

        // Verifica la selección de almacén y cliente en la cotización
        let SelecionAlmacen = ($('#IdAlmacen').val() != null) ? true : false;
        let Cliente = ($('#IdCliente').val() != null) ? true : false;

        if (key == 1) {
            // Verifica la selección de almacén y cliente al agregar el primer producto
            if (!SelecionAlmacen || !Cliente) {
                $("#Error .modal-body p").text('Debes seleccionar el almacén, el cliente y la estimación de entrega.');
                $("#Error").modal("show");
                return;
            }
        } else {
            // Verifica la cantidad y selección de producto al agregar productos adicionales
            let cantidadVacia = false;
            $('input[name="Cantidad[]"]').each(function () {
                if ($(this).val() === '') {
                    cantidadVacia = true;
                    return false;
                }
            });
            if (cantidadVacia) {
                $("#Error .modal-body p").text('Por favor, ingresa una cantidad antes de agregar un nuevo producto.');
                $("#Error").modal("show");
                return;
            }

            if ($('select[name="Clave[]"]').last().val() === null) {
                $("#Error .modal-body p").text('Debes seleccionar primero un producto.');
                $("#Error").modal("show");
                return;
            }
        }

        // Realiza una solicitud AJAX para obtener los productos del almacén seleccionado
        $.ajax({
            url: $('#obtenerProductosAlmacen').data('url'),
            data: {
                Almacen: $('#IdAlmacen').val()
            },
            type: 'GET',
            success: function (data) {
                let options = '';
                data.forEach(producto => {
                    // Verifica si el producto ya está en la lista de productos seleccionados
                    let productoExistente = ProductosSelecionado.find(item => item === producto.ClaveProducto);
                    if (!productoExistente)
                        options += `<option value="${producto.ClaveProducto}">${producto.Nombre} [${producto.ClaveProducto}]</option>`;
                });

                // Agrega una nueva fila a la tabla con los datos obtenidos
                $('#tabla-productos-cotizar').append(`
                <tr class="table-active fila-producto">
                    <td class="text-center">${key}</td>
                    <td class="text-center">
                        <select name="Clave[]" class="form-control text-center">
                            <option value="" disabled selected> --Seleccionar-- </option>
                            ${options}
                        </select>
                    </td>
                    <td class="text-center" id="Unidad"></td>
                    <td class="text-center" id="Existencias"></td>
                    <td class="text-center" name='Cantidad[]' id="Cantidad" min="1" oninput="validarCantidadExistencia(this)"></td>
                    <td class="text-center" name='Costo' id="Costo"></td>
                    <td class="text-center" name='SubTotal[]' id="SubTotal"></td>
                    <td class="text-center">
                        <button type="button" class="badge rounded bg-danger eliminar-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor"></path>
                                <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            `);

                key++;

            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    /**
     * Maneja el evento de clic en el botón de eliminar de una fila de producto.
     * Elimina la fila correspondiente y actualiza la información total.
     */
    $('#tabla-productos-cotizar').on('click', '.eliminar-btn', function (event) {
        event.preventDefault();
        const claveProducto = $(this).closest('tr').find('td').eq(1).find('select').val();
        $(this).closest('tr').remove();
        key--;
        ActulizarSubTotal()

        // Elimina el producto de la lista de productos seleccionados
        ProductosSelecionado = ProductosSelecionado.filter(producto => producto !== claveProducto);
    });

    /**
     * Maneja el evento de clic en el botón "Enviar Salida" en la interfaz de cotización.
     * Verifica que se hayan agregado productos y que se haya ingresado cantidad y producto para cada uno.
     * Muestra un mensaje de error si no se cumplen las condiciones.
     */
    $('#Enviar-Salida').click(function () {
        event.preventDefault();
        let productosCompletos = true;

        // Verifica que se hayan agregado por lo menos un producto
        if ($('tr.table-active').length === 0) {
            $("#Error .modal-body p").text('Debes agregar por lo menos un producto.');
            $("#Error").modal("show");
            return;
        }

        // Verifica que se haya ingresado cantidad y producto para cada fila de productos
        $('tr.table-active').each(function () {
            let cantidad = $(this).find('td[name="Cantidad[]"] input').val();
            if (!cantidad || cantidad === '') {
                productosCompletos = false;
                return false; // Detiene el bucle si un producto no está completo
            }
        });

        if (!productosCompletos) {
            $("#Error .modal-body p").text('Por favor, asegúrate de ingresar una cantidad y un producto');
            $("#Error").modal("show");
            return;
        }
    });




    /**
     * Maneja el evento de clic en el botón "Enviar Cotización".
     * Verifica que se hayan agregado productos y que se haya ingresado cantidad y producto para cada uno.
     * Si todo está completo, realiza una solicitud AJAX para enviar la cotización al servidor.
     * Muestra un mensaje de éxito y proporciona opciones para imprimir o cerrar la cotización.
     */
    $('#Enviar-Cotizacion').on('click', function (event) {
        event.preventDefault();
        let productosCompletos = true;

        // Verifica que se hayan agregado por lo menos un producto
        if ($('tr.table-active').length === 0) {
            $("#Error .modal-body p").text('Debes agregar por lo menos un producto.');
            $("#Error").modal("show");
            return;
        }

        // Verifica que se haya ingresado cantidad y producto para cada fila de productos
        $('tr.table-active').each(function () {
            let cantidad = $(this).find('td[name="Cantidad[]"] input').val();
            if (!cantidad || cantidad === '') {
                productosCompletos = false;
                return false; // Detiene el bucle si un producto no está completo
            }
        });

        if (!productosCompletos) {
            $("#Error .modal-body p").text('Por favor, asegúrate de ingresar una cantidad y un producto');
            $("#Error").modal("show");
            return;
        } else {
            // Configuración de AJAX para incluir el token CSRF en la solicitud
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Obtención de la URL para enviar el formulario mediante AJAX
            var EnviarFormularioAjax = $("#EnviarFormularioAjax").data("url");
            const formData = new FormData($("#formulario")[0]);

            // Solicitud AJAX para enviar la cotización al servidor
            $.ajax({
                type: "POST",
                url: EnviarFormularioAjax,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Muestra un mensaje de éxito y opciones para imprimir o cerrar la cotización
                    $("#Congratulations").modal("show");
                    var IdCotizacion = response.IdCotizacion;

                    // Evento al hacer clic en el botón de imprimir
                    $("#imprimirBtn").click(function () {
                        var PDFShow = $("#PDFShow").data("url");
                        PDFShow = PDFShow + '?IdCotizacion=' + IdCotizacion;

                        // Abrir la nueva pestaña
                        window.open(PDFShow, "_blank");
                        location.reload();
                    });

                    // Evento al cerrar el modal de felicitaciones
                    $('#Congratulations').on('hidden.bs.modal', function () {
                        location.reload();
                    });

                    // Evento al hacer clic en el botón de cerrar
                    $('#CerrarBTN').click(function () {
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    // Manejo de errores y muestra un mensaje de error
                    var errorMessage = JSON.parse(xhr.responseText).errors[0];
                    $("#Error .modal-body p").text(errorMessage);
                    $("#Error").modal("show");
                },
            });
        }
    });

});