<?php

class Realiza {
    private $email;
    private $id_tarea;
    private $horas;

    /**
     * 
     * @param type $email
     * @param type $id_tarea
     * @param type $horas
     */
    public function __construct($email, $id_tarea, $horas) {
        $this->email = $email;
        $this->id_tarea = $id_tarea;
        $this->horas = $horas;
    }

    /**
     * 
     * @return string
     */
    public function __toString(): string {
        return "Realiza[email=" . $this->email
                . ", id_tarea=" . $this->id_tarea
                . ", horas=" . $this->horas
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