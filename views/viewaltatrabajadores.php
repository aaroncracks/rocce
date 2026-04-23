
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
    <h2 class="mb-4 text-center">Alta Trabajador</h2>

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <form action="index.php?accion=altatrabajador"  method="post" enctype="multipart/form-data">
                    <div class="control-group">
                    <label for="">NOMBRE</label>
                    <input type="text" class="form-control p-4" name="Nombre" placeholder="Tu nombre"
                        required="required" data-validation-required-message="Por favor escriba el nombre" />
                    <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="">CORREO ELECTRONICO</label>
                        <input type="email" class="form-control p-4" name="correo" placeholder="Tu correo"
                            required="required" data-validation-required-message="Por favor escriba el correo" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="">CONTRASEÑA</label>
                        <input type="text" class="form-control p-4" name="contraseña" placeholder="Tu contraseña"
                            required="required" data-validation-required-message="Por favor escriba la contraseña" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <label for="">PUESTO</label>
                        <select name="puesto" class="form-control" required="required">
                            <optgroup label="Conservación">
                                <option value="Agentes Medioambientales">Agentes Medioambientales</option>
                                <option value="Veterinarios">Veterinarios</option>
                                <option value="Capataces">Capataces</option>
                            </optgroup>
                            <optgroup label="Atención al público">
                                <option value="Guías">Guías</option>
                                <option value="Informadores">Informadores</option>
                                <option value="Recepcionistas">Recepcionistas</option>
                            </optgroup>
                            <optgroup label="Mantenimiento">
                                <option value="Limpieza">Limpieza</option>
                                <option value="Cuadrillas terrestres">Cuadrillas terrestres</option>
                            </optgroup>
                            <optgroup label="Administración">
                                <option value="Administrativo">Administrativo</option>
                                <option value="Contables">Contables</option>
                            </optgroup>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                    <label for="">Imagen</label>
                <input type="file" name="imagen">
                    <div class="text-center">
                        <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">CREAR TRABAJADOR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <?php include ('views/footer.php'); ?>
</body>
</html>
