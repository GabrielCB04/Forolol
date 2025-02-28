// Función para mostrar/ocultar
document.getElementById('toggle_boton1').addEventListener('click', function() {
    let campo_password = document.getElementById('password1'); 
    let icono_ojo = document.getElementById('icono_ojo1'); 
    
    if (campo_password.type === 'password') {
    campo_password.type = 'text';  
    icono_ojo.src = 'imagenes/iconos/mostrar_password.png'; 
    } else {
    campo_password.type = 'password';  
    icono_ojo.src = 'imagenes/iconos/ocultar_password.png';  
    }
    });
    
// Lo mismo para confirmar contraseña
    document.getElementById('toggle_boton2').addEventListener('click', function() {
    let campo_password = document.getElementById('password2'); 
    let icono_ojo = document.getElementById('icono_ojo2'); 
    
    if (campo_password.type === 'password') {
    campo_password.type = 'text'; 
    icono_ojo.src = 'imagenes/iconos/mostrar_password.png'; 
    } else {
    campo_password.type = 'password';  
    icono_ojo.src = 'imagenes/iconos/ocultar_password.png';  
    }
    });
    

//Condiciones de nombre y contraseña
function validarFormuario(){
    let username = document.getElementById("nombre_usuario").value;
    let email = document.getElementById("email").value;
    let password1 = document.getElementById("password1").value;
    let password2 = document.getElementById("password2").value;
    let usernameError = document.getElementById("usernameError");
    let emailError = document.getElementById("emailError");
    let password1Error = document.getElementById("password1Error");
    let password2Error = document.getElementById("password2Error");
    let isValid = true;

 // Limpiar errores anteriores
usernameError.textContent = "";
emailError.textContent = "";
password1Error.textContent = "";
password2Error.textContent = "";

// Validación del nombre de usuario
if (!/[^a-zA-Z0-9]/.test(username)) {
    usernameError.textContent = "El nombre de usuario debe contener caracteres especiales.";
    isValid = false;
}
if (username.length < 10 || username.length > 30) {
    usernameError.textContent = "El nombre de usuario debe tener entre 10 y 30 caracteres.";
    isValid = false;
}
if (/^\d/.test(username)) {
    usernameError.textContent = "El nombre de usuario no puede comenzar con un número.";
    isValid = false;
}

// Validación del email
if (!/\S+@\S+\.\S+/.test(email)) {
    emailError.textContent = "El email no es válido.";
    isValid = false;
}

// Validación de la contraseña
if (!/[0-9]/.test(password1)) {
    password1Error.textContent = "La contraseña debe contener al menos un número.";
    isValid = false;
}
if (!/[A-Z]/.test(password1)) {
    password1Error.textContent = "La contraseña debe contener al menos una letra mayúscula.";
    isValid = false;
}
if (password1.length < 5 || password1.length > 20) {
    password1Error.textContent = "La contraseña debe tener entre 5 y 20 caracteres.";
    isValid = false;
}

// Validación confirmación contraseña
if (password1 !== password2) {
    password2Error.textContent = "Las contraseñas no coinciden.";
    isValid = false;
}

return isValid;
};

