<?php

include("conexion.php");

$id     = (int) $_POST['id'];
$nombre = trim($_POST['nombre']);
$email  = trim($_POST['email']);

if (empty($nombre) || empty($email)) {
    die("Tots els camps són obligatoris.");
}

$stmt = mysqli_prepare($conn, "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);
mysqli_stmt_execute($stmt);

header("Location: listar.php");
exit;
