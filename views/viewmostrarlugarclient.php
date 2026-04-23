<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>PARQUE NACIONAL ROCCE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <?php include ('controller/header.php'); ?>

<div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Lugar</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="index.php?accion=home">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Lugar</p>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="row">
                <?php 
                    foreach ($datos as $dato) {

                ?>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="package-item bg-white mb-2">   
                                    <img src="<?= $dato['imagen'] ?>" class="card-img-top">                             
                                    <div class="p-4">
                                        <a class="h5 text-decoration-none" href=""><?php echo $dato["nombre"]; ?></a>
                                    <p><?php echo $dato["descripcion"]; ?></p>
                                    <div class="border-top mt-4 pt-4">
                                        <div class="d-flex justify-content-between">
                                        </div>
                                    </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                    
                <?php } ?>
                
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
            
 
<?php include ('views/footer.php'); ?>
</body>
</html>
