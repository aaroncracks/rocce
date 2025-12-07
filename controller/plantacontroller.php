<?php
require_once ('model/plantamodel.php');
require_once('controller/lugarcontroller.php');

class planta_controller{
    
    private $model;

    public function __construct() {
        $this->model = new planta_model();
        $this->controller = new lugar_controller();
    }


    function mostrarplanta(){
        $datos=$this->model->get_plantas();
        
        //Llamada a la vista
        require_once("views/viewmostrarplanta.php");

    }

    function mostraraltaplanta(){
        $datos = $this->controller->mostrardatos();
        require_once("views/viewaltaplantas.php");
    }

    function mostrarmodplanta(){
        $datos = $this->model->get_plantas1();
        $lugares = $this->controller->mostrardatos();
        require_once("views/viewmodplanta.php");
    }

    function mod($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id){
        $datos=$this->model->mod_planta($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewplanta&msg=modificado");

    }

    function alta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id){
        $datos=$this->model->set_planta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewplanta&msg=creado");

    }

    function del($id){
        $datos=$this->model->del_planta($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewplanta&msg=eliminado");

    }
}
?>