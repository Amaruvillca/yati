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
ADD archivo_comprimido LONGBLOB NOT NULL AFTER  edad;
ALTER TABLE juegos
ADD estado_revision ENUM('En revisión', 'Aprobado', 'Rechazado') NOT NULL DEFAULT 'En revisión';


select* from usuarios;
INSERT INTO categoria (nombre_categoria) VALUES ('Matemáticas');
ALTER TABLE usuarios
ADD estado ENUM('activo', 'no activo') NOT NULL DEFAULT 'activo';
ALTER TABLE juegos
ADD fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER Descripcion;
select*from categoria;
SHOW VARIABLES LIKE 'secure_file_priv';

INSERT INTO juegos (
    nombre_juego,
    imagen_juego,
    Descripcion,
    url_juego,
    edad,
    id_categoria,
    id_usuario,
    archivo_comprimido,
    estado_revision,
    fecha_creacion
) VALUES (
    'Juego de Matemáticas',
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/l2.jpeg'), -- Ruta del archivo de imagen
    'Un juego educativo para aprender matemáticas básicas.',
    'https://www.ejemplo.com/juego-matematicas',
    7, -- Edad recomendada
    1, -- ID de la categoría correspondiente
    1, -- ID del usuario que está añadiendo el juego
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/CODIGO.rar'), -- Ruta del archivo comprimido
    'En revisión',
    NOW() -- Fecha de creación
);
INSERT INTO juegos (
    nombre_juego,
    imagen_juego,
    Descripcion,
    url_juego,
    edad,
    id_categoria,
    id_usuario,
    archivo_comprimido,
    estado_revision,
    fecha_creacion
) VALUES (
    'Juego de razonamineto',
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/l2.jpeg'), -- Ruta del archivo de imagen
    'juegos ',
    'https://www.ejemplo.com/juego-matematicas',
    8, -- Edad recomendada
    1, -- ID de la categoría correspondiente
    1, -- ID del usuario que está añadiendo el juego
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/CODIGO.rar'), -- Ruta del archivo comprimido
    'En revisión',
    NOW() -- Fecha de creación
);
select * from juegos;
INSERT INTO juegos (
    nombre_juego,
    imagen_juego,
    Descripcion,
    url_juego,
    edad,
    id_categoria,
    id_usuario,
    archivo_comprimido,
    estado_revision,
    fecha_creacion
) VALUES (
    'chezz',
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/l2.jpeg'), -- Ruta del archivo de imagen
    'juegos ',
    'https://www.ejemplo.com/juego-matematicas',
    10, -- Edad recomendada
    1, -- ID de la categoría correspondiente
    1, -- ID del usuario que está añadiendo el juego
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/CODIGO.rar'), -- Ruta del archivo comprimido
    'En revisión',
    NOW() -- Fecha de creación
);
select * from categoria;
INSERT INTO califica (Puntuacion, id_juego, id_usuario)
VALUES (4, 1, 1);
INSERT INTO califica (Puntuacion, id_juego, id_usuario)
VALUES (5, 1, 2);
INSERT INTO califica (Puntuacion, id_juego, id_usuario)
VALUES (1, 1, 3);
select*from califica ;
select*from juegos;
ALTER TABLE juegos MODIFY imagen_juego LONGBLOB;
INSERT INTO juegos (
    nombre_juego,
    imagen_juego,
    Descripcion,
    url_juego,
    edad,
    id_categoria,
    id_usuario,
    archivo_comprimido,
    estado_revision,
    fecha_creacion
) VALUES (
    'ratataaaaaaaaapu',
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/h.jpg'), -- Ruta del archivo de imagen
    'Un juego educativo para aprender matemáticas básicas.',
    'https://www.ejemplo.com/juego-matematicas',
    5, -- Edad recomendada
    1, -- ID de la categoría correspondiente
    1, -- ID del usuario que está añadiendo el juego
    LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/CODIGO.rar'), -- Ruta del archivo comprimido
    'En revisión',
    NOW() -- Fecha de creación
);
select* from usuarios;
select* from categoria;
select * from juegos;
ALTER TABLE categoria
ADD imagen_categoria LONGBLOB AFTER nombre_categoria,
ADD descripcion_categoria VARCHAR(100) AFTER imagen_categoria;
CREATE TABLE favoritos (
    id_favorito INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_juego INT NOT NULL,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_juego) REFERENCES juegos(id_juego)
);
CREATE TABLE comentarios (
    id_comentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    comentario TEXT NOT NULL,
    fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL,
    id_juego INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_juego) REFERENCES juegos(id_juego)
);
CREATE TABLE historial_juego (
    id_historial INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_juego INT NOT NULL,
    fecha_juego TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_juego) REFERENCES juegos(id_juego)
);
-- Añadir 20 calificaciones a la tabla califica
INSERT INTO califica (Puntuacion, id_juego, id_usuario) VALUES 
(5, 3, 1),
(5, 3, 1),
(3, 3, 1),
(5, 3, 2),
(5, 3, 2),
(5, 4, 2),
(5, 4, 3),
(5, 4, 3),
(5, 4, 3),
(5, 5, 4),
(5, 5, 4),
(5, 5, 4),
(5, 5, 5),
(5, 5, 5),
(5, 5, 5),
(5, 5, 6),
(5, 5, 6),
(5, 3, 6),
(5, 1, 7),
(5, 2, 7);
CREATE VIEW juegos_populares AS
SELECT j.id_juego, j.nombre_juego, j.imagen_juego, j.Descripcion, c.nombre_categoria, AVG(cal.Puntuacion) AS promedio_puntuacion
FROM juegos j
JOIN categoria c ON j.id_categoria = c.id_categoria
JOIN califica cal ON j.id_juego = cal.id_juego
GROUP BY j.id_juego, j.nombre_juego, j.imagen_juego, j.Descripcion, c.nombre_categoria
HAVING promedio_puntuacion >= 4.5;
SELECT * FROM juegos_populares;
-- Añadir más calificaciones con puntuaciones altas
INSERT INTO califica (Puntuacion, id_juego, id_usuario) VALUES 
(5, 1, 8),
(5, 1, 9),
(5, 2, 10),
(5, 2, 11),
(4, 3, 12),
(5, 3, 13),
(5, 1, 14),
(5, 1, 15),
(5, 2, 16),
(5, 2, 17),
(4, 3, 18),
(5, 3, 19),
(5, 1, 20),
(5, 1, 21),
(5, 2, 22),
(5, 2, 23),
(4, 3, 24),
(5, 3, 25);
select * from juegos;




