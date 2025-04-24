<?php
include_once "servidor.php";

// Obtener valores del formulario o establecer valores de prueba
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$password = $_REQUEST['password'];
$tipo = $_REQUEST['tipo'];
$confi_correo = $correo;
$confi_password = $password;

try {
    // Conectar a la base de datos
    $cone = new Servidor("root", "proyecto", "");
    $conexion = $cone->conecta();

    // Verificar si el correo ya existe
    $revisarcorreo = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $revisarcorreo->bindParam(':correo', $correo);
    $revisarcorreo->execute();

    if ($revisarcorreo->rowCount() > 0) {
        // El correo ya existe en la base de datos
        echo json_encode(array('error' => 'error correo'));
    } else {
        // Insertar nuevo usuario
        $sql = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, correo, confi_correo, password, confi_password, tipo) VALUES (:nombre, :apellidos, :correo, :confi_correo, :password, :confi_password, :tipo)");
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellidos', $apellidos);
        $sql->bindParam(':correo', $correo);
        $sql->bindParam(':confi_correo', $confi_correo);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':confi_password', $confi_password);
        $sql->bindParam(':tipo', $tipo);
        
        if ($sql->execute()) {
            // Registro exitoso
            $res = array(
                'nombre' => $nombre,
                'tipo' => $tipo
            );
            echo json_encode($res);
        } else {
            // Error al ejecutar la consulta de inserción
            $errorInfo = $sql->errorInfo();
            echo json_encode(array('error' => 'error sql', 'message' => $errorInfo[2]));
        }
    }
} catch (PDOException $e) {
    // Capturar excepciones de PDO
    echo json_encode(array('error' => 'PDOException', 'message' => $e->getMessage()));
}
?>
