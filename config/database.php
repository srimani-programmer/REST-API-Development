<?php
    class Database {

        // Data base Parameters
        private $host = "localhost";
        private $db_name = "company";
        private $username = "root";
        private $password = "";
        private $conn;

        // Database Connection

        public function connect() {
            $this->conn = null;

            try {

                $this->conn = new PDO('mysql:host='. $this->host . ';dbname='. $this->db_name, $this->username, $this->password);
                // Setting the Connection Attribute for the PDO Object To display the Error.
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection Error: ".$e->getMessage();
            }

            return $this->conn;
        }

    }
?>