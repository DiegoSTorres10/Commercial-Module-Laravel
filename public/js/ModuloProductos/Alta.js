$(document).ready(function () {


    /**
 * Genera un código hash para una cadena dada.
 * @param {string} str - La cadena de entrada.
 * @returns {number} - Código hash generado.
 */
    function hashCode(str) {
        var hash = 0;
        for (var i = 0; i < str.length; i++) {
            hash = str.charCodeAt(i) + ((hash << 5) - hash);
        }
        return hash;
    }



    /**
  * Inicializa el datepicker y gestiona la lógica de fecha.
  */
    $(function () {
        // Obtener la fecha actual
        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');
        var formattedFechaAlta = year + '-' + month + '-' + day;

        // Selector para el input de fecha
        var date_input = $('input[name="FechaCotizacion"]');

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
     * Manejador de evento blur para el campo 'Nombre'.
     * Calcula una clave única basada en el valor del campo 'Nombre'
     * y actualiza el campo 'ClaveProducto'.
     */
    $('#Nombre').on('blur', function () {
        // Obtener el valor del campo 'Nombre'
        var inputVal = $(this).val();

        // Generar un código hash y tomar los primeros 5 caracteres
        var hash = hashCode(inputVal).toString().slice(0, 5);

        // Combinar parte del nombre con el hash para formar la clave
        var key = inputVal.substring(0, 4) + '-' + hash;

        // Actualizar el valor del campo 'ClaveProducto'
        $('#ClaveProducto').val(key);
    });




    /**
     * Formatea el campo 'CostoProveedor' para aceptar solo números y el símbolo '$'.
     */
    jQuery("#CostoProveedor").on('input', function () {
        var inputVal = jQuery(this).val();

        // Limpiar el valor para aceptar solo números y el símbolo '$'
        var cleanedVal = inputVal.replace(/[^0-9.]+$/g, '');

        // Añadir el símbolo '$' si no está presente
        if (!/^\$/.test(cleanedVal)) {
            cleanedVal = "$" + cleanedVal;
        }

        // Actualizar el valor del campo 'CostoProveedor'
        jQuery(this).val(cleanedVal);
    });


    /**
     * Manejador de clic para el botón 'Siguiente'.
     * Valida y procesa la información antes de redirigir a la siguiente página.
     */
    $('#Siguiente').on('click', function (event) {
        event.preventDefault();

        // Inicializar variables de validación
        var ClaveProducto = true;
        var ErrorTipo = true;
        var ErrorClasificador = true;
        var UnidadMedida = true;
        var ErrorNombre = true;
        var FechaCotizacion = true;
        var ErrorProveedor = true;
        var CostoProveedor = true;
        var IdTipoMoneda = true;

        // Validar la clave del producto
        if ($('#ClaveProducto').val() == '') {
            ClaveProducto = false;
            $('#ErrorClave').text("Error: no puedes dejar en blanco la clave del producto").css('color', 'red');
        } else {
            ClaveProducto = true;
            $('#ErrorClave').text("");
        }

        // Validar el tipo
        if ($('input[name="IdTipo"]:checked').val() == null) {
            ErrorTipo = false;
            $('#ErrorTipo').text("Error: no puedes dejar en blanco el tipo").css('color', 'red');
        } else {
            ErrorTipo = true;
            $('#ErrorTipo').text("");
        }

        // Validar el clasificador
        if ($('#Clasificador').val() == '') {
            ErrorClasificador = false;
            $('#ErrorClasificador').text("Error: no puedes dejar en blanco el clasificador").css('color', 'red');
        } else {
            ErrorClasificador = true;
            $('#ErrorClasificador').text("");
        }

        // Validar la unidad de medida
        if ($('#UnidadMedida').val() == '') {
            UnidadMedida = false;
            $('#ErrorMedida').text("Error: no puedes dejar en blanco la unidad de medida").css('color', 'red');
        } else {
            UnidadMedida = true;
            $('#ErrorMedida').text("");
        }

        // Validar el nombre
        if ($('#Nombre').val() == '') {
            ErrorNombre = false;
            $('#ErrorNombre').text("Error: no puedes dejar en blanco el nombre").css('color', 'red');
        } else {
            ErrorNombre = true;
            $('#ErrorNombre').text("");
        }

        // Validar la fecha de cotización
        if ($('#FechaCotizacion').val() == '') {
            FechaCotizacion = false;
            $('#ErrorFecha').text("Error: no puedes dejar en blanco la fecha").css('color', 'red');
        } else {
            FechaCotizacion = true;
            $('#ErrorFecha').text("");
        }

        // Validar el proveedor
        if ($('#IdProveedor').val() == null) {
            ErrorProveedor = false;
            $('#ErrorProveedor').text("Error: no puedes dejar en blanco el proveedor").css('color', 'red');
        } else {
            ErrorProveedor = true;
            $('#ErrorProveedor').text("");
        }

        // Validar el costo del proveedor
        if ($('#CostoProveedor').val() == '$' || $('#CostoProveedor').val() == '') {
            CostoProveedor = false;
            $('#ErrorCosto').text("Error: no puedes dejar en blanco el costo del proveedor").css('color', 'red');
        } else {
            CostoProveedor = true;
            var costoDecimal = parseFloat($('#CostoProveedor').val().replace(/[^\d.]/g, ''));
            $('#ErrorCosto').text("");
        }

        // Validar el tipo de moneda
        if ($('#IdTipoMoneda').val() == null) {
            IdTipoMoneda = false;
            $('#ErrorMoneda').text("Error: no puedes dejar en blanco el tipo de moneda").css('color', 'red');
        } else {
            IdTipoMoneda = true;
            $('#ErrorMoneda').text("");
        }

        // Si todas las validaciones son exitosas
        if (ClaveProducto && ErrorTipo && ErrorClasificador && UnidadMedida && ErrorNombre && FechaCotizacion && ErrorProveedor && CostoProveedor && IdTipoMoneda) {
            // Construir el objeto producto
            var producto = {
                ClaveProducto: $("#ClaveProducto").val(),
                IdTipo: $("input[name='IdTipo']:checked").val(),
                Clasificador: $("#Clasificador").val(),
                UnidadMedida: $("#UnidadMedida").val(),
                Nombre: $("#Nombre").val(),
                Descripcion: $("#Descripcion").val(),
                FechaCotizacion: $("#FechaCotizacion").val(),
                IdProveedor: $("#IdProveedor").val(),
                CostoProveedor: costoDecimal,
                IdTipoMoneda: $("#IdTipoMoneda").val(),
            };

            // Guardar en el Local Storage
            localStorage.setItem('producto', JSON.stringify(producto));

            // Obtener la URL de redirección y navegar
            var nextUrl = $('#ruta-siguiente').data('url');
            window.location.href = nextUrl + '?producto=' + encodeURIComponent(JSON.stringify(producto));
        }
    });


});


