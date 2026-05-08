<?php
class proyecto_model{
    private $db;
    private $proyectos;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->proyectos=array();
    }
    
    public function get_proyectos(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 6;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM proyectos")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "select * from proyectos";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE titulo LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->proyectos[]=$filas;
        }
        return $this->proyectos;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 6;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM proyectos")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }
    public function get_proyectos1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("select * from proyectos where id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->proyectos[]=$filas;
        }
        return $this->proyectos;
    }

    public function get_proyectos2(){
        $id = $_SESSION["usuario"];
        $consulta=$this->db->query("select * from proyectos inner join trabajan on proyectos.id=trabajan.proyecto_id where investigador_id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->proyectos[]=$filas;
        }
        return $this->proyectos;
    }

    public function get_proyectos3(){
        $id = $_SESSION["usuario"];
        $consulta=$this->db->query("select * from proyectos LEFT JOIN trabajan
            ON proyectos.id = trabajan.proyecto_id 
            AND trabajan.investigador_id = $id
        WHERE trabajan.investigador_id IS NULL;");
        while($filas=$consulta->fetch_assoc()){
            $this->proyectos[]=$filas;
        }
        return $this->proyectos;
    }

    public function set_proyectos($titulo, $autor, $justificacion, $ruta){
        $id_inv = $_SESSION["usuario"];
        try{
            $Sentencia="INSERT proyectos (titulo, autor, fecha, justificacion, archivo) ";
            $Sentencia.="VALUES ('$titulo', '$autor', CURRENT_DATE(), '$justificacion', '$ruta');";
            $consulta=$this->db->query($Sentencia);
            $Sentencia="INSERT trabajan (investigador_id, proyecto_id) ";
            $Sentencia.="VALUES ('$id_inv', LAST_INSERT_ID());";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function add_proyectos($id){
        $id_inv = $_SESSION["usuario"];
        try{
            $Sentencia="INSERT trabajan (investigador_id, proyecto_id) ";
            $Sentencia.="VALUES ('$id_inv', '$id')";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_proyecto($id, $titulo, $autor, $justificacion, $ruta){

        try{
            $Sentencia="UPDATE proyectos ";
            $Sentencia.="SET titulo='$titulo', autor='$autor', justificacion='$justificacion', archivo='$ruta' WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }
    public function del_proyecto($id){

        try{
            $Sentencia="DELETE from trabajan ";
            $Sentencia.="WHERE proyecto_id='$id'";
            $consulta=$this->db->query($Sentencia);
            $Sentencia="DELETE from proyectos ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }

}