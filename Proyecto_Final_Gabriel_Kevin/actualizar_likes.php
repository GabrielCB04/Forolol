<?php
include 'index.php'; 

if (isset($_GET['id'])) {
    $idPubli = $_GET['id'];
    $update_likes = "UPDATE publicaciones SET likes_publi = likes_publi + 1 WHERE id_publi = $idPubli";
    mysqli_query($conexion, $update_likes);
    echo "Likes actualizados";
} else {
    echo "ID no proporcionado";
}
?>