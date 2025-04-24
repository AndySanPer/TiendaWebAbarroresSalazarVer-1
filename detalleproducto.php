<?php 


// Definir el estado inicial del nombre de usuario y tipo
if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "Sin identificar";
} else {
    // Si se recibe un nombre y tipo, actualizar la sesión
    if (isset($_REQUEST['nombre'])) { 
        $_SESSION['nombre'] = $_REQUEST['nombre'];
        $_SESSION['tipo'] = $_REQUEST['tipo'];
    }
}


    include_once "servidor.php";
    include_once "encabezado.php";

    $id=$_REQUEST['id'];

    $cone = new Servidor("root","proyecto","");
    $conexion = $cone->conecta(); 
    $sql = $conexion->prepare("SELECT * FROM productos WHERE id = '$id'");
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $sql->execute();

    $producto = array();

    $producto = $sql->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/detalleproducto.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    

    <script>
    $(function(){
        $('#zoomimagen').on('input', function() {
            var zoomValue = $(this).val(); 
            var scaledZoom = zoomValue / 100; 
            $('.imagen2').css('transform', 'scale(' + scaledZoom + ')'); 

            if (zoomValue == 100) {
                $('.imagen2').css('transform', 'scale(1)');
            }
});


        $('#comprar').on('click', function(){
            var cliente = '<?php echo $_SESSION['nombre']; ?>';

            if (cliente === 'Sin identificar') {
                alert('Lo sentimos, se necesita tener una cuenta para comprar');
                return;
            } else {
                var cantidad = parseInt($('#cantidad').val());

                var color = ''; 
                if ($('#gris').prop('checked')) {
                    color = 'gris';
                } else if ($('#negro').prop('checked')) {
                    color = 'negro';
                } else {
                    alert('Selecciona un color');
                    return;
                }

                var vericapago = $('#opciones').val();

                if (vericapago == '') {
                    alert('Por favor seleccione un método de pago');
                    return;
                } else {
                    var metodopago = vericapago; 
                }

                var precioproducto = '<?php echo $producto["precio"]; ?>';
                var nombreproducto = '<?php echo $producto["producto"]; ?>';

                if (precioproducto && cantidad && cantidad > 0) {
                    var total = precioproducto * cantidad;
                } else {
                    alert('Selecciona la cantidad');
                    return;
                }

                var stoke = parseInt('<?php echo $producto["cantidad"]; ?>');    
                var clave = '<?php echo $id; ?>';

                if (cantidad > stoke) {
                    alert("Lo sentimos no hay, solo tenemos en stock " + stoke);
                    return;
                } else {
                    var nuevostoke = stoke - cantidad; 
                    $('#stock').val(nuevostoke);
                    stoke = nuevostoke; 
                    alert("Nuevo stock: " + nuevostoke);
                    $.getJSON("actucantidad.php", { clave: clave, nuevostoke: nuevostoke }, function(resultado) {
                        if (resultado == 'okey') {
                            alert('stoke actualizado');
                        } else {
                            alert('error de actualizacion de stoke');
                        }
                    });
                }

                $.getJSON("ventas.php", {cliente: cliente, nombreproducto: nombreproducto, cantidad: cantidad, color: color, metodopago: metodopago, precioproducto: precioproducto, total: total}, function(resultados) {
                    if (resultados == 'okey') {
                        alert('Compra exitosa');
                        limpiarcomprar();
                        location.reload();

                    } else {
                        alert('Lo sentimos ocurrió un error :,c');
                    }
                });
            }
        });

        $('#opiniones').on('click', function(){
            var cliente = '<?php echo $_SESSION['nombre']; ?>';

            if (cliente === 'Sin identificar') {
                alert('Lo sentimos, se necesita tener una cuenta para opinar');
            } else {
                var opinion = $('#notas').val();

                var calificando = ''; 

                if ($('#5').prop('checked')) {
                    calificando = 5; 
                } else if ($('#4').prop('checked')) {
                    calificando = 4;
                } else if ($('#3').prop('checked')) {
                    calificando = 3;
                } else if ($('#2').prop('checked')) {
                    calificando = 2;
                } else if ($('#1').prop('checked')) {
                    calificando = 1;
                } else {
                    alert('Por favor califique el producto');
                    return;
                }

                var nombreproducto = '<?php echo $producto["producto"]; ?>';

                $.getJSON("reseña.php", {cliente: cliente, opinion:opinion, calificando:calificando, nombreproducto:nombreproducto}, function(resultados) {
                    if (resultados == 'okey') {
                        alert('Gracias por comentar sobre nuestro producto');
                        limpiarOpinion();
                    } else {
                        alert('Lo sentimos ocurrió un error :,c');
                    }
                });
            }
        });

        function limpiarcomprar() {
            $('#cantidad').val('');
            $('input[name=opcion]').prop('checked', false);
            $('#opciones').val('');
        }

        function limpiarOpinion() {
            $('#notas').val('');
            $('input[name=puntuacion]').prop('checked', false);
        }
    });
</script>



    <title>Document</title>
</head>
<body>
    
    <div class="producto-detallado" style="height: 600px;">
        <div class="divizquierdo">
            <h2 class="nombreproducto"><?php echo $producto['producto']; ?></h2>
            <div class="imagen"><img src="img/produ_alter.jpg" alt="<?php echo $producto['alterno']; ?>" class="imagen2"></div>
            <br>
            <input type="range" class="form-range" id="zoomimagen" min="100" max="200" value="100" style="background-color: rgb(252, 219, 226); width: 300px; border-radius: 30px 30px 30px 30px;">
            <br><br>
            <button type="button" class="boton" id="comprar">COMPRAR</button>
        </div>

        <div class="divderecho">
            <p readonly class="precio" >Precio: MX$ <?php echo $producto['precio']; ?></p>
            <br>
            <label style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 25px; margin-left: 10px; margin-bottom: 10px;">DESCRIPCIÓN:</label>
            <br>
            <div class="overflow-auto" style="height: 60px; margin-left: 10px;"><p class="descrip"><?php echo $producto['descripcion']; ?></p></div> 
            <br>
            <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">Stock:</label> <input readonly type="number" id="stock" style="border: none;" value="<?php echo $producto["cantidad"]; ?>" >
            <br><br>
            <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">Cantidad:</label>
            <br><br>
            <input style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;" type="number" id="cantidad" name="cantidad" min="1" value="1">
            <br><br>
            <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">Color</label>
            <br><br>
            <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px; color: gray;">Gris</label>
            <input style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px; color: gray;" type="radio" id="gris" name="opcion">
            <br>
            <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px; color: black;" >Negro</label>
            <input style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px; color: black;" type="radio" id="negro" name="opcion">
            <br><br>
            <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">Seleccione el metodo de pago:</label>
            <br>
            <select style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;" id="opciones" name="opciones">
                <option value=""></option>
                <option value="tarjeta" style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;" >Tarjetas de Crédito/Débito</option>
                <option value="paypal" style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">PayPal</option>
                <option value="efectivo" style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px;">Pago contra entrega</option>
            </select>
        </div>
    </div>

    <div class="divabajo">
        <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 30px; color: black;">Calificación:</label>
        <br><br>

        <div class="cali">
            <div class="puntos">
                <label><h4>5</h4></label>
                <br>
                <label><h4>4</h4></label>
                <br>
                <label><h4>3</h4></label>
                <br>
                <label><h4>2</h4></label>
                <br>
                <label><h4>1</h4></label>
            </div>
            <div class="divpuntuacionbarras">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 0%"></div>
                </div>
                <br>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 25%"></div>
                </div>
                <br>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
                <br>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 75%"></div>
                </div>
                <br>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <div class="opi">
            <div>
                <label style="margin-left: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 20px; color: black;">Opinion del producto:</label>
                <br><br>
                <textarea id="notas" name="notas" rows="4" cols="50" style="margin-left: 10px;"></textarea>
            </div>  

            <div class="califi">
                <label class="titulocali">Calificar</label>
                <div class="etiradiocali">
                    <label class="etinum"><h4>5</h4></label>
                    <label class="etinum"><h4>4</h4></label>
                    <label class="etinum"><h4>3</h4></label>
                    <label class="etinum"><h4>2</h4></label>
                    <label class="etinum"><h4>1</h4></label>
                </div>
                <div>
                    <input type="radio" name="puntuacion" id="5" class="radioc">
                    <input type="radio" name="puntuacion" id="4" class="radioc">
                    <input type="radio" name="puntuacion" id="3" class="radioc">
                    <input type="radio" name="puntuacion" id="2" class="radioc">
                    <input type="radio" name="puntuacion" id="1" class="radioc">
                </div>
                <div class="botonopi">
                    <button type="submit" class="btnopi" id="opiniones">Enviar opinion</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

