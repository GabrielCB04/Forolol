document.addEventListener('DOMContentLoaded', function() {
    // Activar el input file cuando se hace clic en la imagen con id="uploadImage"
    const uploadImage = document.getElementById('uploadImage');
    const fileInput = document.getElementById('archivo');

    if (uploadImage && fileInput) {
        uploadImage.addEventListener('click', function() {
            fileInput.click();
            console.log("Haga clic en la imagen para subir archivo");
        });
    }

        // Manejar clic en el tema (para visitas)
document.querySelectorAll('.tema').forEach(function(tema) {
    tema.addEventListener('click', function() {
        var idPubli = this.id.split('-')[1]; // Obtener el ID de la publicación
        window.location.href = 'respuesta.php?id=' + idPubli;
        // Enviar una solicitud al servidor para actualizar las visitas
        fetch('actualizar_visitas.php?id=' + idPubli);
    });
});
// Manejar clic en el botón de Like
document.querySelectorAll('.like').forEach(function(boton) {
    boton.addEventListener('click', function(event) {
        event.stopPropagation(); // Evitar que el clic se propague al contenedor del tema
        var idPubli = this.getAttribute('data-id'); // Obtener el ID de la publicación
        // Enviar una solicitud al servidor para actualizar los likes
        fetch('actualizar_likes.php?id=' + idPubli)
            .then(response => {
                    if (response.ok) {
                        location.reload(); // Recargar la página
                    }
            })
            .catch(error => console.error('Error:', error));
    });
});
    
});

