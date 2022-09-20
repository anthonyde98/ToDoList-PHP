<?php

    require "connection.php";

    class Tarea{
        private $connection = null;

        function __construct()
        {   $connection = new Connection();
            $this->connection = $connection->conectar();
        }

        private function error(){
            echo "<h4 style='position: fixed; top: 10px; right: 10px; width: fit-content' class='card p-4 rounded shadow text-danger'>Hubo un error inesperado.</h4>";
        }

        public function insertarTarea($nombre, $descripcion, $fecha){
            try {
                $sentencia = $this->connection->prepare('INSERT INTO `todo` (nombre, descripcion, fecha, usuario) VALUES (?, ?, ?, ?)');
                $sentencia->bindParam(1, $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(2, $descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
                $sentencia->bindParam(4, $_SESSION['usuario'], PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $this->connection = null;
                return $resultado;
            } catch (PDOException $e) {
                $this->error();
            }
        }

        public function buscarTareas(){
            try {
                $sentencia = $this->connection->prepare('SELECT * FROM `todo` WHERE usuario = ? ORDER BY `fecha` ASC');
                $sentencia->bindParam(1, $_SESSION['usuario'], PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                $this->connection = null;
                return $resultado;
            } catch (PDOException $e) {
                $this->error();
            }
        }

        public function buscarTareasConFiltro($busqueda){
            try {
                $sentencia = $this->connection->prepare('SELECT * FROM `todo` WHERE usuario = ? AND (nombre LIKE ? OR descripcion LIKE ?) ORDER BY `fecha` ASC');
                $sentencia->bindParam(1, $_SESSION['usuario'], PDO::PARAM_STR);
                $sentencia->bindParam(2, $busqueda, PDO::PARAM_STR);
                $sentencia->bindParam(3, $busqueda, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                $this->connection = null;
                return $resultado;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        public function buscarTarea($id){  
            try {
                $sentencia = $this->connection->prepare('SELECT * FROM `todo` WHERE id = ? AND usuario = ?');
                $sentencia->bindParam(1, $id, PDO::PARAM_INT);
                $sentencia->bindParam(2, $_SESSION['usuario'], PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $this->connection = null;
                return $resultado;
            } catch (PDOException $e) {
                $this->error();
            }
        }

        public function editarTarea($id, $nombre, $descripcion, $fecha, $estado){  
            try {
                $sentencia = $this->connection->prepare('UPDATE `todo` SET nombre = ?, descripcion = ?, fecha = ?, estado = ? WHERE id = ? AND USUARIO = ?');
                $sentencia->bindParam(1, $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(2, $descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(3, $fecha, PDO::PARAM_STR);
                $sentencia->bindParam(4, $estado, PDO::PARAM_STR);
                $sentencia->bindParam(5, $id, PDO::PARAM_INT);
                $sentencia->bindParam(6, $_SESSION['usuario'], PDO::PARAM_STR);
                return $sentencia->execute();
                $this->connection = null;
            } catch (PDOException $e) {
                $this->error();
                return -3;
            }
        }

        public function eliminarTarea($id){  
            try {
                $sentencia = $this->connection->prepare('DELETE FROM `todo` WHERE id = ? AND usuario = ?');
                $sentencia->bindParam(1, $id, PDO::PARAM_INT);
                $sentencia->bindParam(2, $_SESSION['usuario'], PDO::PARAM_STR);
                $sentencia->execute();
                $this->connection = null;
            } catch (PDOException $e) {
                $this->error();
            }
        }
    }

?>