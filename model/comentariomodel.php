<?php
class comentario_model{
    private $db;
    private $comentarios;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->comentarios=array();
    }

    public function get_comentarios(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM comentarios")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "select * from comentarios";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE descripcion like '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->comentarios[]=$filas;
        }
        return $this->comentarios;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM comentarios")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }
    
    public function get_comentarios1(){
        $id = $_SESSION["usuario"];
        $consulta=$this->db->query("select * from comentarios where usuario_id='$id'");
        while($filas=$consulta->fetch_assoc()){
            $this->comentarios[]=$filas;
        }
        return $this->comentarios;
    }

    public function get_comentarios2(){
        $id = $_GET["id"];
        $consulta=$this->db->query("select comentarios.id, nombre, descripcion, fecha from comentarios inner join usuarios on comentarios.usuario_id=usuarios.id where actividad_id='$id'");
        while($filas=$consulta->fetch_assoc()){
            $this->comentarios[]=$filas;
        }
        return $this->comentarios;
    }

    public function set_comentario($usuario_id, $actividad_id, $descripcion){
        
        try{
            $Sentencia="INSERT comentarios (usuario_id, actividad_id, descripcion, fecha) ";
            $Sentencia.="VALUES ('$usuario_id', '$actividad_id', '$descripcion', CURRENT_DATE());";
            $consulta=$this->db->query($Sentencia);
            
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
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_comentario($descripcion){

        try{
            $Sentencia="UPDATE comentarios ";
            $Sentencia.="SET descripcion='$descripcion' WHERE id='$id'";
            mysqli_query($c,$Sentencia);
            echo "Dado de alta exitosamente";
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}