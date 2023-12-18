$(document).ready(function () {

    /**
     * Manejador de clic para el botón 'Nuevo Proveedor'.
     * Muestra el modal de creación de proveedores al hacer clic.
     */
    $('#btnNuevoProveedor').on('click', function () {
        $('#createproveedor').modal('show');
    });

});