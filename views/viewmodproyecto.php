

            
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

    <?php include ('controller/header.php'); 
        if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]=="Admin"){
    ?>
    <a href="index.php" class="btn btn-primary w-40 left--1-m">Volver</a>
    <?php 
        }else{   
    ?>
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">Alta Proyecto</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><a class="text-white" href="index.php">Inicio</a></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">Alta Proyecto</p>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
           
                    <?php
    foreach($datos as $dato){


?>
<h2>MODIFICAR PROYECTO - <?php echo $dato["titulo"] ?></h2><br>
<form <?php echo 'action="index.php?accion=modproyecto&id='.$dato["id"].'"'; ?>  method="post" enctype="multipart/form-data">
    <div class="control-group">
        <input type="text" class="form-control p-4" name="titulo" placeholder="titulo" <?php echo 'value='.$dato["titulo"]; ?>
            required="required" data-validation-required-message="Por favor escriba el titulo" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control p-4" name="autor" placeholder="autor" <?php echo 'value='.$dato["autor"]; ?>
            required="required" data-validation-required-message="Por favor escriba el autor" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <textarea class="form-control py-3 px-4" rows="4" name="justificacion" placeholder="justificacion"
            required="required"
            data-validation-required-message="Por favor escriba una justificacion"> <?php echo $dato["justificacion"]; ?></textarea>
        <p class="help-block text-danger"></p>
    </div>
    <label for="">Archivo</label>
                <input type="file" name="archivo">
    <div class="text-center">
        <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Modificar <?php echo $dato["titulo"] ?></button>
    </div>
    <?php     }
    ?>
</form>
      </div>
    </div>
</div>
    
<?php include ('views/footer.php'); ?>
</body>
</html>