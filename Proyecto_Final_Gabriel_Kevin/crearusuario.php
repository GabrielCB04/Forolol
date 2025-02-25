<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="js/crearusuario.js" defer></script>
    </head>
    <body>
    <div class="login_main">
    <div class="div_login">
        <br>
        <!--  Crear un usuario en phpmyadmin -->
        <form method="post" action="crearusuario.php"  onsubmit="return validarFormuario()">
            <h2>Crear tu cuenta</h2>
            <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre de usuario" class="reg_nombre"><br>
            <span id="usernameError" style="color: red;"></span><br>
            <input type="text" name="email" id="email" class="reg_email" placeholder="Email"><br>
            <span id="emailError" style="color: red;"></span><br>
            <div style="position: relative; display: inline-block;">
                <input type="password" name="password1" id= "password1" class="reg_password" placeholder="Contraseña"><br>
                <button class="ver_ocultar_password" id="toggle_boton1" type="button">
                    <img id="icono_ojo1" src="imagenes/iconos/ocultar_password.png" alt="Ver contraseña" style="width: 20px; height: 20px;">
                </button>
            </div><br>
            <span id="password1Error" style="color: red;"></span><br>
            <div style="position: relative; display: inline-block;">
                <input type="password" name="password2" id="password2" class="reg_password" placeholder="Confirmar contraseña"><br>
                <button class="ver_ocultar_password" id="toggle_boton2" type="button">
                    <img id="icono_ojo2" src="imagenes/iconos/ocultar_password.png" alt="Ver contraseña" style="width: 20px; height: 20px;">
                </button>
            </div><br>
            <span id="password2Error" style="color: red;"></span><br>
            <a href="index.php"> <input type="submit" name="login" value="Crear cuenta" class="submit_registrarse"><br><br></a>
            </div></div>
        </form>
    </body>

<?php
if ($_POST) {
$conexion=mysqli_connect("localhost","root","","forolol");

$nombre_usuario = $_POST['nombre_usuario'];
$email = $_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$foto = "default.jpg";

// Validación del nombre de usuario
if (!preg_match('/[^a-zA-Z0-9]/', $nombre_usuario)) {
    $errors['nombre_usuario'] = "El nombre de usuario debe contener caracteres especiales.";
}
if (strlen($nombre_usuario) < 10 || strlen($nombre_usuario) > 30) {
    $errors['nombre_usuario'] = "El nombre de usuario debe tener entre 10 y 30 caracteres.";
}
if (preg_match('/^\d/', $nombre_usuario)) {
    $errors['nombre_usuario'] = "El nombre de usuario no puede comenzar con un número.";
}

// Validación del email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "El email no es válido.";
}

// Validación de la contraseña
if (!preg_match('/[0-9]/', $password1)) {
    $errors['password1'] = "La contraseña debe contener al menos un número.";
}
if (!preg_match('/[A-Z]/', $password1)) {
    $errors['password1'] = "La contraseña debe contener al menos una letra mayúscula.";
}
if (strlen($password1) < 5 || strlen($password1) > 20) {
    $errors['password1'] = "La contraseña debe tener entre 5 y 20 caracteres.";
}

// Validación de la confirmación de la contraseña
if ($password1 !== $password2) {
    die("Las contraseñas no coinciden.");}

if (empty($errors)) {
$crear_user = "CREATE USER '$nombre_usuario'@'forolol' IDENTIFIED BY '$password1'";
// Habria que cambiar el insert para que inserte tmb el email
if (mysqli_multi_query($conexion, $crear_user)) {
    header("Location: login.php");
            exit();
    $insertar_datos = "INSERT INTO usuarios (nom_usr, pass_usr, email_usr, foto_usr) VALUES ('$nombre_usuario', '$password1', '$email', '$foto')";
    $resultado=mysqli_query($conexion,$insertar_datos);
} 

else {
    echo "Error al crear el usuario: " . $conexion->error;
}
} else {
    // Mostrar errores de validación
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
    mysqli_close($conexion);
}
?>
</html>


