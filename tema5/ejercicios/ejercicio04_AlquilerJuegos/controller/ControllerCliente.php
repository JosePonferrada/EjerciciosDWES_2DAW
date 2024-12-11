<?php

require_once 'conexion.php';
require_once '../model/cliente.php';

class ControllerCliente {

    /**
     * 
     * @param type $datos
     * @return bool
     */
    public static function insertCliente($datos) {
        // En primer lugar, obtenemos el valor clave del array y
        // le aplicamos el cifrado MD5.
        $clave = md5($datos['pwd']);
        // Indicamos el tipo de cliente.
        $tipo = "cliente";
        // Realizamos la consulta.
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("INSERT INTO cliente VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssss',
                    $datos['user'], $datos['name'], $datos['surname'], $datos['address'], $datos['city'], $clave, $tipo);

            // Ejecutamos.
            if ($stmt->execute()) 
                $filas = $conex->affected_rows;
            $stmt->close();
            $conex->close();
        } catch (Exception $ex) {
            if ($ex->getCode() == 1062) {
                echo("<span style='color:red'>ERROR. EXISTE UN REGISTRO CON EL MISMO DNI.</span>");
            } else {
                echo("ERROR en la BD! " . $ex->getMessage());
            }
            $filas = false;
        }
        return $filas;
    }

    /**
     * 
     * @param Cliente $cliente
     * @param type $clave
     * @return type
     */
    public static function isClienteValid(Cliente $cliente, $clave) {
        // Ciframos la clave introducida.
        $encript = md5($clave);
        // Comparamos las claves del Cliente encontrado y del usuario.
        // Si son iguales, devuelve 0.
        return strcmp($encript, $cliente->clave);
    }

    /**
     * 
     * @param type $id
     * @return mixed
     */
    public static function getClienteById($id) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM cliente WHERE DNI = ?");
            $stmt->bind_param('s', $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $fila = $result->fetch_object();
                $cliente = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo);
            } else {
                $cliente = false;
            }
            $stmt->close();
            $conex->close();
            return $cliente;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }

    /**
     * 
     * @return mixed
     */
    public static function getAll(): mixed {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM cliente");
            if ($result->num_rows) {
                while ($fila = $result->fetch_object()) {
                    $cliente = new Cliente($fila->DNI, $fila->Nombre, $fila->Apellidos, $fila->Direccion, $fila->Localidad, $fila->Clave, $fila->Tipo);
                    $clientes[] = $cliente;
                }
            } else {
                $clientes = false;
            }
            $conex->close();
            return $clientes;
        } catch (Exception $ex) {
            die("ERROR en la BD! " . $ex->getMessage());
        }
    }
}

?>