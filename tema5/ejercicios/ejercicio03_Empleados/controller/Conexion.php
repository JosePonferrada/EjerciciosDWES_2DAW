<?php

class Conexion extends mysqli {
    private $host = "localhost";
    private $user = "dwes";
    private $pass = "abc123.";
    private $db = "tareas_mvc";
    
    public function __construct() {
        parent::__construct($this->host, $this->user, $this->pass, $this->db);
    }
    
    public function __get(string $name): mixed {
        return $this->name;
    }
    
    public function __set(string $name, mixed $value): void {
        $this->name = $value;
    }
    
}

?>