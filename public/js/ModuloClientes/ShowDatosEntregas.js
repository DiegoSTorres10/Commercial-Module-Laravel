$(document).ready(function () {


    /**
     * Maneja el evento de clic en el botón "BModificar2".
     * Quita el atributo 'readonly' de los campos correspondientes en la sección de datos de entrega.
     * Remueve el botón "BModificar2".
     * Muestra el botón "BotonEnviarDatos2".
     */
    $('#BModificar2').on('click', () => {
        // Quita el atributo 'readonly' de los campos correspondientes en la sección de datos de entrega
        $('#NombreCompletoEntrega').removeAttr('readonly');
        $('#CalleEntrega').removeAttr('readonly');
        $('#NoExteriorEntrega').removeAttr('readonly');
        $('#NoInteriorEntrega').removeAttr('readonly');
        $('#ColoniaEntrega').removeAttr('readonly');
        $('#MunicipioEntrega').removeAttr('readonly');
        $('#EstadoEntrega').removeAttr('readonly');
        $('#PaisEntrega').removeAttr('readonly');
        $('#CPEntrega').removeAttr('readonly');
        $('#Referencias').removeAttr('readonly');

        // Remueve el botón "BModificar2"
        $('#BModificar2').remove();

        // Muestra el botón "BotonEnviarDatos2"
        $('#BotonEnviarDatos2').removeClass('d-none');
    });



    /**
     * Maneja el evento de envío del formulario "formuDatosEntrega".
     * Evita que el formulario se envíe automáticamente y realiza validaciones.
     * Muestra mensajes de error si los campos obligatorios no están completos.
     * Envía el formulario solo si la validación es exitosa.
     */
    $('#formuDatosEntrega').submit(function (event) {
        event.preventDefault();

        var correcto1 = true;

        // Validaciones de campos obligatorios
        if ($('#NombreCompletoEntrega').val() == '') {
            $('#ErrorFacNombre').text("No puedes dejar vacío el nombre").css('color', 'red');
        } else {
            $('#ErrorFacNombre').text("");
        }

        if ($('#CalleEntrega').val() == '') {
            correcto1 = false;
            $('#ErrorFacCalle').text("No puedes dejar vacío la calle").css('color', 'red');
        } else {
            $('#ErrorFacCalle').text("");
        }

        if ($('#NoExteriorEntrega').val() == '') {
            correcto1 = false;
            $('#ErrorFacNoExterior').text("No puedes dejar vacío el No. Exterior").css('color', 'red');
        } else {
            $('#ErrorFacNoExterior').text("");
        }

        if ($('#ColoniaEntrega').val() == '') {
            correcto1 = false;
            $('#ErrorFacColonia').text("No puedes dejar vacío la colonia").css('color', 'red');
        } else {
            $('#ErrorFacColonia').text("");
        }

        if ($('#MunicipioEntrega').val() == '') {
            correcto1 = false;
            $('#ErrorFacMunicipio').text("No puedes dejar vacío el municipio").css('color', 'red');
        } else {
            $('#ErrorFacMunicipio').text("");
        }

        if ($('#EstadoEntrega').val() == '') {
            correcto1 = false;
            $('#ErrorFacEstado').text("No puedes dejar vacío el estado").css('color', 'red');
        } else {
            $('#ErrorFacEstado').text("");
        }

        if ($('#CPEntrega').val() == '') {
            correcto1 = false;
            $('#ErrorFacCP').text("No puedes dejar vacío el CP").css('color', 'red');
        } else {
            $('#ErrorFacCP').text("");
        }

        // Envía el formulario solo si la validación es exitosa
        if (correcto1) {
            this.submit();
        }
    });


});