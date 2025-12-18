<?php
class Connection
{
    private $host = 'localhost';
    private $db   = 'messenger';
    private $user = 'root';
    private $pass = "";
    private $charset = 'utf8mb4';
    private $pdo=null;

    /*
     * Conexión a remoto:
     * private $host = 'iestrassierra.net';
     * private $db   = 'daw2526a13';
     * private $user = 'daw2526a13';
     * private $pass = "pBYiwY!7";
     * private $charset = 'utf8mb4';
     * private $pdo=null;
    */
    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public function getPdo():?PDO {
        return $this->pdo;
    }
}