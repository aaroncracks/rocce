<?php
class animal_model{
    private $db;
    private $animales;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->animales=array();
    }

    public function actualizarTemporada($id, $temporada){

        $sql = "UPDATE especies
                SET temporada = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param("ii", $temporada, $id);

        return $stmt->execute();
    }

    public function actualizarlugar($id, $lugar){

        $sql = "UPDATE especies
                SET lugar_id = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param("ii", $lugar, $id);

        return $stmt->execute();
    }
    
    public function get_animales(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 6;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM animales")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "SELECT especie_id, especies.nombre as nombre, nom_cientifico, reproduccion, habitat, esqueleto, alimentacion, lugar_id, animales.imagen, lugares.nombre as lugar, temporada From animales 
        inner join especies on animales.especie_id = especies.id
        inner join lugares on especies.lugar_id = lugares.id";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE especies.nombre LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->animales[]=$filas;
        }
        return $this->animales;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 6;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM animales")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
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

    public function set_animal($nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id, $ruta, $temporada){

        try{
            $Sentencia="INSERT especies (nombre, nom_cientifico, reproduccion, habitat, lugar_id, temporada) ";
                $Sentencia.="VALUES ('$nombre', '$nombre_cientifico', '$reproduccion', '$habitat', '$lugar_id', '$temporada')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT animales (especie_id, esqueleto, alimentacion, imagen) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$esqueleto', '$alimentacion', '$ruta')";
                $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_animal($id, $nombre, $nombre_cientifico, $reproduccion, $habitat, $esqueleto, $alimentacion, $lugar_id, $ruta, $temporada){
        
        try{
           $Sentencia="UPDATE especies ";
                $Sentencia.="SET nombre='$nombre', nom_cientifico='$nombre_cientifico', reproduccion='$reproduccion', habitat='$habitat', lugar_id='$lugar_id', imagen='$ruta', temporada='$temporada' WHERE id='$id'";
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