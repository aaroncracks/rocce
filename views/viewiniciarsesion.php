<!DOCTYPE html>
<html lang="en">

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
            case 'modificado':
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Espera',
            text: 'Espere por favor',
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
            icon: 'error',
            title: 'Error',
            text: 'Usuario incorrecto',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>

    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Iniciar Sesion</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="index.php?accion=home">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Iniciar Sesion</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <form action="index.php?accion=iniciarsesion"  method="post">
                    <div class="control-group">
                    <input type="email" class="form-control p-4" name="Correo" placeholder="Tu correo"
                        required="required" data-validation-required-message="Por favor escriba el correo" />
                    <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                    <input type="text" class="form-control p-4" name="contra" placeholder="Tu contraseña"
                        required="required" data-validation-required-message="Por favor escriba la contraseña" />
                    <p class="help-block text-danger"></p>
                    </div>
                    <div class="text-center">
                    <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Iniciar sesion</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
    

<?php include ('views/footer.php'); ?>
</body>

</html>
