<?php
include_once "servidor.php";

$cliente = $_REQUEST['cliente'];
$opinion = $_REQUEST['opinion'];
$calificando = $_REQUEST['calificando'];
$nombreproducto = $_REQUEST['nombreproducto'];



$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta(); 
$sql;

    $sql = $conexion->prepare("INSERT INTO reseñas (cliente, opinion, puntaje, producto) 
    VALUES (:a, :b, :c, :d)");
    $sql->bindParam(':a', $cliente);
    $sql->bindParam(':b', $opinion);
    $sql->bindParam(':c', $calificando);
    $sql->bindParam(':d', $nombreproducto);
   
   
if($sql->execute()) {
    $res = 'okey';
} else {
    $res = 'error';
}

echo json_encode($res);
?>


