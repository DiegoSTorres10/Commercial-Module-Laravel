$(document).ready(function () {

    /**
     * Valida si algunos de los campos requeridos está vacío o nulo.
     * Retorna true si algún campo está vacío o nulo, de lo contrario, retorna false.
     */
    function validarCampos() {
        return (
            $('#NombreCompleto').val() === '' ||
            $('#Calle').val() === '' ||
            $('#Colonia').val() === '' ||
            $('#NoExterior').val() === '' ||
            $('#Municipio').val() === '' ||
            $('#Estado').val() === '' ||
            $('#Pais').val() === null ||
            $('#CP').val() === ''
        );
    }


    /**
     * Inicializa el campo de fecha 'FechaAlta' con la fecha actual.
     */
    var FechaAlta = $('#FechaAlta');
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');

    FechaAlta.val(year + '-' + month + '-' + day);


    /**
     * Configura la entrada para aceptar solo dígitos en el campo 'CP'.
     */
    jQuery("#CP").on('input', function () {
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]+$/g, ''));
    });

    /**
     * Configura la entrada para aceptar solo dígitos en el campo 'tel1'.
     */
    jQuery("#tel1").on('input', function () {
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]+$/g, ''));
    });

    /**
     * Manejador de cambio para la casilla de verificación 'Extranjero'.
     * Establece el valor del campo 'RFC' y su atributo de solo lectura en consecuencia.
     */
    $('#Extranjero').on('change', function () {
        if ($(this).is(':checked')) {
            $('#RFC').val('XEXX010101000');
            $('#RFC').attr('readonly', 'readonly');
        } else {
            $('#RFC').val('');
            $('#RFC').removeAttr('readonly');
        }
    });




    /**
     * Manejador de eventos 'keyup' para el campo 'RFC'.
     * Convierte el valor a mayúsculas y valida su formato, cambiando el color en consecuencia.
     */
    $('#RFC').keyup(function () {
        this.value = this.value.toUpperCase();
        var rfc = $("#RFC").val();
        var regex = /^[A-Z]{4}\d{6}[A-Z0-9]{3,4}$/;

        if (rfc != '') {
            if (regex.test(rfc)) {
                $('#RFC').css('color', 'green');
            } else {
                $('#RFC').css('color', 'red');
            }
        }
    });


    /**
     * Expresión regular para validar el formato de una dirección de correo electrónico.
     */
    var email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2})?$/;

    /**
     * Manejador de eventos 'keyup' para el campo 'Email'.
     * Valida el formato de la dirección de correo electrónico y muestra un mensaje correspondiente.
     */
    $('#Email').on('keyup', function () {
        var correo = $(this).val();
        if (correo === '') {
            $('#msgCorreo').text('');
            return;
        }
        if (email.test(correo)) {
            $('#msgCorreo').text('Correo válido').css('color', 'green');
        } else {
            $('#msgCorreo').text('Correo inválido, no tiene el formato adecuado').css('color', 'red');
        }
    });



    /**
     * Manejador de clic para el botón 'BDatosEntregas'.
     * Muestra el contenedor de datos de entregas y elimina el botón correspondiente.
     */
    $('#BDatosEntregas').on('click', () => {
        $('#ContenedorDatosEntregas').removeClass('d-none');
        // $('#BDatosEntregas').addClass('d-none');
        $('#BDatosEnt').remove();
    });

    /**
     * Manejador de clic para el botón 'BDatosFiscales'.
     * Muestra el contenedor de datos fiscales y elimina el botón correspondiente.
     */
    $('#BDatosFiscales').on('click', () => {
        $('#ContenedorDatosFiscales').removeClass('d-none');
        // $('#BDatosFiscales').addClass('d-none');
        $('#BDatosFis').remove();
    });



    /**
     * Manejador de clic para los botones de opciones de entrega.
     */
    $('input[type="radio"][name="radioOptionsEntrega"]').click(function () {
        if ($(this).val() === "si") {
            if (validarCampos()) {
                $('#errorModal').modal('show');
                $("#radioSiEntrega").prop("checked", false);
            }
            else {
                // Asignar valores de los campos de dirección de facturación a los campos de dirección de entrega
                $('#NombreCompletoEntrega').val($('#NombreCompleto').val());
                $('#CalleEntrega').val($('#Calle').val());
                $('#NoExteriorEntrega').val($('#NoExterior').val());
                $('#NoInteriorEntrega').val($('#NoInterior').val());
                $('#ColoniaEntrega').val($('#Colonia').val());
                $('#MunicipioEntrega').val($('#Municipio').val());
                $('#EstadoEntrega').val($('#Estado').val());

                // Copiar la selección de país
                var selectedId = $('#Pais option:selected').val();
                var selectedValue = $('#Pais option:selected').text();
                $('#PaisEntrega').val(selectedId);
                $('#PaisEntrega option:contains(' + selectedValue + ')').prop('selected', true);

                // Copiar el código postal
                $('#CPEntrega').val($('#CP').val());
            }
        }
    });




    /**
     * Manejador de clic para los botones de opciones de facturación.
     */
    $('input[type="radio"][name="radioOptions"]').click(function () {
        if ($(this).val() === "si") {
            if (validarCampos()) {
                $('#errorModal').modal('show');
                $("#radioSi").prop("checked", false);
            }
            else {
                // Asignar valores de los campos de dirección de entrega a los campos de dirección de facturación
                $('#NombreCompletoFacturacion').val($('#NombreCompleto').val());
                $('#CalleFacturacion').val($('#Calle').val());
                $('#NoExteriorFacturacion').val($('#NoExterior').val());
                $('#NoInteriorFacturacion').val($('#NoInterior').val());
                $('#ColoniaFactura').val($('#Colonia').val());
                $('#MunicipioFactura').val($('#Municipio').val());
                $('#EstadoFactura').val($('#Estado').val());

                // Copiar la selección de país
                var selectedId = $('#Pais option:selected').val();
                var selectedValue = $('#Pais option:selected').text();
                $('#PaisFactura').val(selectedId);
                $('#PaisFactura option:contains(' + selectedValue + ')').prop('selected', true);

                // Copiar el código postal
                $('#CPFactura').val($('#CP').val());
            }
        }
    });


    /**
     * Verifica si hay datos de facturación y muestra el contenedor correspondiente.
     */
    if (
        $('#NombreCompletoFacturacion').val() !== '' ||
        $('#CalleFacturacion').val() !== '' ||
        $('#NoExteriorFacturacion').val() !== '' ||
        $('#ColoniaFactura').val() !== '' ||
        $('#MunicipioFactura').val() !== '' ||
        $('#EstadoFactura').val() !== '' ||
        $('#PaisFactura').val() !== null ||
        $('#CPFactura').val() !== ''
    ) {
        $('#ContenedorDatosFiscales').removeClass('d-none');
        $('#BDatosFiscales').addClass('d-none');
    }

    /**
     * Verifica si hay datos de entrega y muestra el contenedor correspondiente.
     */
    if (
        $('#NombreCompletoEntrega').val() !== '' ||
        $('#CalleEntrega').val() !== '' ||
        $('#NoExteriorEntrega').val() !== '' ||
        $('#ColoniaEntrega').val() !== '' ||
        $('#MunicipioEntrega').val() !== '' ||
        $('#EstadoEntrega').val() !== '' ||
        $('#PaisEntrega').val() !== null ||
        $('#CPEntrega').val() !== ''
    ) {
        $('#ContenedorDatosEntregas').removeClass('d-none');
        $('#BDatosEntregas').addClass('d-none');
    }



    // $('#formulario').submit(function(event){
    //     event.preventDefault();



    //     if ($('#NombreCompletoFacturacion').val()==='' ||$('#CalleFacturacion').val()===''  ||$('#NoExteriorFacturacion').val()==='' || $('#ColoniaFactura').val()===''  || $('#MunicipioFactura').val()==='' || $('#EstadoFactura').val()==='' || $('#PaisFactura').val()===null ||  $('#CPFactura').val()===''
    //     || $('#NombreCompletoEntrega').val()==='' ||$('#CalleEntrega').val()===''  ||$('#NoExteriorEntrega').val()==='' || $('#ColoniaEntrega').val()===''  || $('#MunicipioEntrega').val()==='' || $('#EstadoEntrega').val()==='' || $('#PaisEntrega').val()===null ||  $('#CPEntrega').val()===''){
    //         $('#ErrorEnviar').modal('show');
    //         return;
    //     }else{
    //         this.submit();
    //     }



    // })


});


