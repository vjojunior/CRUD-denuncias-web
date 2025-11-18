CREATE DATABASE IF NOT EXISTS municipalidad;
USE municipalidad;

CREATE TABLE denuncias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    ubicacion VARCHAR(150) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    ciudadano VARCHAR(100) NOT NULL,
    telefono_ciudadano VARCHAR(15) NOT NULL,
    fecha_registro DATETIME NOT NULL
);
