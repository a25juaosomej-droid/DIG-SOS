<?php
// GAME VAULT — Connexió a la base de dades
$host     = "localhost";
$user     = "a25juaosomej_52";
$password = "InsPedralbes2025";
$database = "a25juaosomej_52";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error de connexió: " . mysqli_connect_error());
}
