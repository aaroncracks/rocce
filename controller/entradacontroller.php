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
        $total=$this->model->get_total();
        $datos=$this->model->get_entradas();

        //Llamada a la vista
        require_once("views/viewmostrarentrada.php");
    }

    function mostrarentradaclient(){
        $total=$this->model->get_total1();
        $datos=$this->model->get_entradas2();

        //Llamada a la vista
        require_once("views/viewmostrarentrada.php");
    }

    function alta($id, $tipo, $fecha_entrada, $cantidad, $precio, $total){
        $alta = true;
        $con = 0;
        $count=$this->model->get_entradas1($fecha_entrada);
        foreach($count as $c){
            $contador=$c["contador"]+$cantidad;
            if($contador>50){
                $true = false;
            }
        }

        $fecha_actual = strtotime(date("Y-m-d H:i:s"));
        $fecha_nacimiento = strtotime($fecha_entrada);

        if($fecha_actual > $fecha_nacimiento){
            $alta = false;
            $con = 1;
        }

        if($alta){
            $datos=$this->model->set_entradas($id, $tipo, $fecha_entrada, $cantidad, $precio, $total);
            
            //Llamada a la vista
            if($_SESSION["usuario"]=="Admin"){
                header("Refresh:1, url=index.php?accion=viewentrada&msg=creado");
            }else{
                header("Refresh:1, url=index.php?msg=creado");
            }
        }else{
            if($con = 0){
                header("Refresh:1, url=index.php?accion=viewaltaentrada&msg=error");
            }else{
                header("Refresh:1, url=index.php?accion=viewaltaentrada&msg=error1");
            }
        }

        
        

    }

    function mostraraltaentrada(){
        require_once("views/viewaltaentradas.php");
    }

    function del($id){
        $datos=$this->model->del_entrada($id);
        
        //Llamada a la vista
        if($_SESSION["usuario"]=="Admin"){
            header("Refresh:1, url=index.php?accion=viewentrada&msg=eliminado");
        }else{
            header("Refresh:1, url=index.php?msg=eliminado");
        }

    }
}
?>