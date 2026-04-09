<?php

include("conexion.php");

$id = (int) $_GET['id'];

$sql  = "SELECT * FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row    = mysqli_fetch_assoc($result);

if (!$row) {
    die("Usuari no trobat.");
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuari</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: #0d1b2a; color: #c8d8ea; min-height: 100vh; }
        header { background: linear-gradient(90deg, #1a2a6c, #1e4db7); padding: 18px 32px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 10px rgba(0,0,0,.4); }
        header h1 { font-size: 1.1rem; font-weight: 600; color: #fff; }
        header a.btn-nou { background: #1e4db7; color: #fff; text-decoration: none; padding: 8px 18px; border-radius: 6px; font-size: .85rem; font-weight: 500; border: 1px solid rgba(255,255,255,.25); transition: background .2s; }
        header a.btn-nou:hover { background: #2563eb; }
        .container { max-width: 820px; margin: 40px auto; padding: 0 20px; }
        .container h2 { font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; color: #e2eaf5; border-left: 3px solid #2563eb; padding-left: 12px; }
        .form-box { background: #12243a; border: 1px solid #1e3a5f; border-radius: 8px; padding: 28px 32px; max-width: 460px; }
        .form-box label { display: block; font-size: .82rem; font-weight: 500; color: #8aaac8; margin-bottom: 6px; margin-top: 16px; }
        .form-box label:first-of-type { margin-top: 0; }
        .form-box input { width: 100%; background: #0d1b2a; border: 1px solid #1e3a5f; border-radius: 6px; padding: 10px 14px; color: #c8d8ea; font-family: 'Poppins', sans-serif; font-size: .88rem; outline: none; transition: border .2s; }
        .form-box input:focus { border-color: #2563eb; }
        .form-btns { display: flex; gap: 10px; margin-top: 22px; }
        .btn-guardar { background: #2563eb; color: #fff; border: none; padding: 9px 20px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: .85rem; font-weight: 600; cursor: pointer; transition: background .2s; text-decoration: none; display: inline-block; }
        .btn-guardar:hover { background: #1d4ed8; }
        .btn-cancelar { background: transparent; color: #8aaac8; border: 1px solid #1e3a5f; padding: 9px 20px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: .85rem; cursor: pointer; text-decoration: none; transition: all .2s; display: inline-block; }
        .btn-cancelar:hover { border-color: #2563eb; color: #c8d8ea; }
    </style>
</head>
<body>

<header>
    <h1>Llistat d'Usuaris</h1>
    <a href="listar.php" class="btn-nou">← Tornar</a>
</header>

<div class="container">
    <h2>Editar usuari</h2>

    <div class="form-box">
        <form method="POST" action="actualizar.php">
            <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>">

            <label for="nombre">Nom</label>
            <input type="text" id="nombre" name="nombre"
                   value="<?php echo htmlspecialchars($row['nombre']); ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   value="<?php echo htmlspecialchars($row['email']); ?>">

            <div class="form-btns">
                <button type="submit" class="btn-guardar">Actualitzar</button>
                <a href="listar.php" class="btn-cancelar">Cancel·lar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
