<?php

namespace Src\Database;

use mysqli;
use Exception;

class DatabaseConnector {
    private $conn;

    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASSWORD'];
        $db = $_ENV['DB_NAME'];
        $port = $_ENV['DB_PORT'];

        try {
            $this->conn = new mysqli($host, $user, $pass, $db, $port);
            $this->conn->set_charset('utf8');
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    public function getConnection(): mysqli {
        return $this->conn;
    }
}