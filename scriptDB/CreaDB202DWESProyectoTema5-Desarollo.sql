
CREATE DATABASE IF NOT EXISTS DB202DWESProyectoTema5;

create user 'User202DWESProyectoTema5'@'%' IDENTIFIED BY 'paso';
grant all privileges on DB202DWESProyectoTema5.* to 'User202DWESProyectoTema5'@'%';

USE DB202DWESProyectoTema5;

/* Creamos la tabla Usuario*/

CREATE TABLE IF NOT EXISTS T01_Usuario (
    T01_CodUsuario VARCHAR(8) PRIMARY KEY,
    T01_Password VARCHAR(255) NOT NULL,
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT DEFAULT 0,
    T01_FechaHoraUltimaConexion INT,
    T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario', 
    T01_ImagenUsuario mediumblob
) ENGINE=INNODB;

/* Creamos la tabla Departamento*/

CREATE TABLE IF NOT EXISTS T02_Departamento (
    T02_CodDepartamento CHAR(3) PRIMARY KEY,
    T02_DescDepartamento VARCHAR(255) NOT NULL,
    T02_FechaCreacionDepartamento INT NOT NULL,
    T02_VolumenNegocio FLOAT NOT NULL,
    T02_FechaBajaDepartamento INT NULL
) ENGINE=INNODB;




