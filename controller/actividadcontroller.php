<?php
require_once ('model/actividadmodel.php');
require_once('controller/lugarcontroller.php');
require_once('controller/comentariocontroller.php');

class actividad_controller{
    
    private $model;

    public function __construct() {
        $this->model = new actividad_model();
        $this->controller = new lugar_controller();
        $this->coment = new comentario_controller();
    }

    function mostraractividadclient(){
        $datos=$this->model->get_actividades();

        
        
        //Llamada a la vista
        require_once("views/viewmostraractividadclient.php");

    }

    function mostraractividad(){
        $total=$this->model->get_total();
        $datos=$this->model->get_actividades();

        
        
        //Llamada a la vista
        require_once("views/viewmostraractividad.php");

    }

    function mostraraltaactividad(){
        $datos = $this->controller->mostrardatos();
        require_once("views/viewaltaactividades.php");
    }

    function mostrarmodactividad(){
        $datos = $this->controller->mostrardatos();
        $actividades = $this->model->get_actividades1();
        require_once("views/viewmodactividad.php");
    }

    function mostrarunactividad(){
        $id = $_GET["id"];
        $comentarios = $this->coment->mostrardatosact();
        $datos = $this->model->get_actividades1();
        require_once("views/viewmostraractividadun.php");
    }

    function alta($nombre, $descripcion, $habilitado, $lugar_id){
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $ruta = "img/" . $nombreImagen;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

        } else {
            $ruta = null;
        }

        $datos=$this->model->set_actividad($nombre, $descripcion, $habilitado, $lugar_id, $ruta);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewactividad&msg=creado");

    }

    function mod($id, $nombre, $descripcion, $habilitado, $lugar_id){
        $datos=$this->model->mod_actividad($id, $nombre, $descripcion, $habilitado, $lugar_id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewactividad&msg=modificado");

    }

    function del($id){
        $datos=$this->model->del_actividad($id);
        
        //Llamada a la vista
        header("Refresh:1, url=index.php?accion=viewactividad&msg=eliminado");

    }

}
    
?>