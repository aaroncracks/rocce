<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';


/*--------------FUNCIONES PRINCIPALES-----------------*/

if(isset($_POST["action"])){
    switch ($_POST["action"]){
        case 'comentar':
            altacomentario($usuario_id, $actividad_id, $descripcion, $fecha);
            break;
    }
}


function seleccionarcontenido(){
    if(isset($_GET['CrearBD'])){
        CrearBD();
    }
    if(isset($_GET['EliminarBD'])) {
        EliminarBD();
    }
    if(isset($_GET['cerrarsesion'])) {
        cerrarsesion();
    }
    if(isset($_GET['viewalta'])) {
        include("../views/viewalta.php"); 
    }
    if(isset($_GET['Alta'])) {
        Alta($correo, $nombre, $Contraseña);
        header("location: ../index.php");
    }
    if(isset($_GET['viewiniciar'])) {
        include("../views/viewiniciarsesion.php"); 
    }
    if(isset($_GET['iniciar'])) {
       iniciarsesion($correo, $Contraseña);
    }

    //CRUD LUGARES

    if(isset($_GET['viewaltalugar'])) {
        include("../views/viewaltalugares.php"); 
    }
    if(isset($_GET['altalugar'])) {
       altalugar($nombre, $descripcion);
    }
    if(isset($_GET['mostrarlugares'])) {
       include("../views/viewmostrarlugar.php");
    }
    if(isset($_GET['modificarlugar'])) {
        $id = $_GET["id"];
       include("../views/viewmodlugar.php");
    }
    if(isset($_GET['modlugar'])) {
       modlugar($id, $nombre, $descripcion);
    }

    //CRUD ACTIVIDADES

    if(isset($_GET['viewaltaactividad'])) {
        include("../views/viewaltaactividades.php"); 
    }
    if(isset($_GET['altaactividad'])) {
       altaactividad($nombre, $descripcion, $habilitado, $lugar_id);
    }
    if(isset($_GET['mostraractividades'])) {
       include("../views/viewmostraractividad.php");
    }
    if(isset($_GET['mostraractividadclient'])) {
       include("../views/viewmostraractividadclient.php");
    }
    if(isset($_GET['modificaractividad'])) {
        $id = $_GET["id"];
       include("../views/viewmodactividad.php");
    }
    if(isset($_GET['modactividad'])) {
       modactividad($id, $nombre, $descripcion, $habilitado, $lugar_id);
    }

    //CRUD MINERALES

    if(isset($_GET['viewaltamineral'])) {
        include("../views/viewaltaminerales.php"); 
    }
    if(isset($_GET['altamineral'])) {
       altamineral($nombre, $formula, $clase, $sistema_cristalino, $habito);
    }
    if(isset($_GET['mostrarminerales'])) {
       include("../views/viewmostrarmineral.php");
    }
    if(isset($_GET['modificarmineral'])) {
        $id = $_GET["id"];
       include("../views/viewmodmineral.php");
    }
    if(isset($_GET['modmineral'])) {
       modmineral($id, $nombre, $formula, $clase, $sistema_cristalino, $habito);
    }

    //CRUD ANIMALES

    if(isset($_GET['viewaltaanimal'])) {
        include("../views/viewaltaanimales.php"); 
    }
    if(isset($_GET['altaanimal'])) {
       altaanimal($nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion);
    }
    if(isset($_GET['mostraranimales'])) {
       include("../views/viewmostraranimal.php");
    }
    if(isset($_GET['modificaranimal'])) {
        $id = $_GET["id"];
       include("../views/viewmodanimal.php");
    }
    if(isset($_GET['modanimal'])) {
       modanimal($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion);
    }

    //CRUD PLANTAS

    if(isset($_GET['viewaltaplanta'])) {
        include("../views/viewaltaplantas.php"); 
    }
    if(isset($_GET['altaplanta'])) {
       altaplanta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo);
    }
    if(isset($_GET['mostrarplantas'])) {
       include("../views/viewmostrarplanta.php");
    }
    if(isset($_GET['modificarplanta'])) {
        $id = $_GET["id"];
       include("../views/viewmodplanta.php");
    }
    if(isset($_GET['modplanta'])) {
       modplanta($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo);
    }

    if(isset($_GET['envio'])) {
       if (enviarCorreo("gonzalezaaronsantana@gmail.com", "Bienvenido al Parque Nacional", "<h2>¡Bienvenido!</h2><p>Gracias por registrarte.</p>")) {

            echo "Email enviado correctamente";

        } else {
            echo "Error al enviar el email";
        }
    }
}

function navegacion(){
    if(isset($_SESSION["usuario"])){
        if(($_SESSION["usuario"])=="Admin"){
            include("views/navegacionadmin.php"); 
        }else{
            include("views/navegacioncliente.php");
        }
    }else{
        include("views/navegacionnoconectado.php");
    }
}

function iniciarsesion(&$correo,&$Contraseña){
    $correo=$_POST['Correo'];
    $Contraseña=$_POST['contra'];
    $Sesion=0;
    
    Conectar($c);
    if($correo=="adminparque@gmail.com" and $Contraseña=="1234")
        $Sesion=3;
    else{
        try{
            mysqli_select_db($c,"parque_nacional");
            $query = mysqli_query($c, "SELECT * FROM usuarios");
            while ($valores = mysqli_fetch_array($query)) {
                if($valores["correo"]==$correo and $valores["contraseña"]==$Contraseña){
                        $Sesion=1;
                } 
            }

        }catch(exception $f){
            echo "No se puede iniciar sesion en estos momentos"; /*No existe la BD*/
            $Sesion=2; /*Que no muestre el mensaje de Usuario Erroneo */
        }
    }

    if($Sesion==1){
        mysqli_select_db($c,"parque_nacional");
        $query = mysqli_query($c, "SELECT id, nombre FROM usuarios WHERE correo='$correo' and contraseña='$Contraseña' LIMIT 1");
        $ar = mysqli_fetch_array($query);
        $_SESSION['usuario']=$ar["id"];
        echo "Sesion iniciada por " .$ar['nombre'];
    }
    if($Sesion==3){
        $_SESSION['usuario']="Admin";
        echo "<h1>Bienvenido Administrador</h1>";
    }
    if($Sesion==0)
        echo "Usuario erroneo";
    if($Sesion==2)
        echo "Por favor espere mientras habilitamos su cuenta";

    header("Refresh:3, url=../index.php");
}
function Alta(&$correo, &$nombre, &$Contraseña){
    $correo=$_POST["Correo"];
    $nombre=$_POST["Nombre"];
    $Contraseña=$_POST["contra"];
    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT usuarios (nombre, correo, contraseña) ";
                $Sentencia.="VALUES ('$nombre', '$correo', '$Contraseña')";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";
            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function altacomentario(&$usuario_id, &$actividad_id, &$descripcion, &$fecha){
    $usuario_id=$_SESSION["usuario"];
    $actividad_id=$_POST["id_actividad"];
    $descripcion=$_POST["Descripcion"];
    $fecha=date("Y-m-d");

    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT comentarios (usuario_id, actividad_id, descripcion, fecha) ";
                $Sentencia.="VALUES ('$usuario_id', '$actividad_id', '$descripcion', '$fecha')";
                $resultado = mysqli_query($c,$Sentencia);
                
                if($resultado){
                    $response = array(
                        'status' => 'success',
                        'message' => 'Se envio el comentario'
                    );
                }else{
                    $response = array(
                        'status' => 'error',
                        'message' => 'No se envio el comentario'
                    );
                }
                header("Refresh:0, url=principal.php?mostraractividadclient");
                echo json_encode($response);



            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function modlugar(&$id, &$nombre, &$descripcion){
    $id = $_GET["id"];
    $nombre=$_POST["Nombre"];
    $descripcion=$_POST["Descripcion"];

    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="UPDATE lugares ";
                $Sentencia.="SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id'";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}
function altalugar(&$nombre, &$descripcion){
    $nombre=$_POST["Nombre"];
    $descripcion=$_POST["Descripcion"];

    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT lugares (nombre, descripcion) ";
                $Sentencia.="VALUES ('$nombre', '$descripcion')";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function modactividad(&$id, &$nombre, &$descripcion, &$habilitado, &$lugar_id){
    $id = $_GET["id"];
    $nombre=$_POST["Nombre"];
    $descripcion=$_POST["Descripcion"];
    if (isset($_POST['habilitado'])) { 
        $habilitado = 1;
    } else { 
        $habilitado = 0;
    }
    $lugar_id=$_POST["lugar_id"];
    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="UPDATE actividades ";
                $Sentencia.="SET nombre='$nombre', descripcion='$descripcion', habilitado=$habilitado, lugar_id='$lugar_id' WHERE id='$id'";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}
function altaactividad(&$nombre, &$descripcion, &$habilitado, &$lugar_id){
    $nombre=$_POST["Nombre"];
    $descripcion=$_POST["Descripcion"];
    if (isset($_POST['habilitado'])) { 
        $habilitado = 1; 
    } else { 
        $habilitado = 0;
    }
    $lugar_id=$_POST["lugar_id"];
    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT actividades (nombre, descripcion, habilitado, lugar_id) ";
                $Sentencia.="VALUES ('$nombre', '$descripcion', $habilitado, '$lugar_id')";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function modmineral(&$id, &$nombre, &$formula, &$clase, &$sistema_cristalino, &$habito){
    $id = $_GET["id"];
    $nombre=$_POST["Nombre"];
    $formula=$_POST["formula"];
    $clase=$_POST["clase"];
    $sistema_cristalino=$_POST["sistema_cristalino"];
    $habito=$_POST["habito"];

    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="UPDATE minerales ";
                $Sentencia.="SET nombre='$nombre', formula='$formula', clase='$clase', sistema_cristalino='$sistema_cristalino', habito='$habito' WHERE id='$id'";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}
function altamineral(&$nombre, &$formula, &$clase, &$sistema_cristalino, &$habito){
    $nombre=$_POST["Nombre"];
    $formula=$_POST["formula"];
    $clase=$_POST["clase"];
    $sistema_cristalino=$_POST["sistema_cristalino"];
    $habito=$_POST["habito"];
    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT minerales (nombre, formula, clase, sistema_cristalino, habito) ";
                $Sentencia.="VALUES ('$nombre', '$formula', '$clase', '$sistema_cristalino', '$habito')";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function modanimal(&$id, &$nombre, &$nombre_cientifico, &$reproduccion, &$habitat, &$esqueleto, &$alimentacion){
    $id = $_GET["id"];
    $nombre=$_POST["Nombre"];
    $nombre_cientifico=$_POST["Nombreci"];
    $habitat=$_POST["habitat"];
    $reproduccion=$_POST["reproduccion"];
    $esqueleto=$_POST["esqueleto"];
    $alimentacion=$_POST["alimentacion"];
    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="UPDATE especies ";
                $Sentencia.="SET nombre='$nombre', nom_cientifico='$nombre_cientifico', reproduccion='$reproduccion', habitat='$habitat' WHERE id='$id'";
                mysqli_query($c,$Sentencia);

                $Sentencia="UPDATE animales ";
                $Sentencia.="SET esqueleto='$esqueleto', alimentacion='$alimentacion' WHERE especie_id='$id'";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}
function altaanimal(&$nombre, &$nombre_cientifico, &$reproduccion, &$habitat, &$esqueleto, &$alimentacion){
    $nombre=$_POST["Nombre"];
    $nombre_cientifico=$_POST["Nombreci"];
    $habitat=$_POST["habitat"];
    $reproduccion=$_POST["reproduccion"];
    $esqueleto=$_POST["esqueleto"];
    $alimentacion=$_POST["alimentacion"];

    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT especies (nombre, nom_cientifico, reproduccion, habitat) ";
                $Sentencia.="VALUES ('$nombre', '$nombre_cientifico', '$reproduccion', '$habitat')";
                mysqli_query($c,$Sentencia);
                $Sentencia="INSERT animales (especie_id, esqueleto, alimentacion) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$esqueleto', '$alimentacion')";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function modplanta(&$id, &$nombre, &$nombre_cientifico, &$reproduccion, &$habitat, &$ciclo, &$tallo){
    $id = $_GET["id"];
    $nombre=$_POST["Nombre"];
    $nombre_cientifico=$_POST["Nombreci"];
    $habitat=$_POST["habitat"];
    $reproduccion=$_POST["reproduccion"];
    $ciclo=$_POST["ciclo"];
    $tallo=$_POST["tallo"];
    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="UPDATE especies ";
                $Sentencia.="SET nombre='$nombre', nom_cientifico='$nombre_cientifico', reproduccion='$reproduccion', habitat='$habitat' WHERE id='$id'";
                mysqli_query($c,$Sentencia);

                $Sentencia="UPDATE plantas ";
                $Sentencia.="SET ciclo='$ciclo', tallo='$tallo' WHERE especie_id='$id'";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}
function altaplanta(&$nombre, &$nombre_cientifico, &$reproduccion, &$habitat, &$ciclo, &$tallo){
    $nombre=$_POST["Nombre"];
    $nombre_cientifico=$_POST["Nombreci"];
    $habitat=$_POST["habitat"];
    $reproduccion=$_POST["reproduccion"];
    $ciclo=$_POST["ciclo"];
    $tallo=$_POST["tallo"];

    
    Conectar($c);
    try{
        mysqli_select_db($c,"parque_nacional");
            try{
                $Sentencia="INSERT especies (nombre, nom_cientifico, reproduccion, habitat) ";
                $Sentencia.="VALUES ('$nombre', '$nombre_cientifico', '$reproduccion', '$habitat')";
                mysqli_query($c,$Sentencia);
                $Sentencia="INSERT plantas (especie_id, ciclo, tallo) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$ciclo', '$tallo')";
                mysqli_query($c,$Sentencia);
                echo "Dado de alta exitosamente";

                header("Refresh:1, url=../index.php");

            } catch(Exception $g){
                echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
            }
    }catch(Exception $f){
        echo "Imposible registrarse en estos momentos."; /*No existe la BD*/
    }
}

function cerrarsesion(){
    session_destroy();
    echo "Sesion Cerrada";
    header("Refresh:3, url=../index.php");
}
function CrearBD(){
    Conectar($c);
    $BD="Parque_nacional";

    mysqli_query($c,"CREATE DATABASE IF NOT EXISTS $BD");
    echo "Base de Datos $BD creada con éxito<br>";
    mysqli_select_db($c,$BD);

    $Sentencia="CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(50) UNIQUE NOT NULL,
    contraseña VARCHAR(100) NOT NULL
    );";
    mysqli_query($c,$Sentencia);
    

    $Sentencia="CREATE TABLE Reseñas (
    usuario_id INT PRIMARY KEY,
    descripcion TEXT,
    fecha DATE,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
        ON DELETE CASCADE
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Entradas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    fch_compra DATE,
    fch_entrada DATE,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Actividades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    descripcion TEXT,
    habilitado BOOLEAN
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Comentarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    actividad_id INT NOT NULL,
    descripcion TEXT,
    fecha DATE,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (actividad_id) REFERENCES Actividades(id)
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Lugares (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    descripcion TEXT
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="ALTER TABLE Actividades
    ADD lugar_id INT,
    ADD FOREIGN KEY (lugar_id) REFERENCES Lugares(id);";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Especies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    nom_cientifico VARCHAR(100),
    reproduccion VARCHAR(100),
    habitat VARCHAR(100)
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Animales (
    especie_id INT PRIMARY KEY,
    esqueleto VARCHAR(50),
    alimentacion VARCHAR(50),
    FOREIGN KEY (especie_id) REFERENCES Especies(id)
        ON DELETE CASCADE
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Plantas (
    especie_id INT PRIMARY KEY,
    ciclo VARCHAR(50),
    tallo VARCHAR(50),
    FOREIGN KEY (especie_id) REFERENCES Especies(id)
        ON DELETE CASCADE
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Minerales (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    formula VARCHAR(100),
    clase VARCHAR(50),
    sistema_cristalino VARCHAR(50),
    habito VARCHAR(100)
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="ALTER TABLE Minerales
    ADD lugar_id INT,
    ADD FOREIGN KEY (lugar_id) REFERENCES Lugares(id);";
    mysqli_query($c,$Sentencia);

    $Sentencia="ALTER TABLE Especies
    ADD lugar_id INT,
    ADD FOREIGN KEY (lugar_id) REFERENCES Lugares(id);";
    mysqli_query($c,$Sentencia);


    $Sentencia="CREATE TABLE Trabajadores (
    usuario_id INT PRIMARY KEY,
    puesto VARCHAR(50),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
        ON DELETE CASCADE
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Investigadores (
    usuario_id INT PRIMARY KEY,
    especialidad VARCHAR(50),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
        ON DELETE CASCADE
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Proyectos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100),
    autor VARCHAR(50),
    fecha DATE,
    justificacion TEXT
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="CREATE TABLE Trabajan (
    investigador_id INT,
    proyecto_id INT,
    PRIMARY KEY (investigador_id, proyecto_id),
    FOREIGN KEY (investigador_id) REFERENCES Investigadores(usuario_id),
    FOREIGN KEY (proyecto_id) REFERENCES Proyectos(id)
    );";
    mysqli_query($c,$Sentencia);

    $Sentencia="INSERT usuarios (nombre, correo, contraseña) ";
    $Sentencia.="VALUES ('Admin', 'adminparque@gmail.com', '1234')";
    mysqli_query($c,$Sentencia);

    echo "Tablas creadas creada<br>";
}
function EliminarBD(){
    $BD="Parque_nacional";
    Conectar($c);

    try{
        $Sentencia="DROP DATABASE $BD";
            if($t=mysqli_query($c,$Sentencia))
                echo "Base de datos Biblioteca eliminada";
    }catch(Exception $f){
        echo "No es borrable porque no existe aun"; /*No existe la BD*/
    }

    session_destroy();
}
function Conectar(&$c){
    if(isset ($_SESSION['usuario']) and $_SESSION['usuario']=="Administrador"){
        $c=mysqli_connect("localhost","adminapp","123"); /*Conexion Admin*/
    }else{
        $c=mysqli_connect("localhost","usuario",""); /*Conexion Usuario*/
    }

}

function enviarCorreo($destino, $asunto, $mensajeHTML) {
    $mail = new PHPMailer(true);

    try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // TU correo y contraseña
        $mail->Username   = 'gonzalezaaronsantana@gmail.com';
        $mail->Password   = 'mkti nlgv utsl xqes';

        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
        $mail->Port       = 587;

        // Remitente
        $mail->setFrom('gonzalezaaronsantana@gmail.com', 'Parque Nacional');

        // Destinatario
        $mail->addAddress($destino);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $mensajeHTML;

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
?>