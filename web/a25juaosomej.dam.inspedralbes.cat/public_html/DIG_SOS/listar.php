<?php

include("conexion.php");

$sql    = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat d'Usuaris</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            background: #12243a;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #1e3a5f;
        }

        thead {
            background: #0d1b2a;
        }

        th {
            padding: 13px 18px;
            text-align: left;
            font-size: .75rem;
            font-weight: 600;
            color: #4d8bf5;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        td {
            padding: 13px 18px;
            font-size: .88rem;
            border-top: 1px solid #1e3a5f;
            color: #c8d8ea;
        }

        tbody tr:hover {
            background: #172f4a;
        }

        .btn-editar {
            background: transparent;
            border: 1px solid #2563eb;
            color: #4d8bf5;
            padding: 5px 14px;
            border-radius: 5px;
            font-size: .8rem;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            margin-right: 6px;
        }

        .btn-editar:hover {
            background: #2563eb;
            color: #fff;
        }

        .btn-eliminar {
            background: transparent;
            border: 1px solid #dc2626;
            color: #f87171;
            padding: 5px 14px;
            border-radius: 5px;
            font-size: .8rem;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-eliminar:hover {
            background: #dc2626;
            color: #fff;
        }

        .buit {
            text-align: center;
            padding: 40px;
            color: #2e4a6a;
            font-size: .88rem;
        }

        .buit a {
            color: #4d8bf5;
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>
    <h1>Llistat d'Usuaris</h1>
    <a href="insertar.php" class="btn-nou">+ Nou usuari</a>
</header>

<div class="container">
    <h2>Usuaris registrats</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) === 0) { ?>
            <tr>
                <td colspan="4">
                    <div class="buit">
                        No hi ha usuaris encara. <a href="insertar.php">Afegeix el primer</a>
                    </div>
                </td>
            </tr>
        <?php } else { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>
                    <a href="editar.php?id=<?php echo (int) $row['id']; ?>" class="btn-editar">Editar</a>
                    <a href="eliminar.php?id=<?php echo (int) $row['id']; ?>"
                       class="btn-eliminar"
                       onclick="return confirm('Segur que vols eliminar aquest usuari?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
