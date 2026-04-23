<?php
require_once ('model/mineralmodel.php');
require_once('controller/lugarcontroller.php');

class mineral_controller{
    
    private $model;

    public function __construct() {
        $this->model = new mineral_model();
        $this->controller = new lugar_controller();
    }


    function mostrarmineral(){
        $total=$this->model->get_total();
        $datos=$this->model->get_minerales();
        
        //Llamada a la vista
        require_once("views/viewmostrarmineral.php");

    }
    function mostrarmodmineral(){
        $datos = $this->model->get_minerales1();
        $lugares = $this->controller->mostrardatos();
        require_once("views/viewmodmineral.php");
    }

    function mod($id, $nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id){
        $datos=$this->model->mod_mineral($id, $nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewmineral&msg=modificado");

    }
    function mostraraltamineral(){
        $datos = $this->controller->mostrardatos();
        require_once("views/viewaltaminerales.php");
    }

    function alta($nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }
        $datos=$this->model->set_mineral($nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id, $ruta);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewmineral&msg=creado");

    }

    function del($id){
        $datos=$this->model->del_mineral($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewmineral&msg=eliminado");

    }
}
?>