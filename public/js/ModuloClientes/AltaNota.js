$(document).ready(function () {

    /**
     * Verifica si hay datos en los campos relevantes y quita el atributo 'readonly' en consecuencia.
     */
    if (
        $('#Observaciones').val().trim() !== '' ||
        $('#Tema').val().trim() !== '' ||
        $('#FechaProximoSeguimiento').val() !== '' ||
        $('#IdCliente').val() !== null
    ) {
        $('#Observaciones').removeAttr('readonly');
        $('#Tema').removeAttr('readonly');
        $('#FechaProximoSeguimiento').removeAttr('readonly');
    }


    /**
     * Asigna la fecha actual al campo 'FechaCreacion'.
     */
    var FechaAlta = $('#FechaCreacion');
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var formattedFechaAlta = year + '-' + month + '-' + day;

    FechaAlta.val(formattedFechaAlta);
    $('#VisualizarFecha').val(day + '-' + month + '-' + year);



    /**
     * Manejador de cambio para el campo 'IdCliente'.
     */
    $('#IdCliente').on('change', function () {
        var clienteId = $(this).val();
        if (clienteId) {
            // Construir la URL con el identificador del cliente
            var urlDatosCliente = Ruta + '?IdCliente=' + clienteId;

            // Cargar datos del cliente utilizando la URL construida
            $('#DatosCliente').load(urlDatosCliente);
        }

        // Quitar el atributo 'readonly' y limpiar los campos de Observaciones, Tema y FechaProximoSeguimiento
        $('#Observaciones').removeAttr('readonly').val('');
        $('#Tema').removeAttr('readonly').val('');
        $('#FechaProximoSeguimiento').removeAttr('readonly').val('');
    });


    /**
     * Configuración del selector de fechas para el campo 'FechaProximoSeguimiento'.
     */
    var date_input = $('input[name="FechaProximoSeguimiento"]');

    $(function () {
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            startDate: formattedFechaAlta
        }).on('change', function () {
            var fecha = $(this).datepicker('getDate');
            $(this).val(fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());
        });

        // Mostrar el selector de fechas al hacer clic en el elemento con el atributo 'data-toggle="datepicker"'
        $('[data-toggle="datepicker"]').on('click', function () {
            date_input.datepicker('show');
        });
    });




});


