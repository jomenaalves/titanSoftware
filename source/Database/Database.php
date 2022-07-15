<?php 

    namespace Source\Database;
    use PDO;

    class Database extends PDO{

        /**
         * Property responsible for connection in database
        */
        private object $conn; 

        public function __construct(){     
            // Create a new pdo instance
            $this->conn = new PDO("mysql:host=" . HOST_OF_YOUR_DBMS . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
            // Set attributes for the PDO
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
     
        public function getConn():object
        {
            return $this->conn;
        }
    }