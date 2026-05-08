<?php
require_once ('model/proyectomodel.php');

class proyecto_controller{
    
    private $model;

    public function __construct() {
        $this->model = new proyecto_model();
    }

    function mostrardatos(){
        $datos=$this->model->get_proyectos();
        return $datos;
    }
    function mostrarproyecto(){
        $total=$this->model->get_total();
        $datos=$this->model->get_proyectos();

        //Llamada a la vista
        require_once("views/viewmostrarproyecto.php");

    }
    function mostrarproyectoinv(){
        $datos=$this->model->get_proyectos2();
        $total=$this->model->get_total();
        //Llamada a la vista
        require_once("views/viewmostrarproyectoinv.php");

    }
    function mostraraddproyectoinv(){
        $datos=$this->model->get_proyectos3();

        //Llamada a la vista
        require_once("views/viewmostraraddproyectoinv.php");
    }

    function add($id){
        $datos=$this->model->add_proyectos($id);
        
        //Llamada a la vista

        header("Refresh:1, url=index.php?accion=viewproyectoinv&msg=añadido");
        
        

    }


    function mostrarmodproyecto(){
        $datos = $this->model->get_proyectos1();
        require_once("views/viewmodproyecto.php");
    }

    function mod($id, $titulo, $autor, $justificacion){

        if ($_FILES['archivo']['error'] == 0) {

            if(file_exists($ruta)){
                unlink($ruta);
            }
        
            $nombreArchivo = time() . "_" . $_FILES['archivo']['name'];
            $ruta = "proyectos/" . $nombreArchivo;

            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

        } 
        $datos=$this->model->mod_proyecto($id, $titulo, $autor, $justificacion, $ruta);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewproyecto&msg=modificado");
        }else{
            header("Refresh:1, url=index.php?accion=viewproyectoinv&msg=modificado");
        }
        

    }

    function alta($titulo, $autor, $justificacion){
        $ruta = null;

        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {

            $nombreArchivo = time() . "_" . $_FILES['archivo']['name'];
            $ruta = "proyectos/" . $nombreArchivo;

            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        }
        $datos=$this->model->set_proyectos($titulo, $autor, $justificacion, $ruta);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewproyecto&msg=creado");
        }else{
            header("Refresh:1, url=index.php?accion=viewproyectoinv&msg=creado");
        }
    }

    function mostraraltaproyecto(){
        require_once("views/viewaltaproyectos.php");
    }

    function del($id){
        $datos=$this->model->del_proyecto($id);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewproyecto&msg=eliminado");
        }else{
            header("Refresh:1, url=index.php?accion=viewproyectoinv&msg=eliminado");
        }
    }
}
?>