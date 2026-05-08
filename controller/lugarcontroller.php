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
        $total=$this->model->get_total();
        $datos=$this->model->get_lugares();

        //Llamada a la vista
        require_once("views/viewmostrarlugar.php");
    }

    function mostrarlugarclient(){
        $datos=$this->model->get_lugares();
$total=$this->model->get_total();
        //Llamada a la vista
        require_once("views/viewmostrarlugarclient.php");
    }

    function mostrarmodlugar(){
        $datos = $this->model->get_lugares1();
        require_once("views/viewmodlugar.php");
    }

    function mod($id, $nombre, $descripcion){
        $ruta = $_POST["imagen_actual"];
        if ($_FILES['imagen']['error'] == 0) {

            if(file_exists($ruta)){
                unlink($ruta);
            }
        
            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        }  
        $datos=$this->model->mod_lugar($id, $nombre, $descripcion, $ruta);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewlugar&msg=modificado");

    }

    function alta($nombre, $descripcion){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }
        $datos=$this->model->set_lugares($nombre, $descripcion, $ruta);
        
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