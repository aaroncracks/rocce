<?php
session_start();

require_once("db/db.php");
require_once("controller/actividadcontroller.php");
require_once("controller/lugarcontroller.php");
require_once("controller/iniciocontroller.php");
require_once("controller/usuariocontroller.php");
require_once("controller/animalcontroller.php");
require_once("controller/plantacontroller.php");
require_once("controller/mineralcontroller.php");
require_once("controller/trabajadorcontroller.php");
require_once("controller/investigadorcontroller.php");
require_once("controller/usuariocontroller.php");
require_once("controller/proyectocontroller.php");
require_once("controller/entradacontroller.php");
require_once("controller/comentariocontroller.php");
require_once("controller/reseñacontroller.php");

    if(isset($_SESSION["usuario"])){
        if($_SESSION["usuario"] == "Admin"){
            $accion = $_GET["accion"] ?? "admin";   
        }else{
            $accion = $_GET["accion"] ?? "home";   
        }
    }else{
        $accion = $_GET["accion"] ?? "home";  
    }

    $controllerac = new actividad_controller();
    $actividades = $controllerac->mostraractividaddatos();
    
    $controllerre = new reseña_controller();
    $reseñas = $controllerre->mostrarreseñadatos();

    switch($accion){
        case 'home':
            $controller = new inicio_controller();
            $controller->mostrarhome($actividades, $reseñas);
            break;

        case 'admin':
            $controller = new inicio_controller();
            $controller->mostraradmin();
            break;

        case 'about':
            $controller = new inicio_controller();
            $controller->mostrarabout();
            break;

        case 'actualizarlugar':
            $id = $_POST['id'];
        $lugar = $_POST['lugar'];
            $controller = new animal_controller();
            $controller->actualizarlugar($id, $lugar);
            break;

        case 'actualizarTemporada':
            $controller = new animal_controller();
            $controller->actualizarTemporada();
            break;

        case 'cerrarsesion':
            $controller = new inicio_controller();
            $controller->cerrar_sesion();
            break;

        case 'mostraractividadclient':
            $controller = new actividad_controller();
            $controller->mostraractividadclient();
            break;
        
        case 'mostrarlugarclient':
            $controller = new lugar_controller();
            $controller->mostrarlugarclient();
            break;

        case 'mostrariniciarsesion':
            $controller = new inicio_controller();
            $controller->mostrariniciosesion();
            break;

        case 'mostraralta':
            $controller = new inicio_controller();
            $controller->mostraralta();
            break;
        
        case 'crearbd':
            $controller = new Conectar();
            $controller->crearbd();
            break;
        
        case 'eliminarbd':
            $controller = new Conectar();
            $controller->eliminarbd();
            break;

        case 'iniciarsesion':
            $correo=$_POST['Correo'];
            $Contraseña=$_POST['contra'];
            $controller = new usuario_controller();
            $controller->iniciarsesion($correo, $Contraseña);
            break;
        
        case 'alta':
            $nombre=$_POST["Nombre"];
            $correo=$_POST['Correo'];
            $Contraseña=$_POST['contra'];
            $controller = new usuario_controller();
            $controller->alta($nombre, $correo, $Contraseña);
            break;

        case 'viewusuario':
            $controller = new usuario_controller();
            $controller->mostrarusuario();
            break;

        case 'viewusuarioun':
            $controller = new usuario_controller();
            $controller->mostrarunusuario();
            break;
        
        case 'viewmodusuario':
            $controller = new usuario_controller();
            $controller->mostrarmodusuario();
            break;

        case 'modusuario':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $contraseña=$_POST["contraseña"];
            $correo=$_POST["correo"];
            $controller = new usuario_controller();
            $controller->mod($id, $nombre, $correo, $contraseña);
            break;
        
        case 'delusuario':
            $id=$_GET["id"];
            $controller = new usuario_controller();
            $controller->del($id);
            break;

        // PROYECTOS CRUD
        case 'viewproyecto':
            $controller = new proyecto_controller();
            $controller->mostrarproyecto();
            break;

        case 'viewproyectoinv':
            $controller = new proyecto_controller();
            $controller->mostrarproyectoinv();
            break;
        
        case 'viewaddproyectoinv':
            $controller = new proyecto_controller();
            $controller->mostraraddproyectoinv();
            break;

        case 'viewaltaproyecto':
            $controller = new proyecto_controller();
            $controller->mostraraltaproyecto();
            break;
        
        case 'viewmodproyecto':
            $controller = new proyecto_controller();
            $controller->mostrarmodproyecto();
            break;
        
        case 'altaproyecto':
            $titulo=$_POST["titulo"];
            $autor=$_POST["autor"];
            $justificacion=$_POST["justificacion"];
            $controller = new proyecto_controller();
            $controller->alta($titulo, $autor, $justificacion);
            break;
        
        case 'modproyecto':
            $id=$_GET["id"];
            $titulo=$_POST["titulo"];
            $autor=$_POST["autor"];
            $justificacion=$_POST["justificacion"];
            $controller = new proyecto_controller();
            $controller->mod($id, $titulo, $autor, $justificacion);
            break;
        
        case 'delproyecto':
            $id=$_GET["id"];
            $controller = new proyecto_controller();
            $controller->del($id);
            break;
        
        case 'addproyecto':
            $id=$_GET["id"];
            $controller = new proyecto_controller();
            $controller->add($id);
            break;

        // ENTRADAS CRUD
        case 'viewentrada':
            $controller = new entrada_controller();
            $controller->mostrarentrada();
            break;

        case 'viewentradaclient':
            $controller = new entrada_controller();
            $controller->mostrarentradaclient();
            break;

        case 'viewaltaentrada':
            $controller = new entrada_controller();
            $controller->mostraraltaentrada();
            break;
        
        
        case 'altaentrada':
            $tipo = $_POST["tipo"];
            $cantidad = intval($_POST["cantidad"]);

            // precios por tipo
            $precios = [
                "General" => 10,
                "Estudiante" => 7,
                "Jubilado" => 6,
                "Niño" => 5
            ];

            $precio = $precios[$tipo];
            $total = $precio * $cantidad;
            $fecha_entrada = $_POST["fch_compra"];

            if($_SESSION["usuario"]=="Admin"){
                $id=1;
            }else{
                $id=$_SESSION["usuario"];
            }

            $controller = new entrada_controller();
            $controller->alta($id, $tipo, $fecha_entrada, $cantidad, $precio, $total);
            break;
        
        
        case 'delentrada':
            $id=$_GET["id"];
            $controller = new entrada_controller();
            $controller->del($id);
            break;

        // PLANTAS CRUD
        case 'viewplanta':
            
            $controller = new planta_controller();
            $controller->mostrarplanta();
            break;

        case 'viewplantaclient':
            
            $controller = new planta_controller();
            $controller->mostrarplantaclient();
            break;
        
        case 'viewaltaplanta':
            $controller = new planta_controller();
            $controller->mostraraltaplanta();
            break;
        
        case 'viewmodplanta':
            $controller = new planta_controller();
            $controller->mostrarmodplanta();
            break;
        
        case 'altaplanta':
            $nombre=$_POST["Nombre"];
            $nombre_cientifico=$_POST["Nombreci"];
            $habitat=$_POST["habitat"];
            $reproduccion=$_POST["reproduccion"];
            $ciclo=$_POST["ciclo"];
            $tallo=$_POST["tallo"];
            $lugar_id=$_POST["lugar_id"];
            $temporada=$_POST["temporada"];
            $controller = new planta_controller();
            $controller->alta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id, $temporada);
            break;
        
        case 'modplanta':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $nombre_cientifico=$_POST["Nombreci"];
            $habitat=$_POST["habitat"];
            $reproduccion=$_POST["reproduccion"];
            $ciclo=$_POST["ciclo"];
            $tallo=$_POST["tallo"];
            $lugar_id=$_POST["lugar_id"];
            $temporada=$_POST["temporada"];
            $controller = new planta_controller();
            $controller->mod($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id, $temporada);
            break;
        
        case 'delplanta':
            $id=$_GET["id"];
            $controller = new planta_controller();
            $controller->del($id);
            break;

        // MINERALES CRUD
        case 'viewmineral':
            
            $controller = new mineral_controller();
            $controller->mostrarmineral();
            break;
        case 'viewaltamineral':
            $controller = new mineral_controller();
            $controller->mostraraltamineral();
            break;
        
        case 'viewmodmineral':
            $controller = new mineral_controller();
            $controller->mostrarmodmineral();
            break;
        
        case 'modmineral':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $formula=$_POST["formula"];
            $clase=$_POST["clase"];
            $sistema_cristalino=$_POST["sistema_cristalino"];
            $habito=$_POST["habito"];
            $lugar_id=$_POST["lugar_id"];
            $controller = new mineral_controller();
            $controller->mod($id, $nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id);
            break;
        
        case 'altamineral':
            $nombre=$_POST["Nombre"];
            $formula=$_POST["formula"];
            $clase=$_POST["clase"];
            $sistema_cristalino=$_POST["sistema_cristalino"];
            $habito=$_POST["habito"];
            $lugar_id=$_POST["lugar_id"];
            $controller = new mineral_controller();
            $controller->alta($nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id);
            break;
        
        case 'delmineral':
            $id=$_GET["id"];
            $controller = new mineral_controller();
            $controller->del($id);
            break;

        // INVESTIGADORES CRUD
        case 'viewinvestigador':
            $controller = new investigador_controller();
            $controller->mostrarinvestigador();
            break;
        case 'viewaltainvestigador':
            $controller = new investigador_controller();
            $controller->mostraraltainvestigador();
            break;
        
        case 'viewmodinvestigador':
            $controller = new investigador_controller();
            $controller->mostrarmodinvestigador();
            break;
        
        case 'modinvestigador':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $contraseña=$_POST["contraseña"];
            $correo=$_POST["correo"];
            $especialidad=$_POST["especialidad"];
            $controller = new investigador_controller();
            $controller->mod($id, $nombre, $correo, $contraseña, $especialidad);
            break;
        
        case 'altainvestigador':
            $nombre=$_POST["Nombre"];
            $contraseña=$_POST["contraseña"];
            $correo=$_POST["correo"];
            $especialidad=$_POST["especialidad"];
            $controller = new investigador_controller();
            $controller->alta($nombre, $correo, $contraseña, $especialidad);
            break;
        
        case 'delinvestigador':
            $id=$_GET["id"];
            $controller = new investigador_controller();
            $controller->del($id);
            break;
        

        // TRABAJADORES CRUD
        case 'viewtrabajador':
            $controller = new trabajador_controller();
            $controller->mostrartrabajador();
            break;
        case 'viewaltatrabajador':
            $controller = new trabajador_controller();
            $controller->mostraraltatrabajador();
            break;
        
        case 'viewmodtrabajador':
            $controller = new trabajador_controller();
            $controller->mostrarmodtrabajador();
            break;
        
        case 'modtrabajador':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $contraseña=$_POST["contraseña"];
            $correo=$_POST["correo"];
            $puesto=$_POST["puesto"];
            $controller = new trabajador_controller();
            $controller->mod($id, $nombre, $correo, $contraseña, $puesto);
            break;
        
        case 'altatrabajador':
            $nombre=$_POST["Nombre"];
            $contraseña=$_POST["contraseña"];
            $correo=$_POST["correo"];
            $puesto=$_POST["puesto"];
            $controller = new trabajador_controller();
            $controller->alta($nombre, $correo, $contraseña, $puesto);
            break;
        
        case 'deltrabajador':
            $id=$_GET["id"];
            $controller = new trabajador_controller();
            $controller->del($id);
            break;
        
        // ANIMALES CRUD
        case 'viewanimal':
            
            $controller = new animal_controller();
            $controller->mostraranimal();
            break;

        case 'viewanimalclient':
            
            $controller = new animal_controller();
            $controller->mostraranimalclient();
            break;
        case 'viewaltaanimal':
            $controller = new animal_controller();
            $controller->mostraraltaanimal();
            break;
        
        case 'viewmodanimal':
            $controller = new animal_controller();
            $controller->mostrarmodanimal();
            break;
        
        case 'modanimal':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $nombre_cientifico=$_POST["Nombreci"];
            $habitat=$_POST["habitat"];
            $reproduccion=$_POST["reproduccion"];
            $esqueleto=$_POST["esqueleto"];
            $alimentacion=$_POST["alimentacion"];
            $lugar_id=$_POST["lugar_id"];
            $controller = new animal_controller();
            $controller->mod($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id);
            break;
        
        case 'altaanimal':
            $nombre=$_POST["Nombre"];
            $nombre_cientifico=$_POST["Nombreci"];
            $habitat=$_POST["habitat"];
            $reproduccion=$_POST["reproduccion"];
            $esqueleto=$_POST["esqueleto"];
            $alimentacion=$_POST["alimentacion"];
            $lugar_id=$_POST["lugar_id"];
            $controller = new animal_controller();
            $controller->alta($nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id);
            break;
        
        case 'delanimal':
            $id=$_GET["id"];
            $controller = new animal_controller();
            $controller->del($id);
            break;
        
        // LUGARES CRUD
        case 'viewlugar':
            
            $controller = new lugar_controller();
            $controller->mostrarlugar();
            break;
        case 'viewaltalugar':
            $controller = new lugar_controller();
            $controller->mostraraltalugar();
            break;

        case 'viewmodlugar':
            $controller = new lugar_controller();
            $controller->mostrarmodlugar();
            break;
        
        case 'altalugar':
            $nombre=$_POST["Nombre"];
            $descripcion=$_POST["Descripcion"];
            $controller = new lugar_controller();
            $controller->alta($nombre, $descripcion);
            break;
        
        case 'modlugar':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $descripcion=$_POST["Descripcion"];
            $controller = new lugar_controller();
            $controller->mod($id, $nombre, $descripcion);
            break;
        
        case 'dellugar':
            $id=$_GET["id"];
            $controller = new lugar_controller();
            $controller->del($id);
            break;

        // ACTIVIDADES CRUD
        case 'viewactividad':
            $controller = new actividad_controller();
            $controller->mostraractividad();
            break;

        case 'viewactividadun':
            $controller = new actividad_controller();
            $controller->mostrarunactividad();
            break;

        case 'viewaltaactividad':
            $controller = new actividad_controller();
            $controller->mostraraltaactividad();
            break;

        case 'viewmodactividad':
            $controller = new actividad_controller();
            $controller->mostrarmodactividad();
            break;
        
        case 'altaactividad':
            $nombre=$_POST["Nombre"];
            $descripcion=$_POST["Descripcion"];
            if (isset($_POST['habilitado'])) { 
                $habilitado = 1; 
            } else { 
                $habilitado = 0;
            }
            $lugar_id=$_POST["lugar_id"];
            $controller = new actividad_controller();
            $controller->alta($nombre, $descripcion, $habilitado, $lugar_id);
            break;
        
        case 'modactividad':
            $id=$_GET["id"];
            $nombre=$_POST["Nombre"];
            $descripcion=$_POST["Descripcion"];
            if (isset($_POST['habilitado'])) { 
                $habilitado = 1; 
            } else { 
                $habilitado = 0;
            }
            $lugar_id=$_POST["lugar_id"];
            $controller = new actividad_controller();
            $controller->mod($id, $nombre, $descripcion, $habilitado, $lugar_id);
            break;
        
        case 'delactividad':
            $id=$_GET["id"];
            $controller = new actividad_controller();
            $controller->del($id);
            break;
        
        // RESEÑAS CRUD
        case 'viewreseña':
            $controller = new reseña_controller();
            $controller->mostrarreseña();
            break;

        case 'viewaltareseña':
            $controller = new reseña_controller();
            $controller->mostraraltareseña();
            break;

        case 'viewmodreseña':
            $controller = new reseña_controller();
            $controller->mostrarmodreseña();
            break;
        
        case 'altareseña':
            $descripcion=$_POST["Descripcion"];
            $controller = new reseña_controller();
            $controller->alta($descripcion);
            break;
        
        case 'modreseña':
            $descripcion=$_POST["Descripcion"];
            $controller = new reseña_controller();
            $controller->mod($descripcion);
            break;
        
        case 'delreseña':
            $id=$_SESSION["usuario"];
            $controller = new reseña_controller();
            $controller->del($id);
            break;

        case 'viewcomentario':
            $controller = new comentario_controller();
            $controller->mostrarcomentario();
            break;

        case 'crearcomentario':
            $texto = $_POST["comentario"];
            $actividad_id = $_POST["actividad_id"];
            $controller = new comentario_controller();
            $controller->crear($texto, $actividad_id);
            break;

    }

?>