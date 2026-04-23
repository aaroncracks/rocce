<?php
class actividad_model{
    private $db;
    private $actividades;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->actividades=array();
    }
    
    public function get_actividades(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM actividades")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "SELECT actividades.id, actividades.nombre, actividades.descripcion, habilitado, lugares.nombre as nom_lugar From actividades left join lugares on actividades.lugar_id=lugares.id";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE actividades.nombre LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->actividades[]=$filas;
        }
        return $this->actividades;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM actividades")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }

    public function get_actividades1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT actividades.id, actividades.nombre, actividades.descripcion, habilitado, lugares.nombre as nom_lugar From actividades left join lugares on actividades.lugar_id=lugares.id 
        WHERE actividades.id='$id'");
        while($filas=$consulta->fetch_assoc()){
            $this->actividades[]=$filas;
        }
        return $this->actividades;
    }

    public function set_actividad($nombre, $descripcion, $habilitado, $lugar_id, $ruta){
        
        try{
            $Sentencia="INSERT actividades (nombre, descripcion, habilitado, lugar_id, imagen) ";
            $Sentencia.="VALUES ('$nombre', '$descripcion', $habilitado, '$lugar_id', '$ruta')";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_actividad($id, $nombre, $descripcion, $habilitado, $lugar_id){

        try{
            $Sentencia="UPDATE actividades ";
            $Sentencia.="SET nombre='$nombre', descripcion='$descripcion', habilitado=$habilitado, lugar_id='$lugar_id' WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_actividad($id){

        try{
            $Sentencia="DELETE from comentarios ";
            $Sentencia.="WHERE actividad_id='$id'";
            $consulta=$this->db->query($Sentencia);
            $Sentencia="DELETE from actividades ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}