<?php
class entrada_model{
    private $db;
    private $entradas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->entradas=array();
    }
    
    public function get_entradas(){
        $consulta=$this->db->query("select * from entradas;");
        while($filas=$consulta->fetch_assoc()){
            $this->entradas[]=$filas;
        }
        return $this->entradas;
    }
    public function get_entradas1($fecha_entrada){
        $consulta=$this->db->query("select count(*) as contador from entradas where fch_entrada='$fecha_entrada';");
        while($filas=$consulta->fetch_assoc()){
            $this->entradas[]=$filas;
        }
        return $this->entradas;
    }

    public function set_entradas($id, $tipo, $fecha_entrada, $cantidad, $precio, $total){
        

            $Sentencia="INSERT entradas (usuario_id, tipo, cantidad, precio, total, fch_compra, fch_entrada) ";
            $Sentencia.="VALUES ('$id', '$tipo', '$cantidad', '$precio', '$total', CURRENT_DATE(), '$fecha_entrada')";
            $consulta=$this->db->query($Sentencia);

    }

    public function del_entrada($id){

        try{
            $Sentencia="DELETE from entradas ";
            $Sentencia.="WHERE id='$id'";
            $consulta=$this->db->query($Sentencia);
            
        } catch(Exception $g){
            echo "El Correo Electronico no es válido. Por favor, use otro."; /*E-Mail es Unique y debe tener un @*/
        }
    }

}