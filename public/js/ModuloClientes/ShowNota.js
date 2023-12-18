$(document).ready(function () {
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var formattedFechaAlta = year + '-' + month + '-' + day;

    var date_input = $('input[name="FechaProximoSeguimiento"]');


    /**
     * Configura el selector de fecha (datepicker) en el formato y con las opciones especificadas.
     * También agrega eventos para actualizar el formato al seleccionar una fecha y mostrar el datepicker al hacer clic en un elemento con el atributo 'data-toggle="datepicker"'.
     */
    $(function () {
        // Configura el datepicker
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            startDate: formattedFechaAlta
        }).on('change', function () {
            // Actualiza el valor del input al formato deseado al cambiar la fecha
            var fecha = $(this).datepicker('getDate');
            $(this).val(fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());
        });

        // Agrega un evento para mostrar el datepicker al hacer clic en elementos con 'data-toggle="datepicker"'
        $('[data-toggle="datepicker"]').on('click', function () {
            date_input.datepicker('show');
        });
    });




});

