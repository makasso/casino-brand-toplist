<?php
declare(strict_types=1);
namespace App;

use PDO;
use PDOException;

class Database {
    private $hostname = 'localhost';
    private $database = 'casino_brand_toplist';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    public $connection;

    /*
     * Create a connection instance to access database
     */
    public function connect(): ?PDO {
        if ($this->connection) return $this->connection;

        try {
            $dsn = "mysql:host={$this->hostname};dbname={$this->database};charset={$this->charset}";

            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $this->connection;
        } catch (PDOException $e) {
            die("Database Connection failed: " . $e->getMessage());
        }
    }
}
