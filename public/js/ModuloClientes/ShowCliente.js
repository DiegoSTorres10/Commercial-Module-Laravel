$(document).ready(function () {

    /**
     * Maneja el evento de clic en el botón "Modificar".
     * Habilita la edición de los campos del formulario deshabilitando el atributo "readonly".
     * Oculta el botón "Modificar" y muestra el botón "Enviar".
     */
    $('#BModificar').on('click', () => {
        // Habilita la edición de los campos del formulario deshabilitando el atributo "readonly"
        $('#NombreCompleto').removeAttr('readonly');
        $('#CURP').removeAttr('readonly');
        $('#RFC').removeAttr('readonly');
        $('#TipoCliente').removeAttr('readonly');
        $('#Calle').removeAttr('readonly');
        $('#NoExterior').removeAttr('readonly');
        $('#NoInterior').removeAttr('readonly');
        $('#Colonia').removeAttr('readonly');
        $('#Municipio').removeAttr('readonly');
        $('#Estado').removeAttr('readonly');
        $('#Pais').removeAttr('readonly');
        $('#CP').removeAttr('readonly');
        $('#tel1').removeAttr('readonly');
        $('#tel2').removeAttr('readonly');
        $('#Email').removeAttr('readonly');

        // Oculta el botón "Modificar" y muestra el botón "Enviar"
        $('#BModificar').addClass('d-none');
        $('#BotonEnviar').removeClass('d-none');
    });



    /**
     * Obtiene el ID del cliente desde el campo con ID "Clave".
     * Construye la URL de la factura utilizando el ID del cliente.
     * Maneja el evento de clic en el botón "BDatosFiscales".
     * Carga los datos de la factura en el contenedor con ID "DatosFactura" utilizando la URL construida.
     * Elimina el elemento con ID "BDatosFiscalesDIV".
     */
    var clientId = $("#Clave").val();
    var url = RutaFactura + '?IdCliente=' + clientId;

    $('#BDatosFiscales').on('click', () => {
        // Carga los datos de la factura en el contenedor con ID "DatosFactura" utilizando la URL construida
        $("#DatosFactura").load(url);

        // Elimina el elemento con ID "BDatosFiscalesDIV"
        $('#BDatosFiscalesDIV').remove();
    });


    /**
     * Construye la URL de los datos de entregas utilizando el ID del cliente.
     * Maneja el evento de clic en el botón "BDatosEntregas".
     * Carga los datos de entregas en el contenedor con ID "DatosEntregas" utilizando la URL construida.
     * Elimina el elemento con ID "BDatosEntregasDIV".
     */
    var urlDatosEntregas = RutaEntregas + '?IdCliente=' + clientId;

    $('#BDatosEntregas').on('click', () => {
        // Carga los datos de entregas en el contenedor con ID "DatosEntregas" utilizando la URL construida
        $("#DatosEntregas").load(urlDatosEntregas);

        // Elimina el elemento con ID "BDatosEntregasDIV"
        $('#BDatosEntregasDIV').remove();
    });





});  