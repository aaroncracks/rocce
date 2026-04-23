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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <?php include ('controller/header.php'); ?>
<?php if (isset($_GET['msg'])){ 
        switch($_GET['msg']){
            case 'creado': 
    ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Creado correctamente',
            text: 'El proyecto se ha guardado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php
            break;

            case 'añadido':
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Modificado correctamente',
            text: 'El proyecto se ha añadido.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php
            break;

            case 'modificado':
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Modificado correctamente',
            text: 'El proyecto se ha modificado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php
            break;

            case 'eliminado':
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Modificado correctamente',
            text: 'El proyecto se ha eliminado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>
<div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">PROYECTOS</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="index.php?accion=home">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">PROYECTOS</p>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="m-4 mb-5">
                <a href="index.php?accion=viewaltaproyecto" class="btn btn-primary w-40 left--1-m m-2">Crear proyecto</a>
                <a href="index.php?accion=viewaddproyectoinv" class="btn btn-primary w-40 left--1-m m-2">Añadir proyecto</a>
            </div>
            
            <div class="row">
                
                <?php 
                    foreach ($datos as $dato) {

                ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-item bg-white mb-2">
                                    
                                    <div class="p-4">
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?php echo $dato["autor"]; ?></small>
                                        <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?php echo $dato["fecha"]; ?></small>
                                    </div>
                                    <a class="h5 text-decoration-none" href="index.php?accion=viewmodproyecto&id=<?= $dato['id'] ?>"><?php echo $dato["titulo"]; ?></a>
                                    <a href="index.php?accion=delproyecto&id=<?= $dato['id'] ?>" class="btn btn-primary ml-5 w-40 left--1-m">Eliminar</a>
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
