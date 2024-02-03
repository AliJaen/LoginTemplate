<?php

class DatabaseConnection {
    private $host = "localhost";
    private $username = "root";
    private $password = "mYp@ssW0rd";
    private $database = "mewcode";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
