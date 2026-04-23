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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            text: 'La actividad se ha guardado.',
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
            title: 'Eliminado correctamente',
            text: 'La actividad se ha eliminado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>


    <div class="container my-5">
    <?php 
                    foreach ($datos as $dato) {

                ?>
    
    <h2 class="mt-3 mb-4 text-center"><?= $dato["nombre"] ?></h2>
<img src="<?= $dato['imagen'] ?>" class="card-img-top" style="width: 100px; height: auto;">
    <p><?= $dato["correo"] ?></p>

    <p><?= $dato["contraseña"] ?></p>
    
    <a href="index.php?accion=viewmodusuario&id=<?= $dato['id'] ?>"
                           class="btn btn-warning btn-sm">
                           Editar
                        </a>
<?php } ?>
    </div>



    <?php include ('views/footer.php'); ?>
    
</body>
</html>
