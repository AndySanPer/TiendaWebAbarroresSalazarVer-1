
<?php 
session_start(); // Iniciar la sesión si no está iniciada

// Definir el estado inicial del nombre de usuario y tipo
if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "Sin identificar";
} else {
    // Si se recibe un nombre y tipo, actualizar la sesión
    if (isset($_REQUEST['nombre'])) { 
        $_SESSION['nombre'] = $_REQUEST['nombre'];
        $_SESSION['tipo'] = $_REQUEST['tipo'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Salazar</title>
  
    <link rel="stylesheet" href="css/encabezado.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="Logo" style="height: 80px; width: 80px; margin-right: 20px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Productos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="productos.php?categoria=fresco">Productos Frescos</a></li>
                            <li><a class="dropdown-item" href="productos.php?categoria=enlatado">Enlatados</a></li>
                            <li><a class="dropdown-item" href="productos.php?categoria=bebidas">Bebidas</a></li>
                            <li><a class="dropdown-item" href="productos.php?categoria=snacks">Snacks</a></li>
                            <li><a class="dropdown-item" href="productos.php?categoria=limpieza">Productos de Limpieza</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="mantenimientoproductos.php">Mantenimiento</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <label style="margin-right: 10px; border: none; margin-top: 5px;"><h4 style="color: #ffffff;">Usuario</h4></label>
                    <img src="img/usuario.png" alt="esto es un usuario" style="width: 60px; height:60px; margin-right: 5px;">
                    <input type="text" readonly style="background-color: #293847; border: none; border-radius: 10px 10px 10px 10px; color: #ffffff; font-weight: bold; text-align: center; width: 90px; margin-right: 10px; font-size: 18px;" id="usuario" value="<?php echo $_SESSION['nombre']; ?>">
                    
                    <?php if ($_SESSION['nombre'] !== "Sin identificar"): ?>
                        <form method="post" action="salir.php" class="d-flex">
                            <input type="submit" name="cerrar_sesion" class="btn btn-warning" style="font-weight: bold; color: white; background-color: #DEDB03; margin-left: 5px; border-radius: 10px; border: none;" value="Cerrar sesión">
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

</body>
</html>
