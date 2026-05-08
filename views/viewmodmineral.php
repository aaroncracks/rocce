

            
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

<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
           
            <?php
    foreach($datos as $dato){
?>
<h2>MODIFICAR MINERAL - <?php echo $dato["nombre"] ?></h2><br>
<form <?php echo 'action="index.php?accion=modmineral&id='.$dato["id"].'"'; ?>  method="post" enctype="multipart/form-data">
    <div class="control-group">
        <input type="text" class="form-control p-4" name="Nombre" placeholder="Nombre" <?php echo 'value='.$dato["nombre"]; ?>
            required="required" data-validation-required-message="Por favor escriba el nombre" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control p-4" name="formula" placeholder="formula" <?php echo 'value='.$dato["formula"]; ?>
            required="required" data-validation-required-message="Por favor escriba el formula" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control p-4" name="clase" placeholder="clase" <?php echo 'value='.$dato["clase"]; ?>
            required="required" data-validation-required-message="Por favor escriba el clase" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control p-4" name="sistema_cristalino" placeholder="sistema_cristalino" <?php echo 'value='.$dato["sistema_cristalino"]; ?>
            required="required" data-validation-required-message="Por favor escriba el sistema_cristalino" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control p-4" name="habito" placeholder="habito" <?php echo 'value='.$dato["habito"]; ?>
            required="required" data-validation-required-message="Por favor escriba el habito" />
        <p class="help-block text-danger"></p>
    </div>
    <input type="hidden"
       name="imagen_actual"
       value="<?= $dato['imagen'] ?>">
    <div class="control-group">
                <select name="lugar_id" class="form-control" required="required">
                    <?php 
                    foreach($lugares as $lugar){            
                        if($contador == 0){
                            echo '<option value="'.$lugar["id"].'" selected>'.$lugar["nombre"].'</option>';
                            $contador++;
                        }else{
                            echo '<option value="'.$lugar["id"].'">'.$lugar["nombre"].'</option>';
                        }
                    
                } ?>
            </select>
            <p class="help-block text-danger"></p>
            <label for="">Imagen</label>
                <input type="file" name="imagen">
    <div class="text-center">
        <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Modificar <?php echo $dato["nombre"] ?></button>
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