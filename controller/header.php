<?php
require_once ('model/trabajadormodel.php');
require_once ('model/investigadormodel.php');

$nav_usuario = 0;

$model = new trabajador_model();
$model1 = new investigador_model();

if(isset($_SESSION["usuario"])){
    if(($_SESSION["usuario"])=="Admin"){
        include("views/navegacionadmin.php"); 
    }else{
        $trabajadores=$model->get_trabajadores();
            foreach($trabajadores as $investigador){
                if($investigador["usuario_id"]==$_SESSION["usuario"]){
                    $nav_usuario = 1;
                }
            }
        $investigadores=$model1->get_investigadores();
            foreach($investigadores as $investigador){
                if($investigador["usuario_id"]==$_SESSION["usuario"]){
                    $nav_usuario = 2;
                }
            }
        
        switch($nav_usuario){
            case 0:
                include("views/navegacioncliente.php");
                break;
            
            case 1:
                include("views/navegaciontrabajador.php");
                break;

            case 2:
                include("views/navegacioninvestigador.php");
                break;
        }
    }
}else{
    include("views/navegacionnoconectado.php");
}
?>