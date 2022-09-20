<?php
    class Connection{
        private $connection = null;
        private $usuario = "root";
        private $contrasena = "K.7@a9]xs[PP*[Uc";
        private $db = "todo_list";
        private $host = "localhost";

        private function error(){
            echo "<h4 style='position: fixed; top: 10px; right: 10px; width: fit-content' class='card p-4 rounded shadow text-danger'>Hubo un error inesperado.</h4>";
        }

        public function conectar(){
            try {
                $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->usuario, $this->contrasena);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->exec("SET CHARACTER SET utf8");
            } catch (PDOException $e) {
                $this->error();
                die();
            }

            return $this->connection;
        }
    }
?>