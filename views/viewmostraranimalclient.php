
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

<div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">ANIMALES</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="index.php?accion=home">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">ANIMALES</p>
                </div>
            </div>
        </div>
    </div>
<?php if (isset($_GET['msg'])){ 
        switch($_GET['msg']){
            case 'creado': 
    ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Creado correctamente',
            text: 'El animal se ha guardado.',
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
            text: 'El animal se ha modificado.',
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
            text: 'El animal se ha eliminado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="row">
                <?php 
                    foreach ($datos as $dato) {

                ?>
                
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-item bg-white mb-2">     
                                    <img src="<?= $dato['imagen'] ?>" class="card-img-top" height="200px">                           
                                    <div class="p-4">
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i><?php echo $dato["lugar"]; ?></small>
                                    </div>
                                        <a class="h5 text-decoration-none" href=""><?php echo $dato["nombre"]; ?></a>
                                    
                                    <p><?php echo $dato["nom_cientifico"]; ?></p>
                                    <div class="border-top mt-4 pt-4">
                                        <div class="d-flex justify-content-between">
                                          <?php 
                                            if((int)$num_trab > 0){
                                               ?>
                                               
                                                 <select class="lugar" data-id="<?= $dato['especie_id'] ?>">
                                                    <option value="" selected disabled hidden>Elige lugar</option>
                                                    <?php 
                                                        foreach($lugares as $lugar){            
                                                                echo '<option value="'.$lugar["id"].'">'.$lugar["nombre"].'</option>';
                                                        
                                                        
                                                    } ?>
                                                </select>

                                                <select class="temporada" data-id="<?= $dato['especie_id'] ?>">
                                                    <option value="" selected disabled hidden>Elige temporada</option>
                                                    <option value="1">En temporada</option>
                                                    <option value="0">No disponible</option>
                                                </select>
                                            
                                            <?php
                                            }
                                          
                                          ?>
                                        </div>
                                    </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                    
                <?php } ?>
                
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll(".lugar").forEach(select => {

        select.addEventListener("change", function(){
            
            let id = this.dataset.id;
            let lugar = this.value;
            console.log("Enviando ID:", id, "Lugar:", lugar);
            $.ajax({

                url: 'index.php?accion=actualizarlugar',

                type: 'POST',

                data: {
                    id : id,
                    lugar : lugar
                },

                success: function(response){

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Animal actualizado',
                        showConfirmButton: false,
                        timer: 2000
                    });

                }

            });

        });

    });

    document.querySelectorAll(".temporada").forEach(select => {

        select.addEventListener("change", function(){

            let id = this.dataset.id;
            let temporada = this.value;

            $.ajax({

                url: 'index.php?accion=actualizarTemporada',

                type: 'POST',

                data: {
                    id : id,
                    temporada : temporada
                },

                success: function(response){

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Animal actualizado',
                        showConfirmButton: false,
                        timer: 2000
                    });

                }

            });

        });

    });
    </script>
 
<?php include ('views/footer.php'); ?>
</body>
</html>