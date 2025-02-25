<?php
session_start();
include 'header.php';
$conexion = mysqli_connect("localhost", "root", "", "forolol");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error()); }

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['id']);
}

$consulta_foto = "SELECT foto_usr FROM usuarios WHERE id_usr = '{$_SESSION['user_id']}'";
$resultado_foto = mysqli_query($conexion, $consulta_foto);

echo "<div class='foto_nombre'>";
echo "<h1>" . htmlspecialchars($_SESSION['username']) . "</h1>";
while($foto=mysqli_fetch_row($resultado_foto)){
echo "<img class='avatar' src='imagenes/fotos_perfil/" . $foto[0] . "' alt='Foto de perfil' width='100' height='100'>";}
echo "<img id=\"uploadImage\" class='icono_cambiar_avatar' src=\"imagenes/iconos/cambiar_avatar.png\" width=\"25px\" height=\"30px\" >";
echo "</div>";

$consulta_estadisticas = "SELECT COUNT(id_publi), SUM(likes_publi), SUM(visitas_publi) FROM publicaciones WHERE id_usr = '{$_SESSION['user_id']}'";
$resultado_estadisticas = mysqli_query($conexion, $consulta_estadisticas);
while($estadisticas=mysqli_fetch_row($resultado_estadisticas)){
    echo "<div class='estadisticas'>";
    echo "<p>Temas publicados: " . $estadisticas[0] . "</p>";
    echo "<p>Likes recibidos: " . $estadisticas[1] . "</p>";
    echo "<p>Visitas totales: " . $estadisticas[2] . "</p>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="js/forolol.js"></script>
</head>
</body>
        <form method="post" action="perfil.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <input type="file" class="boton_cambiar_avatar" name="archivo" id="archivo" accept="image/*" required> <br>
        <input type="submit" value="Guardar cambios" class="boton_guardar_avatar">
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>     
</body>
</html>
<?php

if (isset($_FILES['archivo'])) {
    $nombre_archivo = $_FILES['archivo']['name'];
    $archivo_temporal = $_FILES['archivo']['tmp_name'];
    $contenido_archivo = file_get_contents($archivo_temporal);
    $nombre_unico = uniqid() . ".jpg";
    $ruta_foto = "imagenes/fotos_perfil/";

    if (file_put_contents($ruta_foto . $nombre_unico, $contenido_archivo)) {
        // Guardar el nombre del archivo en la base de datos
        $id_usr = $_SESSION['user_id']; 
        $consulta_foto_actual = "SELECT foto_usr FROM usuarios WHERE id_usr = '$id_usr'";
        $resultado_foto_actual = mysqli_query($conexion, $consulta_foto_actual);
        while ($foto_actual = mysqli_fetch_row($resultado_foto_actual)) {
            if ($foto_actual[0] != "default.jpg") {
                unlink($ruta_foto . $foto_actual[0]);
            }
        }
        $update_foto = "UPDATE usuarios SET foto_usr = '$nombre_unico' where id_usr = '$id_usr'";
        mysqli_query($conexion, $update_foto);
        header("Location: perfil.php");
    } else {
        echo "Error al subir la imagen.";
    }
}
?>


