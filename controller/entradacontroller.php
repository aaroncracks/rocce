<?php
require_once ('model/entradamodel.php');

class entrada_controller{
    
    private $model;

    public function __construct() {
        $this->model = new entrada_model();
    }

    function mostrardatos(){
        $datos=$this->model->get_entradas();
        return $datos;
    }
    function mostrarentrada(){
        $datos=$this->model->get_entradas();

        //Llamada a la vista
        require_once("views/viewmostrarentrada.php");
    }


    function alta($id, $tipo, $fecha_entrada, $cantidad, $precio, $total){
        $count=$this->model->get_entradas1($fecha_entrada);
        foreach($count as $c){
            $contador=$c["contador"]+$cantidad;
            if($contador>50){
                header("Refresh:1, url=index.php?accion=viewentrada&msg=error");
            }
        }

        $datos=$this->model->set_entradas($id, $tipo, $fecha_entrada, $cantidad, $precio, $total);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewentrada&msg=creado");

    }

    function mostraraltaentrada(){
        require_once("views/viewaltaentradas.php");
    }

    function del($id){
        $datos=$this->model->del_entrada($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewentrada&msg=eliminado");

    }
}
?>