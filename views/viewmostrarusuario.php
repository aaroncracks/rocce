
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

<?php include ('controller/header.php'); ?>

    <?php if (isset($_GET['msg'])){ 
        switch($_GET['msg']){
            case 'creado': 
    ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Creado correctamente',
            text: 'El usuario se ha guardado.',
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
            text: 'El usuario se ha modificado.',
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
            text: 'El usuario se ha eliminado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>
    <a href="index.php" class="btn btn-primary w-40 left--1-m">Volver</a>
    
    <div class="container my-5">

    <h2 class="mb-4 text-center">Gestión de Usuarios</h2>

    <?php $pag= $_GET["pag"] ?? 1; ?>
    <!-- Botón Crear -->
    <div class="mb-3">
        <a href="index.php?accion=mostraralta" class="btn btn-success">
            + Crear Usuario
        </a>
    </div>
<form class="row g-3 mt-5 mb-2" method="POST" action="index.php?accion=viewusuario">
        <div class="col-md-2">
            <input type="text" name="buscar" class="form-control" placeholder="nombre">
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit" id="sendMessageButton">Buscar</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Imagen</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($datos as $dato){ ?>
                <tr>
                    <td><img src="<?= $dato["imagen"] ?>" alt="" width="100px"></td>
                    <td><?= $dato["id"] ?></td>
                    <td><?= $dato["nombre"] ?></td>
                    <td><?= $dato["correo"] ?></td>
                    <td><?= $dato["contraseña"] ?></td>
                    <td>

                        <!-- Editar -->
                        <a href="index.php?accion=viewmodusuario&id=<?= $dato['id'] ?>"
                           class="btn btn-warning btn-sm">
                           Editar
                        </a>

                        <!-- Eliminar -->
                        <a href="index.php?accion=delusuario&id=<?= $dato['id'] ?>"
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
        <a href="index.php?accion=viewusuario&pag=<?= $pag - 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewusuario&pag=<?= 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
            <?php } ?>
        <?php if($pag>$total){ ?>
        <a href="index.php?accion=viewusuario&pag=<?= $pag + 1 ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewusuario&pag=<?= $total ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
            <?php } ?>
    </div>

</div>
 
    <?php include ('views/footer.php'); ?>
</body>
</html>