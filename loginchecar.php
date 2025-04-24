<?php
include_once "servidor.php";

// Valores obtenidos del formulario (por ahora solo para prueba)
$correo = $_GET['correo'];
$contrasena = $_GET['contrasena'];

$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta();

// Consulta SQL para obtener el usuario por correo
$revisacredenciales = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
$revisacredenciales->bindParam(':correo', $correo);
$revisacredenciales->execute();

$res = $revisacredenciales->fetch(PDO::FETCH_ASSOC);

// Verificar la contraseña
if ($res) {
    if ($contrasena === $res['password']) {
        // Contraseña correcta
        echo json_encode($res);
    } else {
        // Contraseña incorrecta
        echo json_encode('incorrecta');
    }
} else {
    // Usuario no encontrado
    echo json_encode(false);
}

$revisacredenciales->closeCursor();
?>
