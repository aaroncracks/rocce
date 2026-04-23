<?php
require_once ('model/investigadormodel.php');
require_once ('model/correomodel.php');

class investigador_controller{
    
    private $model;

    public function __construct() {
        $this->model = new investigador_model();
    }

    function mostrardatos(){
        $datos=$this->model->get_investigadores();
        return $datos;
    }
    function mostrarinvestigador(){
        $total=$this->model->get_total();
        $datos=$this->model->get_investigadores();

        //Llamada a la vista
        require_once("views/viewmostrarinvestigador.php");

    }
    function mostrarmodinvestigador(){
        $datos = $this->model->get_investigadores1();
        require_once("views/viewmodinvestigador.php");
    }

    function mod($id, $nombre, $correo, $contraseña, $especialidad){
        $datos=$this->model->mod_investigador($id, $nombre, $correo, $contraseña, $especialidad);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewinvestigador&msg=modificado");

    }

    function alta($nombre, $correo, $contraseña, $especialidad){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }
        $datos=$this->model->set_investigadores($nombre, $correo, $contraseña, $especialidad, $ruta);
        $correoModel = new correo_model();
        $correoModel->enviarcorreoalta($correo);
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewinvestigador&msg=creado");

    }

    function mostraraltainvestigador(){
        require_once("views/viewaltainvestigadores.php");
    }

    function del($id){
        $datos=$this->model->del_investigador($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewinvestigador&msg=eliminado");

    }
}
?>