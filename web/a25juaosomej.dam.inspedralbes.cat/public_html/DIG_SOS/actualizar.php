<?php
include("conexion.php");

$id        = (int) $_POST['id'];
$titol     = trim($_POST['titol']);
$developer = trim($_POST['developer']);
$any       = trim($_POST['any_llancament']);
$plataforma = trim($_POST['plataforma']);
$estat     = trim($_POST['estat']);
$genere    = isset($_POST['genere']) ? implode(',', $_POST['genere']) : '';
$puntuacio = intval($_POST['puntuacio']);
$notes     = trim($_POST['notes']);

if (empty($titol) || empty($plataforma)) {
    die("El títol i la plataforma són obligatoris.");
}

$stmt = mysqli_prepare($conn,
    "UPDATE jocs SET titol = ?, developer = ?, any_llancament = ?, plataforma = ?,
     estat = ?, genere = ?, puntuacio = ?, notes = ? WHERE id = ?"
);
mysqli_stmt_bind_param($stmt, "ssssssiis",
    $titol, $developer, $any, $plataforma, $estat, $genere, $puntuacio, $notes, $id
);
mysqli_stmt_execute($stmt);

header("Location: listar.php");
exit;
