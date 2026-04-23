<?php
class planta_model{
    private $db;
    private $plantas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->plantas=array();
    }
    
    public function get_plantas1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT id, nombre, nom_cientifico, reproduccion, habitat, ciclo, tallo, lugar_id From plantas inner join especies on plantas.especie_id = especies.id
        WHERE plantas.especie_id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->plantas[]=$filas;
        }
        return $this->plantas;
    }
    public function get_plantas(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM plantas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "SELECT id, nombre, nom_cientifico, reproduccion, habitat, ciclo, tallo, lugar_id From plantas inner join especies on
         plantas.especie_id = especies.id";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE nombre LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->plantas[]=$filas;
        }
        return $this->plantas;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM plantas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }

    public function set_planta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id, $ruta){

        try{
            $Sentencia="INSERT especies (nombre, nom_cientifico, reproduccion, habitat, lugar_id, imagen) ";
                $Sentencia.="VALUES ('$nombre', '$nombre_cientifico', '$reproduccion', '$habitat', '$lugar_id', '$ruta')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT plantas (especie_id, ciclo, tallo) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$ciclo', '$tallo')";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_planta($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo){
        
        try{
           $Sentencia="UPDATE especies ";
                $Sentencia.="SET nombre='$nombre', nom_cientifico='$nombre_cientifico', reproduccion='$reproduccion', habitat='$habitat' WHERE id='$id'";
                $consulta=$this->db->query($Sentencia);

                $Sentencia="UPDATE plantas ";
                $Sentencia.="SET ciclo='$ciclo', tallo='$tallo' WHERE especie_id='$id'";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_planta($id){

        try{
            $Sentencia="DELETE from especies ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}