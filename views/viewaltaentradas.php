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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://www.paypal.com/sdk/js?client-id=AW7ndV76sT9SSoFvy_rO-8MppTKkhc9oD8WRh0B4LsWtTRwt9UtFi5kULTayQklGh43p772rp1O2b2dj&currency=EUR"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <?php include ('controller/header.php'); 
        if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]=="Admin"){
    ?>
    <h2 class="mb-1 mt-5 text-center">Alta Entrada</h2>
    <?php 
        }else{   
    ?>
        <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">COMPRAR ENTRADA</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="index.php">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">COMPRAR ENTRADA</p>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <?php if (isset($_GET['msg'])){ 
        switch($_GET['msg']){
            case 'error': 
    ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Creado correctamente',
            text: 'El proyecto se ha guardado.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php
            break;

            case 'error1':
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Modificado correctamente',
            text: 'El proyecto se ha añadido.',
            timer: 4000,
            showConfirmButton: false
        });
        </script>
    <?php 
        break;
    }} ?>
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <form id="form" method="post">
                <div class="control-group">
                    <label for="">TIPO DE ENTRADA</label>
                        <select id="tipo" name="tipo" class="form-control" required="required">
                            <option value="General">General - 10€</option>
                            <option value="Estudiante">Estudiante - 7€</option>
                            <option value="Jubilado">Jubilado - 6€</option>
                            <option value="Niño">Niño - 5€</option>
                        </select>
                        <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                    <label for="">CANTIDAD</label>
                    <input id="cantidad" type="number" class="form-control p-4" name="cantidad" placeholder="cantidad" 
                        required="required" data-validation-required-message="Por favor escriba el cantidad" />
                    <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                    <label for="">FECHA</label>
                    <input id="fch_compra" type="date" class="form-control p-4" name="fecha" placeholder="fecha" 
                        required="required" data-validation-required-message="Por favor escriba el fecha" />
                    <p class="help-block text-danger"><?php if(isset($_GET["msg"])){ echo "Pon la fecha mas adelante que la actual"; } ?></p>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Comprar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pagoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar Reserva</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Seleccionar "Confirmar" para terminar de confirmar la reserva. <p>Tienes hasta 12 horas para pagar.</p></div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="">Más Tarde</a>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="paypalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión en PayPal</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="paypal-login-button-container"></div>
                    </div>
                </div>
            </div>
        </div>

    <?php include ('views/footer.php'); ?>

    <script>
        document.querySelector("#form").addEventListener("submit", function(event){
            event.preventDefault();
            $('#pagoModal').modal('show');
            alert("pijama");
            $('#pagoModal').off('shown.bs.modal').on('shown.bs.modal', function () {
                        $('#paypal-button-container').empty(); // Limpia si ya estaba renderizado antes
                        paypal.Buttons({
                            style: {
                                layout: 'vertical',
                                shape: 'rect',
                                color: 'gold',
                                tagline: false
                            },
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: 2
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    const email = details.payer.email_address;
                                    const nombre = details.payer.name.given_name + ' ' + details.payer.name.surname;
                                    $.ajax({
                                         url: 'index.php?accion=altaentrada',
                                         type: 'POST',
                                         data: {
                                             tipo : tipo,
                                             cantidad : cantidad,
                                             fch_compra : fch_compra,
                                         },
                                         success: function(response) {
                                             if (response) {
                                                 window.location.href = "";
                                             }else {
                                                 alert(response);
                                             }
                                         },
                                         error: function() {
                                             alert('Ocurrió un error al procesar la solicitud.');
                                         }
                                    });
                                });
                                
                            },
                            onError: function(err) {
                                console.log(err);
                                alert('Hubo un error con PayPal: ' + err.message);
                            },
                            fundingSource: paypal.FUNDING.PAYPAL
                        }).render('#paypal-button-container');
                });
        });
        
    
        
    </script>
</body>
</html>
