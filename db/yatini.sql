create database yatini;
use yatini;
CREATE TABLE usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(10) NOT NULL,
    gmail VARCHAR(30) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tipo ENUM('administrador', 'usuario') NOT NULL,
    token VARCHAR(100) NULL,
    fecha_expiracion_token DATETIME NULL
);
ALTER TABLE usuarios
ADD contrasena VARCHAR(100) NOT NULL AFTER gmail;

CREATE TABLE categoria(
    id_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(30) NOT NULL
);

CREATE TABLE juegos (
   id_juego INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nombre_juego VARCHAR(30) NOT NULL,
   imagen_juego MEDIUMBLOB,
   Descripcion VARCHAR(100) NOT NULL,
   url_juego VARCHAR(100) NOT NULL,
   edad TINYINT NOT NULL,
   id_categoria INT NOT NULL,
   id_usuario INT NOT NULL,
   FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
   FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
CREATE TABLE califica(
   id_puntuacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   Puntuacion TINYINT NOT NULL CHECK (Puntuacion >= 0 AND Puntuacion <= 5), 
   fecha_calificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   id_juego INT NOT NULL,
   id_usuario INT NOT NULL,
   FOREIGN KEY (id_juego) REFERENCES juegos(id_juego),
   FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
INSERT INTO usuarios (nombre_usuario, gmail, tipo)
VALUES ('alva2000', '76595194amaru@gmail.com', 'administrador');

UPDATE usuarios
SET contrasena = '70680819Amaru'
WHERE id_usuario = 1;
INSERT INTO usuarios (nombre_usuario, gmail, contrasena, tipo)
VALUES ('carlos2000', '77574524carlos@gmail.com', '77574524Carlos', 'usuario');

ALTER TABLE juegos
ADD archivo_juego VARCHAR(100) NOT NULL;

ALTER TABLE juegos
ADD archivo_comprimido LONGBLOB NOT NULL AFTER  edad;
ALTER TABLE juegos
ADD estado_revision ENUM('En revisión', 'Aprobado', 'Rechazado') NOT NULL DEFAULT 'En revisión';



