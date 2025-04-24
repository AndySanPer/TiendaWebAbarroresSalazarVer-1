<?php include_once "servidor.php"; 

$cone = new Servidor("root","proyecto","");
$conexion = $cone->conecta(); 
$sql=$conexion->prepare("SELECT * FROM productos" );
$sql->setfetchMode(PDO::FETCH_ASSOC);
$sql->execute();


$res = array(); // Inicializa el arreglo para almacenar todos los registros

while ($reg = $sql->fetch(PDO::FETCH_ASSOC)) {
    // Agrega cada fila como un solo arreglo asociativo al arreglo principal $res
    $res[] = array(
        'id' => $reg['id'],
        'producto' => $reg['producto'],
        'imagen' => $reg['imagen'],
        'alterno' => $reg['alterno'],
        'descripcion' => $reg['descripcion'],
        'estado' => $reg['estado'],
        'precio' => $reg['precio'],
        'categoria' => $reg['categoria'],
        'cantidad' => $reg['cantidad'],
        'proveedor' => $reg['proveedor'] // Asegúrate de incluir correctamente 'proveedor'
    );
}

       
    echo json_encode($res);
    // cerrar la consulta
    $sql->closeCursor();
    



?>