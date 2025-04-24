<?php 
include_once "encabezado.php";
include_once "servidor.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/logincss.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>

    <script>
        $(function(){
            var intentos = 0;

            $('#enviar').on('click', function(event){
                event.preventDefault();

                var correo = $('#correo').val();
                var contrasena = $('#contrasena').val();

                if (correo == "") {
                    alert('Lo sentimos el correo es requerido');
                    $('#correo').focus();
                    return;
                } 
                if (contrasena == "") {
                    alert('Lo sentimos la contraseña es requerida');
                    $('#contrasena').focus();
                    return; 
                } 
                
                if (intentos >= 2) {
                    alert("Ha excedido el número máximo de intentos. Por favor, intente más tarde o registrate con una nueva cuenta.");
                    $('#correo').val("");
                    $('#contrasena').val("");
                    location.href = "index.php";
                    return;
                }

                $.getJSON("loginchecar.php", {correo: correo, contrasena: contrasena}, function(resultados) {
                    if (!resultados) {
                        alert("Usuario no encontrado. Verifica tus credenciales.");
                        $('#correo').val("");
                        $('#contrasena').val("");
                        $('#correo').focus();
                        intentos++; 
                    } else {
                        if (resultados === 'incorrecta') {
                            alert("Lo sentimos, contraseña incorrecta.");
                            $('#contrasena').val("");
                            $('#contrasena').focus();
                            intentos++; 
                        } else {
                            alert("Bienvenid@ de vuelta " + resultados['nombre']);
                            document.getElementById('forma').reset();
                            location.href = "index.php?nombre=" + resultados['nombre'] + '&tipo=' + resultados['tipo'];
                        }
                    }
                }).fail(function() {
                    alert("Ocurrió un error al intentar iniciar sesión. Por favor, inténtalo de nuevo más tarde.");
                });
            });
        });
    </script>
</head>
<body>
    <form id="forma">
        <div class="contenedor">
            <div class="imagen">
                <img src="img/logo.png" alt="imagen login" class="editimagen">
            </div>
            <div class="info">
                <div class="divetiquetas">
                    <label for="correo" class="eticorreo">Ingresa tu correo:</label>
                    <input type="email" id="correo" class="incorreo">
                </div>
                <div class="divetiquetas">
                    <label for="contrasena" class="eticontraseña">Ingresa tu contraseña:</label>
                    <input type="password" id="contrasena" class="incontraseña">
                </div>
            </div>
            <div class="botones">
                <button type="submit" id="enviar" class="btnenviar">Enviar</button>
                <p style="text-align: center; margin-top: 10px; font-size: 14px;">¿No tienes cuenta? <a href="registrate.php">Regístrate aquí</a></p>
            </div>
        </div>
    </form>
</body>
</html>
