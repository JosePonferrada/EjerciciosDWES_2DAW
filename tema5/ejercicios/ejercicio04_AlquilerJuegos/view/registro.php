<?php
// Importaciones.
require_once '../model/cliente.php';
require_once '../controller/controllerCliente.php';

// Propago la sesión si existe la cookie PHPSESSID.
if (isset($_COOKIE['PHPSESSID']))
    session_start();

// Si existe una sesión Logueado, redirigimos a inicio.php
if (isset($_SESSION['logueado'])) {
    header("Location:inicio.php");
    exit();
}

// Si pulsamos sobre Crear cuenta.
if (isset($_POST['register'])) {
    // Si todos los campos de texto NO ESTÁN vacíos, creamos cuenta.
    if (!empty($_POST['user']) && !empty($_POST['name']) 
            && !empty($_POST['surname']) && !empty($_POST['address']) 
            && !empty($_POST['city']) && !empty($_POST['pwd'])) {
        
        // Guardamos los datos en un array para proceder a insertar el
        // nuevo cliente.
        $datos['user'] = $_POST['user'];
        $datos['name'] = $_POST['name'];
        $datos['surname'] = $_POST['surname'];
        $datos['address'] = $_POST['address'];
        $datos['city'] = $_POST['city'];
        $datos['pwd'] = $_POST['pwd'];
        
        // Procedemos a insertar el nuevo Cliente.
        if (ControllerCliente::insertCliente($datos) > 0) {
            // Obtenemos el registro creado.
            $cliente = ControllerCliente::getClienteById($datos['user']);
            
            // Creamos sesión con el datos del cliente.
            ini_set("session.gc_maxlifetime", 1800);
            session_set_cookie_params(1800);
            session_start();
            $_SESSION['logueado'] = $cliente;

            // Redirigimos a Inicio.
            header("Location:inicio.php");
        }
        
    } else {
        // Mensaje de error.
        $msg = "<br><br><span style='color:red'>No puede haber campos de texto vacíos!</span>";
    }
}
?>

<html>
    <head>
        <title>Registro - MVC (alquiler_juegos)</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col py-3">
                    <h1>Registro</h1>
                    <form action="" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input type="text" class="form-control" id="dni" placeholder="Introduzca su DNI" name="user">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Introduzca su nombre" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" placeholder="Introduzca sus apellidos" name="surname">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" placeholder="Introduzca su direccion" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="localidad" class="form-label">Localidad:</label>
                            <input type="text" class="form-control" id="localidad" placeholder="Introduzca su direccion" name="city">
                        </div>                        
                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave:</label>
                            <input type="password" class="form-control" id="clave" placeholder="Introduzca su clave" name="pwd">
                        </div>
                        <button type="submit" name="register" class="btn btn-success">Crear cuenta</button>
                    </form>
                    <a href="login.php"><button class="btn btn-warning">Iniciar sesión</button></a>
                    <a href="inicio.php"><button class="btn btn-dark">Cancelar</button></a>
                    <!-- Mostramos el mensaje de error -->
                    <?php if (isset($_POST['register']) && isset($msg)) echo $msg; ?>                    
                </div>
            </div>
        </div>
    </body>
</html>