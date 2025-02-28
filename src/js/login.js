// Función para mostrar/ocultar
document.getElementById('toggle_boton').addEventListener('click', function() {
    let campo_password = document.getElementById('password');
    let icono_ojo = document.getElementById('icono_ojo');

    if (campo_password.type === 'password') {
        campo_password.type = 'text';  
        icono_ojo.src = 'imagenes/iconos/mostrar_password.png'; 
    }else{
        campo_password.type = 'password';  
        icono_ojo.src = 'imagenes/iconos/ocultar_password.png';  
    }
});
