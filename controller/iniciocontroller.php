<?php
class inicio_controller{
    function mostrarhome($actividades, $reseñas){
        require_once("views/viewindex.php");
    }
    function mostraradmin(){
        require_once("views/viewindexadmin.php");
    }
    function mostrariniciosesion(){
        require_once("views/viewiniciarsesion.php");
    }
    function mostraralta(){
        require_once("views/viewalta.php");
    }
    function cerrar_sesion(){
        session_destroy();
        header("Refresh:1, url=index.php?home");
    }
    function mostrarabout(){
        require_once("views/viewabout.php");
    }
}
?>