<?php
    session_start();

    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try{
                // CAMBIO 1: Agregar charset=utf8mb4 en la conexión
                $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=bd_globalmjf2;charset=utf8mb4","root","root");
                
                // CAMBIO 2: Configurar atributos PDO para UTF-8MB4
                $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conectar->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");
                
                return $conectar;
            } catch (Exception $e){
                print "¡Error BD! :" . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function set_names(){
            // CAMBIO 3: Cambiar de utf8 a utf8mb4
            return $this->dbh->query("SET NAMES 'utf8mb4'");
        }

		public static function ruta(){
            return "http://localhost:8080/globalmjf/admin/page/";
        }
	
    }
?>