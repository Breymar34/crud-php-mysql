<?php
class Crud{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "threewmadone";
    private $conn; // MySQLi connection object

    public function __construct()
    {
        // Open db connection
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully";
    }

    public function __destruct()
    {
        // Close db connection
        if ($this->conn) {
            $this->conn->close();
            echo "Connection closed";
        }
    }
}

$crud = new Crud();
