<?php
include_once "servidor.php";

$id = $_REQUEST['id'];
$producto = $_REQUEST['producto'];
$imagen = $_REQUEST['imagen'];
$alterno = $_REQUEST['alterno'];
$descripcion = $_REQUEST['descripcion'];
$estado = $_REQUEST['estado'];
$precio = $_REQUEST['precio'];
$categoria = $_REQUEST['categoria'];
$cantidad = $_REQUEST['cantidad'];
$proveedor = $_REQUEST['proveedor'];
$cone = new Servidor("root", "proyecto", "");
$conexion = $cone->conecta(); 
$sql;

if (empty($id)) {
    $sql = $conexion->prepare("INSERT INTO productos (producto, imagen, alterno, descripcion, estado, precio, categoria, cantidad, proveedor) 
    VALUES (:producto, :imagen, :alterno, :descripcion, :estado, :precio, :categoria, :cantidad, proveedor)");
} else {
    $sql = $conexion->prepare("UPDATE productos 
    SET producto = :producto, imagen = :imagen, alterno = :alterno, descripcion = :descripcion, estado = :estado, precio = :precio, categoria = :categoria, cantidad = :cantidad, proveedor = :proveedor 
    WHERE id = :id");
    $sql->bindParam(':id', $id);
}

$sql->bindParam(':producto', $producto);
$sql->bindParam(':imagen', $imagen);
$sql->bindParam(':alterno', $alterno);
$sql->bindParam(':descripcion', $descripcion);
$sql->bindParam(':estado', $estado);
$sql->bindParam(':precio', $precio);
$sql->bindParam(':categoria', $categoria);
$sql->bindParam(':cantidad', $cantidad);
$sql->bindParam(':proveedor', $proveedor);

$res = '';

if ($sql->execute()) {
    $res = 'okey';
} else {
    $res = 'error';
}

echo json_encode($res);
?>
