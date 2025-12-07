<?php
require_once ('model/actividadmodel.php');
require_once('controller/lugarcontroller.php');

class actividad_controller{
    
    private $model;

    public function __construct() {
        $this->model = new actividad_model();
        $this->controller = new lugar_controller();
    }

    function mostraractividadclient(){
        $datos=$this->model->get_actividades();

        
        
        //Llamada a la vista
        require_once("views/viewmostraractividadclient.php");

    }

    function mostraractividad(){
        $datos=$this->model->get_actividades();

        
        
        //Llamada a la vista
        require_once("views/viewmostraractividad.php");

    }

    function mostraraltaactividad(){
        $datos = $this->controller->mostrardatos();
        require_once("views/viewaltaactividades.php");
    }

    function mostrarmodactividad(){
        $datos = $this->controller->mostrardatos();
        $actividades = $this->model->get_actividades1();
        require_once("views/viewmodactividad.php");
    }

    function alta($nombre, $descripcion, $habilitado, $lugar_id){
        $datos=$this->model->set_actividad($nombre, $descripcion, $habilitado, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewactividad&msg=creado");

    }

    function mod($id, $nombre, $descripcion, $habilitado, $lugar_id){
        $datos=$this->model->mod_actividad($id, $nombre, $descripcion, $habilitado, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewactividad&msg=modificado");

    }

    function del($id){
        $datos=$this->model->del_actividad($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewactividad&msg=eliminado");

    }

}
    
?>