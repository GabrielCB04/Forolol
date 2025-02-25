<?php
    include 'index.php';

    if (isset($_GET['id'])) {
        $idPubli = $_GET['id'];
        $update_visitas = "UPDATE publicaciones SET visitas_publi = visitas_publi + 1 WHERE id_publi = $idPubli";
        mysqli_query($conexion, $update_visitas);
        echo "Visitas actualizadas";
    } else {
        echo "ID no proporcionado";
    }
?>