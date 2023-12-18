$(document).ready(function () {


    /**
     * Maneja el evento de clic en el botón "BModificar1".
     * Habilita la edición de campos en el formulario de facturación.
     * Oculta el botón "BModificar1" y muestra el botón "BotonEnviarDatos".
     */
    $('#BModificar1').on('click', () => {
        $('#NombreCompletoFacturacion').removeAttr('readonly');
        $('#CalleFacturacion').removeAttr('readonly');
        $('#NoExteriorFacturacion').removeAttr('readonly');
        $('#NoInteriorFacturacion').removeAttr('readonly');
        $('#ColoniaFactura').removeAttr('readonly');
        $('#MunicipioFactura').removeAttr('readonly');
        $('#EstadoFactura').removeAttr('readonly');
        $('#PaisFactura').removeAttr('readonly');
        $('#CPFactura').removeAttr('readonly');
        $('#BModificar1').remove(); // Elimina el botón "BModificar1"
        $('#BotonEnviarDatos').removeClass('d-none'); // Muestra el botón "BotonEnviarDatos"
    });


    /**
     * Maneja el evento de envío del formulario de datos de facturación.
     * Realiza validaciones y muestra mensajes de error si es necesario.
     * Envía el formulario si todas las validaciones son exitosas.
     */
    $('#formuDatosFactura').submit(function (event) {
        event.preventDefault();

        var correcto1 = true;

        // Validación del campo "NombreCompletoFacturacion"
        if ($('#NombreCompletoFacturacion').val() == '') {
            $('#ErrorFacNombre').text("No puedes dejar vacío el nombre").css('color', 'red');
            correcto1 = false;
        } else {
            $('#ErrorFacNombre').text("");
        }

        // Validación del campo "CalleFacturacion"
        if ($('#CalleFacturacion').val() == '') {
            $('#ErrorFacCalle').text("No puedes dejar vacío la calle").css('color', 'red');
            correcto1 = false;
        } else {
            $('#ErrorFacCalle').text("");
        }

        // Validación del campo "NoExteriorFacturacion"
        if ($('#NoExteriorFacturacion').val() == '') {
            correcto1 = false;
            $('#ErrorFacNoExterior').text("No puedes dejar vacío el No. Exterior").css('color', 'red');
        } else {
            $('#ErrorFacNoExterior').text("");
        }

        // Validación del campo "ColoniaFactura"
        if ($('#ColoniaFactura').val() == '') {
            correcto1 = false;
            $('#ErrorFacColonia').text("No puedes dejar vacío la colonia").css('color', 'red');
        } else {
            $('#ErrorFacColonia').text("");
        }

        // Validación del campo "MunicipioFactura"
        if ($('#MunicipioFactura').val() == '') {
            correcto1 = false;
            $('#ErrorFacMunicipio').text("No puedes dejar vacío el municipio").css('color', 'red');
        } else {
            $('#ErrorFacMunicipio').text("");
        }

        // Validación del campo "EstadoFactura"
        if ($('#EstadoFactura').val() == '') {
            correcto1 = false;
            $('#ErrorFacEstado').text("No puedes dejar vacío el estado").css('color', 'red');
        } else {
            $('#ErrorFacEstado').text("");
        }

        // Validación del campo "CPFactura"
        if ($('#CPFactura').val() == '') {
            correcto1 = false;
            $('#ErrorFacCP').text("No puedes dejar vacío el CP").css('color', 'red');
        } else {
            $('#ErrorFacCP').text("");
        }

        // Envía el formulario si todas las validaciones son exitosas
        if (correcto1) {
            this.submit();
        }
    });


});