CREATE DATABASE IF NOT EXISTS LIBRERIA;
USE LIBRERIA;

CREATE TABLE USUARIOS (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  contraseña TEXT,
  direccion VARCHAR(255),
  telefono VARCHAR(20)
);

CREATE TABLE LIBROS (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255),
  autor VARCHAR(100),
  precio DECIMAL(10, 2),
  cantidad INT
);

CREATE TABLE CARRITO (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  libro_id INT,
  cantidad INT,
  monto_total DECIMAL(10, 2),
  FOREIGN KEY (usuario_id) REFERENCES USUARIOS(ID),
  FOREIGN KEY (libro_id) REFERENCES LIBROS(ID)
);
