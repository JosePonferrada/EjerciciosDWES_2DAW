<?php

class Tarea {
    private $id;
    private $nombre;
    private $fecha_inicio;
    private $fecha_fin;
    
    /**
     * 
     * @param type $id
     * @param type $nombre
     * @param type $fecha_inicio
     * @param type $fecha_fin
     */
    public function __construct($id,$nombre,$fecha_inicio,$fecha_fin) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return "Tarea[id=" . $this->id
                . ", nombre=" . $this->nombre
                . ", fecha_inicio=" . $this->fecha_inicio
                . ", fecha_fin=" . $this->fecha_fin
                . "]";
    }
    
    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed {
        return $this->$name;
    }
    
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }
}

?>