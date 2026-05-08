<?php


class usuario_model{
    private $db;
    private $usuarios;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->usuarios=array();
    }
    
    public function get_usuarios(){
        $consulta=$this->db->query("select * from usuarios;");
        while($filas=$consulta->fetch_assoc()){
            $this->usuarios[]=$filas;
        }
        return $this->usuarios;
    }

    public function get_usuarios1($correo, $Contraseña){
        $consulta=$this->db->query("SELECT id, nombre FROM usuarios WHERE correo='$correo' and contraseña='$Contraseña' LIMIT 1;");
        while($filas=$consulta->fetch_assoc()){
            $this->usuarios[]=$filas;
        }
        return $this->usuarios;
    }

    public function get_usuarios2(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM usuarios u
        LEFT JOIN trabajadores t ON u.id = t.usuario_id
        LEFT JOIN investigadores i ON u.id = i.usuario_id
        WHERE t.usuario_id IS NULL
        AND i.usuario_id IS NULL")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);
        if($pag > $totalPaginas){
            $pag = $totalPaginas;
        }
        if($pag < 1){
            $pag = 1;
        }
        $sql = "SELECT id, nombre, correo, contraseña, u.imagen FROM usuarios u
        LEFT JOIN trabajadores t ON u.id = t.usuario_id
        LEFT JOIN investigadores i ON u.id = i.usuario_id
        WHERE t.usuario_id IS NULL
        AND i.usuario_id IS NULL ";
        if (!empty($_POST["buscar"])) {
            $buscar = $_POST["buscar"];
            $sql .= " AND nombre LIKE '$buscar%' ";
        }
        $sql .= "LIMIT $inicio, $porPagina;";
        $consulta=$this->db->query($sql);
        
        while($filas=$consulta->fetch_assoc()){
            $this->usuarios[]=$filas;
        }
        return $this->usuarios;
    }

    public function get_total(){
        $pag = $_GET["pag"] ?? 1;
        $porPagina = 5;
        $inicio = ($pag - 1) * $porPagina;
        $totalRegistros = $this->db->query("SELECT COUNT(*) AS total FROM usuarios u
        LEFT JOIN trabajadores t ON u.id = t.usuario_id
        LEFT JOIN investigadores i ON u.id = i.usuario_id
        WHERE t.usuario_id IS NULL
        AND i.usuario_id IS NULL")->fetch_assoc()["total"];
        $totalPaginas = ceil($totalRegistros / $porPagina);

        return $totalPaginas;
    }

    public function get_usuarios3(){
        $id = $_GET["id"];
        $consulta=$this->db->query("SELECT id, nombre, correo, contraseña, imagen FROM usuarios WHERE id='$id' LIMIT 1;");
        while($filas=$consulta->fetch_assoc()){
            $this->usuarios[]=$filas;
        }
        return $this->usuarios;
    }

    public function set_usuario($correo, $nombre, $Contraseña, $ruta){

        
        try{
            $Sentencia="INSERT usuarios (nombre, correo, contraseña, imagen) ";
            $Sentencia.="VALUES ('$nombre', '$correo', '$Contraseña', '$ruta')";
            $consulta=$this->db->query($Sentencia);
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }

    public function mod_usuario($id, $nombre, $correo, $Contraseña, $ruta){
        try{
            $Sentencia="UPDATE usuarios ";
            $Sentencia.="SET nombre='$nombre', correo='$correo', contraseña='$Contraseña', imagen='$ruta' WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }
    public function del_usuario($id){

        try{
            $Sentencia="DELETE from usuarios ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
        } catch(Exception $g){
            echo "Error"; /*E-Mail es Unique y debe tener un @*/
        }
    }
}