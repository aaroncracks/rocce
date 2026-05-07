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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include ('controller/header.php'); ?>
    <!-- Navbar End -->
    
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'creado'){ ?>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Creado correctamente',
        text: 'El usuario se ha guardado.',
        timer: 4000,
        showConfirmButton: false
    });
    </script>

    <?php } ?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Fauna y Flora</h4>
                            <h1 class="display-3 text-white mb-md-4">Descubre la diversidad del parque</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-3 text-white mb-md-4">Actividades</h1>
                            <a href="index.php?accion=mostraractividadclient" class="btn btn-primary py-md-3 px-md-5 mt-2">Ver</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-3.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-3 text-white mb-md-4">Lugares</h1>
                            <a href="index.php?accion=mostrarlugarclient" class="btn btn-primary py-md-3 px-md-5 mt-2">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Booking Start -->
    <!-- <div class="container-fluid booking mt-5 pb-5">
        <div class="container pb-5">
            <div class="bg-light shadow" style="padding: 30px;">
                <div class="row align-items-center" style="min-height: 60px;">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <select class="custom-select px-4" style="height: 47px;">
                                        <option selected>Destination</option>
                                        <option value="1">Destination 1</option>
                                        <option value="2">Destination 1</option>
                                        <option value="3">Destination 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date" data-target="#date2" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <select class="custom-select px-4" style="height: 47px;">
                                        <option selected>Duration</option>
                                        <option value="1">Duration 1</option>
                                        <option value="2">Duration 1</option>
                                        <option value="3">Duration 1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Booking End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Sobre Nosotros</h6>
                        <h1 class="mb-3">PARQUE NACIONAL ROCCE</h1>
                        <p>En el Parque Nacional Rocce, creemos que la naturaleza no es solo un lugar para visitar: es un hogar que debemos proteger, estudiar y respetar.
                             Nuestro parque nace con el propósito de conservar uno de los ecosistemas más valiosos y diversos del territorio, 
                            ofreciendo a cada visitante la oportunidad de reconectar con el entorno natural de forma responsable y sostenible.</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-2.jpg" alt="">
                            </div>
                        </div>
                        <a href="index.php?accion=about" class="btn btn-primary mt-1">Ver mas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-money-check-alt text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Conservacion</h5>
                            <p class="m-0">Protegemos la fauna y flora autóctona.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-award text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Educación y divulgación</h5>
                            <p class="m-0">Creemos en el poder del conocimiento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-globe text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Experiencia natural</h5>
                            <p class="m-0">Nuestro objetivo es que cada persona que visite el parque pueda disfrutar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <div class="d-flex justify-content-center align-items-center mr-5 pr-5">
                    <img style="width: 200px" src="img/logoactividad.png" alt="Image">
                    <h1>Actividades</h1>
                </div>
                
            </div>
            <div class="row">
            <?php foreach($actividades as $actividad){ ?>
               
                    <div class="col-lg-4 col-md-6 mb-4">
                        <img class="img-fluid" src="<?= $actividad["imagen"] ?>" width="500px">
                    <div class="package-item bg-white mb-2">
                        
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?= $actividad["nom_lugar"] ?></small>
                            </div>
                            <a class="h5 text-decoration-none" href=""><?= $actividad["nombre"] ?></a>
                            
                        </div>
                    </div>
                </div>
                
                <?php } ?>
            </div>
            <a href="index.php?accion=mostraractividadclient" class="btn btn-primary py-md-3 px-md-5 mt-2">Ver mas</a>
            </div>
            
        </div>
        
    </div>

    <div class="bg-primary container-fluid py-5">
        <div class="text-center mb-3 pb-3">
                <div class="d-flex justify-content-center align-items-center mr-5 pr-5">
                    <h1>Mapa</h1>
                </div>
                
            </div>
            <iframe src="https://maps.app.goo.gl/CHjmBqabrcjX9bQr5" frameborder="0" width="600" height="450"></iframe>
    </div>

    <div class="container-fluid py-5">
        <div class="text-center mb-3 pb-3">
                <div class="d-flex justify-content-center align-items-center mr-5 pr-5">
                    <img style="width: 200px" src="img/logoactividad.png" alt="Image">
                    <h1>Reseñas</h1>
                </div>
                
            </div>
        <?php 
                    foreach ($reseñas as $reseña) {

                ?>
                
                            <div class="col mb-4">
                                <div class="package-item bg-white mb-2">
                                    
                                    <div class="p-4">
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><?php echo $reseña["nombre"]; ?></small>
                                    </div>
                                    <a class="h5 text-decoration-none" href=""><?php echo $reseña["descripcion"]; ?></a>
                                    <p><?php echo $reseña["fecha"]; ?></p>
                                    <?php
                                    try{ 
                                        if(isset($_SESSION["usuario"])){
                                        if($reseña["id"]==$_SESSION["usuario"]){ 
                                    ?>
                                        <a href="index.php?accion=delreseña&id=<?= $reseña['id'] ?>"
                                        onclick="return confirm('¿Seguro que quieres eliminar este usuario?')"
                                        class="btn btn-danger btn-sm">
                                        Eliminar
                                        </a>
                                        <?php }}
                                    }catch(Exception $g){ 
                                        echo "no se encuentra el id usuario";
                                         }?>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                    
                <?php } ?>
    </div>

    

    <!-- Destination Start -->
    <?php include ('views/footer.php'); ?>
</body>

</html>