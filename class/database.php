<?php
    class dbConnection {

        protected $db_conn;
        public $db_name = 'merkadu';
        public $db_user = 'root';
        public $db_pass = 'rexadrivan';
        public $db_host = 'localhost';

        function connect(){
            try{
                $this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;",$this->db_user,$this->db_pass);
                $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->db_conn;
                $this->conn = null;
            }catch(PDOException $e){
                die('failed to connect to database');
            }
        }
    }

?>