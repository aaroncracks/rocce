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

    <a href="index.php" class="btn btn-primary w-40 left--1-m">Volver</a>
    <h2 class="mb-4 text-center">Alta Actividad</h2>

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <form action="index.php?accion=altaactividad" method="post" enctype="multipart/form-data">
                    <div class="control-group">
                        <label for="">NOMBRE</label>
                        <input type="text" class="form-control p-4" name="Nombre" placeholder="Nombre"
                            required="required" data-validation-required-message="Por favor escriba el nombre" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="">DESCRIPCION</label>
                        <textarea class="form-control py-3 px-4" rows="5" name="Descripcion" placeholder="Descripcion"
                            required="required"
                            data-validation-required-message="Por favor escriba una descripcion"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="">LUGAR</label>
                        <select name="lugar_id" class="form-control" required="required">
                            <?php 
                            foreach($datos as $dato){            
                                if($contador == 0){
                                    echo '<option value="'.$dato["id"].'" selected>'.$dato["nombre"].'</option>';
                                    $contador++;
                                }else{
                                    echo '<option value="'.$dato["id"].'">'.$dato["nombre"].'</option>';
                                }
                            
                        } ?>
                    </select>
                    <p class="help-block text-danger"></p>
                </div>
                <div class="control-group mt-5">
                    <label for="">HABILITAR</label>
                    <input type="checkbox" name="habilitado"
                        data-validation-required-message="Por favor escriba el sistema_cristalino" />
                    <p class="help-block text-danger"></p>
                </div>
                <label for="">Imagen</label>
                <input type="file" name="imagen">
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-4 mt-5" type="submit" id="sendMessageButton">CREAR ACTIVIDAD</button>
                </div>
                </form>
            </div>
        </div>
    </div>
 

    <?php include ('views/footer.php'); ?>
</body>
</html>

