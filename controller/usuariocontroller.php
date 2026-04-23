<?php
require_once ('model/usuariomodel.php');
require_once ('model/correomodel.php');

class usuario_controller{

    function iniciarsesion($correo, $Contraseña){
        
        $Sesion=0;
        
        if($correo=="adminparque@gmail.com" and $Contraseña=="1234"){
            $_SESSION['usuario']="Admin";
            echo "<h1>Bienvenido Administrador</h1>";
            header("Location: index.php?accion=admin");
            exit;
        }

        try{
            $model = new usuario_model();
            $datos=$model->get_usuarios();
            foreach ($datos as $dato) {
                if($dato["correo"]==$correo and $dato["contraseña"]==$Contraseña){
                    $Sesion=1;
                } 

            }

        }catch(exception $f){
            echo "No se puede iniciar sesion en estos momentos"; /*No existe la BD*/
            $Sesion=2; /*Que no muestre el mensaje de Usuario Erroneo */
        }
        

        if($Sesion==1){
            $datos=$model->get_usuarios1($correo, $Contraseña);
            foreach($datos as $dato){
                $_SESSION['usuario']=$dato["id"];
            }
            
        }
        if($Sesion==0){
            echo "Usuario erroneo";
        }
            
        if($Sesion==2){
            echo "Por favor espere mientras habilitamos su cuenta";
        }

        header("Refresh:1, url=index.php");
    }



    function alta($nombre, $correo, $Contraseña){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }
        $daralta = true;
        $model = new usuario_model();
        $datos=$model->get_usuarios();
            foreach ($datos as $dato) {
                if($dato["correo"]==$correo){
                    $daralta = false;
                } 
            }
        if($daralta){
            
            $datos=$model->set_usuario($correo, $nombre, $Contraseña, $ruta);
            $correoModel = new correo_model();
            $correoModel->enviarcorreoalta($correo);
                
            if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]=="Admin"){
                header("Refresh:1, url=index.php?accion=viewusuario&msg=creado");
            }else{
                
                header("Refresh:1, url=index.php?msg=creado");
            }
            
            
            
        }else{
            header("Refresh:1, url=index.php?accion=mostraralta");
        }
        
    }

    function mostrarusuario(){
        $model = new usuario_model();
        $total=$model->get_total();
        $datos=$model->get_usuarios2();

        //Llamada a la vista
        require_once("views/viewmostrarusuario.php");

    }
    function mostrarmodusuario(){
        $model = new usuario_model();
        $datos = $model->get_usuarios3();
        require_once("views/viewmodusuario.php");
    }
    function mostrarunusuario(){
        $model = new usuario_model();
        $datos = $model->get_usuarios3();
        require_once("views/viewmostrarusuarioun.php");
    }

    function mod($id, $nombre, $correo, $contraseña){
        $model = new usuario_model();
        $datos=$model->mod_usuario($id, $nombre, $correo, $contraseña);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewusuario&msg=modificado");
        }else{
            header("Refresh:1, url=index.php?accion=viewusuarioun&id=$id&msg=modificado");
        }

    }

    function del($id){
        $model = new usuario_model();
        $datos=$model->del_usuario($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewusuario&msg=eliminado");

    }
}

?>