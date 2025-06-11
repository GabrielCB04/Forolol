-- Crear la tabla USUARIOS
CREATE TABLE USUARIOS (
    id_usr INT AUTO_INCREMENT PRIMARY KEY,
    nom_usr VARCHAR(30) NOT NULL,
    email_usr VARCHAR(100) NOT NULL,
    pass_usr VARCHAR(200) NOT NULL,
    foto_usr VARCHAR(400)
);

-- Crear la tabla PUBLICACIONES
CREATE TABLE PUBLICACIONES (
    id_publi INT AUTO_INCREMENT PRIMARY KEY,
    id_usr INT,
    fecha_publi DATE NOT NULL,
    titulo_publi VARCHAR(150) NOT NULL, 
    likes_publi INT DEFAULT 0,
    resps_publi INT DEFAULT 0,
    desc_publi VARCHAR(150),
    img_publi VARCHAR(150),
    visitas_publi INT DEFAULT 0,
    FOREIGN KEY (id_usr) REFERENCES USUARIOS(id_usr)
);

-- Crear la tabla RESPUESTAS
CREATE TABLE RESPUESTAS (
    id_resp INT AUTO_INCREMENT PRIMARY KEY,
    id_publi INT,
    id_usr INT,
    likes_resp VARCHAR(20) DEFAULT 0,
    fecha_resp DATE NOT NULL,
    cont_resp TEXT NOT NULL,
    img_resp VARCHAR(200),
    FOREIGN KEY (id_publi) REFERENCES PUBLICACIONES(id_publi),
    FOREIGN KEY (id_usr) REFERENCES USUARIOS(id_usr)
);
