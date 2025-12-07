<?php
class comentario_model{
    private $db;
    private $comentarios;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->comentarios=array();
    }
    
    public function get_comentarios($actividad_id){
        $consulta=$this->db->query("select * from comentarios where actividad_id='$actividad_id'");
        while($filas=$consulta->fetch_assoc()){
            $this->comentarios[]=$filas;
        }
        return $this->comentarios;
    }

    public function set_comentario($usuario_id, $actividad_id, $descripcion, $fecha){
        
        try{
            $Sentencia="INSERT comentarios (usuario_id, actividad_id, descripcion, fecha) ";
            $Sentencia.="VALUES ('$usuario_id', '$actividad_id', '$descripcion', '$fecha')";
            $resultado = mysqli_query($c,$Sentencia);
            
            if($resultado){
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
            header("Refresh:0, url=index.php");
            echo json_encode($response);
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_comentario($descripcion){

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