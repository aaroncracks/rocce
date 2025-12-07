<?php
require_once ('model/lugarmodel.php');

class lugar_controller{
    
    private $model;

    public function __construct() {
        $this->model = new lugar_model();
    }

    function mostrardatos(){
        $datos=$this->model->get_lugares();
        return $datos;
    }
    function mostrarlugar(){
        $datos=$this->model->get_lugares();

        //Llamada a la vista
        require_once("views/viewmostrarlugar.php");

    }
    function mostrarmodlugar(){
        $datos = $this->model->get_lugares1();
        require_once("views/viewmodlugar.php");
    }

    function mod($id, $nombre, $descripcion){
        $datos=$this->model->mod_lugar($id, $nombre, $descripcion);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewlugar&msg=modificado");

    }

    function alta($nombre, $descripcion){
        $datos=$this->model->set_lugares($nombre, $descripcion);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewlugar&msg=creado");

    }

    function mostraraltalugar(){
        require_once("views/viewaltalugares.php");
    }

    function del($id){
        $datos=$this->model->del_lugar($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewlugar&msg=eliminado");

    }
}
?>