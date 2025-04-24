<?php
include_once "servidor.php";

// Contraseña de administrador directamente especificada
$contrasenaadmin = $_POST['contrasenaadmin'];

$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta(); 

// Consulta preparada para buscar la contraseña del administrador
$sql = $conexion->prepare("SELECT * FROM administrador WHERE contrasena = :contrasenaadmin");
$sql->bindParam(':contrasenaadmin', $contrasenaadmin);
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();

// Verificar si se encontró un administrador con esa contraseña
if ($sql->rowCount() > 0) {
    // Contraseña válida para administrador
    $result = 'okey';
} else {
    // Contraseña incorrecta para administrador
    $result = 'error';
}

// Devolver resultado en formato JSON
echo json_encode($result);
?>
