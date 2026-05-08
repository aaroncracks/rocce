<?php
require_once ('model/plantamodel.php');
require_once('controller/lugarcontroller.php');
require_once('controller/trabajadorcontroller.php');

class planta_controller{
    
    private $model;

    public function __construct() {
        $this->model = new planta_model();
        $this->controller = new lugar_controller();
        $this->controller1 = new trabajador_controller();
    }


    function mostrarplanta(){
       $total=$this->model->get_total();
        $datos=$this->model->get_plantas();
        
        //Llamada a la vista
        require_once("views/viewmostrarplanta.php");

    }

    function mostrarplantaclient(){
        $datos=$this->model->get_plantas();
        $num_trab=$this->controller1->trabajadorid();
        $lugares = $this->controller->mostrardatos();
        $total=$this->model->get_total();
        //Llamada a la vista
        require_once("views/viewmostrarplantaclient.php");

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

    function mod($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id, $temporada){
        $ruta = $_POST["imagen_actual"];
        if ($_FILES['imagen']['error'] == 0) {

            if(file_exists($ruta)){
                unlink($ruta);
            }
        
            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        }  
        $datos=$this->model->mod_planta($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id, $temporada, $ruta, $temporada);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewplanta&msg=modificado");

    }

    function alta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id, $temporada){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }
        $datos=$this->model->set_planta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id, $ruta, $temporada);
        
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