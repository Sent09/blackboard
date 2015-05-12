CREATE DATABASE blackboard;

USE blackboard;

CREATE TABLE usuario (
    login VARCHAR(30) NOT NULL PRIMARY KEY,
    clave VARCHAR(40) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(60) NOT NULL,
    email VARCHAR(40) NOT NULL,
    fechaalta DATE NOT NULL,
    isactivo TINYINT(1) NOT NULL default 0,
    isroot TINYINT(1) NOT NULL default 0,
    rol ENUM('administrador','usuario') NOT NULL default 'usuario',
    fechalogin DATETIME,
    urlfoto VARCHAR(60)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;

CREATE TABLE post (
    idpost INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(200) NOT NULL,
    gusta INT,
    fechapost DATETIME,
    login VARCHAR(30) NOT NULL,
    FOREIGN KEY (login) REFERENCES usuario(login)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;

CREATE TABLE archivospost (
    idarchivospost INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(60) NOT NULL,
    extension VARCHAR(10) NOT NULL,
    idpost INT NOT NULL,
    FOREIGN KEY (idpost) REFERENCES post(idpost)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;

CREATE TABLE notificaciones (
    idnotificaciones INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    loginusuario varchar(30) NOT NULL,
    loginusuarioseguido varchar(30) NOT NULL,
    nuevosposts INT NOT NULL,
    FOREIGN KEY (loginusuario) REFERENCES usuario(login),
    FOREIGN KEY (loginusuarioseguido) REFERENCES usuario(login)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;

CREATE TABLE megusta (
    login VARCHAR(30) NOT NULL,
    idpost INT NOT NULL,
    FOREIGN KEY (login) REFERENCES usuario(login),
    FOREIGN KEY (idpost) REFERENCES post(idpost)
)engine=innodb charset=utf8 collate=utf8_unicode_ci;