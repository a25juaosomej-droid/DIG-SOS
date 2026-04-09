<?php

include("conexion.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email  = trim($_POST['email']);

    if (empty($nombre) || empty($email)) {
        $error = "Tots els camps són obligatoris.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El format de l'email no és vàlid.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nombre, $email);
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
    <title>Nou Usuari</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #0d1b2a;
            color: #c8d8ea;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(90deg, #1a2a6c, #1e4db7);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
        }

        header h1 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
        }

        header a.btn-nou {
            background: #1e4db7;
            color: #fff;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: .85rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, .25);
            transition: background .2s;
        }

        header a.btn-nou:hover {
            background: #2563eb;
        }

        .container {
            max-width: 820px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .container h2 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #e2eaf5;
            border-left: 3px solid #2563eb;
            padding-left: 12px;
        }

        .form-box {
            background: #12243a;
            border: 1px solid #1e3a5f;
            border-radius: 8px;
            padding: 28px 32px;
            max-width: 460px;
        }

        .form-box label {
            display: block;
            font-size: .82rem;
            font-weight: 500;
            color: #8aaac8;
            margin-bottom: 6px;
            margin-top: 16px;
        }

        .form-box label:first-of-type {
            margin-top: 0;
        }

        .form-box input {
            width: 100%;
            background: #0d1b2a;
            border: 1px solid #1e3a5f;
            border-radius: 6px;
            padding: 10px 14px;
            color: #c8d8ea;
            font-family: 'Poppins', sans-serif;
            font-size: .88rem;
            outline: none;
            transition: border .2s;
        }

        .form-box input:focus {
            border-color: #2563eb;
        }

        .form-box input::placeholder {
            color: #2e4a6a;
        }

        .form-btns {
            display: flex;
            gap: 10px;
            margin-top: 22px;
        }

        .btn-guardar {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 9px 20px;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-guardar:hover {
            background: #1d4ed8;
        }

        .btn-cancelar {
            background: transparent;
            color: #8aaac8;
            border: 1px solid #1e3a5f;
            padding: 9px 20px;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: .85rem;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            display: inline-block;
        }

        .btn-cancelar:hover {
            border-color: #2563eb;
            color: #c8d8ea;
        }

        .error {
            background: #1f1010;
            border: 1px solid #dc2626;
            color: #f87171;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: .85rem;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

<header>
    <h1>Llistat d'Usuaris</h1>
    <a href="listar.php" class="btn-nou">← Tornar</a>
</header>

<div class="container">
    <h2>Afegir usuari</h2>

    <div class="form-box">
        <?php if ($error !== "") { ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>

        <form method="POST" action="insertar.php">
            <label for="nombre">Nom</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ex: Joan García">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Ex: joan@exemple.com">

            <div class="form-btns">
                <button type="submit" class="btn-guardar">Guardar</button>
                <a href="listar.php" class="btn-cancelar">Cancel·lar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
