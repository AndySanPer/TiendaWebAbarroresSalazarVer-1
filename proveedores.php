<?php include_once "servidor.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/proveedores.css">
</head>
<body>

<div class="providers-section">
    <h2 class="tituloprove">Proveedores Destacados</h2>

    <div id="carouselProviders" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=sabritas">
                                <img src="img/proveedor1.jpg" alt="Proveedor 1">
                                <span>SABRITAS</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=coca">
                                <img src="img/proveedor2.png" alt="Proveedor 2">
                                <span>COCA-COLA</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=bimbo">
                                <img src="img/proveedor3.png" alt="Proveedor 3">
                                <span>BIMBO</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=tiarosa">
                                <img src="img/proveedor4.png" alt="Proveedor 4">
                                <span>TÍA ROSA</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=marinela">
                                <img src="img/proveedor5.png" alt="Proveedor 5">
                                <span>MARINELA</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=grupo corona">
                                <img src="img/proveedor6.png" alt="Proveedor 6">
                                <span>CORONA</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=la costeña">
                                <img src="img/proveedor7.png" alt="Proveedor 7">
                                <span>LA COSTEÑA</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=alpura">
                                <img src="img/proveedor8.png" alt="Proveedor 8">
                                <span>ALPURA</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=jarritos">
                                <img src="img/proveedor9.png" alt="Proveedor 9">
                                <span>JARRITOS</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=ace">
                                <img src="img/proveedor10.png" alt="Proveedor 10">
                                <span>ACE</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=ariel">
                                <img src="img/proveedor11.png" alt="Proveedor 11">
                                <span>ARIEL</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=lala">
                                <img src="img/proveedor12.png" alt="Proveedor 12">
                                <span>LALA</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=kelloggs">
                                <img src="img/proveedor13.png" alt="Proveedor 13">
                                <span>KELLOGGS</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=rancho salazar">
                                <img src="img/logorancho.jpg" alt="Proveedor 14">
                                <span>RANCHO SALAZAR</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="provider-card">
                            <a href="productosprovee.php?proveedor=dolores">
                                <img src="img/proveedor15.png" alt="Proveedor 15">
                                <span>DOLORES</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProviders" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProviders" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
