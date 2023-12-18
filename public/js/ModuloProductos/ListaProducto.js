$(document).ready(function () {

    /**
     * Formatea el campo 'PorcentajeInput' para aceptar solo números y el símbolo '%'.
     */
    jQuery("#PorcentajeInput").on("input", function () {
        var inputVal = jQuery(this).val();

        // Limpiar el valor para aceptar solo números y el símbolo '%'
        var cleanedVal = inputVal.replace(/[^0-9.]+$/g, '');

        // Añadir el símbolo '%' si no está presente
        if (!/^\%/.test(cleanedVal)) {
            cleanedVal = "%" + cleanedVal;
        }

        // Actualizar el valor del campo 'PorcentajeInput'
        jQuery(this).val(cleanedVal);
    });


    var CostoProveedor = $('#CostoProveedor').val()


    /**
     * Calcula y muestra el precio sugerido en la tabla al salir del campo 'PorcentajeInput'.
     */
    $("#PorcentajeInput").on("blur", function () {
        // Obtener el porcentaje como número decimal
        var porcentajeDecimal = parseFloat(
            $("#PorcentajeInput")
                .val()
                .replace(/[^\d.]/g, "")
        );

        // Asignar el porcentaje al campo 'Porcentaje'
        $('#Porcentaje').val(porcentajeDecimal);

        // Verificar si el porcentaje es un número válido
        if (!isNaN(porcentajeDecimal)) {
            // Calcular el precio sugerido y actualizar las celdas de la tabla
            $("#CostoProveedorTabla").text("$" + CostoProveedor);
            $("#PrecioSugeridoTabla").text(
                "$" + (CostoProveedor * (1 + porcentajeDecimal / 100)).toFixed(2)
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
     * Manejador de clic para el botón 'Actualizar'.
     * Realiza validaciones antes de enviar el formulario.
     */
    $("#Actualizar").click(function (event) {
        event.preventDefault();

        // Obtener el valor del radio button seleccionado
        SeleccionLista = $('input[name="listas[]"]:checked').val();

        // Validar si la lista seleccionada es la especial y si los campos correspondientes están llenos
        if (SeleccionLista == 0 && ($("#NombreLista").val() == "" || isNaN($('#Porcentaje').val()) || $('#Porcentaje').val() == '')) {
            $("#ErrorLista").modal("show");
        } else {
            // Enviar el formulario
            $('#myForm').submit();
        }
    });
});
