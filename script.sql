/*
    Sergio Matamoros Delgado
*/

CREATE DATABASE sergioTiendaFotos;

USE sergioTiendaFotos;

CREATE TABLE Usuarios(
    idUsuario smallint UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre varchar(50) NOT NULL,
    apellido varchar(50) NOT NULL,
    correo varchar(50) NOT NULL UNIQUE,
    pw varchar(255) NOT NULL,

    CONSTRAINT PK_idUsuario PRIMARY KEY (idUsuario)
);

CREATE TABLE Pedidos(
    idPedido smallint UNSIGNED NOT NULL AUTO_INCREMENT,
    idUsuario smallint UNSIGNED NOT NULL,
    nombreAlbum VARCHAR(50) NULL DEFAULT NULL,
    tipo char(2) NOT NULL CHECK(tipo='a' OR tipo='f'),
    fecha TIMESTAMP NOT NULL DEFAULT now(),

    CONSTRAINT PK_idPedido PRIMARY KEY (idPedido),
    CONSTRAINT FK_idUsuario FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

/* CREAR USUARIO Y PERMISOS*/
CREATE USER "2daw04Pruebas"@"localhost" IDENTIFIED BY 'Clave04';

/*
    Dar permisos al usuario
    Se le conceden los permisos de seleccionar, insertar, eliminar y actualizar
    Unicamente tendrá estos permisos en las tablas de empleados y cuentas, que son las que el 
    programa hace gestiones.
*/
GRANT SELECT, INSERT, DELETE, UPDATE, CREATE VIEW ON sergiotiendafotos.pedidos TO '2daw04Pruebas'@'localhost';
GRANT SELECT, INSERT, DELETE, UPDATE, CREATE VIEW ON sergiotiendafotos.usuarios TO '2daw04Pruebas'@'localhost';