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
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM investigadores")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "SELECT id, nombre, correo, contraseña, especialidad, usuario_id From investigadores inner join usuarios on investigadores.usuario_id = usuarios.id";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " WHERE nombre LIKE '$buscar%'";
        }
        $sql .= " LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->investigadores[]=$filas;
        }
        return $this->investigadores;
    }
    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
         $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM investigadores")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        return $totalPaginas;
    }

    public function set_investigadores($nombre, $correo, $contraseña, $especialidad, $ruta){
        try{
            $Sentencia="INSERT usuarios (nombre, correo, contraseña) ";
                $Sentencia.="VALUES ('$nombre', '$correo', '$contraseña')";
                $consulta=$this->db->query($Sentencia);
                $Sentencia="INSERT investigadores (usuario_id, especialidad, imagen) ";
                $Sentencia.="VALUES (LAST_INSERT_ID(), '$especialidad', '$ruta')";
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