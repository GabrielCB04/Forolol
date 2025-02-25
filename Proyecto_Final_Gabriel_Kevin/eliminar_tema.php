<?php
echo("Location: index.php");
include 'perfil.php'; // Incluir la conexión a la base de datos

if (isset($_GET['id'])) {
    $idPubli = $_GET['id'];
    $borrar_respuestas = "DELETE FROM respuestas WHERE id_publi = $idPubli";
    $borrar_publi = "DELETE FROM publicaciones WHERE id_publi = $idPubli";
    if (mysqli_query($conexion, $borrar_respuestas)){
        echo "Respuestas eliminadas";
    } else {
        echo "Error al eliminar respuestas: " . mysqli_error($conexion);
    }
    if (mysqli_query($conexion, $borrar_publi)){
    header("Location: index.php");
};
} else {
    echo "ID no proporcionado";
}
?>