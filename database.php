<?php

class Database {
    //database attributes
    private $host = 'localhost';
    private $dbname = 'blog_db';
    private $username = 'root';
    private $password = 'root';
    private $conn;
//making a connect function that make connection with my database on the dbm engine
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
