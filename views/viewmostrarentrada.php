
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
            text: 'El entrada se ha guardado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php
            break;

            case 'error':
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Fecha incorrecta',
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
            text: 'El entrada se ha eliminado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>
    <?php $pag= $_GET["pag"] ?? 1; 
    
        if($_SESSION["usuario"]=="Admin"){
    ?>
    <a href="index.php" class="btn btn-primary w-40 left--1-m">Volver</a>


    <div class="container my-5">

    <h2 class="mb-4 text-center">Gestión de entradas</h2>

    <!-- Botón Crear -->
    <div class="mb-3">
        <a href="index.php?accion=viewaltaentrada" class="btn btn-success">
            + Crear Entrada
        </a>
    </div>
<form class="row g-3 mt-5 mb-2" method="POST" action="index.php?accion=viewentrada">
        <div class="col-md-2">
            <input type="date" name="buscar" class="form-control" placeholder="titulo">
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit" id="sendMessageButton">Buscar</button>
        </div>
    </form>

    <?php }else{ ?>
    <div class="container my-5">

    <h2 class="mb-4 text-center">Entradas</h2>


    <form class="row g-3 mt-5 mb-2" method="POST" action="index.php?accion=viewentradaclient">
        <div class="col-md-2">
            <input type="date" name="buscar" class="form-control" placeholder="titulo">
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit" id="sendMessageButton">Buscar</button>
        </div>
    </form>
    <?php } ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Fecha Compra</th>
                    <th>Fecha Entrada</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($datos as $dato){ ?>
                <tr>
                    <td><?= $dato["id"] ?></td>
                    <td><?= $dato["usuario_id"] ?></td>
                    <td><?= $dato["tipo"] ?></td>
                    <td><?= $dato["cantidad"] ?></td>
                    <td><?= $dato["precio"] ?></td>
                    <td><?= $dato["total"] ?></td>
                    <td><?= $dato["fch_compra"] ?></td>
                    <td><?= $dato["fch_entrada"] ?></td>
                    <td>
                        <a href="index.php?accion=delentrada&id=<?= $dato['id'] ?>"
                           onclick="return confirm('¿Seguro que quieres eliminar este entrada?')"
                           class="btn btn-danger btn-sm">
                           Eliminar
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

       <?php
    
        if($_SESSION["usuario"]=="Admin"){
    ?>
   <?php if($pag<1){ ?>
            <a href="index.php?accion=viewentrada&pag=<?= $pag - 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewentrada&pag=<?= 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
            <?php } ?>
        <?php if($pag>$total){ ?>
        <a href="index.php?accion=viewentrada&pag=<?= $pag + 1 ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewentrada&pag=<?= $total ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
            <?php } ?>

    <?php }else{ ?>
    
    <?php } ?>
        <?php if($pag<1){ ?>
            <a href="index.php?accion=viewentradaclient&pag=<?= $pag - 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewentradaclient&pag=<?= 1 ?>" class="btn btn-primary w-40 left--1-m">Anterior</a>
            <?php } ?>
        <?php if($pag>$total){ ?>
        <a href="index.php?accion=viewentradaclient&pag=<?= $pag + 1 ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
        <?php }else{ ?>
            <a href="index.php?accion=viewentradaclient&pag=<?= $total ?>" class="btn btn-primary w-40 left--1-m">Despues</a>
            <?php } ?>
    </div>
 
  <?php include ('views/footer.php'); ?>
</body>
</html>