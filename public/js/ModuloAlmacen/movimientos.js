/**
 * Función para validar la cantidad en un input de tipo número.
 * @param {HTMLElement} input - Elemento HTML que contiene el input de tipo número.
 */
function validarCantidad(input) {
    // Obtiene el valor del input de tipo número
    var value = $(input).find('input[type="number"]').val();

    // Verifica si el valor es menor que 1
    if (parseInt(value) < 1) {
        // Establece el valor del input a 1 si es menor que 1
        $(input).find('input[type="number"]').val(1);
    }
}

/**
 * Función para validar la cantidad en un input de tipo número en función de las existencias disponibles.
 * @param {HTMLElement} input - Elemento HTML que contiene el input de tipo número.
 */
function validarCantidadExistencia(input) {
    // Obtiene el elemento input de tipo número
    var inputElement = $(input).find('input[type="number"]');

    // Obtiene el valor numérico del input
    var value = parseInt(inputElement.val());

    // Encuentra la fila actual utilizando la clase 'fila-producto'
    var currentRow = $(input).closest('.fila-producto');

    // Obtiene las existencias disponibles de la fila actual
    var existencias = parseInt(currentRow.find('#Existencias').text());

    // Verifica si el valor es menor que 1
    if (value < 1) {
        // Establece el valor del input a 1 si es menor que 1
        inputElement.val(1);
    } else if (value > existencias) {
        // Si el valor es mayor que las existencias disponibles, muestra una alerta y ajusta el valor al máximo permitido
        alert("No puedes colocar un número mayor a las existencias");
        inputElement.val(existencias);
    }
}



$(document).ready(function () {

    // Obtiene el elemento con ID 'FechaMovimiento'
    var FechaAlta = $('#FechaMovimiento');

    // Obtiene la fecha actual
    var today = new Date();

    // Obtiene el año actual
    var year = today.getFullYear();

    // Obtiene el mes actual y agrega un cero al principio si es necesario para tener dos dígitos
    var month = String(today.getMonth() + 1).padStart(2, '0');

    // Obtiene el día actual y agrega un cero al principio si es necesario para tener dos dígitos
    var day = String(today.getDate()).padStart(2, '0');

    // Establece el valor del campo 'FechaMovimiento' con la fecha actual en el formato 'YYYY-MM-DD'
    FechaAlta.val(year + '-' + month + '-' + day);





    // Maneja el evento de cambio en el select con ID 'Tipo'
    $('#Tipo').on('change', function () {
        // Obtiene el valor seleccionado en el select 'Tipo'
        let IdTipo = $('#Tipo').val();

        // Limpia las tablas de productos
        $('#tabla-productos').empty();
        $('#tabla-productos_eliminar').empty();

        // Muestra u oculta las secciones de entrada y salida según el tipo seleccionado
        if (IdTipo == 'Ent') {
            $('#EntradaDiv').removeClass('d-none')
            $('#SalidaDiv').addClass('d-none')

        } else {
            $('#SalidaDiv').removeClass('d-none')
            $('#EntradaDiv').addClass('d-none')
        }

        // Realiza una solicitud AJAX para obtener razones en función del tipo seleccionado
        var url = $('#consulta-razones').data('url');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {
                IdTipo: IdTipo
            },
            success: function (response) {
                $('#Razon').empty();
                $('#Razon').append("<option value='' disabled selected>--Seleccione la razón--</option>");

                // Llena el select 'Razon' con las razones obtenidas
                $.each(response, function (index, razon) {
                    let option = "<option value='" + razon.IdRazon + "'>" + razon.Razon + "</option>";
                    $('#Razon').append(option);
                });

            },
            error: function (error) {
                console.log(error);
            }
        });

        // Maneja la lógica específica para el tipo 'Ent'
        // Verifica si el tipo seleccionado es 'Ent' (entrada de productos)
        if ($('#Tipo').val() == 'Ent') {
            // Inicializa la clave única para cada producto
            let key = 1;

            // Almacena las claves de los productos seleccionados para evitar duplicados
            let ProductosSeleccionados = [];

            // Maneja el evento de cambio en el select con nombre 'Clave[]' en la tabla de productos
            $('#tabla-productos').on('change', 'select[name="Clave[]"]', function () {
                // Obtiene el valor seleccionado en el select
                let selectedOption = $(this).val();
                // Obtiene la fila actual
                let currentRow = $(this).closest('tr');
                // Agrega la clave del producto seleccionado al array
                ProductosSeleccionados.push(selectedOption);

                // Realiza una solicitud AJAX para obtener los detalles del producto seleccionado desde el servidor
                $.ajax({
                    url: $('#ObtenerDetallesProductos').data('url'),
                    data: {
                        ClaveProducto: selectedOption
                    },
                    type: 'GET',
                    success: function (producto) {
                        // Actualiza la columna 'Unidad' con la unidad de medida del producto
                        currentRow.find('#Unidad').text(producto[0].UnidadMedida);
                        // Agrega un campo de entrada para la cantidad del producto
                        currentRow.find('#Cantidad').html(`<input type="number" name="Cantidad[]" class="form-control text-center">`);
                        // Agrega un campo de entrada para el costo del producto con el precio obtenido del servidor
                        currentRow.find('#Costo').html(`<input type="number" name="Costo[]" value="${producto[0].Precio}" class="form-control text-center">`);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            // Maneja el clic en el botón 'agregar-producto'
            $('#agregar-producto').click(function () {
                // Previene el comportamiento por defecto del evento
                event.preventDefault();

                // Verifica si se ha seleccionado el almacén, el tipo de movimiento y la razón
                let SeleccionAlmacen = $('#Almacen').val() != null;
                let SeleccionTipo = $('#Tipo').val() != null;
                let SeleccionRazon = $('#Razon').val() != null;

                if (key == 1) {
                    // Si es la primera fila, verifica la selección del almacén, el tipo de movimiento y la razón
                    if (!SeleccionRazon || !SeleccionTipo || !SeleccionAlmacen) {
                        $("#Error .modal-body p").text('Debes seleccionar el almacen, el tipo de movimiento y la razon');
                        $("#Error").modal("show");
                        return;
                    }
                } else {
                    // Si no es la primera fila, verifica que todas las cantidades no estén vacías
                    let cantidadVacia = false;
                    $('input[name="Cantidad[]"]').each(function () {
                        if ($(this).val() === '') {
                            cantidadVacia = true;
                            return false; // Detiene el bucle si una cantidad está vacía
                        }
                    });

                    if (cantidadVacia) {
                        $("#Error .modal-body p").text('Por favor, ingresa una cantidad antes de agregar un nuevo producto.');
                        $("#Error").modal("show");
                        return;
                    }
                }

                // Verifica si se ha seleccionado un producto en la última fila
                if ($('select[name="Clave[]"]').last().val() === null) {
                    $("#Error .modal-body p").text('Debes seleccionar primero un producto.');
                    $("#Error").modal("show");
                    return;
                }

                // Realiza una solicitud AJAX para obtener la lista de productos
                $.ajax({
                    url: $('#ObtenerProductos').data('url'),
                    type: 'GET',
                    success: function (data) {
                        // Construye las opciones del select para los productos no seleccionados
                        let options = '';
                        data.forEach(producto => {
                            let productoExistente = ProductosSeleccionados.find(item => item === producto.ClaveProducto);
                            if (!productoExistente)
                                options += `<option value="${producto.ClaveProducto}">${producto.Nombre} [${producto.ClaveProducto}]</option>`;
                        });

                        // Agrega una nueva fila a la tabla con los datos obtenidos
                        $('#tabla-productos').append(`
                    <tr class="table-active">
                        <td class="text-center">${key}</td>
                        <td class="text-center">
                            <select name="Clave[]" class="form-control text-center">
                                <option value="" disabled selected> --Seleccionar-- </option>
                                ${options}
                            </select>
                        </td>
                        <td class="text-center" id="Unidad"></td>
                        <td class="text-center" name='Cantidad[]' id="Cantidad" min="1" oninput="validarCantidad(this)"></td>
                        <td class="text-center" name='Costo[]' id="Costo"></td>
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

                        key++; // Incrementa la clave única
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            // Maneja el clic en el botón de eliminación de productos
            $('#tabla-productos').on('click', '.eliminar-btn', function (event) {
                // Previene el comportamiento por defecto del evento
                event.preventDefault();
                // Obtiene la clave del producto de la fila actual
                const claveProducto = $(this).closest('tr').find('td').eq(1).find('select').val();
                // Elimina la fila
                $(this).closest('tr').remove();
                key--; // Decrementa la clave única
                // Filtra las claves de los productos seleccionados para eliminar la clave del producto eliminado
                ProductosSeleccionados = ProductosSeleccionados.filter(producto => producto !== claveProducto);
            });

            // Maneja el clic en el botón 'Enviar-Entrada'
            $('#Enviar-Entrada').click(function () {
                // Previene el comportamiento por defecto del evento
                event.preventDefault();
                let productosCompletos = true;

                // Verifica que se haya agregado al menos un producto
                if ($('tr.table-active').length === 0) {
                    $("#Error .modal-body p").text('Debes agregar por lo menos un producto.');
                    $("#Error").modal("show");
                    return;
                }

                // Verifica que todas las cantidades y precios estén completos
                $('tr.table-active').each(function () {
                    let cantidad = $(this).find('td[name="Cantidad[]"] input').val();
                    let precio = $(this).find('td[name="Costo[]"] input').val();

                    if (!cantidad || cantidad === '' || !precio || precio === '') {
                        productosCompletos = false;
                        return false; // Detiene el bucle si un producto no está completo
                    }
                });

                if (!productosCompletos) {
                    // Muestra un mensaje de error si no se completan todas las cantidades y precios
                    $("#Error .modal-body p").text('Por favor, asegúrate de ingresar una cantidad y un precio para cada producto seleccionado.');
                    $("#Error").modal("show");
                } else {
                    // Envía el formulario si todos los productos están completos
                    $('#formulario').submit();
                }
            });
        }

        // Verifica si el tipo seleccionado es 'Sal' (salida de productos)
        else if ($('#Tipo').val() == 'Sal') {
            // Inicializa la clave única para cada producto
            let key = 1;
            // Almacena las claves de los productos seleccionados para evitar duplicados
            let ProductosSeleccionados = [];

            // Maneja el evento de cambio en el select con nombre 'Almacen'
            $('#Almacen').on('change', function () {
                let key = 1;
                // Limpia la tabla de productos a eliminar
                $('#tabla-productos_eliminar').empty();

                // Realiza una solicitud AJAX para obtener los productos del almacén seleccionado
                $.ajax({
                    url: $('#obtenerProductosAlmacen').data('url'),
                    data: {
                        Almacen: $('#Almacen').val()
                    },
                    type: 'GET',
                    success: function (data) {
                        let options = '';
                        // Construye las opciones del select para los productos no seleccionados
                        data.forEach(producto => {
                            let productoExistente = ProductosSeleccionados.find(item => item === producto.ClaveProducto);
                            if (!productoExistente)
                                options += `<option value="${producto.ClaveProducto}">${producto.Nombre} [${producto.ClaveProducto}]</option>`;
                        });

                        // Agrega una nueva fila a la tabla con los datos obtenidos
                        $('#tabla-productos_eliminar').append(`
                    <tr class="table-active">
                        <td class="text-center">${key}</td>
                        <td class="text-center">
                            <select name="Clave[]" class="form-control text-center">
                                <option value="" disabled selected> --Seleccionar-- </option>
                                ${options}
                            </select>
                        </td>
                        <td class="text-center" id="Unidad"></td>
                        <td class="text-center" id="Existencias"></td>
                        <td class="text-center" name='Cantidad[]' id="Cantidad" min="1" oninput="validarCantidad(this)"></td>
                        <td class="text-center" name='Costo[]' id="Costo"></td>
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
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            // Maneja el evento de cambio en el select con nombre 'Clave[]' en la tabla de productos a eliminar
            $('#tabla-productos_eliminar').on('change', 'select[name="Clave[]"]', function () {
                // Obtiene el valor seleccionado en el select
                let selectedOption = $(this).val();
                // Obtiene la fila actual
                let currentRow = $(this).closest('tr');
                // Agrega la clave del producto seleccionado al array
                ProductosSeleccionados.push(selectedOption);

                // Realiza una solicitud AJAX para obtener los detalles del producto seleccionado desde el servidor
                $.ajax({
                    url: $('#ObtenerDetallesProductosAlmacen').data('url'),
                    data: {
                        ClaveProducto: selectedOption,
                        IdAlmacen: $('#Almacen').val()
                    },
                    type: 'GET',
                    success: function (data) {
                        // Actualiza las columnas 'Unidad', 'Existencias', y agrega campos de entrada para 'Cantidad' y 'Costo'
                        currentRow.find('#Unidad').text(data.UnidadMedida);
                        currentRow.find('#Existencias').text(data.Existencias);
                        currentRow.find('#Cantidad').html(`<input type="number" name="Cantidad[]" class="form-control text-center">`);
                        currentRow.find('#Costo').text(data.Precio);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            // Maneja el clic en el botón 'Eliminar-Producto'
            $('#Eliminar-Producto').click(function () {
                event.preventDefault();
                let SelecionAlmacen = false;
                let SeleccionTipo = false;
                let SeleccionRazon = false;

                // Verifica si se ha seleccionado el almacén, el tipo de movimiento y la razón
                if ($('#Almacen').val() != null)
                    SelecionAlmacen = true;
                else
                    SelecionAlmacen = false;

                if ($('#Tipo').val() != null)
                    SeleccionTipo = true;
                else
                    SeleccionTipo = false;

                if ($('#Razon').val() != null)
                    SeleccionRazon = true;
                else
                    SeleccionRazon = false;

                if (key == 1) {
                    // Si es la primera fila, verifica la selección del almacén, el tipo de movimiento y la razón
                    if (!SeleccionRazon || !SeleccionTipo || !SelecionAlmacen) {
                        $("#Error .modal-body p").text('Debes seleccionar el almacen, el tipo de movimiento y la razon');
                        $("#Error").modal("show");
                        return;
                    }
                } else {
                    // Si no es la primera fila, verifica que todas las cantidades no estén vacías
                    let cantidadVacia = false;
                    $('input[name="Cantidad[]"]').each(function () {
                        if ($(this).val() === '') {
                            cantidadVacia = true;
                            return false; // Detiene el bucle si una cantidad está vacía
                        }
                    });

                    if (cantidadVacia) {
                        $("#Error .modal-body p").text('Por favor, ingresa una cantidad antes de agregar un nuevo producto.');
                        $("#Error").modal("show");
                        return;
                    }
                }

                // Verifica que se haya seleccionado un producto
                if ($('select[name="Clave[]"]').last().val() === null) {
                    $("#Error .modal-body p").text('Debes seleccionar primero un producto.');
                    $("#Error").modal("show");
                    return;
                }

                // Realiza una solicitud AJAX para obtener los productos del almacén seleccionado
                $.ajax({
                    url: $('#obtenerProductosAlmacen').data('url'),
                    data: {
                        Almacen: $('#Almacen').val()
                    },
                    type: 'GET',
                    success: function (data) {
                        let options = '';
                        // Construye las opciones del select para los productos no seleccionados
                        data.forEach(producto => {
                            let productoExistente = ProductosSeleccionados.find(item => item === producto.ClaveProducto);
                            if (!productoExistente)
                                options += `<option value="${producto.ClaveProducto}">${producto.Nombre} [${producto.ClaveProducto}]</option>`;
                        });

                        // Agrega una nueva fila a la tabla con los datos obtenidos
                        $('#tabla-productos_eliminar').append(`
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
                        <td class="text-center" name='Costo[]' id="Costo"></td>
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

                        key++; // Incrementa la clave única
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            // Maneja el clic en el botón de eliminación de productos
            $('#tabla-productos_eliminar').on('click', '.eliminar-btn', function (event) {
                // Previene el comportamiento por defecto del evento
                event.preventDefault();
                // Obtiene la clave del producto de la fila actual
                const claveProducto = $(this).closest('tr').find('td').eq(1).find('select').val();
                // Elimina la fila
                $(this).closest('tr').remove();
                key--; // Decrementa la clave única
                // Filtra las claves de los productos seleccionados para eliminar la clave del producto eliminado
                ProductosSeleccionados = ProductosSeleccionados.filter(producto => producto !== claveProducto);
            });

            // Maneja el clic en el botón 'Enviar-Salida'
            $('#Enviar-Salida').click(function () {
                // Previene el comportamiento por defecto del evento
                event.preventDefault();
                let productosCompletos = true;

                // Verifica que se haya agregado al menos un producto
                if ($('tr.table-active').length === 0) {
                    $("#Error .modal-body p").text('Debes agregar por lo menos un producto.');
                    $("#Error").modal("show");
                    return;
                }

                // Verifica que todas las cantidades estén completas
                $('tr.table-active').each(function () {
                    let cantidad = $(this).find('td[name="Cantidad[]"] input').val();

                    if (!cantidad || cantidad === '') {
                        productosCompletos = false;
                        return false; // Detiene el bucle si una cantidad no está completa
                    }
                });

                if (!productosCompletos) {
                    // Muestra un mensaje de error si no se completan todas las cantidades
                    $("#Error .modal-body p").text('Por favor, asegúrate de ingresar una cantidad para cada producto seleccionado.');
                    $("#Error").modal("show");
                } else {
                    // Envía el formulario si todos los productos están completos
                    $('#formulario').submit();
                }
            });
        }

    })










});


