<?php
class animal_model{
    private $db;
    private $animales;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->animales=array();
    }
    
    public function get_animales(){
        $consulta=$this->db->query("SELECT especie_id, nombre, nom_cientifico, reproduccion, habitat, esqueleto, alimentacion, lugar_id From animales inner join especies on animales.especie_id = especies.id;");
        while($filas=$consulta->fetch_assoc()){
            $this->animales[]=$filas;
        }
        return $this->animales;
    }

    public function get_animales1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT especie_id, nombre, nom_cientifico, reproduccion, habitat, esqueleto, alimentacion, lugar_id From animales inner join especies on animales.especie_id = especies.id
        WHERE animales.especie_id='$id'");
        while($filas=$consulta->fetch_assoc()){
            $this->animales[]=$filas;
        }
        return $this->animales;
    }

    public function set_animal($nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id){

        try{
            $Sentencia="INSERT especies (nombre, nom_cientifico, reproduccion, habitat, lugar_id) ";
                $Sentencia.="VALUES ('$nombre', '$nombre_cientifico', '$reproduccion', '$habitat', '$lugar_id')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT animales (especie_id, esqueleto, alimentacion) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$esqueleto', '$alimentacion')";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_animal($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id){
        
        try{
           $Sentencia="UPDATE especies ";
                $Sentencia.="SET nombre='$nombre', nom_cientifico='$nombre_cientifico', reproduccion='$reproduccion', habitat='$habitat', lugar_id='$lugar_id' WHERE id='$id'";
                $consulta=$this->db->query($Sentencia);

                $Sentencia="UPDATE animales ";
                $Sentencia.="SET esqueleto='$esqueleto', alimentacion='$alimentacion' WHERE especie_id='$id'";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_animal($id){

        try{
            $Sentencia="DELETE from especies ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}