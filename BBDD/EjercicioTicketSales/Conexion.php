<?php
class Connection
{
    private $host = 'localhost';
    private $db   = 'salasdecine';
    private $user = 'root';
    private $pass = "";
    private $charset = 'utf8mb4';
    private $pdo=null;

    /*
     *antonio - > cordoba
     *alumno - > alumno
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