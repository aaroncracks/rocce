<?php
class Conectar{
    public static function conexion(){
        try{
            $conexion=new mysqli("localhost", "root", "", "parque_nacional");
            $conexion->query("SET NAMES 'utf8'");
            return $conexion;
        }catch(Exception $e){
            die("
                <h2 style='color:red;text-align:center;margin-top:50px'>
                    ❌ Error de conexión con la base de datos
                </h2>
                <p style='text-align:center'>
                    Base de datos '<b>parque nacional</b>' no encontrada.<br>
                    Verifica que exista en MySQL.
                </p>
                <p style='text-align:center;color:gray'>
                    <small>" . $e->getMessage() . "</small>
                </p>
            ");
        }
    }

    public function crearbd(){
        $BD="Parque_nacional";

        $conexion=new mysqli("localhost", "root", "");
        $conexion->query("SET NAMES 'utf8'");
        try{
            mysqli_query($conexion,"CREATE DATABASE IF NOT EXISTS $BD");
            $c = $this->conexion();

            $Sentencia="CREATE TABLE Usuarios (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50) NOT NULL,
            correo VARCHAR(50) UNIQUE NOT NULL,
            contraseña VARCHAR(100) NOT NULL
            );";
            mysqli_query($c,$Sentencia);
            

            $Sentencia="CREATE TABLE Reseñas (
            usuario_id INT PRIMARY KEY,
            descripcion TEXT,
            fecha DATE,
            FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
                ON DELETE CASCADE
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Entradas (
            id INT PRIMARY KEY AUTO_INCREMENT,
            tipo VARCHAR(50) NOT NULL,
            cantidad INT NOT NULL,
            precio DECIMAL(10,2) NOT NULL,
            total DECIMAL(10,2) NOT NULL,
            fch_compra DATE,
            fch_entrada DATE
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="ALTER TABLE Entradas
            ADD usuario_id INT NULL,
            ADD FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
            ON DELETE SET NULL;";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Actividades (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50),
            descripcion TEXT,
            habilitado BOOLEAN
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Comentarios (
            id INT PRIMARY KEY AUTO_INCREMENT,
            usuario_id INT NOT NULL,
            actividad_id INT NOT NULL,
            descripcion TEXT,
            fecha DATE,
            FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
            FOREIGN KEY (actividad_id) REFERENCES Actividades(id)
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Lugares (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50),
            descripcion TEXT
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="ALTER TABLE Actividades
            ADD lugar_id INT NULL,
            ADD FOREIGN KEY (lugar_id) REFERENCES Lugares(id)
            ON DELETE SET NULL;";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Especies (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50),
            nom_cientifico VARCHAR(100),
            reproduccion VARCHAR(100),
            habitat VARCHAR(100)
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Animales (
            especie_id INT PRIMARY KEY,
            esqueleto VARCHAR(50),
            alimentacion VARCHAR(50),
            FOREIGN KEY (especie_id) REFERENCES Especies(id)
                ON DELETE CASCADE
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Plantas (
            especie_id INT PRIMARY KEY,
            ciclo VARCHAR(50),
            tallo VARCHAR(50),
            FOREIGN KEY (especie_id) REFERENCES Especies(id)
                ON DELETE CASCADE
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Minerales (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50),
            formula VARCHAR(100),
            clase VARCHAR(50),
            sistema_cristalino VARCHAR(50),
            habito VARCHAR(100)
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="ALTER TABLE Minerales
            ADD lugar_id INT NULL,
            ADD FOREIGN KEY (lugar_id) REFERENCES Lugares(id)
            ON DELETE SET NULL;";
            mysqli_query($c,$Sentencia);

            $Sentencia="ALTER TABLE Especies
            ADD lugar_id INT NULL,
            ADD FOREIGN KEY (lugar_id) REFERENCES Lugares(id)
            ON DELETE SET NULL;";
            mysqli_query($c,$Sentencia);


            $Sentencia="CREATE TABLE Trabajadores (
            usuario_id INT PRIMARY KEY,
            puesto VARCHAR(50),
            FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
                ON DELETE CASCADE
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Investigadores (
            usuario_id INT PRIMARY KEY,
            especialidad VARCHAR(50),
            FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
                ON DELETE CASCADE
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Proyectos (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titulo VARCHAR(100),
            autor VARCHAR(50),
            fecha DATE,
            justificacion TEXT
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="CREATE TABLE Trabajan (
            investigador_id INT,
            proyecto_id INT,
            PRIMARY KEY (investigador_id, proyecto_id),
            FOREIGN KEY (investigador_id) REFERENCES Investigadores(usuario_id),
            FOREIGN KEY (proyecto_id) REFERENCES Proyectos(id)
            );";
            mysqli_query($c,$Sentencia);

            $Sentencia="INSERT usuarios (nombre, correo, contraseña) ";
            $Sentencia.="VALUES ('Admin', 'adminparque@gmail.com', '1234')";
            mysqli_query($c,$Sentencia);

            $Sentencia="ALTER TABLE Animales ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Plantas ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Lugares ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Usuarios ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Investigadores ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Trabajadores ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Actividades ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Minerales ADD imagen VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            $Sentencia="ALTER TABLE Proyectos ADD archivo VARCHAR(255);";
            mysqli_query($c,$Sentencia);
            echo "<h2 style='color:red;text-align:center;margin-top:50px'>
                     BASE DE DATOS CREADA CON EXITO
                </h2>";

        }catch(Exception $e){
            die("
                <h2 style='color:green;text-align:center;margin-top:50px'>
                    ❌ Error de conexión con la base de datos
                </h2>
                <p style='text-align:center'>
                    Base de datos '<b>parque nacional</b>' ya esta creada.<br>
                    Verifica que no exista en MySQL.
                </p>
                <p style='text-align:center;color:gray'>
                    <small>" . $e->getMessage() . "</small>
                </p>
            ");
        }
        
        
    }

    public function eliminarbd(){
        $BD="Parque_nacional";
        $c = $this->conexion();

        try{
            $Sentencia="DROP DATABASE $BD";
                if($t=mysqli_query($c,$Sentencia))
                   echo "<h2 style='color:red;text-align:center;margin-top:50px'>
                     BASE DE DATOS ELIMINADA CON EXITO
                </h2>";
        }catch(Exception $f){
            echo "No es borrable porque no existe aun"; /*No existe la BD*/
        }
    }
}

?>