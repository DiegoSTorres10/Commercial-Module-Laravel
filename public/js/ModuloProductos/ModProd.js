$(document).ready(function () {


    /**
     * Inicializa el datepicker y gestiona la lógica de fecha.
     */
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var formattedFechaAlta = year + '-' + month + '-' + day;

    // Selector para el input de fecha
    var date_input = $('input[name="FechaCotizacion"]');

    $(function () {
        // Configurar el datepicker
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            startDate: formattedFechaAlta
        }).on('change', function () {
            // Formatear la fecha seleccionada y actualizar el valor del input
            var fecha = $(this).datepicker('getDate');
            $(this).val(fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());
        });

        // Mostrar el datepicker al hacer clic en el elemento con data-toggle="datepicker"
        $('[data-toggle="datepicker"]').on('click', function () {
            date_input.datepicker('show');
        });
    });



    /**
     * Inicializa el datepicker y muestra el campo de fecha al hacer clic en el botón correspondiente.
     */
    $(function () {
        $('[data-toggle="datepicker1"]').on('click', function () {
            var $form = $(this).closest('form'); // Encuentra el formulario más cercano al botón
            var $dateInput = $form.find('.fecha-cotizacion'); // Encuentra el campo de fecha específico dentro de ese formulario

            // Configurar el datepicker
            $dateInput.datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
                startDate: formattedFechaAlta
            }).on('change', function () {
                // Formatear la fecha seleccionada y actualizar el valor del input
                var fecha = $(this).datepicker('getDate');
                $(this).val(fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());
            }).datepicker('show'); // Mostrar el datepicker
        });
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
     * Inicializa la lógica para el manejo de costos de proveedor.
     */
    $(function () {
        $('.costo-proveedor').each(function () {
            var $costoProveedor = $(this);
            var costoProveedorBueno = $costoProveedor.closest('form').find('.costo-proveedor-bueno');
            var costo = $costoProveedor.val().replace(/[^\d.]/g, '');
            costoProveedorBueno.val(parseFloat(costo));

            $costoProveedor.on('input', function () {
                // Limpiar el valor para aceptar solo números y el símbolo '$'
                var inputVal = $(this).val();
                var cleanedVal = inputVal.replace(/[^0-9.]+$/g, '');
                if (!/^\$/.test(cleanedVal)) {
                    cleanedVal = "$" + cleanedVal;
                }
                $(this).val(cleanedVal);

                // Actualizar el valor del costoProveedorBueno
                var costo = $costoProveedor.val().replace(/[^\d.]/g, '');
                if (costo != 0) {
                    costoProveedorBueno.val(parseFloat(costo));
                } else {
                    costoProveedorBueno.val('');
                }
            });
        });
    });



    /**
     * Manejador de clic para el botón 'AgregarDistribuidor'.
     * Muestra el modal del formulario al hacer clic.
     */
    $('#AgregarDistribuidor').on('click', function () {
        $('#FormularioModal').modal('show');
    });

    /**
     * Manejador de clic para el botón 'EnviarFomulario'.
     * Realiza validaciones y envía el formulario mediante AJAX.
     */
    $('#EnviarFomulario').on('click', function (event) {
        event.preventDefault();

        // Variables para validación
        var FechaCotizacion = true;
        var ErrorProveedor = true;
        var CostoProveedor = true;
        var IdTipoMoneda = true;
        var ErrorRadio = true;

        // Validaciones
        if ($('#FechaCotizacion').val() == '') {
            FechaCotizacion = false;
            $('#ErrorFecha').text("Error no puedes dejar en blanco la fecha").css('color', 'red');
        } else {
            FechaCotizacion = true;
            $('#ErrorFecha').text("");
        }

        if ($('#IdProveedor').val() == null) {
            ErrorProveedor = false;
            $('#ErrorProveedor').text("Error no puedes dejar en blanco el proveedor").css('color', 'red');
        } else {
            ErrorProveedor = true;
            $('#ErrorProveedor').text("");
        }

        if ($('#CostoProveedor').val() == '$' || $('#CostoProveedor').val() == '') {
            CostoProveedor = false;
            $('#ErrorCosto').text("Error no puedes dejar en blanco el costo proveedor").css('color', 'red');
        } else {
            CostoProveedor = true;
            $('#ErrorCosto').text("");
        }

        if ($('#IdTipoMoneda').val() == null) {
            IdTipoMoneda = false;
            $('#ErrorMoneda').text("Error no puedes dejar en blanco el tipo de moneda").css('color', 'red');
        } else {
            IdTipoMoneda = true;
            $('#ErrorMoneda').text("");
        }

        if ($('input[name="Seleccionado"]:checked').length === 0) {
            ErrorRadio = false;
            $('#ErrorRadio').text("Error no puedes dejar en blanco el quieres escoger como tu distribuidor").css('color', 'red');
        } else {
            ErrorRadio = true;
            $('#ErrorRadio').text("");
        }

        // Envío de formulario si todas las validaciones son exitosas
        if (IdTipoMoneda && CostoProveedor && ErrorProveedor && FechaCotizacion && ErrorRadio) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            let ClaveProducto = $('#ClaveProducto').val();
            let IdProveedor = $('#IdProveedor').val();
            let FechaCotizacion = $('#FechaCotizacion').val();
            let IdTipoMoneda = $('#IdTipoMoneda').val();
            var costoDecimal = parseFloat($('#CostoProveedor').val().replace(/[^\d.]/g, ''));
            let valorSeleccionado = $('input[name="Seleccionado"]:checked').val();
            var url = $("#NuevoDistribuidor").data("url");

            // Realizar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    ClaveProducto: ClaveProducto,
                    IdProveedor: IdProveedor,
                    FechaCotizacion: FechaCotizacion,
                    IdTipoMoneda: IdTipoMoneda,
                    CostoProveedor: costoDecimal,
                    valorSeleccionado: valorSeleccionado,
                },
                success: function (response) {
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
    });


});


