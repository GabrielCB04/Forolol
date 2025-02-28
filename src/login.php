<html>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="js/login.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="login_main">
        <div class="div_login">
        <!--  Al pulsar crear usuario te lleva a crearusuario.php -->
        <form method="post" action="login.php">
            <h2>Iniciar Sesión </h2>
            <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" class="login_usr"><br>
            <div style="position: relative; display: inline-block;">
                <input type="password" id="password" name="password" placeholder="Contraseña" class="password_usr"><br>
                <button class="ver_ocultar_password" id="toggle_boton" type="button">
            <img id="icono_ojo" src="imagenes/iconos/ocultar_password.png" alt="Ver contraseña" style="width: 20px; height: 20px;">
        </button>
        </div><br><br>
            <br>
            <input type="submit" name="login" value="Iniciar sesión" class="submit_login"><br><br>
            ¿No tienes cuenta?
            <a href="crearusuario.php"> Registrarse <br> </a>
        </form>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

<?php
session_start();
if ($_POST) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];
    $conexion=mysqli_connect("localhost","root","","forolol");
    $consulta="SELECT id_usr, nom_usr, pass_usr FROM usuarios WHERE nom_usr='$nombre_usuario' AND pass_usr='$password'";
    $resultado=mysqli_query($conexion,$consulta);
    $columnas=mysqli_fetch_assoc($resultado);
    if ($columnas) {

    $_SESSION['user_id'] = $columnas['id_usr'];
    $_SESSION['username'] = $columnas['nom_usr'];
    
    // establecer una cookie con el nombre de usuario que expira en 1 año
    setcookie("username", $columnas['nom_usr'], time() + (365 * 24 * 60 * 60), "/");

    // Escribir en accesos.txt
    $log_entry = "Usuario: " . $columnas['nom_usr'] . " - Fecha: " . date("Y-m-d H:i:s") . "\n";
    file_put_contents("Registros/accesos.txt", $log_entry, FILE_APPEND);

    // Crear o actualizar fichero_sesion.txt con los datos de la sesión
    $sesion_datos = "Usuario: " . $columnas['nom_usr'] . " - Contraseña: " . $columnas['pass_usr'] . " - Fecha: " . date("Y-m-d H:i:s") . "\n";
    file_put_contents("Registros/fichero_sesion.txt", $sesion_datos, FILE_APPEND);

    echo "Usuario logueado con éxito. <a href='index.php'>Volver al inicio</a>";
    echo "Inicio de sesión exitoso. Bienvenido, " . $user['username'] . "!";
        header("Location: index.php");
        exit();
    } else {
        echo "<p class='error_login'>Usuario o contraseña incorrectos</p>" . $conexion->error;
    }
}
?>
</div></div>
</html>


