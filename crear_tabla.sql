CREATE TABLE PERSONAS(
    ID_PERSONA INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    NOMBRE VARCHAR(64) NULL,
    APELLIDO VARCHAR(64) NULL, 
    EDAD INT NULL, 
    NACIMIENTO DATE NULL 
)

CREATE TABLE materiales(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    codigo VARCHAR(64) NULL,
    nombre VARCHAR(64) NULL,
    tipo   VARCHAR(64) NULL, 
    precio INT NULL
)


insert into materiales(codigo,nombre,tipo,precio)
values ('C01','Cemento','Polvo',900)
      ,('M01','Madera','Solido',500)
      ,('T01','Tornilos','Metalico',100)


CREATE TABLE cds(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    interpret VARCHAR(64) NULL,
    titel VARCHAR(64) NULL, 
    jahr INT NULL, 
    NACIMIENTO DATE NULL 
)


insert into cds(interpret,titel,jahr)
values('Paul Desmonds','Take five',1962)
     ,('Bart Howard','Fly Me to the Moon',1954)
     ,('Billy Streyhorn','The The A-Train',1951)     