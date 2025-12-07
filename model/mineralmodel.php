<?php
class mineral_model{
    private $db;
    private $minerales;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->minerales=array();
    }
    
    public function get_minerales(){
        $consulta=$this->db->query("select * from minerales;");
        while($filas=$consulta->fetch_assoc()){
            $this->minerales[]=$filas;
        }
        return $this->minerales;
    }

    public function get_minerales1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("select * from minerales where id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->minerales[]=$filas;
        }
        return $this->minerales;
    }

    public function set_mineral($nombre, $formula, $clase, $sistema_cristalino, $habito, $lugar_id){
        
        try{
            $Sentencia="INSERT minerales (nombre, formula, clase, sistema_cristalino, habito, lugar_id) ";
            $Sentencia.="VALUES ('$nombre', '$formula', '$clase', '$sistema_cristalino', '$habito', '$lugar_id')";
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