<?php 
include_once "servidor.php";

$id=$_GET['registro'];

$cone = new Servidor("root","proyecto","");
$conexion = $cone->conecta(); 
$sql=$conexion->prepare("DELETE FROM productos WHERE id = $id" );

if($sql->execute()){
    $bandera='okey';
}else{
    $bandera='error';
}

$sql -> closeCursor();

echo json_encode($bandera);



?>