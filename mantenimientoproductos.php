<?php 
include_once "encabezado.php";
include_once "servidor.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mantenimientoproductos.css"> <!-- Archivo CSS separado -->
   

    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/mantenimientoproductos.js"></script> <!-- Archivo JS separado -->

    <script>
      $(function() {
    function imprimir() {
        $.getJSON("consultaproductos.php", {}, function(datos) {
            // Limpiar tabla antes de agregar datos nuevos
            $("#tabla tbody").empty();

            // Iterar sobre los datos recibidos
            for (let i = 0; i < datos.length; i++) {
                // Crear una nueva fila en la tabla y agregar los datos
                var row = '<tr>' +
                    '<td>' + datos[i].id + '</td>' +
                    '<td>' + datos[i].producto + '</td>' +
                    '<td>' + datos[i].imagen + '</td>' +
                    '<td>' + datos[i].alterno + '</td>' +
                    '<td>' + datos[i].descripcion + '</td>' +
                    '<td>' + datos[i].estado + '</td>' +
                    '<td>' + datos[i].precio + '</td>' +
                    '<td>' + datos[i].categoria + '</td>' +
                    '<td>' + datos[i].cantidad + '</td>' +
                    '<td>' + datos[i].proveedor + '</td>' +
                    '<td><button class="borra btn" data-id="' + datos[i].id + '"><img class="img-fluid" src="img/basurachico.png"></button></td>' +
                    '<td><button class="modifica btn" data-id="' + datos[i].id + '"><img class="img-fluid" id="cambia" src="img/modificarchico.png"></button></td>' +
                    '</tr>';
                $("#tabla tbody").append(row);
            }
        });
    }

    // Llamar a la función imprimir al cargar la página
    imprimir();

    // Eventos y funciones adicionales pueden seguir aquí según sea necesario

    $('#grabar').on('click', function(){
    var id = $('#id').val();
    var producto = $('#producto').val();
    var imagen = $('#imagen').val();
    var alterno = $('#alterno').val();
    var descripcion = $('#descripcion').val();
    var estado = $('#estado').val();
    var precio = $('#precio').val();
    var categoria = $('#categoria').val();
    var cantidad = $('#cantidad').val();
    var proveedor = $('#proveedor').val();
    
    $.getJSON("altaproductos.php", {id:id,producto: producto,imagen: imagen,alterno: alterno,descripcion: descripcion,estado: estado,precio: precio,categoria: categoria,cantidad: cantidad,proveedor: proveedor}, function(resultados) {
        if (resultados == 'okey') {
                    alert('¡Registro dado de alta con exito!');
                    limpiaalta();
                    refrescarpagina();
                    imprimir(); // Actualizar la tabla después de borrar
                } else {
                    alert('Ocurrió un error al intentar borrar el registro :(');
                }
    });
});

    // Función para mostrar mensajes
    function muestraMensaje(mensaje) {
        // Aquí puedes ajustar cómo quieres mostrar el mensaje, por ejemplo, usando Bootstrap toast, alertas personalizadas, etc.
        alert(mensaje); // Ejemplo básico con alert
    }

    // Evento para borrar un producto
    $('#tabla').on('click', '.borra', function() {
        var id = $(this).data('id');
        var confirma = confirm("¿Estás seguro de borrar el registro?");
        if (confirma) {
            $.getJSON("btnborrarproducto.php", { registro: id }, function(resultados) {
                if (resultados == 'okey') {
                    muestraMensaje('¡Registro borrado con éxito!');
                    imprimir(); // Actualizar la tabla después de borrar
                } else {
                    muestraMensaje('Ocurrió un error al intentar borrar el registro :(');
                }
            });
        } else {
            muestraMensaje('Solicitud cancelada con éxito');
        }
    });

    // Función para limpiar campos del formulario
    $('#limpiar').on('click', function() {
        limpiaalta();
    });

    function limpiaalta() {
        // Limpiar los valores de los campos del formulario
        $('#id').val('');
        $('#producto').val('');
        $('#imagen').val('');
        $('#alterno').val('');
        $('#descripcion').val('');
        $('#estado').val('');
        $('#precio').val('');
        $('#categoria').val('');
        $('#cantidad').val('');
        $('#proveedor').val('');
    }

    // Función para refrescar la página
    function refrescarpagina() {
        location.reload();
    }

    $('#tabla').on('click', '.modifica', function() {
            var id = $(this).data('id');
            var producto = $(this).closest('tr').find('td:eq(1)').text();
            var imagen = $(this).closest('tr').find('td:eq(2)').text();
            var alterno = $(this).closest('tr').find('td:eq(3)').text();
            var descripcion = $(this).closest('tr').find('td:eq(4)').text();
            var estado = $(this).closest('tr').find('td:eq(5)').text();
            var precio = $(this).closest('tr').find('td:eq(6)').text();
            var categoria = $(this).closest('tr').find('td:eq(7)').text();
            var cantidad = $(this).closest('tr').find('td:eq(8)').text();
            var proveedor = $(this).closest('tr').find('td:eq(9)').text();

            // Asignar valores a los campos del formulario de modificación
            $('#id').val(id).prop('readonly', true);
            $('#producto').val(producto);
            $('#imagen').val(imagen);
            $('#alterno').val(alterno);
            $('#descripcion').val(descripcion);
            $('#estado').val(estado);
            $('#precio').val(precio);
            $('#categoria').val(categoria);
            $('#cantidad').val(cantidad);
            $('#proveedor').val(proveedor);
        });



});


    </script>
    
</head>
<body>
<div class="container-fluid">
    <h1 class="titulo">Mantenimiento de Productos</h1>
    <div class="row">
        <div class="col-md-4 formulario">
            <!-- Formulario de registro de datos -->
            <form id="formulario-productos">
                <div class="mb-3">
                    <label for="clave" class="form-label">ID</label>
                    <input type="number" class="form-control" id="id" readonly>
                </div>
                <div class="mb-3">
                    <label for="producto" class="form-label" >PRODUCTO</label>
                    <input type="text" class="form-control" id="producto" >
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label" >IMAGEN</label>
                    <input type="text" class="form-control" id="imagen" >
                </div>
                <div class="mb-3">
                    <label for="alterno" class="form-label" >ALTERNO</label>
                    <input type="text" class="form-control" id="alterno" >
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label" >DESCRIPCIÓN</label>
                    <input type="text" class="form-control" id="descripcion" >
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label" >ESTADO</label>
                    <input type="text" class="form-control" id="estado" >
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">PRECIO</label>
                    <input type="number" class="form-control" id="precio" name="precio">
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label" >CATEGORIA</label>
                    <input type="text" class="form-control" id="categoria" >
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label" >CANTIDAD</label>
                    <input type="number" class="form-control" id="cantidad" >
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label" >PROVEEDOR</label>
                    <input type="text" class="form-control" id="proveedor" >
                </div>
                <button type="submit" class="btn btn-primary" id="grabar">Grabar</button>
                <button type="button" class="btn btn-secondary" id="limpiar">Limpiar Campos</button>
            </form>
        </div>
        <div class="col-md-8">
            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">ALTERNO</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CATEGORIA</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PROVEEDOR</th>
                            <th scope="col">BORRAR</th>
                            <th scope="col">MODIFICAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas de la tabla se insertarán dinámicamente con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
