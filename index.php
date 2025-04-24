<?php 
include_once "encabezado.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abarrotes Salazar</title>
  
  <!-- Estilos CSS personalizados -->
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

  <div class="carousel-container">
    <div class="carousel-slide">
      <img src="img/banner3.jpg" alt="Oferta 1">
      <img src="img/banner2.jpg" alt="Oferta 2">
      <img src="img/banner1.jpg" alt="Oferta 3">
    </div>
    <button class="prev-btn">&lt;</button>
    <button class="next-btn">&gt;</button>
  </div>
  <script src="js/index.js"></script>
  
   <!-- Incluir el archivo bot.php donde está el widget de Telegram -->
   <?php include_once "bot.php"; ?>
   <br>
   <?php include_once "pie.php"; ?>
   <br>
   <?php include_once "proveedores.php"; ?>

</body>
</html>
