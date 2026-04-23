
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

   <?php include ('controller/header.php'); ?>

    <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">Alta Reseña</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><a class="text-white" href="index.php">Inicio</a></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">Alta Reseña</p>
                    </div>
                </div>
            </div>
        </div>

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <form id="addreseña" method="post">
                    <div class="control-group">
                        <label for="">DESCRIPCION</label>
                        <textarea class="form-control py-3 px-4" rows="5" id="descripcion" name="Descripcion" placeholder="Descripcion"
                            required="required"
                            data-validation-required-message="Por favor escriba una descripcion"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">CREAR RESEÑA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#addreseña').submit(function() {
            $.ajax({
                type: 'POST',
                url: 'index.php?accion=altareseña', // Archivo PHP que procesará los datos
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
