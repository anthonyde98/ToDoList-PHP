<?php

    require "connection.php";

    class Usuario{
        private $connection = null;

        function __construct()
        {   
            $connection = new Connection();
            $this->connection = $connection->conectar();
        }

        private function error(){
            echo "<h4 style='position: fixed; top: 10px; right: 10px; width: fit-content' class='card p-4 rounded shadow text-danger'>Hubo un error inesperado.</h4>";
        }

        public function registrar($correo, $contrasena){  
            try {
                $hash = password_hash($contrasena, PASSWORD_DEFAULT);

                $sentencia = $this->connection->prepare('INSERT INTO `usuario` (correo, contrasena) VALUES (?, ?)');
                $sentencia->bindParam(1, $correo, PDO::PARAM_STR);
                $sentencia->bindParam(2, $hash, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $this->connection->lastInsertId();
                $this->connection = null;
                return $resultado;
            } catch (PDOException $e) {
                if($e->errorInfo[1] == 1062){
                    return -1;
                }
                else{
                    $this->error();
                }
                return -3;
            }
        }

        public function iniciarSesion($correo, $contrasena){  
            try {
                $sentencia = $this->connection->prepare('SELECT id, contrasena FROM `usuario` WHERE correo = ?');
                $sentencia->bindParam(1, $correo, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = ($sentencia->fetch(PDO::FETCH_ASSOC));
                $this->connection = null;

                if(!$resultado){
                    return -1;
                }
                
                if(password_verify($contrasena, $resultado['contrasena'])){
                    return $resultado['id'];
                }
                else{
                    return -2;
                }
            } catch (PDOException $e) {
                return -3;
                $this->error();
            }
        }
        
        public function cerrarSesion(){  
            session_start();
            session_destroy();
            if($_COOKIE['usuario']){
                header("Location: ../login.php?cookies=reset_cookie");
                die();
            }
            else{
                header("Location: ../login.php");
                die();
            }
        }
    }

?>