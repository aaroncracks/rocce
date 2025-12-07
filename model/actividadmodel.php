<?php
class actividad_model{
    private $db;
    private $actividades;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->actividades=array();
    }
    
    public function get_actividades(){
        $consulta=$this->db->query("SELECT actividades.id, actividades.nombre, actividades.descripcion, habilitado, lugares.nombre as nom_lugar From actividades left join lugares on actividades.lugar_id=lugares.id");
        while($filas=$consulta->fetch_assoc()){
            $this->actividades[]=$filas;
        }
        return $this->actividades;
    }

    public function get_actividades1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT actividades.id, actividades.nombre, actividades.descripcion, habilitado, lugares.nombre as nom_lugar From actividades left join lugares on actividades.lugar_id=lugares.id 
        WHERE actividades.id='$id'");
        while($filas=$consulta->fetch_assoc()){
            $this->actividades[]=$filas;
        }
        return $this->actividades;
    }

    public function set_actividad($nombre, $descripcion, $habilitado, $lugar_id){
        
        try{
            $Sentencia="INSERT actividades (nombre, descripcion, habilitado, lugar_id) ";
            $Sentencia.="VALUES ('$nombre', '$descripcion', $habilitado, '$lugar_id')";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_actividad($id, $nombre, $descripcion, $habilitado, $lugar_id){

        try{
            $Sentencia="UPDATE actividades ";
            $Sentencia.="SET nombre='$nombre', descripcion='$descripcion', habilitado=$habilitado, lugar_id='$lugar_id' WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_actividad($id){

        try{
            $Sentencia="DELETE from actividades ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}