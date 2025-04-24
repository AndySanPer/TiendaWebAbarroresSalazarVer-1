<?php 
include_once "servidor.php";
include_once "encabezado.php";

$productos_por_pagina = 8;

if (isset($_GET['pagina'])) {
    $pagina_actual = $_GET['pagina'];
} else {
    $pagina_actual = 1;
}

$productonoquiero = ($pagina_actual - 1) * $productos_por_pagina;

$proveedor = $_GET['proveedor']; // Cambio de 'categoria' a 'proveedor'

$cone = new Servidor("root","proyecto","");
$conexion = $cone->conecta(); 
$sql = $conexion->prepare("SELECT * FROM productos WHERE proveedor = '$proveedor' LIMIT $productonoquiero, $productos_por_pagina"); // Modificado para usar 'proveedor' en lugar de 'categoria'
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();

$productos = array();

while ($registro = $sql->fetch()) {
    $productos[] = array(
        'id' => $registro['id'],
        'nombre' => $registro['producto'],
        'imagen' => $registro['imagen'],
        'alterno' => $registro['alterno'],
        'descripcion' => $registro['descripcion'],
        'estado' => $registro['estado'],
        'precio' => $registro['precio']
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/productos.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>

    <script>
        $(function(){
            $('.comprar').click(function() {
                var id = $(this).data('id');
                window.location.href = "detalleproducto.php?id=" + id;
            });
        });
    </script>
</head>
<body>

<div class="contenedor">
    <?php foreach ($productos as $productoreconocido){ ?>
        <div class="caja">
            <div class="nombre"><label><?php echo $productoreconocido['nombre'];?></label></div>
            <div class="imagen"><img src="img/produ_alter.jpg" alt="<?php echo $productoreconocido['alterno']; ?>" class="imagen2"></div>
            <div class="descripcion"><input style="border: none;" type="text" value="<?php echo $productoreconocido['descripcion']; ?>" readonly ></div>
            <div class="estado"><label><?php echo $productoreconocido['estado']; ?></label></div>
            <div class="precio"><label> MX$ <?php echo $productoreconocido['precio']; ?></label></div>
            <div class="divboton"><button type="submit" class="boton comprar" data-id="<?php echo $productoreconocido['id']; ?>">COMPRAR</button></div>
        </div>
    <?php } ?>
</div>

<?php

$sql_total = $conexion->prepare("SELECT COUNT(*) AS total FROM productos WHERE proveedor = '$proveedor'"); // Modificado para usar 'proveedor' en lugar de 'categoria'
$sql_total->execute();
$total_registros = $sql_total->fetch()['total'];
$total_paginas = ceil($total_registros / $productos_por_pagina);

if ($total_paginas > 1) {
    echo '<div class="pagination">';
    if ($pagina_actual > 1) {
        echo '<a href="?proveedor=' . $proveedor . '&pagina=' . ($pagina_actual - 1) . '">Anterior</a>'; // Cambiado de 'categoria' a 'proveedor'
    }
    for ($i = 1; $i <= $total_paginas; $i++) {
        if ($i == $pagina_actual) {
            echo '<span>' . $i . '</span>';
        } else {
            echo '<a href="?proveedor=' . $proveedor . '&pagina=' . $i . '">' . $i . '</a>'; // Cambiado de 'categoria' a 'proveedor'
        }
    }
    if ($pagina_actual < $total_paginas) {
        echo '<a href="?proveedor=' . $proveedor . '&pagina=' . ($pagina_actual + 1) . '">Siguiente</a>'; // Cambiado de 'categoria' a 'proveedor'
    }
    echo '</div>';
}
?>

</body>
</html>
