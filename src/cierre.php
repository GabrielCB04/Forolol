<?php
    session_start();
    //Cuando se cierra sesion se eliminan las coockie
    if (isset($_COOKIE['username'])) {
    setcookie("username", "", time() - 3600, "/");
    }
    
    // Eliminar la sesión del fichero_sesion.txt
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    
        $sesion_datos = file_get_contents("Registros/fichero_sesion.txt");
    
        $sesion_datos = preg_replace("/Usuario: " . $username . " - .*\n/", "", $sesion_datos);
    
        file_put_contents("Registros/fichero_sesion.txt", $sesion_datos);
    }
    
    session_destroy(); 
    header("Location: index.php"); 
    exit();
?>
