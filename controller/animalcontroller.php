<?php
require_once ('model/animalmodel.php');
require_once('controller/lugarcontroller.php');
require_once('controller/trabajadorcontroller.php');

class animal_controller{
    
    private $model;

    public function __construct() {
        $this->model = new animal_model();
        $this->controller = new lugar_controller();
        $this->controller1 = new trabajador_controller();
    }



    function mostraranimal(){
        $total=$this->model->get_total();
        $datos=$this->model->get_animales();
        
        //Llamada a la vista
        require_once("views/viewmostraranimal.php");

    }

    function mostraranimalclient(){
        $datos=$this->model->get_animales();
        $num_trab=$this->controller1->trabajadorid();

        //Llamada a la vista
        require_once("views/viewmostraranimalclient.php");

    }

    function mostrarmodanimal(){
        $datos = $this->model->get_animales1();
        $lugares = $this->controller->mostrardatos();
        require_once("views/viewmodanimal.php");
    }

    function mod($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id){
        $datos=$this->model->mod_animal($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewanimal&msg=modificado");

    }

    function mostraraltaanimal(){
        $datos = $this->controller->mostrardatos();
        require_once("views/viewaltaanimales.php");
    }

    function alta($nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }
        $datos=$this->model->set_animal($nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id, $ruta);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewanimal&msg=creado");

    }

    function del($id){
        $datos=$this->model->del_animal($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewanimal&msg=eliminado");

    }
}
?>