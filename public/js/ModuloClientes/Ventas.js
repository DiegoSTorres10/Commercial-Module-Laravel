/**
 * Actualiza los valores de IVA, Total sin Descuento y Descuento Total basados en el Subtotal y Descuento proporcionados.
 */
function ActualizarIVATotal() {
    // Obtiene los valores actuales
    const SubTotal = $('#SubtotalOficial').val();
    const IVA = $('#IVATotal');
    const DescuentoTotal = $('#DescuentoTotal');
    const TotalSinDescuento = $('#TotalCompra');
    const DescuentoInput = $('#Descuento').val();

    // Realiza los cálculos
    let OperacionIva = SubTotal * 0.16;
    let OperacionTotalSinDescuento = parseFloat(SubTotal) + parseFloat(OperacionIva); // Asegúrate de convertir a números
    let OperacionTotalDescuento = OperacionTotalSinDescuento - (OperacionTotalSinDescuento * DescuentoInput / 100);

    // Actualiza los valores en los elementos correspondientes
    IVA.val(OperacionIva.toFixed(2));
    TotalSinDescuento.val(OperacionTotalSinDescuento.toFixed(2));
    DescuentoTotal.val(OperacionTotalDescuento.toFixed(2));
}



/**
 * Actualiza el subtotal sumando los valores de las celdas con el nombre "SubTotal[]" en la tabla.
 * Luego llama a la función ActualizarIVATotal para recalcular otros valores relacionados.
 */
function ActulizarSubTotal() {
    let totalSubtotales = 0;

    // Itera sobre las celdas de Subtotal y suma sus valores
    $('td[name="SubTotal[]"]').each(function () {
        var subtotalText = $(this).text().trim();
        var subtotalValue = parseFloat(subtotalText) || 0; // Parsea a número, si es posible

        totalSubtotales += subtotalValue;
    });

    // Actualiza el valor total en el elemento designado
    $('#SubtotalOficial').val(totalSubtotales.toFixed(2));

    // Llama a la función para recalcular otros valores relacionados
    ActualizarIVATotal();
}


/**
 * Valida la cantidad de productos ingresada en un input.
 * - Si la cantidad es menor a 1, se establece como 1.
 * - Si la cantidad es mayor a las existencias, muestra una alerta y ajusta la cantidad al máximo de existencias.
 * - Si la cantidad está vacía, se marca como no vacío.
 * - Actualiza el subtotal de la fila y llama a la función ActulizarSubTotal para recalcular el subtotal total.
 * @param {HTMLElement} input - El input que contiene la cantidad de productos.
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
     * Maneja el evento de entrada (input) en el campo de descuento.
     * - Limpia el valor del campo dejando solo caracteres numéricos y el punto decimal.
     * - Si no comienza con '%', agrega '%'.
     * - Actualiza el valor del campo con el valor limpio.
     * - Parsea el descuento a un número y verifica si es mayor al 100%.
     *   - Si es mayor a 100, muestra una alerta y establece el descuento al 100%.
     *   - Si no es un número, establece el descuento a 0.
     *   - Si es un número válido, actualiza el campo de descuento y llama a la función ActualizarIVATotal.
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
            if (isNaN(DescuentoParseado)) {
                $('#Descuento').val(0);
            } else {
                $('#Descuento').val(DescuentoParseado);
                ActualizarIVATotal();
            }
        }
    });






    let key = 1;
    let ProductosSelecionado = []

    /**
     * Maneja el evento de cambio en el campo de selección de productos.
     * - Obtiene el valor seleccionado.
     * - Obtiene la fila actual.
     * - Agrega el producto seleccionado al array ProductosSelecionado.
     * - Realiza una solicitud AJAX para obtener los detalles del producto desde el servidor.
     *   - Actualiza las celdas correspondientes en la fila con la información obtenida.
     *     - Unidad, Existencias, Cantidad (agregando un campo de entrada de número), Costo y SubTotal.
     * - Si hay un error en la solicitud AJAX, muestra un mensaje de error en la consola.
     */
    $('#tabla-productos-cotizar').on('change', 'select[name="Clave[]"]', function () {
        let selectedOption = $(this).val();
        let currentRow = $(this).closest('tr');
        ProductosSelecionado.push(selectedOption);

        // Realizar una solicitud AJAX para obtener los detalles del producto seleccionado desde el servidor
        $.ajax({
            url: $('#ObtenerDetallesProductosAlmacen').data('url'),
            data: {
                ClaveProducto: selectedOption,
                IdAlmacen: $('#IdAlmacen').val()
            },
            type: 'GET',
            success: function (data) {
                currentRow.find('#Unidad').text(data.UnidadMedida);
                currentRow.find('#Existencias').text(data.Existencias);
                currentRow.find('#Cantidad').html(`<input type="number" name="Cantidad[]" class="form-control text-center">`);
                currentRow.find('#Costo').text(data.Precio);
                currentRow.find('#SubTotal').html(`<input type="text" id="SubTotal" name="SubTotal[]" class="form-control text-center" readonly>`);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });



    /**
     * Maneja el evento de clic en el botón "Agregar Producto".
     * - Verifica que todas las cantidades estén ingresadas antes de agregar un nuevo producto.
     * - Verifica que se haya seleccionado un producto antes de agregarlo.
     * - Realiza una solicitud AJAX para obtener la lista de productos en el almacén.
     *   - Filtra los productos que no han sido seleccionados.
     *   - Agrega una nueva fila a la tabla con la información del producto seleccionado.
     * - Maneja el evento de clic en el botón de eliminación de un producto.
     *   - Remueve la fila correspondiente y actualiza el subtotal.
     * - Maneja el evento de clic en el botón "Enviar Salida".
     *   - Verifica que se haya agregado al menos un producto.
     *   - Verifica que todas las cantidades estén ingresadas.
     *   - Muestra un mensaje de error si no se cumple alguna condición.
     */
    $('#Agregar-Producto').click(function (event) {
        event.preventDefault();

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

        $('#tabla-productos-cotizar').on('click', '.eliminar-btn', function (event) {
            event.preventDefault();
            const claveProducto = $(this).closest('tr').find('td').eq(1).find('select').val(); // Obtén el valor de la clave del producto
            $(this).closest('tr').remove();
            key--;
            ActulizarSubTotal()

            ProductosSelecionado = ProductosSelecionado.filter(producto => producto !== claveProducto);
        });


        $('#Enviar-Salida').click(function () {
            event.preventDefault();
            let productosCompletos = true;

            if ($('tr.table-active').length === 0) {
                $("#Error .modal-body p").text('Debes agregar por lo menos un producto.');
                $("#Error").modal("show");
                return;
            }

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

    })




    $('#modalNuevaVenta, #CerrarIcono, #CerrarBtn').on('hidden.bs.modal', function () {
        $('#Monto').val('');
        $('#MetodoPago').val('');
        $('#Efectivo').addClass('d-none');
        $('#Tarjeta').addClass('d-none');
        $('#MetodoPago').off('change');
        $('#Monto').off('input');
        $('#EnviarMetodoPago').off('click');
        $('#Efectivo').addClass('d-none');
        $('#Tarjeta').addClass('d-none');
    });



    // Manejo del clic en el botón con ID 'Enviar-Cotizacion'
    $('#Enviar-Cotizacion').on('click', function (event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del evento

        let productosCompletos = true;

        // Verifica si se ha seleccionado al menos un producto
        if ($('tr.table-active').length === 0) {
            $("#Error .modal-body p").text('Debes agregar por lo menos un producto.');
            $("#Error").modal("show");
            return;
        }

        // Itera sobre los productos seleccionados para validar la cantidad
        $('tr.table-active').each(function () {
            let cantidad = $(this).find('td[name="Cantidad[]"] input').val();

            // Verifica si la cantidad está presente
            if (!cantidad || cantidad === '') {
                productosCompletos = false;
                return false; // Detiene el bucle si un producto no está completo
            }
        });

        // Muestra mensajes de error si las validaciones no se cumplen
        if (!productosCompletos) {
            $("#Error .modal-body p").text('Por favor, asegúrate de ingresar una cantidad y un producto');
            $("#Error").modal("show");
            return;
        } else {
            // Configura eventos para manejar la entrada del monto
            jQuery("#Monto").on("input", function () {
                var inputVal = jQuery(this).val();
                var cleanedVal = inputVal.replace(/[^0-9.]+$/g, "");
                jQuery(this).val(cleanedVal);
            });

            // Muestra el modal de nueva venta
            $('#modalNuevaVenta').modal('show');

            // Obtiene el total a pagar y actualiza la interfaz
            const TotalPagar = parseFloat($('#DescuentoTotal').val());
            $('#TotalPagoMT').val(`$ ${TotalPagar}`);

            // Manejo del cambio en el método de pago
            $('#MetodoPago').on('change', () => {
                if ($('#MetodoPago').val() == 1) {
                    // Muestra campos de tarjeta y oculta efectivo
                    $('#Tarjeta').removeClass('d-none');
                    $('#Efectivo').addClass('d-none');
                    $('#Monto').val('');
                } else if ($('#MetodoPago').val() == 2) {
                    // Muestra campos de efectivo y oculta tarjeta
                    $('#Efectivo').removeClass('d-none');
                    $('#Tarjeta').addClass('d-none');
                    $('#Monto').val('');
                }

                // Manejo de la entrada del monto y cálculo del cambio
                $('#Monto').on('input', () => {
                    var monto = parseFloat($('#Monto').val()) || 0;
                    var cambio = TotalPagar - monto;
                    cambio = cambio >= 0 ? 0 : cambio * -1;
                    $('#Cambio').val(`$ ${cambio.toFixed(2)} `);
                });
            });

            // Manejo del clic en el botón de enviar método de pago
            $('#EnviarMetodoPago').on('click', (e) => {
                e.preventDefault();

                var monto = parseFloat($('#Monto').val());

                // Verifica si el monto es suficiente para cubrir el total de la venta
                if ((TotalPagar - monto) > 0) {
                    alert('No tiene suficiente saldo para pagar');
                    return;
                }

                // Oculta el modal de nueva venta
                $('#modalNuevaVenta').modal('hide');

                // Configuración de la solicitud AJAX
                var EnviarFormularioAjax = $("#EnviarFormularioAjax").data("url");
                const formData = new FormData($("#formulario")[0]);
                const formDataModal = new FormData($("#FormularioMetodoPago")[0]);
                const combinedFormData = new FormData();

                // Combina los datos del formulario principal y del modal de método de pago
                for (var pair of formData.entries()) {
                    combinedFormData.append(pair[0], pair[1]);
                }
                for (var pair of formDataModal.entries()) {
                    combinedFormData.append(pair[0], pair[1]);
                }

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                // Realiza la solicitud AJAX para enviar los datos al servidor
                RegresarIndex = $('#RegresarIndiex').data('url');
                $.ajax({
                    type: "POST",
                    url: EnviarFormularioAjax,
                    data: combinedFormData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Muestra el modal de felicitaciones y proporciona opciones para imprimir o cerrar la venta
                        $("#Congratulations").modal("show");
                        var IdVenta = response.IdVenta;
                        $("#imprimirBtn").click(function () {
                            var PDFShow = $("#PDFShow").data("url");
                            PDFShow = PDFShow + '?IdVenta=' + IdVenta;

                            // Abre una nueva pestaña con el PDF y redirige a la página principal
                            window.open(PDFShow, "_blank");
                            window.location.href = RegresarIndex;
                        });

                        // Maneja el evento de ocultar el modal de felicitaciones
                        $('#Congratulations').on('hidden.bs.modal', function () {
                            window.location.href = RegresarIndex;
                        });

                        // Maneja el clic en el botón de cerrar
                        $('#CerrarBTN').click(function () {
                            window.location.href = RegresarIndex;
                        });
                    },
                    error: function (xhr, status, error) {
                        // Maneja errores y muestra mensajes de error
                        var errorMessage = JSON.parse(xhr.responseText).errors[0];
                        $("#Error .modal-body p").text(errorMessage);
                        $("#Error").modal("show");
                    },
                });
            });
        }
    });
});