<?php
    session_start();

    class Conectar {
        protected $dbh;

        protected function Conexion() {
            try {
                // Cambiado "mysql:local" (incorrecto) por "mysql:host"
                $this->dbh = new PDO("mysql:host=localhost;dbname=bd_globalmjf2", "root", "root", [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]);
                // Aseguramos que la conexión use utf8mb4 para emojis
                $this->dbh->exec("SET NAMES 'utf8mb4'");
                return $this->dbh;
            } catch (Exception $e) {
                print "¡Error BD! :" . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function set_names() {
            // Ya no es necesario si usas PDO::MYSQL_ATTR_INIT_COMMAND
            return $this->dbh->query("SET NAMES 'utf8mb4'");
        }

        public static function ruta() {
            return "http://localhost:8080/globalmjf/admin/page/";
        }
    }
