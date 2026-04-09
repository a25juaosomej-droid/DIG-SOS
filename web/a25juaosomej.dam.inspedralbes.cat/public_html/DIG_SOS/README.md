# CRUD PHP MySQLi

## Descripció

Aplicació web CRUD completa desenvolupada en PHP procedural amb MySQLi. Permet gestionar usuaris (crear, llistar, editar i eliminar) connectant-se a una base de dades MySQL en el servidor `dam.inspedralbes.cat`.

link: http://a25juaosomej.dam.inspedralbes.cat/DIG_SOS/listar.php

## Estructura del projecte

```
/DIG_SOS
  conexion.php      → Connexió a la base de dades
  index.php         → Redirecció a listar.php
  listar.php        → Llista tots els usuaris
  insertar.php      → Formulari i lògica per afegir usuari
  editar.php        → Formulari per editar un usuari existent
  actualizar.php    → Lògica per actualitzar un usuari
  eliminar.php      → Lògica per eliminar un usuari
```

## Estructura de la base de dades

```sql
CREATE TABLE usuarios (
    id     INT(11)      NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email  VARCHAR(150) NOT NULL,
    PRIMARY KEY (id)
);
```

## Tecnologies utilitzades

- PHP (procedural)
- MySQLi (consultes preparades)
- HTML5 / CSS3
- Servidor: dam.inspedralbes.cat
