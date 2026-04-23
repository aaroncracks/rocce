<?php
class entrada_model{
    private $db;
    private $entradas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->entradas=array();
    }
    
    public function get_entradas(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM entradas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "select * from entradas";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE fch_entrada = '$buscar'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->entradas[]=$filas;
        }
        return $this->entradas;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM entradas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }
    public function get_total1(){
        $usuario = $_SESSION["usuario"];
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM entradas where usuario_id='$usuario'")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }
    public function get_entradas1($fecha_entrada){
        $consulta=$this->db->query("select count(*) as contador from entradas where fch_entrada='$fecha_entrada';");
        while($filas=$consulta->fetch_assoc()){
            $this->entradas[]=$filas;
        }
        return $this->entradas;
    }
    public function get_entradas2(){
        $usuario = $_SESSION["usuario"];
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM entradas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "select * from entradas where usuario_id='$usuario'";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " AND fch_entrada = '$buscar'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->entradas[]=$filas;
        }
        return $this->entradas;
    }

    public function set_entradas($id, $tipo, $fecha_entrada, $cantidad, $precio, $total){
        

            $Sentencia="INSERT entradas (usuario_id, tipo, cantidad, precio, total, fch_compra, fch_entrada) ";
            $Sentencia.="VALUES ('$id', '$tipo', '$cantidad', '$precio', '$total', CURRENT_DATE(), '$fecha_entrada')";
            $consulta=$this->db->query($Sentencia);

    }

    public function del_entrada($id){

        try{
            $Sentencia="DELETE from entradas ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}