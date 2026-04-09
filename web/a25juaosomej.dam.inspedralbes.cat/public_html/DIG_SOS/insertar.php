<?php

include("conexion.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titol      = trim($_POST['titol']);
    $developer  = trim($_POST['developer']);
    $any        = trim($_POST['any']);
    $plataforma = trim($_POST['plataforma']);
    $estat      = trim($_POST['estat']);
    $genere     = isset($_POST['genere']) ? implode(',', $_POST['genere']) : '';
    $puntuacio  = intval($_POST['puntuacio']);
    $notes      = trim($_POST['notes']);

    if (empty($titol) || empty($plataforma)) {
        $error = "El títol i la plataforma són obligatoris.";
    } else {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO jocs (titol, developer, any_llancament, plataforma, estat, genere, puntuacio, notes)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "ssssssiss",
            $titol, $developer, $any, $plataforma, $estat, $genere, $puntuacio, $notes
        );
        mysqli_stmt_execute($stmt);
        header("Location: listar.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir Joc — GAME VAULT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Share Tech Mono', monospace;
            background: #050a14;
            color: #e0d4ff;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: repeating-linear-gradient(
                0deg, transparent, transparent 3px,
                rgba(0,0,0,0.04) 3px, rgba(0,0,0,0.04) 4px
            );
            pointer-events: none;
            z-index: 999;
        }

        header {
            background: #050a14;
            border-bottom: 2px solid #a855f7;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        header::after {
            content: '';
            position: absolute;
            bottom: -6px; left: 0; right: 0;
            height: 2px;
            background: #ff6b00;
            opacity: .5;
        }

        .logo {
            font-family: 'Orbitron', monospace;
            font-size: 1rem;
            font-weight: 900;
            color: #a855f7;
            letter-spacing: 3px;
        }

        .logo span { color: #ff6b00; }

        header a.btn-back {
            background: transparent;
            border: 1px solid #a855f7;
            color: #a855f7;
            text-decoration: none;
            padding: 6px 16px;
            font-family: 'Share Tech Mono', monospace;
            font-size: .8rem;
            letter-spacing: 1px;
            transition: background .2s;
        }

        header a.btn-back:hover { background: rgba(168,85,247,.1); }

        .container { max-width: 540px; margin: 40px auto; padding: 0 20px; }

        .eyebrow { font-size: .7rem; color: #a855f7; opacity: .6; letter-spacing: 3px; margin-bottom: 4px; }

        .page-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.1rem;
            font-weight: 900;
            color: #ff6b00;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .page-subtitle {
            font-size: .72rem;
            color: #a855f7;
            opacity: .5;
            letter-spacing: 2px;
            margin-bottom: 28px;
        }

        .blink { animation: blink 1.2s step-end infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

        .form-box {
            background: #07111f;
            border: 1px solid #a855f7;
            padding: 28px;
            position: relative;
        }

        .form-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #a855f7, #ff6b00);
        }

        .form-box::after {
            content: 'GAME_ENTRY_FORM_v2.4';
            position: absolute;
            top: 10px; right: 14px;
