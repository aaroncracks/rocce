<?php
class lugar_model{
    private $db;
    private $lugares;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->lugares=array();
    }
    
    public function get_lugares(){
        $consulta=$this->db->query("select * from lugares;");
        while($filas=$consulta->fetch_assoc()){
            $this->lugares[]=$filas;
        }
        return $this->lugares;
    }
    public function get_lugares1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("select * from lugares where id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->lugares[]=$filas;
        }
        return $this->lugares;
    }

    public function set_lugares($nombre, $descripcion){
        
        try{
            $Sentencia="INSERT lugares (nombre, descripcion) ";
            $Sentencia.="VALUES ('$nombre', '$descripcion')";
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