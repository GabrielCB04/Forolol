<?php
session_start();
include 'header.php';
$conexion = mysqli_connect("localhost", "root", "", "forolol");
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['id']);
    // Buscar la publicación en la base de datos
    $query = "SELECT * FROM publicaciones WHERE id_publi = '$id'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $post = mysqli_fetch_assoc($resultado);
    } else {
        die("Publicación no encontrada.");
    }
} else {
    die("ID de publicación no proporcionado.");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($post['titulo_publi']); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<body>
    <?php
    echo "<h1>" . htmlspecialchars($post['titulo_publi']) . "</h1>";

    echo "<h3>" . nl2br(htmlspecialchars($post['desc_publi'])) . "</h3>";
    
    if (!empty($post['img_publi'])): 
        $conexion1 = mysqli_connect("localhost", "root", "", "forolol");
        $consulta_foto_publi = "SELECT img_publi FROM publicaciones where id_publi=$id"; 
        $resultado_foto_publi = mysqli_query($conexion1, $consulta_foto_publi);
        $foto_publi = mysqli_fetch_row($resultado_foto_publi);
    ?>
        <img src="imagenes/fotos_publicacion/<?php echo htmlspecialchars($foto_publi[0]); ?>" alt="Imagen de la publicación">

    <?php endif; ?>
    <br>
    <form method="post" action="respuesta.php?id=<?php echo $id; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <textarea name="respuesta" class="contenido_respuesta" placeholder="Escribe tu respuesta aquí" required></textarea><br>
        <input type="submit" class="enviar_respuesta" value="Enviar respuesta">
    </form>
    <br>
    <?php
if ($_POST) {
    if (!isset($_SESSION["user_id"])) {
        die("Debes iniciar sesión para responder a esta publicación.");
    }
    else{
    $respuesta = $_POST['respuesta'];
    $conexion=mysqli_connect("localhost","root","","forolol");
    $insertar_respuesta = "INSERT INTO respuestas (id_publi, id_usr, cont_resp) VALUES ('$id', '{$_SESSION["user_id"]}', '$respuesta')";
    $resultado = mysqli_query($conexion, $insertar_respuesta);
    if ($resultado) {
        echo "Tema insertado con éxito. <a href='index.php'>Volver al inicio</a>";
        $post_id = mysqli_insert_id($conexion); // Obtener el ID del post insertado
        mysqli_close($conexion);
        header("Location: respuesta.php?id=$id"); 
        exit();
    } else {
        echo "Error al insertar el tema: " . $conexion->error;
    }
}
}
    ?>
    <?php
echo "<h2>Respuestas</h2>";

$consulta_respuestas = "SELECT id_resp, cont_resp, nom_usr, foto_usr FROM respuestas JOIN usuarios 
ON respuestas.id_usr = usuarios.id_usr WHERE id_publi = '$id'";
$resultado_respuestas = mysqli_query($conexion, $consulta_respuestas);

while($respuestas=mysqli_fetch_row($resultado_respuestas)){
    echo("<div id=".$respuestas[0]." class='respuesta_tema'>");
    echo "<div class=titulo_respuesta>";
    echo "<img src='imagenes/fotos_perfil/" . $respuestas[3] . "' width='50px' height='50px' class='avatar_publi'>";
    echo("<h4>".$respuestas[2]."</h4>");
        echo("</div>");
    echo("<p>".$respuestas[1]."</p>");
    echo("</div>");
};

?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
