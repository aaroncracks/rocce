<?php
require_once ('model/reseñamodel.php');
require_once ('model/entradamodel.php');

class reseña_controller{
    
    private $model;
    private $entrada;

    public function __construct() {
        $this->model = new reseña_model();
        $this->entrada = new entrada_model();
    }

    function mostrarreseñaclient(){
        $datos=$this->model->get_reseñas();

        
        
        //Llamada a la vista
        require_once("views/viewmostrarreseñaclient.php");

    }

    function mostrarreseña(){
        $total=$this->model->get_total();
        $datos=$this->model->get_reseñas();

        
        
        //Llamada a la vista
        require_once("views/viewmostrarreseña.php");

    }

    function mostraraltareseña(){
        $alta = true;
        $usuario = $_SESSION["usuario"];
        $datos = $this->entrada->get_entradas();
        foreach($datos as $dato){
            if($dato["usuario_id"]==$usuario){
                $alta = true;
            }
        }
        if($alta){
            require_once("views/viewaltareseñas.php");
        }else{
            header("Refresh:1, url=index.php?msg=error");
        }
        
    }

    function mostrarunreseña(){
        
        $datos = $this->model->get_reseñas1();
        require_once("views/viewmostrarreseñaun.php");
    }

    function alta($descripcion){
        $usuario = $_SESSION["usuario"];
        $datos=$this->model->set_reseña($usuario, $descripcion);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewreseña&msg=creado");
        }else{
            header("Refresh:1, url=index.php?msg=creado");
        }

    }


    function del($id){
        $datos=$this->model->del_reseña($id);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewreseña&msg=eliminado");
        }else{
            header("Refresh:1, url=index.php?msg=eliminado");
        }
    }

}
    
?>