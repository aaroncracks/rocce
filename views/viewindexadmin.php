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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include ('controller/header.php'); ?>
    <!-- Navbar End -->
    

    <div class="container my-5">
    <a href="index.php?accion=cerrarsesion" class="btn btn-primary w-40 left--1-m">Cerrar sesion</a>
    <h1 class="mb-4 text-center">Panel de Administración</h1>
      
    <h2 class="mb-4 mt-5 text-center">Registros</h2>
    <div class="row">

        <!-- Usuarios -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Trabajadores</h4>
                    <p class="card-text">Gestiona altas, bajas y modificar.</p>
                    <a href="index.php?accion=viewtrabajador" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Investigadores</h4>
                    <p class="card-text">Gestiona altas, bajas y modificar.</p>
                    <a href="index.php?accion=viewinvestigador" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Usuarios</h4>
                    <p class="card-text">Gestiona altas, bajas y modificar.</p>
                    <a href="index.php?accion=viewusuario" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Actividades -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Actividades</h4>
                    <p class="card-text">Modifica o crea nuevos actividades.</p>
                    <a href="index.php?accion=viewactividad" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Comentarios -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Animales</h4>
                    <p class="card-text">Modifica o crea nuevos animales.</p>
                    <a href="index.php?accion=viewanimal" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Entradas -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Plantas</h4>
                    <p class="card-text">Modifica o crea nuevas plantas.</p>
                    <a href="index.php?accion=viewplanta" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Proyectos -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Minerales</h4>
                    <p class="card-text">Modifica o crea nuevos minerales.</p>
                    <a href="index.php?accion=viewmineral" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Proyectos -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Lugares</h4>
                    <p class="card-text">Modifica o crea nuevos lugares.</p>
                    <a href="index.php?accion=viewlugar" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Proyectos -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Proyectos</h4>
                    <p class="card-text">Modifica o elimina nuevos proyectos.</p>
                    <a href="index.php?accion=viewproyecto" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Entradas</h4>
                    <p class="card-text">Crea nuevas entradas.</p>
                    <a href="index.php?accion=viewentrada" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Reseñas</h4>
                    <p class="card-text">Administra las reseñas.</p>
                    <a href="index.php?accion=viewreseña" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title">Comentarios</h4>
                    <p class="card-text">Administra los comentarios.</p>
                    <a href="index.php?accion=viewcomentario" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>

    </div>
</div>


    <?php include ('views/footer.php'); ?>
</body>

</html>