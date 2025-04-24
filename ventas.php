<?php
include_once "servidor.php";

$cliente = $_REQUEST['cliente'];
$nombreproducto = $_REQUEST['nombreproducto'];
$cantidad = $_REQUEST['cantidad'];
$color = $_REQUEST['color'];
$metodopago = $_REQUEST['metodopago'];
$precioproducto = $_REQUEST['precioproducto'];
$total = $_REQUEST['total'];


$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta(); 
$sql;

    $sql = $conexion->prepare("INSERT INTO ventas (cliente, producto, cantidad, color, metodopago, precio, total) 
    VALUES (:a, :b, :c, :d, :e, :f, :g)");
    $sql->bindParam(':a', $cliente);
    $sql->bindParam(':b', $nombreproducto);
    $sql->bindParam(':c', $cantidad);
    $sql->bindParam(':d', $color);
    $sql->bindParam(':e', $metodopago);
    $sql->bindParam(':f', $precioproducto);
    $sql->bindParam(':g', $total);
   




if($sql->execute()) {
    $res = 'okey';
} else {
    $res = 'error';
}

echo json_encode($res);
?>


