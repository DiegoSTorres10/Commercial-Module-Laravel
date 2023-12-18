$(document).ready(function () {

    /**
     * Recupera el objeto de producto almacenado en el Local Storage.
     */
    var producto = JSON.parse(localStorage.getItem("producto"));

    /**
 * Formatea el campo 'Porcentaje' para aceptar solo números y el símbolo '%'.
 */
    jQuery("#Porcentaje").on("input", function () {
        var inputVal = jQuery(this).val();

        // Limpiar el valor para aceptar solo números y el símbolo '%'
        var cleanedVal = inputVal.replace(/[^0-9.]+$/g, '');

        // Añadir el símbolo '%' si no está presente
        if (!/^\%/.test(cleanedVal)) {
            cleanedVal = "%" + cleanedVal;
        }

        // Actualizar el valor del campo 'Porcentaje'
        jQuery(this).val(cleanedVal);
    });

    /**
 * Calcula y muestra el precio sugerido en la tabla al salir del campo 'Porcentaje'.
 */
    $("#Porcentaje").on("blur", function () {
        // Obtener el porcentaje como número decimal
        var porcentajeDecimal = parseFloat(
            $("#Porcentaje")
                .val()
                .replace(/[^\d.]/g, "")
        );

        // Verificar si el porcentaje es un número válido
        if (!isNaN(porcentajeDecimal)) {
            // Calcular el precio sugerido y actualizar las celdas de la tabla
            $("#CostoProveedorTabla").text("$" + producto.CostoProveedor);
            $("#PrecioSugeridoTabla").text(
                "$" + (producto.CostoProveedor * (1 + porcentajeDecimal / 100)).toFixed(2)
            );
            $("#Seleccionada").attr("checked", "checked");
        } else {
            // Limpiar las celdas de la tabla si el porcentaje no es válido
            $("#PrecioSugeridoTabla").text("");
            $("#CostoProveedorTabla").text("");
            $("#Seleccionada").removeAttr("checked");
        }
    });

    /**
     * Manejador de clic para el botón 'Regresar'.
     * Recupera los datos del producto del Local Storage y regresa a la vista anterior.
     */
    $("#botonRegresar").click(function (event) {
        event.preventDefault();

        // Obtener los datos del Local Storage
        var producto = JSON.parse(localStorage.getItem("producto"));



        // Redirigir a la vista anterior
        window.history.back();
    });

    /**
     * Manejador de evento para el modal 'Congratulations' cuando se oculta.
     * Redirige a la siguiente URL al ocultar el modal.
     */
    $("#Congratulations").on('hidden.bs.modal', function (e) {
        var nextUrl = $('#Finalizado').data('url');
        window.location.href = nextUrl;
    });


    /**
     * Envía los datos del producto al servidor mediante una solicitud AJAX.
     */
    function enviar() {
        // Asignar el IdLista al objeto producto
        producto.IdLista = SeleccionLista;

        // Configurar encabezados para la solicitud AJAX
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Obtener la URL para la solicitud AJAX
        var url = $("#NuevoProducto").data("url");

        // Realizar la solicitud AJAX
        $.ajax({
            type: "POST",
            url: url,
            data: {
                Producto: producto,
            },
            success: function (response) {
                // Mostrar el modal de felicitaciones en caso de éxito
                $("#Congratulations").modal("show");
            },
            error: function (xhr, status, error) {
                // Mostrar el modal de error con el mensaje recibido del servidor
                var errorMessage = JSON.parse(xhr.responseText).errors[0];
                $("#Error .modal-body p").text(errorMessage);
                $("#Error").modal("show");
            },
        });
    }

    /**
     * Manejador de clic para el botón 'Enviar'.
     * Realiza validaciones y envía los datos al servidor mediante AJAX.
     */
    $("#Enviar").click(function (event) {
        event.preventDefault();

        // Obtener el valor del radio button seleccionado
        SeleccionLista = $('input[name="listas[]"]:checked').val();

        // Validar si no se ha seleccionado ninguna lista
        if (SeleccionLista == null) {
            $("#ErrorEnviar").modal("show");
        } else {
            // Obtener el porcentaje como número decimal
            var porcentajeDecimal = parseFloat(
                $("#Porcentaje")
                    .val()
                    .replace(/[^\d.]/g, "")
            );

            // Validar si la lista seleccionada es la especial y si los campos correspondientes están llenos
            if (SeleccionLista == 0 && ($("#NombreLista").val() == "" || isNaN(porcentajeDecimal))) {
                $("#ErrorLista").modal("show");
            } else {
                // Realizar la lógica de AJAX
                if (SeleccionLista == 0) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    let NombreLista = $("#NombreLista").val();
                    var url = $("#ruta").data("url");

                    const myFunction = () => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    NombreLista: NombreLista,
                                    Porcentaje: porcentajeDecimal,
                                },
                                success: function (response) {
                                    SeleccionLista = response.IdLista;
                                    resolve(true); // Resolve con true si la petición tiene éxito
                                },
                                error: function (xhr, status, error) {
                                    $("#Error").modal("show");
                                    reject(error); // Rechazar si hay un error en la petición
                                },
                            });
                        });
                    };

                    myFunction()
                        .then((result) => {
                            enviar();
                            return;
                        })
                        .catch((error) => {
                            console.error(error);
                        });

                    return; // Detener la ejecución del código después de la lógica AJAX
                }

                // Si la lista no es la especial, simplemente enviar los datos
                enviar();
            }
        }
    });



});
