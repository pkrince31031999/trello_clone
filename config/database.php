<?php
class Database {
    private static $instance = null;
    private $connection;

    private $host = "localhost";
    private $db_name = "trello_clone";
    private $username = "root";
    private $password = "";

    private function __construct() {
        $this->connection = new PDO(
            "mysql:host={$this->host};dbname={$this->db_name}",
            $this->username,
            $this->password
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
