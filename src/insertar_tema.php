<?php
session_start();
include 'header.php';
?>
<html>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/forolol.js"></script>
    </head> 
    <body>

    <h2>Publicar tema</h2>
        <br>
        <div class="div_insertar_tema">
        <!--  Formulario de creación de tema -->
        <form method="post" action="insertar_tema.php" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título" required class="titulo_insertar_tema">
            <img id="uploadImage" src="imagenes/iconos/insertar_imagen.png" alt="Haz clic para cargar una imagen" width="25px" height="30px" style="padding-bottom: 5px; cursor: pointer;">
            <input type="file" name="archivo" id="archivo" accept="image/*" class="file_tema"><br>
            <img id="preview" src="" alt="Imagen cargada" style="display: none; margin-top: 20px; width: 300px;">
            <textarea name="contenido" placeholder="Contenido" class="contenido_tema"></textarea><br>
            <a href="insertar_tema.php"> <input type="submit" name="insertar_tema" value="Publicar tema" class="boton_insertar_tema"></a>  <br>       
        </form>  </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
<?php

if ($_POST) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $nombre_unico = null;
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = $_FILES['archivo']['name'];
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        $ruta_foto = "imagenes/fotos_publicacion/";
        $contenido_archivo = file_get_contents($archivo_temporal);
        $nombre_unico = uniqid() . ".jpg";

        if (file_put_contents($ruta_foto . $nombre_unico, $contenido_archivo)) {   
        } else {
        }
    }
    $conexion=mysqli_connect("localhost","root","","forolol");
    $insertar_tema = "INSERT INTO publicaciones (titulo_publi, desc_publi, img_publi, id_usr) 
    VALUES ('$titulo', '$contenido', '$nombre_unico', '{$_SESSION["user_id"]}')";
        $resultado = mysqli_query($conexion,$insertar_tema);
        if ($resultado) {
            $post_id = mysqli_insert_id($conexion); // Obtener el ID del tema insertado
            mysqli_close($conexion);
            header("Location: respuesta.php?id=$post_id"); 
            exit();
        } else {
            echo "Error al insertar el tema: " . $conexion->error;
            }
}
?>
</html>


