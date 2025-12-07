<?php
class planta_model{
    private $db;
    private $plantas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->plantas=array();
    }
    
    public function get_plantas1(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT id, nombre, nom_cientifico, reproduccion, habitat, ciclo, tallo, lugar_id From plantas inner join especies on plantas.especie_id = especies.id
        WHERE plantas.especie_id='$id';");
        while($filas=$consulta->fetch_assoc()){
            $this->plantas[]=$filas;
        }
        return $this->plantas;
    }
    public function get_plantas(){
        
        $consulta=$this->db->query("SELECT id, nombre, nom_cientifico, reproduccion, habitat, ciclo, tallo, lugar_id From plantas inner join especies on plantas.especie_id = especies.id;");
        while($filas=$consulta->fetch_assoc()){
            $this->plantas[]=$filas;
        }
        return $this->plantas;
    }

    public function set_planta($nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo, $lugar_id){

        try{
            $Sentencia="INSERT especies (nombre, nom_cientifico, reproduccion, habitat, lugar_id) ";
                $Sentencia.="VALUES ('$nombre', '$nombre_cientifico', '$reproduccion', '$habitat', '$lugar_id')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT plantas (especie_id, ciclo, tallo) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$ciclo', '$tallo')";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_planta($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $ciclo, $tallo){
        
        try{
           $Sentencia="UPDATE especies ";
                $Sentencia.="SET nombre='$nombre', nom_cientifico='$nombre_cientifico', reproduccion='$reproduccion', habitat='$habitat' WHERE id='$id'";
                $consulta=$this->db->query($Sentencia);

                $Sentencia="UPDATE plantas ";
                $Sentencia.="SET ciclo='$ciclo', tallo='$tallo' WHERE especie_id='$id'";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function del_planta($id){

        try{
            $Sentencia="DELETE from especies ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}