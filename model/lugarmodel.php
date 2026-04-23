<?php
class lugar_model{
    private $db;
    private $lugares;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->lugares=array();
    }
    
    public function get_lugares(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM lugares")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "select * from lugares";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE nombre LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lugares[]=$filas;
        }
        return $this->lugares;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM lugares")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }
    public function get_lugares1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("select * from lugares where id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->lugares[]=$filas;
        }
        return $this->lugares;
    }

    public function set_lugares($nombre, $descripcion, $ruta){
        
        try{
            $Sentencia="INSERT lugares (nombre, descripcion) ";
            $Sentencia.="VALUES ('$nombre', '$descripcion', '$ruta')";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_lugar($id, $nombre, $descripcion){

        try{
            $Sentencia="UPDATE lugares ";
            $Sentencia.="SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }
    public function del_lugar($id){

        try{
            $Sentencia="DELETE from lugares ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}