<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="forolol.js"></script>
    </head>
<body>
<?php
session_start();
include 'header.php';
echo "<div class='main'>";
$conexion = mysqli_connect("localhost", "root", "", "forolol");
$consulta="SELECT p.id_publi, p.titulo_publi, p.likes_publi, p.resps_publi, p.visitas_publi, u.nom_usr, u.foto_usr 
    FROM publicaciones p JOIN usuarios u on p.id_usr = u.id_usr WHERE p.id_usr = '{$_SESSION['user_id']}' ORDER BY p.visitas_publi DESC";
$resultado=mysqli_query($conexion,$consulta);
echo "<h2>Mis temas</h2>";
while($columnas2=mysqli_fetch_row($resultado)){ 

    echo "<div id='tema-" . $columnas2[0] . "' class='tema'>";
        echo "<div class='contenido_publicacion'>";
        echo "<div id='titulo_tema' class='titulo_tema'>";
        echo "<img src='imagenes/fotos_perfil/" . $columnas2[6] . "' width='50px' height='50px' class='avatar_publi'>";
        echo "<h4>" . $columnas2[5] . "</h4>";
        echo "</div>";
        echo "<h2>" . $columnas2[1] . "</h2>";
        echo "<div class='info_publi' id='info_publi'>";
        echo "<img src='imagenes/iconos/like.png' class='like' data-id='" . $columnas2[0] . "' alt='Like' width='30' height='30' style='cursor:pointer;'> " . $columnas2[2] . "";
        echo "<img src='imagenes/iconos/comentario.png' width='30px' height='30px'>" . $columnas2[3] . "";
        echo "<img src='imagenes/iconos/visitas.png' width='30px' height='30px'>" . $columnas2[4] . "";
        echo "<button class='borrar' data-id='" . $columnas2[0] . "'>";
        echo "<img src='imagenes/iconos/papelera.png' alt='Eliminar' />";
        echo "</div>";
        echo "</button>";
        echo "</div>";
        echo "</div>";

}
?>
<script>
    // Contador visitas
document.querySelectorAll('.tema').forEach(function(tema) {
    tema.addEventListener('click', function() {
        var idPubli = this.id.split('-')[1]; // Obtener el ID del tema
        window.location.href = 'respuesta.php?id=' + idPubli;
        fetch('actualizar_visitas.php?id=' + idPubli)
    });
});
    // Borrar tema
document.querySelectorAll('.borrar').forEach(function(boton) {
    boton.addEventListener('click', function(event) {
        event.stopPropagation(); 
        var idPubli = this.getAttribute('data-id'); // Obtener el ID de la publicación
        if (confirm("¿Estás seguro de que quieres eliminar esta publicación?")) { // alert de confirmar
            try{
                fetch('eliminar_tema.php?id=' + idPubli)
                .then(response => {
                    if (response.ok) {
                        location.reload(); // Recargar la página
                    } else {
                        console.error('Error al eliminar la publicación');
                    }
                })
            }catch(error){
                console.log(error)
            }
        console.log("hola")}

    });
});
</script>
</div>
</body>
</html>
