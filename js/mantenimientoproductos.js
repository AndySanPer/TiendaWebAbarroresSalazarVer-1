$(function() {
    // Funciones y eventos jQuery aquí

    function imprimir() {
        // Lógica para imprimir productos en la tabla
    }

    // Eventos para botones de borrar y modificar
    $('#tabla').on('click', '.borra', function() {
        // Lógica para borrar un producto
    });

    $('#tabla').on('click', '.modifica', function() {
        // Lógica para modificar un producto
    });

    // Evento para el formulario de grabar
    $('#grabar').on('click', function() {
        // Lógica para grabar un nuevo producto
    });

    // Evento para limpiar campos del formulario
    $('#limpiar').on('click', function() {
        // Lógica para limpiar los campos del formulario
    });

    // Función para refrescar la página
    function refrescarpagina() {
        location.reload();
    }

    // Función para limpiar campos del formulario
    function limpiaalta() {
        $('#clave').val('');
        $('#producto').val('');
        $('#ruta').val('');
        $('#alterno').val('');
        $('#descripcion').val('');
        $('#estado').val('');
        $('#precio').val('');
        $('#categoria').val('');
        $('#cantidad').val('');
    }

    // Llamada a la función imprimir al cargar la página
    imprimir();
});


