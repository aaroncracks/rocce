
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

<?php include ('controller/header.php'); 
    
?>
<?php $pag= $_GET["pag"] ?? 1; ?>
    
<?php if (isset($_GET['msg'])){ 
        switch($_GET['msg']){
            case 'creado': 
    ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Creado correctamente',
            text: 'El trabajador se ha guardado.',
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
            text: 'El trabajador se ha modificado.',
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
            text: 'El trabajador se ha eliminado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>
    
    <div class="container my-5">
<?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]=="Admin"){ ?>
    <a href="index.php" class="btn btn-primary w-40 left--1-m">Volver</a>
    <h2 class="mb-4 text-center">Gestión de Reseñas</h2>
<form class="row g-3 mt-5 mb-2" method="POST" action="index.php?accion=viewreseña">
        <div class="col-md-2">
            <input type="text" name="buscar" class="form-control" placeholder="descripcion">
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit" id="sendMessageButton">Buscar</button>
        </div>
    </form>
    <!-- Botón Crear -->

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($datos as $dato){ ?>
                <tr>
                    <td><?= $dato["id"] ?></td>
                    <td><?= $dato["nombre"] ?></td>
                    <td><?= $dato["descripcion"] ?></td>
                    <td><?= $dato["fecha"] ?></td>
                    <td>

                        <!-- Eliminar -->
                        <a href="index.php?accion=delreseña&id=<?= $dato['id'] ?>"
                           onclick="return confirm('¿Seguro que quieres eliminar este usuario?')"
                           class="btn btn-danger btn-sm">
                           Eliminar
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if($pag<1){ ?>
        <a href="index.php?accion=viewreseña&pag=<?= $pag - 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewreseña&pag=<?= 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
            <?php } ?>
        <?php if($pag>$total){ ?>
        <a href="index.php?accion=viewreseña&pag=<?= $pag + 1 ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewreseña&pag=<?= $total ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
            <?php } ?>
    </div>
    <?php }else{ ?>
        <?php 
                    foreach ($datos as $dato) {

                ?>
                
                            <div class="col mb-4">
                                <div class="package-item bg-white mb-2">
                                    
                                    <div class="p-4">
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><?php echo $dato["nombre"]; ?></small>
                                    </div>
                                    <a class="h5 text-decoration-none" href=""><?php echo $dato["descripcion"]; ?></a>
                                    <p><?php echo $dato["fecha"]; ?></p>
                                    <?php if($dato["id"]==$_SESSION["usuario"]){ ?>
                                    <a href="index.php?accion=delreseña&id=<?= $dato['id'] ?>"
                                    onclick="return confirm('¿Seguro que quieres eliminar este usuario?')"
                                    class="btn btn-danger btn-sm">
                                    Eliminar
                                    </a>
                                    <?php } ?>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                    
                <?php } ?>
    <?php } ?>
</div>
 
    <?php include ('views/footer.php'); ?>
</body>
</html>