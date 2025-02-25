<html>
<!doctype html>
<html> 
    <head>
        <title> Forolol </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

<?php session_start(); 
include 'header.php'; ?>
<div class="main">
<h2>Temas relevantes</h2>
<!-- Código para mostrar los temas -->
<?php
if (!$resultado){
    $conexion=mysqli_connect("localhost","root","","forolol");
    $consulta="SELECT p.id_publi, p.titulo_publi, p.likes_publi, p.resps_publi, p.visitas_publi, u.nom_usr, u.foto_usr 
    FROM publicaciones p JOIN usuarios u on p.id_usr = u.id_usr ORDER BY p.visitas_publi DESC";
    $resultado=mysqli_query($conexion,$consulta);
    }
    while($temas=mysqli_fetch_row($resultado)){ 
        echo "<div id='tema-" . $temas[0] . "' class='tema'>";
        echo "<div id='titulo_tema' class='titulo_tema'>";
        echo "<img src='imagenes/fotos_perfil/" . $temas[6] . "' width='50px' height='50px' class='avatar_publi'>";
        echo "<h4>" . $temas[5] . "</h4>";
        echo "</div>";
        echo "<h2>" . $temas[1] . "</h2>";
        echo "<div class='info_publi' id='info_publi'>";
        echo "<img src='imagenes/iconos/like.png' class='like' data-id='" . $temas[0] . "' alt='Like' width='30' height='30' style='cursor:pointer;'> " . $temas[2] . "";
        echo "<img src='imagenes/iconos/comentario.png' width='30px' height='30px'>" . $temas[3] . "";
        echo "<img src='imagenes/iconos/visitas.png' width='30px' height='30px'>" . $temas[4] . "";
        echo "</div>";
        echo "</div>";
    }
    ?>
<script src="js/forolol.js"></script>
</div>
<?php
    // Verificar si el usuario ya ha aceptado o rechazado las cookies
    if (!isset($_COOKIE['cookies_forolol'])) {
        // Mostrar el mensaje emergente de cookies
        echo '<div id="mensaje_cookies" class="mensaje_cookies">';
        echo "<img src='imagenes/iconos/icono_cookies.png' class='icono_cookies' width='30px' height='30px'>";
        echo 'Este sitio usa cookies. ';
        echo '<a href="#" onclick="AceptarCookies()">Aceptar</a> | ';
        echo '<a href="#" onclick="RechazarCookies()">Rechazar</a>';
        echo '</div>';
        echo '<script src="js/cookies.js"></script>'; // Se ejecuta el script de cookies.js
    }
?>

</body>
<?php include 'footer.html'; ?>
</html>


