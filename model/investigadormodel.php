<?php
class investigador_model{
    private $db;
    private $investigadores;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->investigadores=array();
    }
    
    public function get_investigadores1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT id, nombre, correo, contraseña, especialidad, usuario_id From investigadores inner join usuarios on investigadores.usuario_id = usuarios.id
        WHERE investigadores.usuario_id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->investigadores[]=$filas;
        }
        return $this->investigadores;
    }
    public function get_investigadores(){
        
        $consulta=$this->db->query("SELECT id, nombre, correo, contraseña, especialidad, usuario_id From investigadores inner join usuarios on investigadores.usuario_id = usuarios.id;");
        while($filas=$consulta->fetch_assoc()){
            $this->investigadores[]=$filas;
        }
        return $this->investigadores;
    }

    public function set_investigadores($nombre, $correo, $contraseña, $especialidad){
        try{
            $Sentencia="INSERT usuarios (nombre, correo, contraseña) ";
                $Sentencia.="VALUES ('$nombre', '$correo', '$contraseña')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT investigadores (usuario_id, especialidad) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$especialidad')";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_investigador($id, $nombre, $correo, $contraseña, $especialidad){
        
        try{
           $Sentencia="UPDATE usuarios ";
                $Sentencia.="SET nombre='$nombre', correo='$correo', contraseña='$contraseña' WHERE id='$id'";
                $consulta=$this->db->query($Sentencia);

                $Sentencia="UPDATE investigadores ";
                $Sentencia.="SET especialidad='$especialidad' WHERE usuario_id='$id'";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_investigador($id){

        try{
            $Sentencia="DELETE from trabajan ";
            $Sentencia.="WHERE investigador_id='$id'";
            $Sentencia="DELETE from usuarios ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}