<?php
class reseña_model{
    private $db;
    private $reseñas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->reseñas=array();
    }
    
    public function get_reseñas(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM reseñas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "SELECT * from reseñas inner join usuarios on reseñas.usuario_id=usuarios.id";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE descripcion LIKE '$buscar%' ";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->reseñas[]=$filas;
        }
        return $this->reseñas;
    }

    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM reseñas")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }

    public function get_reseñas1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT * from reseñas 
        WHERE usuario_id='$id'");
        while($filas=$consulta->fetch_assoc()){
            $this->reseñas[]=$filas;
        }
        return $this->reseñas;
    }

    public function set_reseña($usuario, $descripcion){
        
        try{
            $Sentencia="INSERT reseñas (usuario_id, descripcion, fecha) ";
            $Sentencia.="VALUES ('$usuario', '$descripcion', CURRENT_DATE())";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
        if($consulta){
                $response = array(
                    'status' => 'success',
                    'message' => 'Se envio el comentario'
                );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'No se envio el comentario'
                );
            }
            echo json_encode($response);
    }

    public function mod_reseña($usuario, $descripcion){

        try{
            $Sentencia="UPDATE reseñas ";
            $Sentencia.="SET descripcion='$descripcion' WHERE usuario_id='$usuario'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_reseña($id){

        try{
            $Sentencia="DELETE from reseñas ";
            $Sentencia.="WHERE usuario_id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}