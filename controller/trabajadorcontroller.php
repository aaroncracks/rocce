<?php
require_once ('model/trabajadormodel.php');

class trabajador_controller{
    
    private $model;

    public function __construct() {
        $this->model = new trabajador_model();
    }

    function mostrardatos(){
        $datos=$this->model->get_trabajadores();
        return $datos;
    }
    function mostrartrabajador(){
        $datos=$this->model->get_trabajadores();

        //Llamada a la vista
        require_once("views/viewmostrartrabajador.php");

    }
    function mostrarmodtrabajador(){
        $datos = $this->model->get_trabajadores1();
        require_once("views/viewmodtrabajador.php");
    }

    function mod($id, $nombre, $correo, $contraseña, $puesto){
        $datos=$this->model->mod_trabajador($id, $nombre, $correo, $contraseña, $puesto);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewtrabajador&msg=modificado");
    }

    function alta($nombre, $correo, $contraseña, $puesto){
        $datos=$this->model->set_trabajadores($nombre, $correo, $contraseña, $puesto);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewtrabajador&msg=creado");

    }

    function mostraraltatrabajador(){
        require_once("views/viewaltatrabajadores.php");
    }

    function del($id){
        $datos=$this->model->del_trabajador($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewtrabajador&msg=eliminado");

    }
}
?>