# GAME VAULT — CRUD PHP MySQLi

## Descripció

Aplicació web CRUD completa desenvolupada en PHP procedural amb MySQLi. Permet gestionar una biblioteca personal de videojocs (afegir, llistar, editar i eliminar) connectant-se a una base de dades MySQL en el servidor `dam.inspedralbes.cat`.

link: http://a25juaosomej.dam.inspedralbes.cat/DIG_SOS/listar.php

## Estructura del projecte

```
/DIG_SOS
  conexion.php      → Connexió a la base de dades
  index.php         → Redirecció a listar.php
  listar.php        → Llista tots els jocs de la biblioteca
  insertar.php      → Formulari i lògica per afegir un joc
  editar.php        → Formulari per editar un joc existent
  actualizar.php    → Lògica per actualitzar un joc
  eliminar.php      → Lògica per eliminar un joc
```

## Estructura de la base de dades

```sql
CREATE TABLE jocs (
    id              INT(11)      NOT NULL AUTO_INCREMENT,
    titol           VARCHAR(150) NOT NULL,
    developer       VARCHAR(100),
    any_llancament  VARCHAR(4),
    plataforma      VARCHAR(50)  NOT NULL,
    estat           VARCHAR(20)  DEFAULT 'Pendent',
    genere          VARCHAR(200),
    puntuacio       INT(2)       DEFAULT 0,
    notes           TEXT,
    PRIMARY KEY (id)
);
```

## Camps del formulari

| Camp | Tipus | Valors possibles |
|---|---|---|
| titol | text | Nom del joc |
| developer | text | Estudi / empresa |
| any_llancament | text | Any (ex: 2024) |
| plataforma | select | PC, PS5, PS4, Xbox Series, Xbox One, Nintendo Switch, Mòbil, Altres |
| estat | select | Pendent, Jugant, Completat, Abandonat, Platejat |
| genere | checkbox[] | Acció, RPG, Estratègia, Aventura, Esports, Terror, Plataformes, Simulació, Puzle |
| puntuacio | range | 0–10 |
| notes | textarea | Text lliure |

## Tecnologies utilitzades

* PHP (procedural)
* MySQLi (consultes preparades)
* HTML5 / CSS3
* Fonts: Orbitron + Share Tech Mono (Google Fonts)
* Servidor: dam.inspedralbes.cat
