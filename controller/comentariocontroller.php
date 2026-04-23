<?php
require_once ('model/comentariomodel.php');

class comentario_controller {

    function mostrardatosact(){
        $model = new comentario_model();
        $comentarios=$model->get_comentarios2();

        // devolver HTML actualizado
        return $comentarios;
    }

    function mostrarcomentario(){
        $model = new comentario_model();
        $total=$model->get_total();
        $datos=$model->get_comentarios();

        //Llamada a la vista
        require_once("views/viewmostrarcomentario.php");

    }

    public function crear($texto, $actividad_id) {

        $usuario_id = $_SESSION["usuario"];

        $model = new comentario_model();
        $model->set_comentario($usuario_id, $actividad_id, $texto);

        require_once("views/viewmostraractividadclient.php");
    }

    public function del_comentario($id){

        try{
            $Sentencia="DELETE from comentarios ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }
}

?>