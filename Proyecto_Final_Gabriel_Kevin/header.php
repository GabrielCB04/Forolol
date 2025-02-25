<html>
<!doctype html>
<html> 
    <head>
        <title> Forolol </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="forolol.css">
        <script src="cookies.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<div class="div_header">
<?php 
//Si esta varible no cambia con buscar_tema, se mostraran todos
$resultado = null; ?>
    <body>
        <a href="index.php"> <img src="imagenes/iconos/forolol_logo.png" class="icono_main"> </a>
        <form method="post" action="index.php">
        <img src="imagenes/iconos/lupa.png" class="icono_lupa" width="18x" height="18px">
        <input type="text" class="buscar_tema" name="buscar_tema" placeholder="Buscar tema">
        </form>
        <?php
        if ($_POST && isset($_POST['buscar_tema'])) {
            $nombre_tema = $_POST['buscar_tema'];
            $conexion=mysqli_connect("localhost","root","","forolol");
            //Consulta para buscar tema
            $consulta="SELECT p.id_publi, p.titulo_publi, p.likes_publi, p.resps_publi, p.visitas_publi, u.nom_usr, u.foto_usr 
            FROM publicaciones p JOIN usuarios u on p.id_usr = u.id_usr WHERE LOWER(p.titulo_publi) LIKE LOWER('{$nombre_tema}%') 
            ORDER BY p.visitas_publi DESC";
            $resultado=mysqli_query($conexion,$consulta);
        }
        ?>
    <!--  Botón de logearse que aparece si no hay sesión abierta -->
    <?php if (!isset($_SESSION['user_id'])): ?>
    <form method="post" action="login.php">
        <a href="login.php"> <input type="button" name="Iniciar sesión" class="login_boton" value="Iniciar sesión"> </a>
    </form> 
    <?php endif; ?>
    <!-- Botón de insertar tema que aparece si hay sesión abierta -->
<?php if (isset($_SESSION['user_id'])): ?>
    <a href="insertar_tema.php"><button class="insertar_tema" name="insertar_tema">
    <img src="imagenes/iconos/plus.png" width="18x" height="18px" class="imagen_suma">
    Nuevo tema
    </button></a>  
    <?php endif; ?>
        <?php 
        if (isset($_SESSION['user_id'])) {     
        $conexion = mysqli_connect("localhost","root","","forolol");
        $consulta_foto = "SELECT foto_usr FROM usuarios WHERE id_usr = '{$_SESSION['user_id']}'";
        $resultado_foto = mysqli_query($conexion, $consulta_foto);
        while($foto=mysqli_fetch_row($resultado_foto)){
            $nombre_foto = $foto[0];
        }
    }
        ?>

    <!-- Código para mostrar un submenú en la foto de perfil si se esta logeado -->
<?php if (isset($_SESSION['user_id'])): ?>
    
    <div class="profile" onclick="toggleMenu()">
        <img class="avatar" src="imagenes/fotos_perfil/<?php echo $nombre_foto; ?>" alt="Avatar" width="60" height="60">
    </div>
    
    <div class="menu_perfil" id="menu_perfil">
        <a href="perfil.php?id=<?php echo $_SESSION['user_id']; ?>">Ver perfil</a>
        <a href="cierre.php">Cerrar sesión</a>
        <a href="temas_usuario.php">Mis temas</a> 
        <a href="respuestas_usuario.php">Mis respuestas</a> 
    </div>

    <script>
        document.getElementById("menu_perfil").style.display = "none";

        function toggleMenu() {
            let menu_perfil = document.getElementById("menu_perfil");
            menu_perfil.style.display = menu_perfil.style.display === "block" ? "none" : "block";
        }

        document.addEventListener("click", function(event) {
            let menu_perfil = document.getElementById("menu_perfil");
            let profile = document.querySelector(".profile");
            if (!profile.contains(event.target) && !menu_perfil.contains(event.target)) {
                menu_perfil.style.display = "none";
            }
        });
    </script>
    <?php endif; ?>
    </div>
    </body>
    </html>