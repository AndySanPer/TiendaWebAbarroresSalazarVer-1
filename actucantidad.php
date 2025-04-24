<?php 
include_once "servidor.php";
$clave = $_REQUEST['clave'];
$nuevostoke = $_REQUEST['nuevostoke'];

$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta(); 

$sql = $conexion->prepare("UPDATE producto SET cantidad = '$nuevostoke' WHERE id = '$clave'");

$res = '';

if($sql->execute()) {
    $res = 'okey';
} else {
    $res = 'error';
}

$sql->closeCursor();

echo json_encode($res);

?>