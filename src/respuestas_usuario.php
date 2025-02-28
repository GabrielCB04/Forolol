<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="forolol.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
<?php
session_start();
include 'header.php';
echo "<div class='main'>";
echo "<h2>Mis respuestas</h2>";
$conexion = mysqli_connect("localhost", "root", "", "forolol");
$consulta_respuestas = "SELECT r.id_resp, r.cont_resp, p.titulo_publi FROM respuestas r JOIN publicaciones p ON r.id_publi = p.id_publi 
WHERE r.id_usr = '{$_SESSION['user_id']}'";
$resultado_respuestas = mysqli_query($conexion, $consulta_respuestas);
while($respuestas=mysqli_fetch_row($resultado_respuestas)){
    echo("<div id=".$respuestas[0]." class='respuesta_tema'>");
    echo("<h2>".$respuestas[2]."</h2>");
    echo("<p>".$respuestas[1]."</p>");
    echo("</div>");
};
?>
</div>
</body>
</html>

