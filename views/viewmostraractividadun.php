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
<img src="<?= $dato['imagen'] ?>" class="card-img-top">
    <h1 class="mb-4 text-center"><?= $dato["nombre"] ?></h1>

    <h3><?= $dato["descripcion"] ?></h3>

    <p>Lugar: <?= $dato["nom_lugar"] ?></p>
    <?php if(isset($_SESSION["usuario"])){?>
    <form id="addcoment" method="post">
        <div class="form-row">
            <input type="hidden" id="actividad_id" name="actividad_id" <?php echo 'value="'.$dato["id"].'"'; ?> >
            <div class="control-group col">
                <input type="text" class="form-control mb-4" id="comentario" name="comentario" placeholder="Hola..."
                required="required" data-validation-required-message="Por favor escriba el comentario" />
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group col">
                <button class="btn btn-primary py-2 px-4" type="submit" id="enviar">Publicar</button>
            </div>
        </div>    
    </form>
<?php } } ?>
<?php 
        foreach ($comentarios as $comentario) {

    ?>

            <div class="col col">
                <div class="package-item bg-white mb-2">
                    
                    <div class="p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <small class="m-0"><?php echo $comentario["nombre"]; ?></small>
                    </div>
                    <a class="h5 text-decoration-none" href=""><?php echo $comentario["descripcion"]; ?></a>
                    <p><?php echo $comentario["fecha"]; ?></p>
                    <?php if(isset($_SESSION["usuario"]) && $comentario["id"]==$_SESSION["usuario"]){ ?>
                    <a href="index.php?accion=delreseña&id=<?= $comentario['id'] ?>"
                    onclick="return confirm('¿Seguro que quieres eliminar este usuario?')"
                    class="btn btn-danger btn-sm">
                    Eliminar
                    </a>
                    <?php } ?>
                    </div>
                    
                </div>
                
            </div>
                            

<?php } ?>
    </div>
<script>
  $(document).ready(function() {
    $('#addcoment').submit(function() {
      $.ajax({
        type: 'POST',
        url: 'index.php?accion=crearcomentario', // Archivo PHP que procesará los datos
        data: $(this).serialize(), // Envía todos los datos del form
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Creado correctamente',
                text: 'El usuario se ha guardado.',
                timer: 4000,
                showConfirmButton: false
            });
        }
      });
    });
  });
</script>


 <?php include ('views/footer.php'); ?>
</body>
</html>
