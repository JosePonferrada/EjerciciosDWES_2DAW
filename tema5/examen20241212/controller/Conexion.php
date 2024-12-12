<?php

class Conexion extends PDO {
    private $dsn = "mysql:host=localhost;dbname=trenes;charset=utf8mb4";
    private $user = "dwes";
    private $pass = "abc123.";
    
    public function __construct() {
        parent::__construct($this->dsn, $this->user, $this->pass);
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
}

?>