<?php
class trabajador_model{
    private $db;
    private $trabajadores;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->trabajadores=array();
    }
    
    public function get_trabajadores1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT id, nombre, correo, contraseña, puesto, usuario_id From trabajadores inner join usuarios on trabajadores.usuario_id = usuarios.id
        WHERE trabajadores.usuario_id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->trabajadores[]=$filas;
        }
        return $this->trabajadores;
    }
    public function get_trabajadores(){
        $consulta=$this->db->query("SELECT id, nombre, correo, contraseña, puesto, usuario_id From trabajadores inner join usuarios on trabajadores.usuario_id = usuarios.id;");
        while($filas=$consulta->fetch_assoc()){
            $this->trabajadores[]=$filas;
        }
        return $this->trabajadores;
    }

    public function set_trabajadores($nombre, $correo, $contraseña, $puesto){
        try{
            $Sentencia="INSERT usuarios (nombre, correo, contraseña) ";
                $Sentencia.="VALUES ('$nombre', '$correo', '$contraseña')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT trabajadores (usuario_id, puesto) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$puesto')";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_trabajador($id, $nombre, $correo, $contraseña, $puesto){
        
        try{
           $Sentencia="UPDATE usuarios ";
                $Sentencia.="SET nombre='$nombre', correo='$correo', contraseña='$contraseña' WHERE id='$id'";
                $consulta=$this->db->query($Sentencia);

                $Sentencia="UPDATE trabajadores ";
                $Sentencia.="SET puesto='$puesto' WHERE usuario_id='$id'";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_trabajador($id){

        try{
            $Sentencia="DELETE from usuarios ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}