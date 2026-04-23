<?php
class mineral_model{
    private $db;
    private $minerales;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->minerales=array();
    }
    
    public function get_minerales(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM minerales")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql="select * from minerales ";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE nombre LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->minerales[]=$filas;
        }
        return $this->minerales;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM minerales")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }

    public function get_minerales1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("select * from minerales where id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->minerales[]=$filas;
        }
        return $this->minerales;
    }

    public function set_mineral($nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id, $ruta){
        
        try{
            $Sentencia="INSERT minerales (nombre, formula, clase, sistema_cristalino, habito, lugar_id, imagen) ";
            $Sentencia.="VALUES ('$nombre', '$formula', '$clase', '$sistema_cristalino', '$habito', '$lugar_id', '$ruta')";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_mineral($id, $nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id){

        try{
            $Sentencia="UPDATE minerales ";
            $Sentencia.="SET nombre='$nombre', formula='$formula', clase='$clase', sistema_cristalino='$sistema_cristalino', habito='$habito', lugar_id='$lugar_id' WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_mineral($id){

        try{
            $Sentencia="DELETE from minerales ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}