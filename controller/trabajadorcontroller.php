<?php
require_once ('model/trabajadormodel.php');
require_once ('model/correomodel.php');

class trabajador_controller{
    
    private $model;

    public function __construct() {
        $this->model = new trabajador_model();
    }
    
    function trabajadorid(){
        $num_trab=$this->model->get_trabajadores2();
        return $num_trab;
    
    }
    
    function mostrardatos(){
        $datos=$this->model->get_trabajadores();
        return $datos;
    }
    function mostrartrabajador(){
        $total=$this->model->get_total();
        $datos=$this->model->get_trabajadores();

        //Llamada a la vista
        require_once("views/viewmostrartrabajador.php");

    }
    function mostrarmodtrabajador(){
        $datos = $this->model->get_trabajadores1();
        require_once("views/viewmodtrabajador.php");
    }

    function mod($id, $nombre, $correo, $contraseña, $puesto){
        $ruta = $_POST["imagen_actual"];
        if ($_FILES['imagen']['error'] == 0) {

            if(file_exists($ruta)){
                unlink($ruta);
            }
        
            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        }  

        $datos=$this->model->mod_trabajador($id, $nombre, $correo, $contraseña, $puesto, $ruta);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewtrabajador&msg=modificado");
    }

    function alta($nombre, $correo, $contraseña, $puesto){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        }
        $datos=$this->model->set_trabajadores($nombre, $correo, $contraseña, $puesto, $ruta);
        $correoModel = new correo_model();
        $correoModel->enviarcorreoalta($correo);
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