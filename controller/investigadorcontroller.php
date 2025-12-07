<?php
require_once ('model/investigadormodel.php');

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
        $datos=$this->model->set_investigadores($nombre, $correo, $contraseña, $especialidad);
        
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